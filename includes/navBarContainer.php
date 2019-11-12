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
                <a class="navItemLink" href="/goodVibes/api.php?action=login">
                <span id="moreMusic">Want more music? </span> <?php echo isset($_SESSION['access_token'])? '<br>Search for albums or songs!' : '<button id="connectSpotify" display="inline">Connect to Spotify!</button>'; ?>
                </a>
            </div>
            <?php if (isset($_SESSION['userLoggedIn'])) { ?>
                <div class="navItem"> 
                    <a class="navItemLink" href="logout.php">Logout</a>
                </div>
            <?php } ?>
           <!-- <div class="navItem"> 
                <a class="navItemLink" href="browse.php"> Browse </a>
            </div>

            <div class="navItem"> 
                <a class="navItemLink" href="music.php"> Your Music </a>
            </div>

            <div class="navItem"> 
                <a class="navItemLink" href="profile.php"> RK800 </a>
            </div> -->
        </div>

    </nav>

</div>