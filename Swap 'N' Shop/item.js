var loggedIn = false;
window.addEventListener('load', function () {
    

    document.querySelector('#user_icon').addEventListener('click', showlogin); 
    
    document.querySelector('#logo').addEventListener('click', goHome); 

    document.querySelector('#login_button').addEventListener('click', login); 
    
    document.querySelector('#close').addEventListener('click', closelogin);

    document.querySelector('#create').addEventListener('click', showCreate);

    document.querySelector('#closeCreate').addEventListener('click', closeCreate);
        
});

function goHome(evt) {
    evt.preventDefault();
    window.location.href = "index.php"; 
}

function login(evt){
    evt.preventDefault();
    loggedIn = true;
    console.log("Logged in: " + loggedIn);
    closelogin();
    
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
