$(document).ready(function () {
    let pageNumber = 0;
    isAdmin = false;
    isSetupArtist = false;

    // ----------------------------ARTISTS----------------------------
    // Pagination
    $("#artists-nav").click(function () {
        $("#tracks-div").hide();
        $('#albums-div').hide();
        $('#cart-div').hide();
        $('#account-div').hide();
        getArtists();
    });

    $("#nextArtist-link").click(function () {
        pageNumber +=1;
        getArtists(pageNumber);
    });

    $("#previousArtist-link").click(function () {
        pageNumber +=-1;
        getArtists(pageNumber);
    });

    // GET ALL
    function getArtists(page){
        let getParam = '/?page=' + pageNumber;
        getArtistsURL = './api/artists/read.php'

        $.ajax({
            url: getArtistsURL + getParam,
            type: 'get',
            success: function (res) {
                if (res['admin'] == 'YES') {
                    isAdmin = true;
                } else {
                    console.log('No admin');
                };
                setupArtistsTable(res['data']);
            },
            failure: function (errMsg) {
                console.log(errMsg);
            }, error: function (e) {
                console.log('error', e);
            }
        });
    }

    // Table setup
    function setupArtistsTable(data) {
        let tRow = '';
        
        if (isAdmin == true && !isSetupArtist) {
            isSetupArtist = true;
            let createBtn = `&nbsp <button id="create-btn" class="btn btn-success create-btn">Create artist</button>`;
            $('#artists-table').find('#options-th').append(createBtn);
        }

        data.forEach(element => {
            let artistId = element.ArtistId;

            if (isAdmin == true) {
                let deleteBtn = `&nbsp <button id="$delete-btn${artistId}" data-artistId="${artistId}" data-artistName="${element.Name}" class="btn btn-danger delete-btn">Delete</button>`;
                let updateBtn = `&nbsp <button id="update-btn${artistId}" data-artistId="${artistId}" class="btn btn-primary update-btn">Update</button>`;
                tRow += '<tr><td>' + element.Name + '</td><td>' + updateBtn + deleteBtn + '</td></tr>';
            } else {
                tRow += '<tr><td>' + element.Name + '</td></tr>';
            }
        });
        $("#artists-table").find('tBody').html(tRow);
        $("#artists-div").show();
    };

    // create-btn
    $('#artists-table').on('click', '.create-btn', function () {
        $('#createArtist-modal').modal('show');
    });

    // create-btn submit
    $('#createArtist-yes').on('click', function () {
        let createUrl = './api/artists/create.php';
        let artistName = $('#artistName-inp').val().trim();

        if (artistName != "") {

            $.ajax({
                url: createUrl,
                type: 'POST',
                data: JSON.stringify({
                    name: artistName
                }),
                success: function (data) {
                    console.log('success');
                },
                failure: function (errMsg) {
                    console.log('failure update');
                },
                error: function (e) {
                    console.log('error');
                }
            })
        } else {
            alert('Fill out the field please')
        }
    });

    // update-btn shows update name modal and sets id to be set
    $('#artists-table').on('click', '.update-btn', function () {
        let id = this.getAttribute('data-artistId');
        $('#artistId-inp').val(id)
        $('#updateArtist-modal').modal('show');
    });

    // update-btn submit
    $("#updateName-submit").on('click', function () {
        let updateURL = './api/artists/update.php';
        let name = $("#update-inp").val().trim();
        let id = $("#artistId-inp").val().trim();
        if (name != "") {
            console.log(id, name)

            $.ajax({
                url: updateURL,
                type: 'POST',
                data: JSON.stringify({
                    id: id,
                    name: name
                }),
                success: function (response) {
                    console.log('updated');
                    $("#updateArtist-modal").modal('hide');
                },
                failure: function (errMsg) {
                    console.log('failure update');
                },
                error: function (e) {
                    console.log('error');
                }
            })
        } else {
            alert('please provide a name');
        }
    });

    // delete-btn
    $("#artists-table").on('click', '.delete-btn', function () {
        let artistName = this.getAttribute('data-artistName');
        let id = this.getAttribute('data-artistId');

        $('#artistId-delInp').val(id);
        $('#confirm-delete-txt').html('Sure you want to delete "' + artistName + '"');
        $("#deleteArtist-modal").modal('show');
    });

    // delete modal dismiss
    $('#deleteArtist-no').on('click', function () {
        $("#deleteArtist-modal").modal('hide');
    });

    // delete-btn submut
    $('#deleteArtist-yes').on('click', function () {
        let deleteUrl = './api/artists/delete.php'
        let id = $('#artistId-delInp').val().trim();

        $.ajax({
            url: deleteUrl,
            type: 'POST',
            data: JSON.stringify({
                id: id
            }),
            success: function (data) {
                $('#deleteArtist-modal').modal('hide');
                getArtists();
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

    //create-modal dismiss
    $('#createArtist-no').on('click', function () {
        $("#createArtist-modal").modal('hide');
    });

}); // EOF
