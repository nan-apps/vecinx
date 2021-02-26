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
    return response()->json([
      'html' => view('addresses.form', $this->getFormCollections())->render(),
      'success' => true,
    ]);
  }

  public function store(AddressRequest $request)
  {
    $address = $this->addressModel->create($request->all());
    return response()->json([
      'success' => true,
      'address' => $address->address,
      'id' => $address->id,
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
