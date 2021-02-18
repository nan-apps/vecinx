
window.VecinxsMap = class VecinxsMap{


  constructor(options){
    this.options = options;
    this.map = null;
  }

  init(){

    try{
      this.map = new L.Map(this.options['container']);
    }catch(e){
      console.log(e);
    }

    var osmUrl='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    var osmAttrib='Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';
    var osm = new L.TileLayer(osmUrl, {minZoom: 1, maxZoom: 20, attribution: osmAttrib});
    this.map.setView([this.options["lat"], this.options["lng"]],this.options["zoom"]);
    this.map.addLayer(osm);
  }

  setMarkers(markersData){

    markersData.forEach((markerData) => {


      marker = new L.marker([markerData.lat, markerData.lng], {});
      marker.bindPopup(this.popUpContent(markerData)).openPopup();
      this.map.addLayer(marker);
    });
  }

  popUpContent(markerData){
    let html = $("#" + this.options["neighbourDataTemplate"]).find(".content").html();
    ["name", "phone", "address"].forEach(key => {
      html = html.replace("%"+key+"%", (markerData[key] || "--"));
    });
    return html;
  }


}
