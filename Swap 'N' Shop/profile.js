window.addEventListener('load', function () {
    document.querySelector('.sidenav').style.display = 'block';
    document.querySelector('#userProfile').addEventListener('click', showProfile);
    document.querySelector('#security').addEventListener('click', showSecurity);
    document.querySelector('#pref').addEventListener('click', showPreferences);
    document.querySelector('#ItemsListed').addEventListener('click', showuserItems);
    document.querySelector('#createL').addEventListener('click', showListingCreate);
    document.querySelector('#logo').addEventListener('click', goHome); 
    document.querySelector('#add_listing_button').addEventListener('click', addListing); 
});

function addListing(evt){
    evt.preventDefault();

    console.log("add button pressed");
    
    var title = encodeURI(document.querySelector('#listing_title').value.trim());
    var desc = encodeURI(document.querySelector('#listing_desc').value.trim());
    var price = encodeURI(document.querySelector('#price').value.trim());
    
    console.log(title);
    console.log(desc);
    console.log(price);
    
    var catergory = document.forms[1];
    var txt = "";
    var i;
    for (i = 0; i < catergory.length; i++) {
        if (catergory[i].checked) {
        txt = txt + catergory[i].value + " ";
        }
    }
    console.log(txt);
    var output = document.getElementById("result_output");
    var frm = document.getElementById("add_product");
    output.innerHTML = "";
    var xhr = new XMLHttpRequest();

    xhr.addEventListener("load", function () {
        if ((xhr.status == 200)||(xhr.status == 201)) {
            console.log("Listing Created");
            output.innerHTML = " Listing Created!";
            
            document.getElementById("price").value = "";
            
            frm.reset();  // Reset
            return false; // Prevent page refresh

        
        } else {
            output.innerHTML = "Listing Not Created!";
        }
    });
    xhr.open("POST", "https://ad1045.brighton.domains/YEAR2/finalgroup/listing.php", true)
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("price=" + price + "&name=" + title + "&desc=" + desc + "&condition=New&department=" + txt);
}


function showSecurity(evt) {
    evt.preventDefault();
    document.querySelector('#securityPage').style.display = 'block';
    document.querySelector('#profile').style.display= 'none';
    document.querySelector('#prefPage').style.display= 'none';
    document.querySelector('#userItems').style.display= 'none';
    document.querySelector('#CreateL').style.display= 'none';
}
function showProfile(evt) {
    evt.preventDefault();
    document.querySelector('#securityPage').style.display = 'none';
    document.querySelector('#profile').style.display= 'block';
    document.querySelector('#prefPage').style.display= 'none';
    document.querySelector('#userItems').style.display= 'none';
    document.querySelector('#CreateL').style.display= 'none';
}

function showPreferences(evt) {
    evt.preventDefault();
    document.querySelector('#securityPage').style.display = 'none';
    document.querySelector('#profile').style.display= 'none';
    document.querySelector('#prefPage').style.display= 'block';
    document.querySelector('#userItems').style.display= 'none';
    document.querySelector('#CreateL').style.display= 'none';
}

function showListingCreate(evt) {
    evt.preventDefault();
    document.querySelector('#securityPage').style.display = 'none';
    document.querySelector('#profile').style.display= 'none';
    document.querySelector('#prefPage').style.display= 'none';
    document.querySelector('#userItems').style.display= 'none';
    document.querySelector('#CreateL').style.display= 'block';

}

function showuserItems(evt) {
    evt.preventDefault();
    document.querySelector('#securityPage').style.display = 'none';
    document.querySelector('#profile').style.display= 'none';
    document.querySelector('#prefPage').style.display= 'none';
    document.querySelector('#userItems').style.display= 'block';
    document.querySelector('#CreateL').style.display= 'none';
}


function goHome(evt) {
    evt.preventDefault();
    window.location.href = "index.php"; 
}
