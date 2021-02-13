require('leaflet')
require('./bootstrap');
require('./OSMLocationPicker');


$(function(){
  
  $(".delete-form").on("submit", () => {
    return confirm("¿Seguro querés borrar el elemento?");
  });

  $(".submit-on-click").on("click", function(){
    $(this).closest("form").submit();
  });

});
