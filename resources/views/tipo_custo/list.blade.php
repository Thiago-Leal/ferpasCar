<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th style="width: 10px">#</th>
            <th>Nome</th>
            <th>Data de Criação</th>
            <th></th>
        </tr>
        @foreach ($tipo_custos as $key => $tipo_custo)
            <tr>
                <td>{{$tipo_custo->id}}.</td>
                <td>{{$tipo_custo->name}}</td>
                <td>{!! date('d/m/Y', strtotime($tipo_custo->created_at)) !!}</td>                
                <td>
                    <div class="btn-group pull-right">
                        @include('tipo_custo.actions')
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</div>
