<?php
include("includes/config.php");
session_destroy();

if(isset($_SESSION['userLoggedIn'])) {
	$userLoggedIn = $_SESSION['userLoggedIn'];
}
else {
	header("Location: register.php");
}

?>

<html>
<head>
	<title>Welcome to Slotify!</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			crossorigin="anonymous"></script>
			<script src="https://unpkg.com/axios/dist/axios.min.js"></script>  

</head>

<body>	
<main>

	<div id="mainSpace"> 

		<div id="leftBar">
			<nav class="navBar">
				<a href="index.php" class="logo">
					<img src="assets/images/icons/beats_logo.gif">
				</a>

			<div class="groupLeftMenu">
				<img src="assets/images/icons/search.png" alt="search">
					<div class="navItem"> 
						<input id="search" type="text" placeholder="SEARCH">
		
					</div>
			</div>

			<div class="groupLeftMenu2">
					<div class="navItem"> 
						<a class="navItemLink" href="browse.php"> Browse </a>
					</div>

					<div class="navItem"> 
						<a class="navItemLink" href="music.php"> Your Music </a>
					</div>

					<div class="navItem"> 
						<a class="navItemLink" href="profile.php"> RK800 </a>
					</div>
			</div>

			</nav>

		</div>

		<div id="rightSpace">
		Recomendamos ahora
		<div id ="result"></div>
		</div>	

		
	</div>

	<div id="musicPlayer"> 

		<div id="nowPlayingBar">
	
			<div id="nowPlayingBarLeft">

				<div class="leftBarContent">
					<span class="albumLink">
						<img  class="albumArtwork" src="assets/images/icons/add_album.png">
					</span>

					<div class="trackInfo">

						<span class="trackName">
							<span>Connor Theme</span>
						</span>

						<span class="artistkName">
							<span>Nima Fakhara</span>
						</span>

					</div>
					

				</div>
			</div>

			<div id="nowPlayingBarCenter">

				<div class="content playerControls">
						<div class="buttons">

								<button class="controlButton shuffle" title="Shuffle Button">
								<img src="assets/images/icons/shuffle.png" alt="shuffle">
								</button>

								<button class="controlButton previous" title="Previous Button">
								<img src="assets/images/icons/previous.png" alt="previous song">
								</button>

								<button class="controlButton pause" title="Pause Button">
								<img src="" alt="pause" style="display: none;">
								</button>

								<button class="controlButton play" title="Play Button">
								<img src="assets/images/icons/play2.png" alt="play">
								</button>

								<button class="controlButton pause" title="Pause Button">
								<img src="assets/images/icons/pause.png" alt="pause" style="display: none;">
								</button>

								<button class="controlButton forward" title="Forward Button">
								<img src="assets/images/icons/forward.png" alt="next song">
								</button>

								<button class="controlButton repeat" title="Repeat Button">
								<img src="assets/images/icons/repeat.png" alt="repeat">
								</button>
						</div>

						<div class="playbackBar">

								<span class="progressTime current">0.00</span>

								<div class="progressBar">
										<div class="progressBarBg">
												<div class="progress">
												</div>
										</div>
								</div>
								<span class="progressTime remaining">0.00</span>
						</div>
				</div>

			</div>

			<div id="nowPlayingBarRight">

				<div class="volumeBar">
					<button class="controlButton volume" title="Volume Button">
						<img src="assets/images/icons/volume.png" alt="volume">
					</button>
					<div class="progressBar">
							<div class="progressBarBg">
								<div class="progress">
								</div>
							</div>
				</div>
				
			</div>

		</div>

		</div>

</main>
<script src="assets/js/app.js"></script>
<script src="assets/js/script.js"></script>
</body>

</html>