<main>
    <!----------- ARTISTS TABLE ----------->
    <div id="artists-div" class="navigation">
        <table class="table table-striped table-bordered table-hover" id="artists-table">
            <thead id="artists-head">
                <tr>
                    <th>Artist</th>
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

    <!----------- TRACKS TABLE  ----------->
    <div id="tracks-div" class="navigation">
        <table class="table table-striped table-bordered table-hover" id="tracks-table">
            <!-- TRACKS -->
            <thead id="tracks-head">
                <tr>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Album</th>
                    <th>Genre</th>
                    <th>Price</th>
                    <th>Action</th>
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

    <!----------- ALBUMS ----------->
    <div id="albums-div" class="navigation">
        <table>
            <thead id="album-head" class="table table-striped table-bordered table-hover">
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


    <!----------- CART ----------->
    <div id="cart-div" class="navigation"> 
        <table id="cart-table" class="table table-striped table-bordered table-hover">
            <thead id="cart-head">
                <tr>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Price</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody id="cart-tbody"></tbody>
        </table>
    </div>

<div></div>

</main>