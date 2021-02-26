<?php

namespace App\Http\Controllers;

use App\Http\Requests\NeighbourRequest;
use App\Models\Address;
use App\Models\Hood;
use App\Models\Neighbour;
use App\Models\Route;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NeighbourController extends Controller
{
  protected $request;
  protected $neighbourModel;
  protected $hoodModel;
  protected $tagModel;
  protected $routeModel;
  protected $addressModel;

  function __construct(
    Request $request,
    Neighbour $neighbourModel,
    Hood $hoodModel,
    Tag $tagModel,
    Route $routeModel,
    Address $addressModel
  )
  {
    $this->request = $request;
    $this->neighbourModel = $neighbourModel;
    $this->hoodModel = $hoodModel;
    $this->tagModel = $tagModel;
    $this->routeModel = $routeModel;
    $this->addressModel = $addressModel;
  }

  public function index()
  {
    return view('neighbours.index', [
      'neighbours' => $this->getFilteredNeighbours(),
      'routes' => $this->routeModel->byName()->get(),
      'routeId' => $this->request->input('route_id'),
      'withDeleted' => $this->request->input('with_deleted'),
    ]);
  }

  public function create()
  {
    return view('neighbours.create', array_merge($this->getFormCollections(), [
      'neighbour' => $this->fillModel($this->neighbourModel)
    ]));
  }

  public function store(NeighbourRequest $request)
  {
    $this->save($request, $this->neighbourModel);
    return redirect()->route('neighbours.edit', $this->neighbourModel)->with('status', '¡Vecinx creadx, ahora podes cargarle notas!');
  }

  public function edit(Neighbour $neighbour)
  {
    return view('neighbours.edit', array_merge($this->getFormCollections(), [
      'neighbour' => $this->fillModel($neighbour),
      'notes' => $neighbour->notes()->byNewest()->take(5)->get()
    ]));
  }

  public function update(NeighbourRequest $request, Neighbour $neighbour)
  {
    $this->save($request, $neighbour);
    return redirect()->route('neighbours.index')->with('status', '¡Vecinx actualizadx!');
  }

  public function enable(Neighbour $neighbour, $value)
  {
    $neighbour->fill(['enable' => $value])->save();
    return redirect()->route('neighbours.index')->with('status', '¡Vecinx actualizadx!');
  }

  public function destroy(Neighbour $neighbour)
  {
    $neighbour->delete();
    return redirect()->route('neighbours.index')->with('status', '¡Vecinx borradx!');
  }

  public function restore($neighbourId)
  {
    $neighbour = $this->neighbourModel->where(['id' => $neighbourId])->onlyTrashed()->get()->first();
    $neighbour->restore();
    return redirect()->route('neighbours.index')->with('status', '¡Vecinx reestablecidx!');
  }

  protected function getFilteredNeighbours()
  {
     $results =  $this->neighbourModel
     ->byName()
     ->byRoute($this->routeModel->find($this->request->input('route_id')));

     if($this->request->input('with_deleted'))
      $results = $results->onlyTrashed();

     return $results->get();
  }

  protected function fillModel(Neighbour $neighbour)
  {
    if($this->request->old()){
      $neighbour->enable = $this->request->old('enable');
      $neighbour->fill($this->request->old());
    }
    return $neighbour;
  }

  protected function save(NeighbourRequest $request, Neighbour $neighbour)
  {
    $neighbour->enable = $request->boolean('enable');
    $neighbour->fill($request->all())->save();
  }

  protected function getFormCollections()
  {
    return [
      'hoods' => $this->hoodModel->enable()->byName()->get(),
      'addresses' => $this->addressModel->get()
    ];
  }


}
