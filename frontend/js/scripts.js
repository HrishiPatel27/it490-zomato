///////////////////
//                          Login/Register page functions
///////////////////

//  Form validation for Login
function checkLoginCredentials(){
    
    var loginUsernameNotClean = document.getElementById('username_login').value;
    var loginPasswordNotClean = document.getElementById('password_login').value;
    
    var loginUsername = loginUsernameNotClean.trim();
    var loginPassword = loginPasswordNotClean.trim();

    if (loginUsername != "" && loginPassword != ""){
        sendLoginCredentials(loginUsername, loginPassword);
    }else{
        if(loginUsername == ""){
            turnFieldToRedColorBorder(loginUsername);
        }
        if(loginPassword == ""){
            turnFieldToRedColorBorder(loginPassword);
        }
        if (loginUsername == "" && loginPassword == ""){
            turnFieldToRedColorBorder(loginUsername);
            turnFieldToRedColorBorder(loginPassword);
        }
    }
}

// This function sends a AJAX request for login 
function sendLoginCredentials(username, password){
    
    var httpReq = createRequestObject();
    httpReq.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            document.getElementById("loginButtonId").innerHTML = "Login";
            
            if(this.responseText == true){
                window.location = "../php/searchRestaurant.php";
            }else{
                window.location = "loginRegister.html";
            }
            
        }else{
            document.getElementById("loginButtonId").innerHTML = "Loading...";
        }
    }
    httpReq.open("GET", "../php/functionCases.php?type=Login&username=" + username + "&password=" + password);
    httpReq.send(null);
}

//  Form validation for Register
function checkRegisterCredentials(){
    
    //  Taking Form input
    var firstnameNotClean = document.getElementById("id_firstname").value;
    var lastnameNotClean = document.getElementById("id_lastname").value;
    var usernameNotClean = document.getElementById("id_username").value;
    var emailNotClean = document.getElementById("id_email").value;
    var passwordNotClean = document.getElementById("id_password").value;
    var confirmPasswordNotClean = document.getElementById("id_confirm_password").value;
    
    //  Cleaning form input
    var firstname = firstnameNotClean.trim();
    var lastname = lastnameNotClean.trim();
    var username = usernameNotClean.trim();
    var email = emailNotClean.trim();
    var password = passwordNotClean.trim();
    var confirmPassword = confirmPasswordNotClean.trim();
    
    
    if (firstname != "" && lastname != "" && username != "" && email != "" && password != "" && confirmPassword != ""){
        sendRegisterCredentials(firstname, lastname, username, email, password);
    }else{
        alert("Information not good");
    }

}

//  This function sends a AJAX request for Register new user
function sendRegisterCredentials(firstname, lastname, username, email, password){
    
    var httpReq = createRequestObject();
    httpReq.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            document.getElementById("registerButtonId").innerHTML = "Register";
            //  var response = JSON.parse(this.responseText);
            if(this.responseText == true){
                alert("User Registered");
            }else{
                alert("Problems registering a new user");
            }
        }else{
            document.getElementById("registerButtonId").innerHTML = "Loading...";
        }
    }
    httpReq.open("GET", "../php/functionCases.php?type=RegisterNewUser&username=" + username + "&password=" + password + "&firstname=" + firstname + "&lastname=" + lastname + "&email=" + email);
    httpReq.send(null);
}

//  This function is called on the onblur event of a username Textbox
function checkForExistingUsername(){
    
    var usernameNotClean = document.getElementById("id_username").value;
    var username = usernameNotClean.trim();
    
    var httpReq = createRequestObject();
    httpReq.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            if(this.responseText == false){
                alert("User exists");
            }else{
                alert("You can register");
            }
            
        }
    }
    httpReq.open("GET", "../php/functionCases.php?type=UsernameVerification&username=" + username);
    httpReq.send(null);
}

//  This function is called on the onblur event of a email textbox
function checkForExistingEmail(){
    
    var emailNotClean = document.getElementById("id_email").value;
    var email = emailNotClean.trim();
    
    alert(email);
    
    var httpReq = createRequestObject();
    httpReq.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            if(this.responseText == false){
                alert("Email exists");
            }else{
                alert("Email can be register");
            }
            
        }
    }
    httpReq.open("GET", "../php/functionCases.php?type=EmailVerification&email=" + email);
    httpReq.send(null);
}






///////////////////
//                          searchRestaurant page functions
///////////////////

//  This function is called when the state is changed and it populates the city column
function stateSelected(){
    var state = document.getElementById("state_id").value;
    
    var httpReq = createRequestObject();
    httpReq.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            var response = JSON.parse(this.responseText);
            
            var sel = document.getElementById('city_id');

            sel.options.length = 0;

            var count = Object.keys(response).length;

            for(var i = 0; i < count; i++){
                    var opt = document.createElement('option');
                    opt.innerHTML = response[i];
                    opt.value = response[i];
                    sel.appendChild(opt);
            }
        }
    }
    httpReq.open("GET", "../php/getCitiesByName.php?state="+state, true);
    httpReq.send(null);
}

//  This function is called when the search button is clicked
function searchRestaurants(){
    
    var state = document.getElementById("state_id").value;
    var city = document.getElementById("city_id").value;
    var cuisine_id = document.getElementById("cuisine_id").value;
    
    var appendChildToPage = document.getElementById("divToHoldRest"); 
    appendChildToPage.innerHTML = "";
 
    var httpReq = createRequestObject();
    httpReq.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var response = JSON.parse(this.responseText);
            
            var user = getUserName();
            var restaurants = response['restaurants'];
            var count = 0;
            
            for(var i in restaurants){
                
                if(count == 0 || count%3 == 0){
                //  main row
                    var mainRowDiv = document.createElement("div");
                    mainRowDiv.classList.add("row");
                }
                
                count = count + 1;
                
                
                var card_holder_id = document.createElement("div");
                
                
                
                
                
                
                
                appendChildToPage.appendChild(mainRowDiv);
           
//                console.log(restaurants[i].restaurant_id);
//                console.log(restaurants[i].name);           //  Used
//                console.log(restaurants[i].menu_url);       //  Used
//                console.log(restaurants[i].thumb);          //  Used
//                console.log(restaurants[i].address);        //  Used
//                console.log(restaurants[i].city_id);        //  Not needed
//                console.log(restaurants[i].rating);         //  Used
//                console.log(restaurants[i].rating_text);    //  Used
     
            }
            
        }
    }
    httpReq.open("GET", "../php/getAllRestaurants.php?state="+state+"&city="+city+"&cuisine_id="+cuisine_id, false);
    httpReq.send(null);
    
} 


//  This function is called when the search button is clicked
function searchRestaurantsOld(){
    
    var state = document.getElementById("state_id").value;
    var city = document.getElementById("city_id").value;
    var cuisine_id = document.getElementById("cuisine_id").value;
    
    var appendChildToPage = document.getElementById("divToHoldRest"); 
    appendChildToPage.innerHTML = "";
 
    var httpReq = createRequestObject();
    httpReq.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var response = JSON.parse(this.responseText);
            
            var user = getUserName();
            
            var restaurants = response['restaurants'];
            
            //console.log(restaurants.length);
            
            //console.log(this.responseText);
            //alert(JSON.stringify(restaurants));
            
            
            var count = 0;
            
            for(var i in restaurants){
                
                if(count == 0 || count%4 == 0){
                //  main row
                    var mainRowDiv = document.createElement("div");
                    mainRowDiv.classList.add("row");
                }
                
                count = count + 1;
                
                //restaurant
                var restDiv = document.createElement("div");
                restDiv.classList.add("col-sm-3");
                mainRowDiv.appendChild(restDiv);
                
                // one
                var one = document.createElement("div");
                one.classList.add("row");
                restDiv.appendChild(one);
                
                //  two
                var two = document.createElement("div");
                two.classList.add("col-sm-12");
                two.classList.add("card");
                one.appendChild(two);
                
                //  three
                var three = document.createElement("div");
                three.classList.add("row");
                three.classList.add("card-items-row-padding-name");
                two.appendChild(three);
                
                //  four
                var four = document.createElement("div");
                four.classList.add("col-sm-12");
                four.classList.add("input-group");
                three.appendChild(four);
                
                //  five
                var five = document.createElement("div");
                five.classList.add("input-group-addon");
                four.appendChild(five);
                
                //  img
                var img = document.createElement("img");
                img.setAttribute("src", restaurants[i].thumb);
                img.setAttribute("alt", "IMG");
                img.setAttribute("height", "45");
                img.setAttribute("width", "45");
                five.appendChild(img);
                
                //  six
                var six = document.createElement("div");
                six.classList.add("input-group-addon");
                four.appendChild(six);
                
                //  h2
                var h3 = document.createElement("h3");
                var a = document.createElement("a");
                a.setAttribute("href", "../php/restaurantHome.php?restId=" + restaurants[i].restaurant_id);
                h3.appendChild(a);
                var restaurantName = document.createTextNode(restaurants[i].name);
                a.appendChild(restaurantName);
                six.appendChild(h3);
                
                //  seven
                var seven = document.createElement("div");
                seven.classList.add("row");
                seven.classList.add("card-items-row-padding-address");
                two.appendChild(seven);
                
                //  eight
                var eight = document.createElement("div");
                eight.classList.add("col-sm-2");
                seven.appendChild(eight);
                
                //  nine
                var nine = document.createElement("div");
                nine.classList.add("col-sm-10");
                var restaurantAddress = document.createTextNode(restaurants[i].address);
                nine.appendChild(restaurantAddress);
                seven.appendChild(nine);
                
                //  ten
                var ten = document.createElement("div");
                ten.classList.add("row");
                ten.classList.add("card-items-row-padding");
                two.appendChild(ten);
                
                //  eleven
                var eleven = document.createElement("div");
                eleven.classList.add("col-sm-12");
                var restaurantRatingAndText = document.createTextNode("Rating: " + restaurants[i].rating + " | " + restaurants[i].rating_text);
                eleven.appendChild(restaurantRatingAndText);
                ten.appendChild(eleven);
                
                //  twelve
                var twelve = document.createElement("div");
                twelve.classList.add("row");
                twelve.classList.add("card-items-row-padding");
                two.appendChild(twelve);
                
                //  thirteen
                var thirteen = document.createElement("div");
                thirteen.classList.add("btn-group");
                thirteen.setAttribute("role", "group");
                thirteen.setAttribute("aria-label", "ThreeButton");
                twelve.appendChild(thirteen);
                
                //  buttonOne
                var buttonOne = document.createElement("button");
                buttonOne.classList.add("btn");
                buttonOne.classList.add("btn-secondary");
                buttonOne.setAttribute("type", "button");
                buttonOne.setAttribute("onclick", "redirectToMenuOfRest('" + restaurants[i].menu_url + "')");
                var restaurantMenu = document.createTextNode("Menu");
                buttonOne.appendChild(restaurantMenu);
                thirteen.appendChild(buttonOne);
                
                //  buttonTwo
                var buttonTwo = document.createElement("button");
                buttonTwo.setAttribute("type", "button");
                buttonTwo.classList.add("btn");
                buttonTwo.classList.add("btn-secondary");
//                buttonTwo.setAttribute("data-toggle", "modal");
//                buttonTwo.setAttribute("data-target", "#exampleModalCenter");
                buttonTwo.setAttribute("id", "suggestionModalButton");
                buttonTwo.setAttribute("data-username", user);
                buttonTwo.setAttribute("data-restaurantId", restaurants[i].restaurant_id);
                buttonTwo.setAttribute("onclick", "suggestionButtonCalled(" + restaurants[i].restaurant_id + ", '" + user + "')");
                var restaurantSuggestion = document.createTextNode("Suggestion");
                buttonTwo.appendChild(restaurantSuggestion);
                thirteen.appendChild(buttonTwo);
                
                //  buttonThree
                var buttonThree = document.createElement("button");
                buttonThree.setAttribute("type", "button");
                buttonThree.classList.add("btn");
                buttonThree.classList.add("btn-secondary");
//                buttonThree.setAttribute("data-toggle", "modal");
//                buttonThree.setAttribute("data-target", "#exampleModalCenter1");
                buttonThree.setAttribute("onclick", "reviewButtonCalled(" + restaurants[i].restaurant_id + ", '" + user + "')");
                var restaurantReview = document.createTextNode("Review");
                buttonThree.appendChild(restaurantReview);
                thirteen.appendChild(buttonThree);

                appendChildToPage.appendChild(mainRowDiv);
           
//                console.log(restaurants[i].restaurant_id);
//                console.log(restaurants[i].name);           //  Used
//                console.log(restaurants[i].menu_url);       //  Used
//                console.log(restaurants[i].thumb);          //  Used
//                console.log(restaurants[i].address);        //  Used
//                console.log(restaurants[i].city_id);        //  Not needed
//                console.log(restaurants[i].rating);         //  Used
//                console.log(restaurants[i].rating_text);    //  Used
     
            }
            
        }
    }
    httpReq.open("GET", "../php/getAllRestaurants.php?state="+state+"&city="+city+"&cuisine_id="+cuisine_id, false);
    httpReq.send(null);
    
} 





//  This function will create an object for http request
function createRequestObject(){
    var ajaxSender;
    try {
      ajaxSender = new XMLHttpRequest();
    }catch (e) {
      try {
         ajaxSender = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         try{
            ajaxSender = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
            alert("Your browser broke!");
         }
      }
    }
    return ajaxSender;
}

//  This function will redirect to the menu page of a restaurant
function redirectToMenuOfRest(url){
    window.location.href = url;
}


//  This function will return the username from session ID
function getUserName(){
    console.log("Get User Name function called");
    
    var returnValue = "";
    
    var httpReq = createRequestObject();
    httpReq.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            
            returnValue = this.responseText;
        }
    }
    
    httpReq.open("GET", "../php/getUserNameFromSession.php", false);
    httpReq.send(null);
    
    return returnValue;
}

//  This function is called when submission button is clicked
function suggestionButtonCalled(restId, user){
    window.location.replace("../php/writeSuggestion.php?restId="+restId+"&user="+user);
}

//  This function is called when review button is clicked
function reviewButtonCalled(restId, user){
    window.location.replace("../php/writeReview.php?restId="+restId+"&user="+user);
}

//  This function will add a restaurant as favorite
function favoriteThisRestaurant(restId){
    
    var b = document.getElementById("favButton");
    
    if(b.value == "false"){
       var httpReq = createRequestObject();
        httpReq.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                if(this.responseText == true){
                    var t = document.createTextNode("Added to Favorite");
                    b.innerHTML = "";
                    b.appendChild(t);
                    b.value = "true";
                    
                }else{
                     var t = document.createTextNode("Add to Favorite");
                    b.innerHTML = "";
                    b.appendChild(t);
                    b.value = "false";
                }

            }
        }
        httpReq.open("GET", "../php/addFavorite.php?restId="+restId, true);
        httpReq.send(null);
    }else{
        alert("Will write function for unfavorite");
    }
    
    
}

//  This function will set the favorite button text onload of the page
function checkForFavorite(favBool){
    //alert(favBool);
    
    var btn = document.getElementById("favButton");
    
    if (favBool == true){
        var t = document.createTextNode("Added to Favorite");
        btn.appendChild(t);
        btn.value = "true";
    }else{
        var t = document.createTextNode("Add to Favorite");
        btn.appendChild(t);
        btn.value = "false";
    }
}





//  This function will add is-invalid to the division  
function turnFieldToRedColorBorder(elementName){
    elementName.classList.add("is-invalid");
}

//  This function is called when the login modal opener button is called
function loginModalOpener(){
    
    var loginUsername = document.getElementById('username_login');
    var loginPassword = document.getElementById('password_login');
    
//    if(loginUsername.value == ""){
//       turnFieldToNormalColorBorder(loginUsername);
//    }
//    
//    if(loginPassword.value == ""){
//        turnFieldToNormalColorBorder(loginPassword);
//    }
}