<main>
    <h1>admin</h1>
    <!----------- ARTISTS TABLE ----------->
    <div id="artists-div">
        <table id="artists-table" class="table table-striped table-bordered table-hover">
            <thead id="artists-head">
                <tr>
                    <th id='artists-th'>Artist</th>
                    <th id='options-th'>Options</th>
                </tr>
            </thead>
            <tbody id="artists-tbody"></tbody>
        </table>
            <nav id="pagination-nav">
                <ul class="pagination">
                    <li id="previousArtist-link" class="page-item"><a class="page-link"><<</a></li>
                    <li id="nextArtist-link" class="page-item"><a class="page-link">>></a></li>
                </ul>
            </nav>
    </div>

    <!-- CREATE artist btn  -->
    <div class="modal fade" id="createArtist-modal" tabindex="-1">
        <div class="modal-dialog">  <!-- enables the sizing and closing -->
            <div class="modal-content">
                <!-- Header and close button -->
                <div class="modal-header">
                    <h5 class="modal-title">Create artist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <h5>New artist name</h5>
                    </div>

                    <div class="form-group">
                        <input type="text" id="artistName-inp" class="form-control" placeholder="Artist name" name="artist-name" required="required">
                    </div>

                    <div class="form-group">
                        <input id="createArtist-yes" class="btn btn-success btn-block btn-lg" value="Create">
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="clearfix">
                        <button  id="createArtist-no" class="btn btn-warning btn-block btn-lg">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- UPDATE artist btn -->
    <div class="modal fade" id="updateArtist-modal" tabindex="-1">
        <div class="modal-dialog">  <!-- enables the sizing and closing -->
            <div class="modal-content">
                <!-- Header and close button -->
                <div class="modal-header">
                    <h5 class="modal-title">Update Artist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" id="update-inp" placeholder="Name" class="form-control" name="newName" required="required">
                    </div>

                    <div class="form-group">
                        <input type="hidden" id="artistId-inp" class="form-control" required="required">
                    </div>

                    <div class="form-group">
                        <input id="updateName-submit" class="btn btn-primary btn-block btn-lg" value="Submit">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DELETE artist btn -->
    <div class="modal fade" id="deleteArtist-modal" tabindex="-1">
        <div class="modal-dialog">  <!-- enables the sizing and closing -->
            <div class="modal-content">
                <!-- Header and close button -->
                <div class="modal-header">
                    <h5 class="modal-title">Delete Artist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <h5 id="confirm-delete-txt"></h5>
                    </div>

                    <div class="form-group">
                        <input id="deleteArtist-no" class="btn btn-warning btn-block btn-lg" value="No">
                    </div>

                    <div class="form-group">
                        <input type="hidden" id="artistId-delInp" class="form-control" name="artist-id" required="required">
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="clearfix">
                        <button  id="deleteArtist-yes" class="btn btn-danger btn-block btn-lg">DELETE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!----------- TRACKS TABLE  ----------->
    <div id="tracks-div">
        <table class="table table-striped table-bordered table-hover" id="tracks-table">
            <!-- TRACKS -->
            <thead id="tracks-head">
                <tr>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Album</th>
                    <th>Genre</th>
                    <th>Price</th>
                    <th id='options-th'>Options</th>
                </tr>
            </thead>
            <tbody id="tracks-body"></tbody>
        </table>
        <nav id="pagination-nav">
            <ul class="pagination">
                <li id="previousTracks-link" class="page-item"><a class="page-link"><<</a></li>
                <li id="nextTracks-link" class="page-item"><a class="page-link">>></a></li>
            </ul>
        </nav>
    </div>

    <!-- CREATE track  -->
    <div class="modal fade" id="createTrack-modal" tabindex="-1">
        <div class="modal-dialog">  <!-- enables the sizing and closing -->
            <div class="modal-content">
                <!-- Header and close button -->
                <div class="modal-header">
                    <h5 class="modal-title">Create track</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <h5>New track</h5>
                    </div>

                    <div class="form-group">
                        <input type="text" id="trackName-inp" class="form-control" placeholder="Title" name="track-name" required="required">
                    </div>

                    <div class="form-group">
                        <input id="createTrack-yes" class="btn btn-success btn-block btn-lg" value="Create">
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="clearfix">
                        <button  id="createTrack-no" class="btn btn-warning btn-block btn-lg">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DELETE track  -->
    <div class="modal fade" id="deleteTrack-modal" tabindex="-1">
        <div class="modal-dialog">  <!-- enables the sizing and closing -->
            <div class="modal-content">
                <!-- Header and close button -->
                <div class="modal-header">
                    <h5 class="modal-title">Delete Track</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <h5 id="confirm-delete-txt"></h5>
                    </div>

                    <div class="form-group">
                        <input id="deleteTrack-no" class="btn btn-warning btn-block btn-lg" value="No">
                    </div>

                    <div class="form-group">
                        <input type="hidden" id="trackId-delInp" class="form-control" name="track-id" required="required">
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="clearfix">
                        <button  id="deleteTrack-yes" class="btn btn-danger btn-block btn-lg">DELETE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!----------- ALBUMS ----------->
    <div id="albums-div">
        <table class="table table-striped table-bordered table-hover" id="albums-table">
            <thead id="album-head">
                <tr>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>test</th>
                    <th></th>
                    <th></th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="album-body"></tbody>
        </table>
    </div>
    <div id="albums-div"></div>
    <div id="tracks-div"></div>
</main>