<?php
/*
if (isset($_POST['search'])) {
    search();
} else {
   
}
*/
function generateFeaturedItems(){
    $html = ' ';

    $mysqli = new mysqli("ad1045.brighton.domains", "ad1045_test_user", "v3=-nl+SX@nm", "ad1045_group_project");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    for($i = 1; $i <= 4; $i++){
       

        $listing = $mysqli->query("SELECT * FROM Listings WHERE ListingsID=$i");
        $listingrow = $listing->fetch_assoc();

        
        $user = $mysqli->query("SELECT * FROM UserData WHERE UserID='$listingrow[UserID]'");
        $userrow = $user->fetch_assoc();
        
        $html .= "
        <section class='item_section'>
            <p class='item_title'>$listingrow[ListingsName]</p>
            <p class='item_price'>£$listingrow[ListingsPrice]</p>
            <p class='item_location'>$userrow[UserCampus]</p>
            <div class='item_spacer_line'></div>
            <p class='item_desc'>$listingrow[ListingsDescription]</p>
            <img class='item_img' src='testimg2.png'>
        </section>
        ";
    }
    $mysqli->close();
    echo $html;
    
}

    

function search(){
    $searchhtml = ' ';
    

    $mysqli = new mysqli("ad1045.brighton.domains", "ad1045_test_user", "v3=-nl+SX@nm", "ad1045_group_project");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    
    $sql = "SELECT COUNT(*) FROM Listings";
    $count = $mysqli->query($sql)->fetch_row()[0];
    for($i = 1; $i <= $count; $i++){
       

        $listing = $mysqli->query("SELECT * FROM Listings WHERE ListingsID=$i");
        $listingrow = $listing->fetch_assoc();

        
        $user = $mysqli->query("SELECT * FROM UserData WHERE UserID='$listingrow[UserID]'");
        $userrow = $user->fetch_assoc();
        
        $searchhtml .= "
        <section class='item_section'>
            <p class='item_title'>$listingrow[ListingsName]</p>
            <p class='item_price'>$listingrow[ListingsPrice]</p>
            <p class='item_location'>$userrow[UserCampus]</p>
            <div class='item_spacer_line'></div>
            <p class='item_desc'>$listingrow[ListingsDescription]</p>
            <img class='item_img' src='testimg.jpg'>
        </section>
        ";
    }
    $mysqli->close();
    echo $searchhtml;
    
}
   
?>
