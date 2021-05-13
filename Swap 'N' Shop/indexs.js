var loggedIn = false;
window.addEventListener('load', function () {
    
    //landingpage();

    document.querySelector('#search_bar form').addEventListener('submit', testproducts);

    let cat = document.querySelectorAll('input[name="radioCategories"]');
                                  

    for (let i = 0; i < cat.length; i++) {
    cat[i].addEventListener("change", testproducts); 
    }
    

    document.querySelector('#All').addEventListener('checked', testproducts);
    document.querySelector('#Electronics').addEventListener('checked', testproducts);
    document.querySelector('#Home').addEventListener('checked', testproducts);
    document.querySelector('#Garden').addEventListener('checked', testproducts);
    document.querySelector('#Clothes').addEventListener('checked', testproducts);
    document.querySelector('#Books').addEventListener('checked', testproducts);
    document.querySelector('#Art').addEventListener('checked', testproducts);
    document.querySelector('#Miscellaneous').addEventListener('checked', testproducts);
    
    document.querySelector('#apply_to_all').addEventListener('click', testproducts);

    document.querySelector('#user_icon').addEventListener('click', showlogin); 
    
    document.querySelector('#logo').addEventListener('click', goHome); 

   // document.querySelector('item_section').addEventListener('click', goToItem); 

    document.querySelector('#login_button').addEventListener('click', login); 
    
    document.querySelector('#close').addEventListener('click', closelogin);

    document.querySelector('#create').addEventListener('click', showCreate);

    
    var minslider = document.getElementById("minmyRange");
    var minoutput = document.getElementById("minpriceslider");
    minoutput.innerHTML = "Min price: £" + minslider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    minslider.oninput = function() {
    minoutput.innerHTML = "Min price: £" + minslider.value;
    }

    var maxslider = document.getElementById("maxmyRange");
    var maxoutput = document.getElementById("maxpriceslider");
    maxoutput.innerHTML = "Max price: £" + maxslider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    maxslider.oninput = function() {
    maxoutput.innerHTML = "Max price: £" + maxslider.value;
    }
        
});

function goHome(evt) {
    evt.preventDefault();
    window.location.href = "index.php"; 
}

function goToItem(evt) {
    evt.preventDefault();
    window.location.href = "item.html"; 
}


function login(evt){
    evt.preventDefault();
    loggedIn = true;
    console.log("Logged in: " + loggedIn);
    closelogin();
}
/*
function landingpage(){
    console.log("loading page laoding");
    let categorys = ['All', 'Electronics','Home','Garden','Clothes','Books','Art','Miscellaneous'];

    
    var div = document.querySelector('#categories_div');
    for (var i = 0; i < 8; i++) {
        
        var radio = document.createElement("input");

        var section = document.createElement("section");
        section.setAttribute("class", "categories_section");
        var entry = div.appendChild(section);

        var category_title = document.createElement('p');
        category_title.textContent = categorys[i];
        category_title.setAttribute("class", "category_title");
        entry.appendChild(category_title);
    }

    //For each item element add a eventListener to move to the item page
    var elements = document.getElementsByClassName("item_section");
    for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener('click', setItemClick, false);
    }
}
*/
/*
function landingpage(){
    console.log("loading page laoding");
    let categorys = ['All', 'Electronics','Home','Garden','Clothes','Books','Art','Miscellaneous'];

    
    var div = document.querySelector('#categories_div');
    for (var i = 0; i < 8; i++) {
        var section = document.createElement("section");
        section.setAttribute("class", "categories_section");
        var entry = div.appendChild(section);

        var category_title = document.createElement('p');
        category_title.textContent = categorys[i];
        category_title.setAttribute("class", "category_title");
        entry.appendChild(category_title);
    }

    //For each item element add a eventListener to move to the item page
    var elements = document.getElementsByClassName("item_section");
    for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener('click', setItemClick, false);
    }
}
*/
var setItemClick = function() {
    window.location.href = "item.html"; 
};

function testproducts(evt){
    evt.preventDefault();

    clearBox("#results_div");

    console.log("search button pressed");
    document.querySelector('#landing_wrap').style.display = "none";
    document.querySelector('.sidenav').style.display = "block";
    document.querySelector('#div_wrap').style.display = "block";
    var search = 'search=';
    
    var campus = ['City','Falmer','Moulsecoomb', 'Eastbourne'];
    var selected = new Array();

    selected = campus.filter(isSelected);
    console.log(selected);

    
    const rbs = document.querySelectorAll('input[name="radioCategories"]');
    let selectedValue;
    for (const rb of rbs) {
        if (rb.checked) {
            selectedValue = rb.value;
            break;
        }
    }
    console.log(selectedValue);
    


    var search_term = encodeURI(document.querySelector('#query').value.trim());
    var min = document.querySelector('#minmyRange').value;
    var max = document.querySelector('#maxmyRange').value;
    
    console.log(min);
    console.log(max);
    console.log("(" + search_term + ")");
    if (search_term == "") {
        console.log("nothing");
        search = "all=aaa";

    }
    

    /*if (search_term == "") {
        search = "all=aaa";
    } else {*/
        //clearBox("#results_div");
        var xhr = new XMLHttpRequest();
        xhr.addEventListener("load", function () {
            var resultcount = document.getElementById("resultcount");
            
            if (xhr.status == 200) {
                var JSON_Data = JSON.parse(xhr.responseText);
                var listings = JSON_Data.Listings;
                console.log(JSON_Data);
                console.log(listings);

                resultcount.innerHTML = "RESULTS: " + listings.length;
                
                for (var i = 0; i < listings.length; i++) {

                    var obj = listings[i];
                    console.log(obj);

                    var listing_id = obj.ListingsID;
                    console.log(listing_id);
                    var name = obj.ListingsName;
                    var price = obj.ListingsPrice;
                    var description = obj.ListingsDescription
                    var campus = obj.UserCampus;

                    newEntry(listing_id, name, price, description, campus);

                }
            } else if(xhr.status == 204){
                resultcount.innerHTML = "RESULTS: 0"
                var div = document.querySelector('#results_div');
                var error = document.createElement('p');
                error.textContent = "Error: No matching products - Please try again";
                error.setAttribute("class", "error");
                div.appendChild(error);
            }
        });
        xhr.open("GET", "https://ad1045.brighton.domains/YEAR2/finalgroup/listing.php?"+ search + search_term + "&min=" + min + "&max=" + max +"&selected=" + selected + "&category=" + selectedValue, true);
        xhr.send();

      //For each item element add a eventListener to move to the item page
      var elements = document.getElementsByClassName("item_section");
      for (var i = 0; i < elements.length; i++) {
          elements[i].addEventListener('click', setItemClick, false);
      }
    }

      
//}

function isSelected(value){
    var checkBox = document.getElementById(value);
    return checkBox.checked
}

function newEntry(listing_id, name, price, description, campus) {

    

    console.log(name);
    console.log(price);
    console.log(description);
    var div = document.querySelector('#results_div');

    //var link = document.createElement("a");
    

    var section = document.createElement("section");
    section.addEventListener('click', setItemClick, false);
    section.setAttribute("id", name);
    section.setAttribute("class", "item_section");
    div.appendChild(section);
    //var entry = link.appendChild(section);

    var item_title = document.createElement('p');
    item_title.textContent = name;
    item_title.setAttribute("class", "item_title");
    section.appendChild(item_title);

    var item_price = document.createElement('p');
    item_price.textContent = "£" + price;
    item_price.setAttribute("class", "item_price");
    section.appendChild(item_price);

    var item_location = document.createElement('p');
    item_location.textContent = campus;
    item_location.setAttribute("class", "item_location");
    section.appendChild(item_location);

    var div = document.createElement('div');
    div.setAttribute("class", "item_spacer_line");
    section.appendChild(div);

    var item_desc = document.createElement('p');
    item_desc.textContent = description;
    item_desc.setAttribute("class", "item_desc");
    section.appendChild(item_desc);

    var img = document.createElement('img');
        img.setAttribute("class", "item_img");
        img.setAttribute("alt", name);
        if (name == "Desk chair"){
            img.setAttribute("src", "deskchair.jpg");
        } else {
           img.setAttribute("src", "testimg.jpg"); 
        }
        section.appendChild(img);

        
}

function showlogin(evt) {
    evt.preventDefault();
    if(loggedIn === true){
       window.location.href = "profile.html"; 
    }
    else{
        document.querySelector('#logIn').style.display = 'block'; 
    }
   
}

function closelogin() {
    document.querySelector('#logIn').style.display = 'none';
}

function showCreate(evt) {
    evt.preventDefault();
    document.querySelector('#createprofile').style.display = 'block';
}

function closeCreate(evt) {
    evt.preventDefault();
    document.querySelector('#createprofile').style.display = 'none';
    document.querySelector('#logIn').style.display = 'none';
}


function getListings() {
    
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("#results_div").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "listing.php", true);
      xmlhttp.send();
    
  }

  function clearBox(elementID) {
    const myNode = document.querySelector(elementID);
    while (myNode.firstChild) {
        myNode.removeChild(myNode.lastChild);
    }
}