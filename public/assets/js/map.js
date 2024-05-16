
function update_location(){
  $.ajax({
    url:  'https://maps.googleapis.com/maps/api/geocode/json?latlng='+latitude+','+longitude+'&key=AIzaSyCjYhtM2Uchr6m8BuU5hBFlTteFeZrHUWA',
    method: "Get",
    processData : false,
    dataType : 'json',
    

success: function(response) {

     json = JSON.stringify(response);
     data = JSON.parse(json);
     var address = data.results[2].formatted_address;
     $('#location').text(address);
   
}
  });

}
update_location();
   

/***
 * 
 * 
 */

function initMaps() {
  var defaultMap = {
    zoom: 20,
    // this removes all the other come-with markers on the side
    styles: [
    {
    "featureType": "poi",
    "stylers": [
      { "visibility": "off" }
    ]
  }
],
    center: {
      lat:latitude,
      lng: longitude,
    },
    mapTypeId: google.maps.MapTypeId.HYBRID
  };
  var map = new google.maps.Map(document.getElementById("default_map"), defaultMap);


  var marker = new google.maps.Marker({
    position: new google.maps.LatLng(latitude, longitude),
    map:map,
    icon:"https://img.icons8.com/color/48/visit.png"
  });
  }


  const dialog = document.querySelector("#dialog-1");
  const dialog2 = document.querySelector("#dialog-2");

  $("#cancel-1").click(function(){
   dialog.close();
  });

  $("#confirm-1").click(function(){
    dialog.close();
    reset();
   });

  $("#cancel-2").click(function(){
    dialog2.close();
   });
      $("#confirm-2").click(function(){
     dialog2.close();
     resetlimit();
    });
   
  $("#download").click(function(){
  window.location = "/download/001";
});
$("#reset").click(function(){
dialog.showModal();
});
function reset(){
    var route= "/resetMeter";
  $.ajax({
    url:route,
    type:'GET',
  
    success:
    function(result){
      if(result !== null && result['success'] !== null){
        $('.device-card-body').prepend(' <div id="success" class=' + '"alert alert-success" style="margin:0px"'+'><ul style="list-style-type:none;"><li>Reset Meter Successfully</li>'+
        '</ul></div>');
           }
           setTimeout(fade_out, 3000);

function fade_out() {
  $("#success ").fadeOut().empty();
}
 
      
    }
    
});
}
$("#resetLimit").click(function(){
  dialog2.showModal();

});

function resetlimit(){

    var route= "/resetLimit";
  $.ajax({
    url:route,
    type:'GET',
  
    success:
    function(result){
      if(result !== null && result['success'] !== null){
         $('.device-card-body').prepend(' <div id="success" class=' + '"alert alert-success" style="margin:0px"'+'><ul style="list-style-type:none;"><li>Reset Limit Successfully</li>'+
        '</ul></div>');
           }
           setTimeout(fade_out, 3000);

function fade_out() {
  $("#success").fadeOut().empty();
}
    
      
    }
    
});
}




   
   



