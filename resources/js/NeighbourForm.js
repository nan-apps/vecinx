
window.NeighbourForm = class NeighbourForm {


  constructor(){
    this.remoteModal = null;
  }

  init(){

    this.attachAddrressIdChangeListener();
    this.initAddressRemoteForm();
  }

  initAddressRemoteForm(){
    (new AddressForm({
      submitSuccessCallback: (response) => {

        if(response.id){
          $("#address_id").append(new Option(response.address, response.id));
          $('.selectpicker').selectpicker('val', response.id);
        } else {
          $("#address_id option:selected").html(response.address);
        }
        $('#address_id').selectpicker('refresh');

      }
    })).init();
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
