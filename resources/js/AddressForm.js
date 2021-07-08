
window.AddressForm = class AddressForm {


  constructor({submitSuccessCallback}){
    this.remoteModal = null;
    this.submitSuccessCallback = submitSuccessCallback;
  }

  init(){
    this.attachAddressCrudClickListener();
  }

  attachAddressCrudClickListener(){
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
        this.submitSuccessCallback(response);
        this.remoteModal.close();
      }
      remoteForm.validationCallback = (response) => {
        $("#remote-modal").animate({ scrollTop: 0 }, 'slow');
      }
      remoteForm.init();
    }


}
