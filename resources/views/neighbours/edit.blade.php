@include('neighbours.form', [
	'title' => 'Editar vecnix',
	'action' => route('neighbours.update', $neighbour->id),
	'method' => 'PUT'
])
