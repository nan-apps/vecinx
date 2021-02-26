
window.RemoteModal = class RemoteModal{


  constructor(url){
    this.url = url;
  }

  open(callback, closeCallback){

    axios.get(this.url).then( (response) => {
    if(response.data.success){

      $("#remote-modal").html(response.data.html);
      $("#remote-modal").on('shown.bs.modal', function(){
        callback($("#remote-modal"));
      });
      
      if(closeCallback){
        $("#remote-modal").on('hidden.bs.modal', function(){
          closeCallback($("#remote-modal"));
        });
      }

      $("#remote-modal").modal('show');

    } else {
      alert("Error obteniendo datos para el mapa");
    }
      

    }).catch(function (error) {
      console.log(error);
      alert("Error obteniendo datos");
    });
  }

  close(){
    $("#remote-modal").modal('hide');
  }


}
