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
                card_holder_id.classList.add("col-lg-4");
                mainRowDiv.appendChild(card_holder_id);
                
                var card_id = document.createElement("div");
                card_id.classList.add("custom-card");
                card_holder_id.appendChild(card_id);
                
                var row_one_in_card = document.createElement("div");
                row_one_in_card.classList.add("row");
                card_id.appendChild(row_one_in_card);
                
                var thumb_holder = document.createElement("div");
                thumb_holder.classList.add("col-3", "col-lg-3");
                row_one_in_card.appendChild(thumb_holder);
                
                if (restaurants[i].thumb == ""){
                    restaurants[i].thumb = "../asset/food-image.png";
                }
                
                var thumb_id = document.createElement("img");
                thumb_id.setAttribute("src", restaurants[i].thumb);
                thumb_id.setAttribute("id", "thumb_id");
                thumb_holder.appendChild(thumb_id);
                
                var name_address_holder = document.createElement("div");
                name_address_holder.classList.add("col-9", "col-lg-9");
                name_address_holder.setAttribute("id", "name_address_holder");
                row_one_in_card.appendChild(name_address_holder);
                
                var name_add_holder_child = document.createElement("div");
                name_add_holder_child.classList.add("row");
                name_address_holder.setAttribute("id", "name_add_holder_child");
                name_address_holder.appendChild(name_add_holder_child);
                
                var rest_name_id = document.createElement("div");
                rest_name_id.classList.add("col-lg-12");
                rest_name_id.setAttribute("id", "rest_name_id");
                var anchor_tag_for_name = document.createElement("a");
                anchor_tag_for_name.setAttribute("href", "#");
                var rest_name_test = document.createTextNode(restaurants[i].name);
                anchor_tag_for_name.appendChild(rest_name_test);
                name_add_holder_child.appendChild(anchor_tag_for_name);
                
                
                var rest_address_id = document.createElement("div");
                rest_address_id.classList.add("col-lg-12");
                rest_address_id.setAttribute("id", "rest_address_id");
                var rest_address_test = document.createTextNode(restaurants[i].address);
                rest_address_id.appendChild(rest_address_test);
                name_add_holder_child.appendChild(rest_address_id);
                
                var name_address_holder = document.createElement("div");
                name_address_holder.classList.add("col-9", "col-lg-9");
                name_address_holder.setAttribute("id", "name_address_holder");
                row_one_in_card.appendChild(name_address_holder);
                
                var row_two_in_card = document.createElement("div");
                row_two_in_card.classList.add("row");
                row_two_in_card.setAttribute("id", "row_two_in_card");
                card_id.appendChild(row_two_in_card);
                
                var rating_and_text_holder = document.createElement("div");
                rating_and_text_holder.classList.add("col-12", "col-lg-3");
                rating_and_text_holder.setAttribute("id", "rating_and_text_holder");
                row_two_in_card.appendChild(rating_and_text_holder);
                
                var rating_text_holder_row = document.createElement("div");
                rating_text_holder_row.classList.add("row");
                rating_text_holder_row.setAttribute("id", "rating_text_holder_row");
                rating_and_text_holder.appendChild(rating_text_holder_row);
                
                var rating_holder = document.createElement("div");
                rating_holder.classList.add("col-6", "col-lg-12");
                rating_holder.setAttribute("id", "rating_holder");
                rating_text_holder_row.appendChild(rating_holder);
                
                var rating_id = document.createElement("div");
                rating_id.setAttribute("id", "rating_id");
                var rating_text = document.createTextNode("Rating: " + restaurants[i].rating);
                rating_id.appendChild(rating_text);
                rating_holder.appendChild(rating_id);
                
                var rating_text_holder = document.createElement("div");
                rating_text_holder.classList.add("col-6", "col-lg-12");
                rating_text_holder.setAttribute("id", "rating_text_holder");
                rating_text_holder_row.appendChild(rating_text_holder);
                
                var rating_text_id = document.createElement("div");
                rating_text_id.setAttribute("id", "rating_text_id");
                var rating_text_text = document.createTextNode(restaurants[i].rating_text);
                rating_text_id.appendChild(rating_text_text);
                rating_text_holder.appendChild(rating_text_id);
                
                var all_buttons_holder = document.createElement("div");
                all_buttons_holder.classList.add("col-12", "col-lg-9");
                rating_holder.setAttribute("id", "all_buttons_holder");
                row_two_in_card.appendChild(all_buttons_holder);
                
                var three_buttons = document.createElement("div");
                three_buttons.setAttribute("id", "three_buttons");
                all_buttons_holder.appendChild(three_buttons);
                
                
                var three_buttons_holder_group = document.createElement("div");
                three_buttons_holder_group.classList.add("btn-group");
                three_buttons_holder_group.setAttribute("id", "three_buttons_holder_group");
                three_buttons_holder_group.setAttribute("role", "group");
                three_buttons_holder_group.setAttribute("aria-label", "Basic Example");
                three_buttons.appendChild(three_buttons_holder_group);
                
                var menu_button_id = document.createElement("button");
                menu_button_id.classList.add("btn", "btn-secondary");
                menu_button_id.setAttribute("type", "button");
                menu_button_id.setAttribute("id", "menu_button_id");
                var menu_button_text = document.createTextNode("Menu");
                menu_button_id.appendChild(menu_button_text);
                three_buttons_holder_group.appendChild(menu_button_id);
                
                var suggestion_button_id = document.createElement("button");
                suggestion_button_id.classList.add("btn", "btn-secondary");
                suggestion_button_id.setAttribute("type", "button");
                suggestion_button_id.setAttribute("id", "suggestion_button_id");
                var suggestion_button_text = document.createTextNode("Suggestion");
                suggestion_button_id.appendChild(suggestion_button_text);
                three_buttons_holder_group.appendChild(suggestion_button_id);
                
                var review_button_id = document.createElement("button");
                review_button_id.classList.add("btn", "btn-secondary");
                review_button_id.setAttribute("type", "button");
                review_button_id.setAttribute("id", "review_button_id");
                var review_button_text = document.createTextNode("Review");
                review_button_id.appendChild(review_button_text);
                three_buttons_holder_group.appendChild(review_button_id);
                
                
                
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