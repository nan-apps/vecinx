<?php

namespace App\Http\Controllers;

use App\Http\Requests\NeighbourRequest;
use App\Models\Hood;
use App\Models\Neighbour;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NeighbourController extends Controller
{
    protected $model;
    protected $hoodModel;
    private $tagModel;

    function __construct(Neighbour $model, Hood $hoodModel, Tag $tagModel)
    {
        $this->model = $model;
        $this->hoodModel = $hoodModel;
        $this->tagModel = $tagModel;
    }

    public function index()
    {
        return view('neighbours.index', [
            'neighbours' => $this->model->byName()->get()
        ]);
    }

    public function create()
    {
        return view('neighbours.create', array_merge($this->getFormCollections(), [
            'neighbour' => $this->getCreateObject()
        ]));
    }

        private function getCreateObject()
        {
            $data = Session::hasOldInput() ? Session::getOldInput() : ['enable' => TRUE];
            return new Neighbour($data);
        }

    public function store(NeighbourRequest $request)
    {
      $valid = $request->validated();
      $this->model->create($request->all());
      return redirect('/neighbours')->with('status', '¡Vecinx creado!');
    }

    public function edit($id)
    {
        $neighbour = $this->getEditObject($id);
        return view('neighbours.edit', array_merge($this->getFormCollections(), [
            'neighbour' => $neighbour,
            'notes' => $neighbour->notes()->byNewest()->take(5)->get()
        ]));
    }

        private function getEditObject($id)
        {
            $neighbour = $this->model->find($id);
            if(Session::hasOldInput()){
                $neighbour->fill(Session::getOldInput());
            }
            return $neighbour;
        }

    public function update(NeighbourRequest $request, $id)
    {
      $valid = $request->validated();
      $obj = $this->model->find($id);
      $obj->enable = $request->boolean('enable');
      $obj->update($request->all());
      return redirect('/neighbours')->with('status', '¡Vecinx actualizadox');
    }

    private function getFormCollections()
    {
        return [
            'hoods' => $this->hoodModel->enable()->byName()->get(),
            'tags' => $this->tagModel->byName()->get(),
        ];
    }

    
}
