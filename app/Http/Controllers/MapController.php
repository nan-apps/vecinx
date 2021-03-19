<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Http\Resources\MapAddressResource;
use App\Models\Address;
use App\Models\Note;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MapController extends Controller
{
  private $request;
  private $addressModel;

  public function __construct(Request $request, Address $addressModel)
  {
    $this->request = $request;
    $this->addressModel = $addressModel;
  }

  public function index()
  {
    if($this->request->ajax()){
      return $this->addressData();
    } else {
    return view('map.index', [
      
    ]);
    }
  }

  protected function addressData()
  {

    return MapAddressResource::collection(
      $this->addressModel->get()
    );
  }


}
