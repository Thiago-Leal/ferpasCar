@if ($custo->trashed())
    {!! Form::open(['method' =>	'POST','route' => ['custo.restroy',	$custo->id],'style'=>'display:inline']) !!}
    <button class="btn btn-warning btn-sm" data-toggle="tooltip" title="Registro excluido em {{ date('d/m/Y H:i:s', strtotime($custo->deleted_at)) }}">
        <i class="fas fa-reply"></i> Restaurar
    </button>
@else
    {!! Form::open(['name' => 'form','method' => 'DELETE','route' => ['custo.destroy',	$custo->id],'style'=>'display:inline']) !!}
    <button class="btn btn-danger btn-sm" type="button" onclick="form.submit()">
        <i class="fa fa-trash-alt">Excluir</i>
    </button>
@endif

<a class="btn btn-info btn-sm" href="{{ route('custo.edit',$custo->id) }}"><i class="fa fa-edit"></i> Editar</a>

{!! Form::close()	!!}
