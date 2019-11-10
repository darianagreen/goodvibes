
<?php
include("includes/handlers/header.php");
include("includes/config.php");
include("includes/classes/Artist.php");
include("includes/classes/Album.php");
include("includes/classes/Song.php");



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

        <?php 
        if(isset($_GET['id'])) {
            $albumId = $_GET['id'];
        }
        else {
             header("Location: index.php");
        }
        
    
        $album = new Album($con, $albumId);
        $artist = $album->getArtist();
        ?>

			<div id ="mainContent">
            
                <div class="entityInfo">

                    <div class="leftSection">
                         <img src="<?php echo $album->getArtworkPath(); ?>">
                         <h2><?php echo $album->getTitle(); ?></h2>
                            <span>By <?php echo $artist->getName(); ?></span>
                           
                    </div>

                    <div class="rightSection">
                            <h2 id="songsList"> Songs </h2>
                            <div class="tracklistContainer">
                            <ul class="tracklist">
		
		<?php
		$songIdArray = $album->getSongIds();

		$i = 1;
		foreach($songIdArray as $songId) {

			$albumSong = new Song($con, $songId);
			$albumArtist = $albumSong->getArtist();

			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src='assets/images/icons/play_white2.png'>
						<span class='trackNumber'>$i</span>
                    </div>
                    
                    <div class='trackInfo'>
                    <span class='trackName'>" . $albumSong->getTitle() . "</span>
                    <span class='artistName'>" . $albumArtist->getName() . "</span>
                </div>

                <div class='trackOptions'>
                    <img class='optionsButton' src='assets/images/icons/more.png'>
                </div>

                <div class='trackDuration'>
                    <span class='duration'>" . $albumSong->getDuration() . "</span>
                </div>

				</li>";

			$i = $i + 1;



		}

		?>



	</ul>

                            </div>
                           
                    </div>

                </div>

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