<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Neighbour;
use App\Models\Note;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NoteController extends Controller
{
  private $model;
  private $neighbourModel;
  private $tagModel;

  public function __construct(Note $model, Neighbour $neighbourModel, Tag $tagModel)
  {
    $this->model = $model;
    $this->neighbourModel = $neighbourModel;
    $this->tagModel = $tagModel;
  }

  public function index(Request $request, $neighbourId)
  {
    $neighbour = $this->neighbourModel->find($neighbourId);
    return view('notes.index', [
      'neighbour' => $neighbour,
      'notes' => $this->getNeighbourNotes($request, $neighbour),
      'tags' => $this->tagModel->byName()->get(),
      'tagId' => $request->input('tag_id')
    ]);
  }

    private function getNeighbourNotes($request, $neighbour)
    {
      return $neighbour
        ->notes()
        ->byNewest()
        ->byTagId($request->input('tag_id'))
        ->get();
    }

  public function create($neighbourId)
  {
    $neighbour = $this->neighbourModel->find($neighbourId);
    return view('notes.create', [
      'neighbour' => $neighbour,
      'note' => $this->getCreateObject(),
      'tags' => $this->tagModel->byName()->get()
    ]);
  }

    private function getCreateObject()
    {
      $data = Session::hasOldInput() ? Session::getOldInput() : [];
      return new Note($data);
    }

  public function store(NoteRequest $request, $neighbourId)
  {
    $valid = $request->validated();
    $this->model->create(array_merge(['neighbour_id' => $neighbourId], $request->all()));
    return $this->redirectToIndex($neighbourId, 'Nota creada!');
  }

  public function edit($neighbourId, $id)
  {
    $neighbour = $this->neighbourModel->find($neighbourId);
    return view('notes.edit', [
      'neighbour' => $neighbour,
      'note' => $this->getEditObject($id),
      'tags' => $this->tagModel->byName()->get()
    ]);
  }

    private function getEditObject($id)
    {
      $obj = $this->model->find($id);
      if(Session::hasOldInput()){
        $obj->fill(Session::getOldInput());
      }
      return $obj;
    }

  public function update(NoteRequest $request, $neighbourId, $id)
  {
    $valid = $request->validated();
    $obj = $this->model->find($id);
    $obj->update($request->all());
    return $this->redirectToIndex($neighbourId, 'Nota actualizada!');
  }

  public function destroy($neighbourId, $id)
  {
    $obj = $this->model->find($id);
    $obj->delete();
    return $this->redirectToIndex($neighbourId, 'Nota borrada!');
  }

    private function redirectToIndex($neighbourId, $statusMsg)
    {
      return redirect()->route('neighbours.notes.index', [$neighbourId])->with('status', $statusMsg);
    }



}
