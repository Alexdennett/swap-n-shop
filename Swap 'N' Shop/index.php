<?php
include ("test.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="indexs.js"></script>
    <title>Swap 'N' Shop</title>

    <link href="styles.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Strait" rel="stylesheet">
    <link rel="icon" type="image/ico" href="images/favicon(1).ico">
</head>

<body>
    <div id="footer_wrapper">
        <div id="wrapper">

            <header id="banner">
                <img id="logo" src="SWAP_N_SHOP.png" href = "index.html" alt="SwapNShopLogo" >
                <h1 id="title">UNIVERSITY OF BRIGHTON</h1>
                <div id="top_user_info">
                    <img id="user_icon" src="usericon.png" href="profile.html">
                </div>
            </header>

            <div id="search_bar">
                <form id="search_form">
                    <input id="query" type="text" name="search">
                    <input id="search_button" type="submit" value="SEARCH">
                </form>
            </div>

            <div class="radio-toolbar" id="categories_div">
                
                <input type="radio" id="All" name="radioCategories" value="All" checked>
                <label for="All">All</label>
                <input type="radio" id="Electronics" name="radioCategories" value="Electronics" >
                <label for="Electronics">Electronics</label>
                <input type="radio" id="Home" name="radioCategories" value="Home" >
                <label for="Home">Home</label>
                <input type="radio" id="Garden" name="radioCategories" value="Garden" >
                <label for="Garden">Garden</label>
                <input type="radio" id="Clothes" name="radioCategories" value="Clothes" >
                <label for="Clothes">Clothes</label>
                <input type="radio" id="Books" name="radioCategories" value="Books" >
                <label for="Books">Books</label>
                <input type="radio" id="Art" name="radioCategories" value="Art" >
                <label for="Art">Art</label>
                <input type="radio" id="Miscellaneous" name="radioCategories" value="Misc" >
                <label for="Miscellaneous">Miscellaneous</label>
            </div>

            <div class="sidenav">
                <div id="price">
                    <h3 id="resultcount">RESULTS: </h3>
                </div>
               
                <div id="price">
                    <p id="minpriceslider">Min price: </p>
                    <div class="slidecontainer">
                        <input type="range" min="1" max="100" value="1" class="slider" id="minmyRange">
                    </div>
                </div>
               
                <div id="price">
                    <p id="maxpriceslider">Max price: </p>
                    <div class="slidecontainer">
                        <input type="range" min="1" max="1000" value="1000" class="slider" id="maxmyRange">
                    </div>
                </div>
                <form id="distance" action="listing.php" method="POST">
                    <label class="container">City
                        <input type="checkbox" name="locationForm[]" checked="checked" value="City" id="City">
                        <span class="checkmark"></span>
                      </label>
                      
                      <label class="container">Moulsecoomb
                        <input type="checkbox" checked="checked" name="locationForm[]" value="Moulsecoomb" id="Moulsecoomb">
                        <span class="checkmark"></span>
                      </label>
                      
                      <label class="container">Falmer
                        <input type="checkbox" checked="checked" name="locationForm[]" value="Falmer" id="Falmer">
                        <span class="checkmark"></span>
                      </label>
                      
                      <label class="container">Eastbourne
                        <input type="checkbox"checked="checked" name="locationForm[]" value="Eastbourne" id="Eastbourne">
                        <span class="checkmark"></span>
                      </label>

                      
                </form>
                <button id="apply_to_all" class="Button" type="submit">Apply all</button>
            </div>
            
                <!-- Login Page --> 
            
    <div id="logIn" class="login">
    
        <form class="loginForm">
            
            <div class="imglogin">
                <span id="close" class="close">&times;</span>
                <img src="icon.png" alt="Avatar" class="avatar">
            </div>
        
        
                <div class="loginBox">
                 <span class="create" id="create"><b><a href='#'>Create an account here</a></b></span> 
                  
                  <br>
                  <br>
                  
                  <label for="username"><b>Username</b></label>
                  <input class="login_input" type="text" placeholder="Enter Username" name="username">
            
                  <label for="password"><b>Password</b></label>
                  <input class="login_input" type="password" placeholder="Enter Password" name="password">

                  <a href="profile.html">
                      <button class="Button" id="login_button" type="submit">Login</button>
                    </a>

                  <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                  </label>
                  
                  
                </div>
    
        </form>
    </div>

    <main id="results_wrapper">

        <div id= "landing_wrap">

            <div id="block_line">
                <p>Featured items</p>
            </div>

            <div id="featured_products">
                <?php echo generateFeaturedItems(); ?>
            </div>
            
        </div>

        <div id = "div_wrap">
            <div id="results_div" class="results_div">
            
            </div>
        </div>

    </main>

             <!-- Create Profile -->
    <div id="createprofile" class="crprof">
    
        <form class="createForm">
            
            <div class="imglogin">
                <span id="closeCreate" class="close">&times;</span>
                <img src="icon.png" alt="Avatar" class="avatar">
            </div>
                  
                  <label for="title"><b> *Title: </b></label>
                  <select id="titles">
                      <option value=""></option>
                      <option value="Mrs">Mrs</option>
                      <option value="Mr">Mr</option>
                      <option value="Miss">Miss</option>
                      <option value="Ms">Ms</option>
                      <option value="Mx">Mx</option>
                  </select>

                  <br>
                  <br>

                  <label for="email"><b>*Enter Email: </b></label>
                  <input type="text" placeholder="Enter Email" name="email">

                  <label for="user"><b>*Create a Username: </b></label>
                  <input type="text" placeholder="Enter a Username" name="username">
            
                  <label for="password"><b>*Create a Password: </b></label>
                  <input type="password" placeholder="Create a Password" name="password">

                  <label for="campus"><b>Campus: </b></label>
                  <select id="campus">
                      <option value=""></option>
                      <option value="Falmer">Falmer</option>
                      <option value="Moulsecoomb">Moulsecoomb</option>
                      <option value="Eastbourne">Eastbourne</option>
                      <option value="City">City</option>
                  </select>
            
                  <button class="Button" type="submit">Create Account</button>
                  
                  <label>
                    <input type="checkbox" name="notifications"> Keep up-to-date with us by recieiving Email notifications!
                  </label>
                  
                  
                </div>
    
        </form>
    </div>
</div>

            <aside>

            </aside>

 </div>


 <footer class="footer">
    <div id="footer_word">
        <br>
        <h5> <a href="index.php" > Home</a> | Login | <a href="tc.html">Terms and Conditions</a> | <a href="mailto:b.brighton@brighton.ac.uk">Contact Us</a> | <a href="about.html" >About Us</a></h5> 
           
    </div>
    </footer>

</body>

</html>