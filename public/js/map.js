$(function(){

  let lat = $("#lat").val() || -34.62713418834205;
  let lng = $("#lng").val() || -58.491122006727366;


  let map = new VecinxsMap({
    container: 'vecinxs-map',
    neighbourDataTemplate: 'map-vecinx-template',
    lat: lat,
    lng: lng,
    zoom: 14
  });
  map.init();


  axios.get('/map').then( (response) => {
    
    if(response.data)
      map.setMarkers(response.data.data);
    else
      alert("Error obteniendo datos para el mapa");

  }).catch(function (error) {
    console.log(error);
    alert("Error obteniendo datos para el mapa");
  });


});
