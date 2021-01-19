$(document).ready(function () {
    let pageNumber = 0;
    isAdmin = false;
    isSetupTracks = false;

    //tracks nav button
    $('#tracks-nav').on('click', function () {
        $('#artists-div').hide();
        $('#albums-div').hide();
        $('#cart-div').hide();
        $('#account-div').hide();
        getTracks();
    });

    // create btn
    $('#tracks-table').on('click', '.create-btn', function () {
        $('#createTrack-modal').modal('show');
    });

    // create btn submit
    $('#submitTrack').on('click', function () {
        let createUrl = './api/tracks/create.php';

        let trackTitle = $('#trackTitle-inp').val().trim();
        let trackAlbumId = $('#trackAlbumId-inp').val().trim();
        let mediaTypeId = $('#MediaTypeId-inp').val().trim();
        let trackGenreId = $('#trackGenreId-inp').val().trim();
        let trackComposer = $('#trackComposer-inp').val().trim();
        let trackMilliseconds = $('#trackMilliseconds-inp').val().trim();
        let trackBytes = $('#trackBytes-inp').val().trim();
        let trackUnitPrice = $('#trackUnitPrice-inp').val().trim();
  
        if (!isNaN(parseFloat(trackUnitPrice) && parseFloat(trackAlbumId) && parseFloat(mediaTypeId) && 
            parseFloat(trackGenreId) && parseFloat(trackMilliseconds) && parseFloat(trackBytes))) {
            
            if (trackTitle != "" && trackAlbumId != "" && mediaTypeId != "" && trackGenreId != "" && trackComposer != "" 
            && trackMilliseconds != "" && trackBytes != "") {
                $.ajax({
                    url: createUrl,
                    type: 'POST',
                    data: JSON.stringify({
                        name: trackTitle,
                        albumId: trackAlbumId,
                        mediaTypeId: mediaTypeId,
                        genreId: trackGenreId,
                        composer: trackComposer,
                        milliseconds: trackMilliseconds,
                        bytes: trackBytes,
                        unitPrice: trackUnitPrice,
                    }),
                    success: function (data) {
                        console.log('success');
                        $('#createTrack-modal').modal('hide');
                    },
                    failure: function (errMsg) {
                        console.log('failure creating');
                    },
                    error: function (e) {
                        console.log('error');
                    }
                })
            } else {
                alert('Fill out all fields please');
            };  
        } else {
            alert("Price, id's, bytes and milliseconds has to be numeric");
        }
    });

    // delete btn
    $("#tracks-table").on('click', '.delete-btn', function () {
        let trackName = this.getAttribute('data-trackName');
        let id = this.getAttribute('data-trackId');

        $('#trackId-delInp').val(id);
        $('#confirm-delete-track').html('Sure you want to delete "' + trackName + '"');
        $("#deleteTrack-modal").modal('show');
    });

    // delete btn submit
    $('#deleteTrack-confirm').on('click', function() {
        let deleteTrackUrl = './api/tracks/delete.php'
        let id = $('#trackId-delInp').val().trim();

        $.ajax({
            url: deleteTrackUrl,
            type: 'POST',
            data: JSON.stringify({
                id: id
            }),
            success: function (data) {
                $('#deleteTrack-modal').modal('hide');
                getTracks();
            },
            failure: function (errMsg) {
                console.log('failure delete');
            },
            error: function (e) {
                console.log('error:',  e);
                alert('Possible constraint violation. No deletions were made');
            }
        });
    });

    // update btn
    $('#tracks-table').on('click', '.update-btn', function(){
        let id = this.getAttribute('data-trackId');
        $('#trackId-inp').val(id);
        // console.log(this.getAttribute('data-trackName'))
        // console.log(this.getAttribute('data-trackTitle'))
        $('#trackTitleUpdate-inp').val(this.getAttribute('data-trackTitle'));
        // $('#trackTitle-inp').val(this.getAttribute('data-trackTitle'));
        $('#trackAlbum-inp').val(this.getAttribute('data-trackAlbum'));
        $('#trackArtist-inp').val(this.getAttribute('data-trackArtist'));
        $('#trackGenre-inp').val(this.getAttribute('data-trackGenre'));
        $('#trackPrice-inp').val(this.getAttribute('data-trackPrice'));
        $('#updateTrack-modal').modal('show');
    });

    //update submit
    //TODO

    // add to cart
    $('#tracks-table').on('click', '.addToCart-btn', function() {
        let id = this.getAttribute('data-trackId');
        let title = this.getAttribute('data-title');
        let artist = this.getAttribute('data-artist');
        let price = this.getAttribute('data-price');

        //products array instantiated in head of html
        products.push({'id':id, 'title':title, 'price':price, 'artist':artist});

    });

    // Get tracks
    function getTracks() {
        let getParam = '/?page=' + pageNumber;
        getTracksURL = './api/tracks/read.php'

        $.ajax({
            url: getTracksURL + getParam,
            type: 'get',
            success: function (res) {

                if (res['admin'] == 'YES') {
                    isAdmin = true;
                } else {
                    console.log('No admin');
                };

                setupTracksTable(res['data']);
            },
            failure: function (errMsg) {
                console.log(errMsg);
            }, error: function (e) {
                console.log('error', e);
            }
        });
    }

    // Table setup
    function setupTracksTable(data) {
        let tRow = '';
        
        console.log(data);

        if (isAdmin == true && !isSetupTracks) {
            isSetupTracks = true;
            let createBtn = `&nbsp <button id="create-btn" class="btn btn-success create-btn">Create tracks</button>`;
            $('#tracks-table').find('#options-th').append(createBtn);
        } 
        
        data.forEach(e => {
            let trackId = e.trackId; 
            let title = '<td>' + e.title + '</td>';
            let artist = '<td>' + e.artist + '</td>';
            let album = '<td>' + e.album + '</td>';
            let genre = '<td>' + e.genre + '</td>';
            let price = '<td>' + e.price + '&#36' + '</td>';
            let addToCartBtn = '<td>' + `&nbsp <button id="addToCart-btn${trackId}" data-trackprice="${e.price}" data-trackGenre="${e.genre}" data-trackAlbum="${e.album}" data-trackId="${trackId}" data-title="${e.title}" data-price=${e.price} data-artist="${e.artist}" class="btn btn-success addToCart-btn">Add to cart</button>` + '</td>';

            if (isAdmin == true) {
                let updateBtn = `&nbsp <button id="update-btn${trackId}" data-trackTitle="${e.title}" data-trackPrice="${e.price}" data-trackGenre="${e.genre}" data-trackAlbum="${e.album}" data-trackId="${trackId}" data-trackPrice=${e.price} data-trackArtist="${e.artist}" class="btn btn-primary update-btn">Update</button>`;
                let deleteBtn = `&nbsp <button id="$delete-btn${trackId}" data-trackId="${trackId}" data-trackName="${e.title}" class="btn btn-danger delete-btn">Delete</button>`;
                let options = '<td>' + updateBtn + deleteBtn + '</td>';
                tRow += '<tr>' + title + artist + album + genre + price + options + '</td></tr>';
            } else {
                tRow += '<tr>' + title + artist + album + genre + price + addToCartBtn + '</td></tr>';
            }
            $("#tracks-table").find('tBody').html(tRow);
        });
        $("#tracks-div").show();
    };

    // Pagination    
    $("#nextTracks-link").click(function () {
        pageNumber += 1;
        getTracks(pageNumber);
    });

    $("#previousTracks-link").click(function () {
        pageNumber += -1;
        getTracks(pageNumber);
    });

    //EOF
});