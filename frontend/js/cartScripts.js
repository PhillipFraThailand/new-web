$(document).ready(function (){
    $('#cart-nav').on('click', function() {
        $('#artists-div').hide();
        $('#albums-div').hide();
        $('#cart-div').hide();
        $('#tracks-div').hide();
        $('#account-div').hide();

        setupCartsTable(products);
    });

    // remove btn
    $('#cart-table').on('click','.remove-btn', function() {
        let index = this.getAttribute('index');
        let tRow = '';
        products.splice(index,1);
        $("#cart-table").find("tbody").html(tRow);
        setupCartsTable(products)
    });

    // Table setup
    function setupCartsTable(data) {
        let tRow = '';

        data.forEach(e => {
            //get index for [] manipulation. expensive compared to incrementing i... but accounts for earlier deletions
            var index = data.indexOf(e);
            let trackId = e.trackId; 
            let title = '<td>' + e.title + '</td>';
            let artist = '<td>' + e.artist + '</td>';;
            let price = '<td>' + e.price + '&#36' + '</td>';
            let removeBtn = `&nbsp <button id="remove-btn${trackId}" data-trackId="${trackId}" data-index${index} class="btn btn-danger remove-btn">Remove</button>`;
            let options = '<td>' + removeBtn + '</td>';

            tRow += '<tr>' + title + artist + price  + options + '</td></tr>';
            $("#cart-table").find("tbody").html(tRow);
        });
        $('#cart-div').show();
    };
});