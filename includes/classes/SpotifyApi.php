<?php
class SpotifyAPI 
{
    const CLIENT_ID = 'c83f6c3553154326b9bd207da47e0282';
    const CLIENT_SECRET = '294bdea15a7b45a4b68a00414e6aaf74';
    const REDIRECT_URI = 'http://localhost:8080/goodVibes/api.php?action=callback';

    private $lastResponse;
    private $code = null;

    public function login()
    {
        $state = $this->generateRandomString();
        $_SESSION['spotify_auth_state'] = $state;
        $query = http_build_query([
            'response_type' => 'code',
            'client_id' => self::CLIENT_ID,
            'scope' => 'streaming user-read-private user-read-email',
            'redirect_uri' => self::REDIRECT_URI,
            'state' => $state,
        ]);
        header("Location: https://accounts.spotify.com/authorize?{$query}");
    }

    public function callback()
    {
        $code = isset($_GET['code']) ? $_GET['code'] : null;
        $state = isset($_GET['state']) ? $_GET['state'] : null;

        $this->code = $code;

        if ($code !== null and $state !== null) {
            $token = $this->getAccessToken();
            // var_dump($token); exit;
        }
        header("Location: /goodVibes/index.php");
        exit;
    }

    private function getAccessToken()
    {
        if (!isset($_SESSION['access_token'])) {
            $response = $this->send('POST', 'https://accounts.spotify.com/api/token', [
                'code'          => $this->code,
                'redirect_uri'  => self::REDIRECT_URI,
                'grant_type'    => 'authorization_code'
            ], [
                'Authorization' => 'Basic '.base64_encode(self::CLIENT_ID. ':'.self::CLIENT_SECRET),
                // 'Content-Type' => 'application/json',
                // 'Accept' => 'application/json'
            ] );

            list($reponseHeaders, $body) = explode("\r\n\r\n", $response, 2);
            $jsonBody = json_decode($body);

            //var_dump( $jsonBody->access_token);
    
            // $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
            // $headers = $this->parseHeaders($headers);
            // $this->lastResponse = [
            //     'headers' => $headers,
            //     'status' => $status,
            //     'url' => $url,
            // ];
            // // Run this here since we might throw
            // $body = $this->parseBody($body, $status);
    
            if (isset($jsonBody->access_token)) {
                $_SESSION['access_token'] = $jsonBody->access_token;
                $_SESSION['refresh_token'] = $jsonBody->refresh_token;            
            }
        }
        return $_SESSION['access_token'];
    }

    public function search($query, $type, $limit=10)
    {
        $response = $this->send('GET', 'https://api.spotify.com/v1/search', [
            'q'     => $query,
            'type'  => $type,
            'limit' => $limit
        ], [
            "Accept" => "application/json",
            "Content-Type" => "application/x-www-form-urlencoded",
            'Authorization' => 'Bearer ' . $this->getAccessToken()
            // 'Content-Type' => 'application/json',
            // 'Accept' => 'application/json'
        ] );

        list($reponseHeaders, $body) = explode("\r\n\r\n", $response, 2);
        $jsonBody = json_decode($body,true);
        header('Content-type: application/json');
        echo json_encode( $jsonBody );
    }

    private function send($method, $url, $parameters = [], $headers = [])
    {
        // Reset any old responses
        $this->lastResponse = [];
        // Sometimes a stringified JSON object is passed
        if (is_array($parameters) || is_object($parameters)) {
            $parameters = http_build_query($parameters);
        }
        $mergedHeaders = [];
        foreach ($headers as $key => $val) {
            $mergedHeaders[] = "$key: $val";
        }

        $options = [
            CURLOPT_HEADER => true,
            CURLOPT_HTTPHEADER => $mergedHeaders,
            CURLOPT_RETURNTRANSFER => true,
        ];
        
        $url = rtrim($url, '/');
        $method = strtoupper($method);

        switch ($method) {
            case 'DELETE': // No break
            case 'PUT':
                $options[CURLOPT_CUSTOMREQUEST] = $method;
                $options[CURLOPT_POSTFIELDS] = $parameters;
                break;
            case 'POST':
                $options[CURLOPT_POST] = true;
                $options[CURLOPT_POSTFIELDS] = $parameters;
                break;
            default:
                $options[CURLOPT_CUSTOMREQUEST] = $method;
                if ($parameters) {
                    $url .= '/?' . $parameters;
                }
                break;
        }

        $options[CURLOPT_URL] = $url;
        $ch = curl_init();
        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        if (curl_error($ch)) {
            throw new \Exception('cURL transport error: ' . curl_errno($ch) . ' ' .  curl_error($ch));
        }

        curl_close($ch);
        return $response;

        // Skip the first set of headers for proxied requests
        // if (preg_match("/^HTTP\/1\.\d 200 Connection established$/", $headers) === 1) {
        //     list($headers, $body) = explode("\r\n\r\n", $body, 2);
        // }

        
    }

    private function generateRandomString()
    {
        $bytes = random_bytes(10);
        return bin2hex($bytes);
    }

    /*protected function authHeaders($headers = [])
    {
        if ($this->session) {
            $accessToken = $this->session->getAccessToken();
        } else {
            $accessToken = $this->accessToken;
        }
        if ($accessToken) {
            $headers = array_merge($headers, [
                'Authorization' => 'Bearer ' . $accessToken,
            ]);
        }
        return $headers;
    }*/

    private function sendRequest($method, $uri, $parameters = [], $headers = [])
    {        
        try {
            return $this->apiRequest($method, $uri, $parameters, $headers);
        } catch (\Exception $e) {
            if ($this->options['auto_refresh'] && $e->hasExpiredToken()) {
                $result = $this->session->refreshAccessToken();
                if (!$result) {
                    throw new \Exception('Could not refresh access token.');
                }
                $headers = $this->authHeaders($headers);
                return $this->sendRequest($method, $uri, $parameters, $headers);
            } elseif ($this->options['auto_retry'] && $e->isRateLimited()) {
                $lastResponse = $this->request->getLastResponse();
                $retryAfter = (int) $lastResponse['headers']['Retry-After'];
                sleep($retryAfter);
                return $this->sendRequest($method, $uri, $parameters, $headers);
            }
            throw $e;
        }
    }

    private function apiRequest($method, $url, $parameters = [], $headers = [])
    {
        // Reset any old responses
        $this->lastResponse = [];
        // Sometimes a stringified JSON object is passed
        if (is_array($parameters) || is_object($parameters)) {
            $parameters = http_build_query($parameters);
        }
        $mergedHeaders = [];
        foreach ($headers as $key => $val) {
            $mergedHeaders[] = "$key: $val";
        }
        $options = [
            // CURLOPT_CAINFO => __DIR__ . '/cacert.pem',
            // CURLOPT_ENCODING => '',
            // CURLOPT_HEADER => true,
            // CURLOPT_HTTPHEADER => $mergedHeaders,
            CURLOPT_RETURNTRANSFER => true,
        ];
        $url = rtrim($url, '/');
        $method = strtoupper($method);
        switch ($method) {
            case 'DELETE': // No break
            case 'PUT':
                $options[CURLOPT_CUSTOMREQUEST] = $method;
                $options[CURLOPT_POSTFIELDS] = $parameters;
                break;
            case 'POST':
                $options[CURLOPT_POST] = true;
                $options[CURLOPT_POSTFIELDS] = $parameters;
                break;
            default:
                $options[CURLOPT_CUSTOMREQUEST] = $method;
                if ($parameters) {
                    $url .= '/?' . $parameters;
                }
                break;
        }
        $options[CURLOPT_URL] = $url;
        $ch = curl_init();
        curl_setopt_array($ch, array_replace($options, $this->curlOptions));
        $response = curl_exec($ch);
        if (curl_error($ch)) {
            throw new \Exception('cURL transport error: ' . curl_errno($ch) . ' ' .  curl_error($ch));
        }
        list($headers, $body) = explode("\r\n\r\n", $response, 2);
        // Skip the first set of headers for proxied requests
        if (preg_match('/^HTTP\/1\.\d 200 Connection established$/', $headers) === 1) {
            list($headers, $body) = explode("\r\n\r\n", $body, 2);
        }
        $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headers = $this->parseHeaders($headers);
        $this->lastResponse = [
            'headers' => $headers,
            'status' => $status,
            'url' => $url,
        ];
        // Run this here since we might throw
        $body = $this->parseBody($body, $status);
        curl_close($ch);
        return $this->lastResponse;
    }
}
