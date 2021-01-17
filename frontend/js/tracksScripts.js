$(document).ready(function () {
    let pageNumber = 0;
    isAdmin = false;
    isSetupTracks = false;

    //tracks nav button
    $('#tracks-nav').on('click', function () {
        $('#artists-div').hide();
        $('#albums-div').hide();
        $('#cart-div').hide();
        $('#tracks-div').show();
        getTracks();
    });

    // create btn
    $('#tracks-table').on('click', '.create-btn', function () {
        $('#createTrack-modal').modal('show');
    });

    // delete-btn
    $("#tracks-table").on('click', '.delete-btn', function () {
        let trackName = this.getAttribute('data-trackName');
        let id = this.getAttribute('data-trackId');

        $('#trackId-delInp').val(id);
        $('#confirm-delete-txt').html('Sure you want to delete "' + trackName + '"');
        $("#deleteArtist-modal").modal('show');
    });

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
    function getTracks(page) {
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
            let addToCartBtn = '<td>' + `&nbsp <button id="addToCart-btn${trackId}" data-trackId="${trackId}" data-title="${e.title}" data-price=${e.price} data-artist="${e.artist}" class="btn btn-success addToCart-btn">Add to cart</button>` + '</td>';

            if (isAdmin == true) {
                let updateBtn = `&nbsp <button id="update-btn${trackId}" data-trackId="${trackId}" data-trackName="${e.title}" class="btn btn-primary update-btn">Update</button>`;
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