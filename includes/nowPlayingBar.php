<?php
$songQuery = mysqli_query($con, "SELECT id FROM Songs ORDER BY RAND() LIMIT 10");

$resultArray = array();

while($row = mysqli_fetch_array($songQuery)) {
	array_push($resultArray, $row['id']);
}

$jsonArray = json_encode($resultArray);
?>

<script>

$(document).ready(function() {
	currentPlaylist = <?php echo $jsonArray; ?>;
	audioElement = new Audio();
	setTrack(currentPlaylist[0], currentPlaylist, false);
});


function setTrack(trackId, newPlaylist, play) {

	audioElement.setTrack("assets/music/bensound-clearday.mp3");

	if(play == true) {
		audioElement.play();
	}
}

function playSong() {
	$(".controlButton.play").hide();
	$(".controlButton.pause").show();
	audioElement.play();
}

function pauseSong() {
	$(".controlButton.play").show();
	$(".controlButton.pause").hide();
	audioElement.pause();
}

</script>


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

            <button class="controlButton shuffle" title="Shuffle button">
						<img src="assets/images/icons/shuffle.png" alt="Shuffle">
					</button>

					<button class="controlButton previous" title="Previous button">
						<img src="assets/images/icons/previous.png" alt="Previous">
					</button>

					<button class="controlButton play" title="Play button" onclick="playSong()">
						<img src="assets/images/icons/play2.png" alt="Play">
					</button>

					<button class="controlButton pause" title="Pause button" style="display: none;" onclick="pauseSong()">
						<img src="assets/images/icons/pause.png" alt="Pause">
					</button>

					<button class="controlButton next" title="Next button">
						<img src="assets/images/icons/forward.png" alt="Next">
					</button>

					<button class="controlButton repeat" title="Repeat button">
						<img src="assets/images/icons/repeat.png" alt="Repeat">
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
