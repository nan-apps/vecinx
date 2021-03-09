<div class="modal-dialog modal-xl">
  <div class="modal-content">

    <form method="POST" action="{{$action}}" class="" >

      @method($method ?? 'POST')

      <div class="modal-header">
        <h5 class="modal-title">{{$title}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="alert alert-danger alert-validation d-none" >
          
        </div>

        <div class="row" >

          <div class="col-md-6" >

            <x-form.buttons-switch 
            label="Recorrido" 
            name="route_id" 
            :collection="$routes" 
            :selected="$address->route_id"
            size="" />

            <x-form.input-text label="Dirección" name="address" :value="$address->address" />

            <x-form.select label="Barrio" name="hood_id" :collection="$hoods" :selected="$address->hood_id" />

            <div class="row" >
              <div class="col-md-6" >
                <x-form.input-text label="Latitud" name="lat" :value="$address->lat" />
              </div>
              <div class="col-md-6" >
                <x-form.input-text label="Longitud" name="lng" :value="$address->lng" />
              </div>
            </div>
            <x-form.input-text label="Notas sobre la parada" name="address_notes" :value="$address->address_notes" />
          </div>

          <div class="col-md-6" >
            <div id="locationPicker" style="width: 100%; height: 100%;"></div>
          </div>

        </div>
        


      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>

    </form>
  </div>
</div>



