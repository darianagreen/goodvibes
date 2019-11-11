<?php
include("includes/handlers/header.php");
include("includes/config.php");
session_destroy();

if(isset($_SESSION['userLoggedIn'])) {
	$userLoggedIn = $_SESSION['userLoggedIn'];
}
?>

<html>
<head>
	<title>Welcome to Slotify!</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="assets/js/player.js"></script> 
			<script src="https://unpkg.com/axios/dist/axios.min.js"></script>  

</head>

<body>	
<main>

	<div id="mainSpace"> 

		<?php include("includes/navBarContainer.php") ?>

		<div id="rightSpace">

			<div id ="mainContent">
			<h2 class="pageHeadingBig">You might also like</h2>
				<div class="gridViewContainer">
					<?php 
					$albumQuery = mysqli_query($con, "SELECT * from albums ORDER BY RAND() LIMIT 10");
					while($row =mysqli_fetch_array($albumQuery)) {


						echo "<div class='gridViewItem'>
							<a href='album.php?id=" . $row['id'] . "'>
								<img src='" . $row['artworkPath'] . "'>
								
								<div class='gridViewInfo'>
								" . $row['title'] . "
								</div>
							</a>
							</div>";
					}
					?>

				</div>

			</div>
		</div>	
	</div>


	


	<div id="musicPlayer"> 
		<?php include("includes/nowPlayingBar.php") ?>
	</div>

</main>
<script src="assets/js/app.js"></script>
<script src="assets/js/script.js"></script>
</body>

</html>