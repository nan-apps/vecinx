
window.NeighbourForm = class NeighbourForm {


  constructor(){
    this.remoteModal = null;
  }

  init(){
    this.attachNewAddressClickListener();
    this.attachAddrressIdChangeListener();
  }

  attachNewAddressClickListener(){
    $("a.new-address, a.edit-address").on("click", (e) => {
      let href = e.target.href;
      this.remoteModal = new RemoteModal(href);
      this.remoteModal.open((modal) => {

        this.initLocationPicker();
        this.initSelectPicker();
        this.initRemoteForm(modal.find('form'));

      });

      return false;
    });

  }

    initLocationPicker(){
      (new LocationPicker({
        mapId: "locationPicker",
        lat: $("#lat").val() || -34.62713418834205,
        lng: $("#lng").val() || -58.491122006727366,
        radius: null,
        zoom: 15,
        addressId: "address",
        latitudeId: "lat",
        longitudeId: "lng",
        longitudeId: "lng",
        radiusId: "radius", 
        defaultAddressCountry: "Argentina",
        defaultAddressCity: "CABA",
      })).init();

    }

    initSelectPicker(){
      $('#remote-modal #hood_id').selectpicker();
    }

    initRemoteForm(form){
      let remoteForm = new RemoteForm(form)
      remoteForm.successCallback = (response) => {
        this.remoteModal.close();

        if(response.id){
          $("#address_id").append(new Option(response.address, response.id));
          $('.selectpicker').selectpicker('val', response.id);
        } else {
          $("#address_id option:selected").html(response.address);
        }
        $('#address_id').selectpicker('refresh');

      }
      remoteForm.init();
    }

    attachAddrressIdChangeListener(){

      $("#address_id").on("change", (e) => {
        if(e.target.value){
          $(".edit-address").removeClass("d-none");
          $(".edit-address").attr("href", "/addresses/" + e.target.value + "/edit");
        } else {
          $("#btn-edit-stop").hide();
        }
      })

    }



}
