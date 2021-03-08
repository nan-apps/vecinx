<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\Hood;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

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
    $address = $address->create($request->all());
    return response()->json([
      'success' => true,
      'address' => $address->address,
      'id' => $address->id,
    ]);
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
      'address' => $address->address
    ]);
  }

  protected function getFormCollections()
  {
    return [
      'hoods' => $this->hoodModel->enable()->byName()->get(),
      'routes' => $this->routeModel->byName()->get(),
    ];
  }

}
