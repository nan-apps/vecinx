window.OSMPICKER = (function(){
	var app = {};
	
	var map;
	var marker;
	var circle;
	app.initmappicker = function(option){
		try{
			map = new L.Map('locationPicker');
		}catch(e){
			console.log(e);
		}

		var osmUrl='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
		var osmAttrib='Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';
		var osm = new L.TileLayer(osmUrl, {minZoom: 1, maxZoom: 20, attribution: osmAttrib});
		map.setView([option["lat"], option["lng"]],option["zoom"]);
		map.addLayer(osm);
		
		if(!marker){
			marker = new L.marker([option["lat"], option["lng"]], {draggable:'true'});
			if(option["radius"]){
				circle = new L.circle([option["lat"], option["lng"]], option["radius"], {
					weight: 2
				});
			}
		}else{
			marker.setLatLng([option["lat"], option["lng"]]);
			if(circle)
				circle.setLatLng([option["lat"], option["lng"]]);
		}
		
		marker.on('dragend', function(e){
			if(circle) circle.setLatLng(e.target.getLatLng());
			map.setView(e.target.getLatLng());
			$("#"+option.latitudeId).val(e.target.getLatLng().lat);
			$("#"+option.longitudeId).val(e.target.getLatLng().lng);
		});
		
		map.addLayer(marker);
		if(circle) map.addLayer(circle);

		$("#"+option.latitudeId).val(option["lat"]);
		$("#"+option.latitudeId).on('change', function(){
			marker.setLatLng([Number($(this).val()), marker.getLatLng().lng]);
			if(circle) circle.setLatLng(marker.getLatLng());
			map.setView(marker.getLatLng());
		});

		$("#"+option.longitudeId).val(option["lng"]);
		$("#"+option.longitudeId).on('change', function(){
			marker.setLatLng([marker.getLatLng().lat, Number($(this).val())]);
			if(circle) circle.setLatLng(marker.getLatLng());
			map.setView(marker.getLatLng());
		});

		$("#"+option.radiusId).val(option["radius"]);
		
		if(circle){
			$("#"+option.radiusId).on('change', function(){
				circle.setRadius(Number($(this).val()));
			});
		}

		$("#"+option.addressId).on('change', function(){
			let address = $(this).val() + ", " + (option.defaultAddressCity + ", " || "") + 
			(option.defaultAddressCountry);
			
			var item = searchLocation(address, newLocation);
		});

		function newLocation(item){
			if(typeof item == "undefined") return;
			$("#"+option.latitudeId).val(item.lat);
			$("#"+option.longitudeId).val(item.lon);
			marker.setLatLng([item.lat, item.lon]);
			if(circle) circle.setLatLng([item.lat, item.lon]);
			map.setView([item.lat, item.lon]);
		}
		/*
		var osmGeocoder = new L.Control.OSMGeocoder({
			collapsed: false,
			position: 'bottomright',
			text: 'Find!',
		});
		map.addControl(osmGeocoder);
		*/
	};

	function searchLocation(text, callback){
		var requestUrl = "https://nominatim.openstreetmap.org/search?format=json&q="+text;
		$.ajax({
			url : requestUrl,
			type : "GET",
			dataType : 'json',
			error : function(err) {
				console.log(err);
			},
			success : function(data) {
				console.log(data);
				var item = data[0];
				callback(item);
			}
		});
	};
	
	return app;
})();
