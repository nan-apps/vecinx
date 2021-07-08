<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\Hood;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class AddressController extends Controller
{
  private $request;
  private $addressModel;
  private $hoodModel;
  private $routeModel;

  public function __construct(Request $request, Address $addressModel, Hood $hoodModel, Route $routeModel)
  {
    $this->request = $request;
    $this->addressModel = $addressModel;
    $this->hoodModel = $hoodModel;
    $this->routeModel = $routeModel;
  }

  public function index()
  {
    return view('addresses.index', [
      'addresses' => $this->getFilteredAddresses(),
      'routes' => $this->routeModel->byName()->get(),
      'routeId' => $this->request->input('route_id'),
    ]);
  }

  public function success(){
    return redirect()->route('addresses.index')->with('status', 'Parada guardada con éxito!');
  }

  public function create()
  {
    $attrs = array_merge($this->getFormCollections(), [
      'address' => $this->addressModel
    ]);
    return response()->json([
      'html' => view('addresses.create', $attrs)->render(),
      'success' => true,
    ]);
  }

  public function store(AddressRequest $request)
  {
    DB::beginTransaction();

    try {
      
      $this->resetOrder();
      $address = $this->addressModel->create($request->all());
      if($request->order_column) #eloquent-sortable por defecto en la creación pone el orden mayor
        $address->fill(['order_column' => $request->order_column])->save();
      DB::commit();
      
      return response()->json([
        'success' => true,
        'address' => $address->full_name,
        'id' => $address->id,
      ]);
    
    } catch (\Exception $e) {
      DB::rollback();
      return response()->json(['success' => false]);
    }

  }

  public function edit(Address $address)
  {
    $attrs = array_merge($this->getFormCollections(), [
      'address' => $address
    ]);
    return response()->json([
      'html' => view('addresses.edit', $attrs)->render(),
      'success' => true,
    ]);
  }
  
  public function update(AddressRequest $request, Address $address)
  {
    $address->fill($request->all())->save();
    return response()->json([
      'success' => true,
      'address' => $address->full_name
    ]);
  }

  public function moveUp(Address $address)
  {
    $address->moveOrderUp();
    return redirect()->route('addresses.index')->with('status', '¡Orden modificado!');
  }

  public function moveDown(Address $address)
  {
    $address->moveOrderDown();
    return redirect()->route('addresses.index')->with('status', '¡Orden modificado!');
  }

  protected function resetOrder(){
    $addresses = $this->getFilteredAddresses();
    $position = 1;
    foreach($addresses as $address){
      if($this->request->order_column == $position){
        $position += 1;
      }
      $address->order_column = $position;
      $position += 1;
      $address->save();
    }
  }

  protected function resetAddressesOrder(Collection $addresses){
    foreach($addresses as $i => $address){
      $address->order_column = $i + 1;
      $address->save();
    }
  }

  protected function getFormCollections()
  {
    return [
      'hoods' => $this->hoodModel->enable()->byName()->get(),
      'routes' => $this->routeModel->byName()->get(),
    ];
  }

  private function getFilteredAddresses(){
    return $this
      ->addressModel
      ->orderBy('route_id')
      ->ordered()
      ->whereBelongsTo('route_id', $this->request->route_id)
      ->get();
  }

}
