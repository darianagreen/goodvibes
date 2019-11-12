<?php
require_once("includes/config.php");
require_once("includes/classes/SpotifyApi.php");
$action = isset($_GET['action']) ? $_GET['action'] : null ;
$api = new SpotifyAPI();

switch($action)
{
    case 'login':
        $api->login();
        break;
    case 'callback':
        $api->callback();
        break;
    case 'search':
        $api->search($_GET['query'], $_GET['type']);
        break;
    default:
        die('Invalid request');
        break;
}
