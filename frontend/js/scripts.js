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

//  This function is called when the search button is clicked
function searchRestaurants(){
    alert("Entered function");
    
    var state = document.getElementById("state_id").value;
    var city = document.getElementById("city_id").value;
    var cuisine_id = document.getElementById("cuisine_id").value;
    
    var httpReq = createRequestObject();
    httpReq.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
        }
    }
    httpReq.open("GET", "../php/getAllRestaurants.php?state="+state+"&city="+city+"&cuisine_id="+cuisine_id, true);
    httpReq.send(null);
    
}   