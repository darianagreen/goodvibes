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
})();

function spotifySearch(query, accessToken) {
    axios({
        url: "https://api.spotify.com/v1/search",
        method: "GET",
        params: {
            q: query,
            type: 'track,artist',
            limit: 10
        },
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/x-www-form-urlencoded",
            'Authorization': 'Bearer ' + accessToken
        }
    }).then(function (response) {
        console.log('Success..');
        $('#result').empty();

        if (response.data.artists) {
            var artists = response.data.artists.items;
            for (var k in artists) {
                $('#result').append(
                    $('<div/>', { html: 'Artist: ' + artists[k].name + ' #id: '+ artists[k].id } )
                );
            }
        }

        if (response.data.tracks) {
            var tracks = response.data.tracks.items;
            for (var k in tracks) {
                console.log(tracks[k]);
                $('#result').append(
                    '<div>Item: ' + tracks[k].name+' #Id: ' + tracks[k].id 
                    + ' <img src="'+tracks[k].album.images[0].url+'">' 
                    + ' </div>'
                );
            }
        }

    }).catch(function (error) {
        console.log('Error!!');
    });
}
