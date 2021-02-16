$(function(){

	let lat = $("#lat").val() || -34.62713418834205;
	let lng = $("#lng").val() || -58.491122006727366;

    OSMPICKER.initmappicker({
        lat: lat,
        lng: lng,
        radius: null,
        zoom: 15,
        addressId: "address",
        latitudeId: "lat",
        longitudeId: "lng",
        longitudeId: "lng",
        radiusId: "radius", 
        defaultAddressCountry: "Argentina",
        defaultAddressCity: "CABA",
      });

  


});
