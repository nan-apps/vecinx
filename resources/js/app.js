require('leaflet')
require('./bootstrap');
require('bootstrap-select');
require('./OSMLocationPicker');
require('./VecinxsMap');



$(function(){
  
  $(".delete-form").on("submit", () => {
    return confirm("¿Seguro querés borrar el elemento?");
  });

  $(".submit-on-click").on("click", function(){
    $(this).closest("form").submit();
  });

  $('.submit-on-change').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
    $(e.target).closest("form").submit();
  });


});
