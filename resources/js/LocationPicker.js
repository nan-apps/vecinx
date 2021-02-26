
window.LocationPicker = class LocationPicker {


  constructor(options){
    this.options = options;
    this.map = null;
    this.marker = null;
    this.circle = null;
  }

  init(){

    let container = L.DomUtil.get(this.options['mapId']);
    if(container != null){
      container._leaflet_id = null;
    }

    try{
      this.map = new L.Map(this.options['mapId']);
    }catch(e){
      console.log(e);
    }

    var osmUrl='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    var osmAttrib='Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';
    var osm = new L.TileLayer(osmUrl, {minZoom: 1, maxZoom: 20, attribution: osmAttrib});
    this.map.setView([this.options["lat"], this.options["lng"]],this.options["zoom"]);
    this.map.addLayer(osm);
    
    this.marker = new L.marker([this.options["lat"], this.options["lng"]], {draggable:'true'});
    if(this.options["radius"]){
      circle = new L.circle([this.options["lat"], this.options["lng"]], this.options["radius"], {
        weight: 2
      });
    }
    
    
    this.marker.on('dragend', (e) => {
      if(this.circle) this.circle.setLatLng(e.target.getLatLng());
      this.map.setView(e.target.getLatLng());
      $("#"+this.options.latitudeId).val(e.target.getLatLng().lat);
      $("#"+this.options.longitudeId).val(e.target.getLatLng().lng);
    });
    
    this.map.addLayer(this.marker);
    if(this.circle) this.map.addLayer(this.circle);

    $("#"+this.options.latitudeId).val(this.options["lat"]);
    $("#"+this.options.latitudeId).on('change', function(){
      this.marker.setLatLng([Number($(this).val()), this.marker.getLatLng().lng]);
      if(this.circle) this.circle.setLatLng(this.marker.getLatLng());
      this.map.setView(this.marker.getLatLng());
    });

    $("#"+this.options.longitudeId).val(this.options["lng"]);
    $("#"+this.options.longitudeId).on('change', function(){
      marker.setLatLng([marker.getLatLng().lat, Number($(this).val())]);
      if(this.circle) this.circle.setLatLng(marker.getLatLng());
      this.map.setView(marker.getLatLng());
    });

    $("#"+this.options.radiusId).val(this.options["radius"]);
    
    if(this.circle){
      $("#"+this.options.radiusId).on('change', function(){
        this.circle.setRadius(Number($(this).val()));
      });
    }

    $("#"+this.options.addressId).on('change', (e) => {
      let address = $(e.target).val() + ", " + (this.options.defaultAddressCity + ", " || "") + 
      (this.options.defaultAddressCountry);
      
      var item = this.searchLocation(address, (item) => {this.newLocation(item)});
    });

  }

  newLocation(item){
    if(typeof item == "undefined") return;
    $("#"+this.options.latitudeId).val(item.lat);
    $("#"+this.options.longitudeId).val(item.lon);
    this.marker.setLatLng([item.lat, item.lon]);
    if(this.circle) this.circle.setLatLng([item.lat, item.lon]);
    this.map.setView([item.lat, item.lon]);
  }

  searchLocation(text, callback){
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

  destroy(){
    this.map.off();
    this.map.remove();
    document.getElementById('locationPicker').innerHTML = "<div id='map' style='width: 100%; height: 100%;'></div>";
    this.map = null;
    this.marker = null;
    this.circle = null;
  }


}
