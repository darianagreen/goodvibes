<?php
include("includes/config.php");
if (!isset($_SESSION['userLoggedIn'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: register.php');
    exit;
}

include("includes/header.php");

if(isset($_SESSION['userLoggedIn'])) {
	$userLoggedIn = $_SESSION['userLoggedIn'];
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

		<?php include("includes/navBarContainer.php") ?>

		<div id="rightSpace">

			<div id ="mainContent">
				<h1 class="pageHeadingBig">Albums</h1>
				<div class="gridViewContainer albums">
					<?php 
					$albumQuery = mysqli_query($con, "SELECT * from albums ORDER BY RAND() LIMIT 10");
					while($row = mysqli_fetch_array($albumQuery)) {


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
				<h2 class="pageHeadingBig">Tracks</h2>
				<div class="gridViewContainer tracks">
				</div>
			</div>
		</div>	
	</div>


	

	<iframe id="framePlayer" src="https://open.spotify.com/embed/track/2QbGvQssb0VLLS4x5NOmyJ"  width="100%" height="90" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
	<!-- <div id="musicPlayer"> 
		<?php include("includes/nowPlayingBar.php") ?>
	</div> -->

</main>
<script src="assets/js/script.js"></script>
</body>

</html>