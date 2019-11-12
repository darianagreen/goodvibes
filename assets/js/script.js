var requestTimeout = null;

//var userInput  = document.getElementById('search').value 

(function() {
    const urlParams = new URLSearchParams(window.location.search);
    const accessToken = urlParams.get('access_token');
    console.log( accessToken );


    $('#search').on('keyup', function(){
        if (requestTimeout !== null) {
            clearTimeout(requestTimeout);
        }

        console.log('Searching....');

        var el = $(this);
        requestTimeout = setTimeout(() => {
            spotifySearch(document.getElementById('search').value, accessToken);
        }, 2000);
    });

    $('.gridViewContainer').on('click', '.gridViewItem a', function(){
        $('#framePlayer').attr('src', 'https://open.spotify.com/embed/' +$(this).data('play'));
    });
})();

function spotifySearch(query, accessToken) {
    axios({
        url: "api.php?action=search",
        method: "GET",
        params: {
            query: query,
            type: 'track,artist,album',
            limit: 10
        },
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/x-www-form-urlencoded"
        }
    }).then(function (response) {
        console.log('Success..');

        if (response.data.albums) {
            var albums = response.data.albums.items;
            html = '';
            for (var k in albums) {
                html += getAlbumTemplate(albums[k]);
            }
            $('.gridViewContainer.albums').empty()
            $('.gridViewContainer.albums').append(html);
        }

        if (response.data.tracks) {
            var tracks = response.data.tracks.items;
            html = '';
            for (var k in tracks) {
                html += getTrackTemplate(tracks[k]);
            }
            $('.gridViewContainer.tracks').empty()
            $('.gridViewContainer.tracks').append(html);
        }

    }).catch(function (error) {
        console.log('Error!!');
    });
}



function getAlbumTemplate(album){
    // console.log('Album', album)    
    return `
<div class="gridViewItem">
    <a href="#${album.id}" data-play="album/${album.id}">
        <img src="${album.images[0].url}">
    </a>
    <div class='gridViewInfo'>
        ${album.name}
    </div>
</div>
`
}

function getTrackTemplate(track){
    // console.log('Track', track.id, track.name, track.album.images[0].url)
    
    return `
<div class="gridViewItem">
    <a href="#${track.id}" data-play="track/${track.id}">
        <img src="${track.album.images[0].url}">
    </a>
    <div class='gridViewInfo'>
        ${track.name}
    </div>
</div>
`
}


