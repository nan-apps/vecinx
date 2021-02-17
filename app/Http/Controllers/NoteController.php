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
  private $request;
  private $noteModel;
  private $neighbourModel;
  private $tagModel;

  public function __construct(
    Request $request, 
    Note $noteModel, 
    Neighbour $neighbourModel, 
    Tag $tagModel)
  {
    $this->request = $request;
    $this->noteModel = $noteModel;
    $this->neighbourModel = $neighbourModel;
    $this->tagModel = $tagModel;
  }

  public function index(Neighbour $neighbour=NULL)
  {
    return view(($neighbour ? 'neighbours.notes.index' : 'notes.index'), [
      'neighbour' => $neighbour,
      'notes' => $this->getFilteredNotes($neighbour),
      'tags' => $this->tagModel->byName()->get(),
      'tagId' => $this->request->input('tag_id')
    ]);
  }

  public function create(Neighbour $neighbour)
  {
    return view('neighbours.notes.create', $this->getFormAttributes($neighbour, $this->noteModel));
  }
  
  public function store(NoteRequest $request, Neighbour $neighbour)
  {
    $this->noteModel->neighbour_id = $neighbour->id;
    $this->noteModel->fill($request->all())->save();
    return $this->redirectToIndex($neighbour, 'Nota creada!');
  }
  
  public function edit(Neighbour $neighbour, Note $note)
  {
    return view('neighbours.notes.edit', $this->getFormAttributes($neighbour, $note));
  }


  public function update(NoteRequest $request, Neighbour $neighbour, Note $note)
  {
    $note->update($request->all());
    return $this->redirectToIndex($neighbour, 'Nota actualizada!');
  }

  public function destroy(Neighbour $neighbour, Note $note)
  {
    $note->delete();
    return $this->redirectToIndex($neighbour, 'Nota borrada!');
  }

  private function getFilteredNotes($neighbour=NULL)
  {
    return $this->noteModel
    ->byNewest()
    ->byTag($this->tagModel->find($this->request->input('tag_id')))
    ->byNeighbour($neighbour)
    ->get();
  }

  private function getFormAttributes(Neighbour $neighbour, Note $note)
  {
    return [
      'neighbour' => $neighbour,
      'note' => $this->request->old() ? $note->fill($this->request->old()) : $note,
      'tags' => $this->tagModel->byName()->get()
    ];
  }

  private function redirectToIndex(Neighbour $neighbour, $statusMsg)
  {
    return redirect()->route('neighbours.notes.index', [$neighbour])->with('status', $statusMsg);
  }



}
