$(function(){

  (new AddressForm({
    submitSuccessCallback: () => {
      location.href = ADDRESSES_SUCCESS_PATH;
    }
  })).init();

});
