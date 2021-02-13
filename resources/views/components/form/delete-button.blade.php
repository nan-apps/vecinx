<form action="{{$route}}" method="POST" class="delete-form btn" style="display: inline-block;" >
	@csrf
	@method('DELETE')
	<button class="btn btn-danger float-right" title="Borrar">
		<x-fa>trash</x-fa>
		Borrar
	</button>
</form>
