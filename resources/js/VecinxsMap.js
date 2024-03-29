
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
      let icon = L.icon({
          iconUrl: markerData.iconPath,
          iconSize: [35, 42],
          //iconAnchor: [22, 94],
          popupAnchor: [0, 5],
          //shadowUrl: 'my-icon-shadow.png',
          //shadowSize: [68, 95],
          //shadowAnchor: [22, 94]
      });

      marker = new L.marker([markerData.lat, markerData.lng], {icon: icon});
      marker.bindPopup(this.popUpContent(markerData)).openPopup();
      this.map.addLayer(marker);
    });
  }

  popUpContent(markerData){
    let html = $("#" + this.options["neighbourDataTemplate"]).find(".content").html();
    html = html.replace("%address%", markerData['address']);
    html = markerData['name'] ? html.replace("%name%", markerData['name']) : html.replace("%name%", "");
    if(markerData['neighbours'].length == 0){
      html = html.replace("%neighbours%", "No hay vecinxs en esta parada");
    } else {
      html = html.replace("%neighbours%", markerData['neighbours'].map((neighbour)=>{
        return "<i class='fa fa-user' ></i> " + neighbour['name'];
      }).join("<br />"));
    }
    return html;
  }


}
