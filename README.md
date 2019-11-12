### Setup
Set parameters of your spotify app in file:
includes/classes/SpotifyApi.php

```
const CLIENT_ID = 'app id';
const CLIENT_SECRET = 'app secret';
const REDIRECT_URI = 'http://localhost:8080/goodVibes/api.php?action=callback';

```
Set parameters in your application on developer dashboard on Spotify. Please change URI to 'http://localhost:8080/goodVibes/api.php?action=callback' 

```
the project must be run in the subfolder http://localhost:8080/goodVibes/index.php