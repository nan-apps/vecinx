<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Http\Resources\NeighbourCollection;
use App\Http\Resources\NeighbourResource;
use App\Models\Neighbour;
use App\Models\Note;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MapController extends Controller
{
  private $request;
  private $neighbourModel;

  public function __construct(Request $request, Neighbour $neighbourModel)
  {
    $this->request = $request;
    $this->neighbourModel = $neighbourModel;
  }

  public function index()
  {
    if($this->request->ajax()){
      return $this->neighboursData();
    } else {
    return view('map.index', [
      
    ]);
    }
  }

  protected function neighboursData()
  {

    return NeighbourResource::collection(
      $this->neighbourModel->enable()->get()
    );
  }


}
