  $( document ).ready(function() {
    initMap();
});
  
  function initMap() {
    var coordinates = {lat: 61, lng: 28};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 4,
      center: coordinates
    });

  }
  
  function newMarker(){
    var latitudeInput = document.getElementById("latitude").value;
    var longitudeInput = document.getElementById("longitude").value;
    
    if (isNaN(longitudeInput) || isNaN(latitudeInput)  || latitudeInput.length == 0 || longitudeInput.length == 0) {
      document.getElementById("errorField").textContent = "Input values!";
      return;
    }
    if(latitudeInput < -85 || latitudeInput > 85){
        latitudeInput = 85*Math.sign(latitudeInput)
        document.getElementById("latitude").value = latitudeInput;

    }
    if(longitudeInput < -180 || longitudeInput > 180){
        longitudeInput = 180*Math.sign(longitudeInput)
        document.getElementById("longitude").value = longitudeInput;
    }

    var latitude = parseFloat(latitudeInput);
    var longitude = parseFloat(longitudeInput);
    var coordinates = {lat: latitude, lng: longitude};
    
    
    var zoomValue = 4;
    if(latitude % 1 != 0 || longitude % 1 != 0){
      zoomValue = 5;
    }

    
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: zoomValue,
      center: coordinates
    });
    var marker = new google.maps.Marker({
      position: coordinates,
      map: map
    });
    
  }