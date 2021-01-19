<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <!-- Styles -->
        <link rel="stylesheet" href="frontend/css/bootstrap.min.css">
        <link rel="stylesheet" href="frontend/css/custom.css">

        <!-- Scripts -->
        <!-- global js var -->
        <script> var products = []; </script>
        <script defer src="frontend/js/jquery-3.5.1.js"></script>
        <script defer src="frontend/js/bootstrap.js"></script>
        <script defer src="frontend/js/loginscripts.js"></script>
        <script defer src="frontend/js/artistsScripts.js"></script>
        <script defer src="frontend/js/tracksScripts.js"></script>
        <script defer src="frontend/js/cartScripts.js"></script>
        <script defer src="frontend/js/accountScripts.js"></script>
        <script defer src="frontend/js/script.js"></script>

        <title>Track Provider</title>
    </head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <!-- Burgermenu appears on small screen  -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Logo  -->
        <img src="frontend/Images/microphone.png" alt="Images/node.png" class="img-responsive">
        <a class="navbar-brand" href="#">Track Providers</a>

        <!-- Navigation -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav mr-auto" id="navbarSupportedContent">

                <button id="home-nav" type="submit" class="btn btn-light">Home</button>

                <button id="artists-nav" type="submit" class="btn btn-light">Artists</button>

                <button id="albums-nav" type="submit" class="btn btn-light">Albums</button>

                <button id="tracks-nav"type="submit" class="btn btn-light">Tracks</button>

                <button id="cart-nav" type="submit" class="btn btn-light">Cart</button>

                <button id="account-nav" type="submit" class="btn btn-light">Account</button>

                <button id="signout-nav" type="submit" class="btn btn-light">Sign out</button>

            </div>
                <form action=""> <!-- This forms allows me to use form-control class -->
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                </form>
                <button class="btn bg-light my-2 my-sm-0" type="submit">Search</button>
        </div>
    </nav>
