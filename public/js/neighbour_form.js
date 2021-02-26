$(function(){

  $("a.open-remote-modal").on("click", function(){
    let href = this.href;

    let remoteModal = new RemoteModal(href);

    remoteModal.open((modal) => {

      let locationPicker = new LocationPicker({
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
      });
      locationPicker.init();

      $('#remote-modal #hood_id').selectpicker();

      let remoteForm = new RemoteForm(modal.find('form'))
      remoteForm.successCallback = () => {
        remoteModal.close();
      }
      remoteForm.init();

    });

    return false;
  });


});
