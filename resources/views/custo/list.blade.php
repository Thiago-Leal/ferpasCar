<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th style="width: 10px">#</th>
            <th>Nome</th>
            <th>Valor</th>
            <th>Tipo de Custo</th>
            <th>Data de Criação</th>
            <th></th>
        </tr>
        @foreach ($custos as $key => $custo)
            <tr>
                <td>{{$custo->id}}.</td>
                <td>{{$custo->name}}</td>
                <td>R$ {{number_format($custo->valor, 2, ',', '.')}}</td>
                <td>{{$custo->tipo_custo->name}}</td>
                <td>{!! date('d/m/Y', strtotime($custo->created_at)) !!}</td>                
                <td>
                    <div class="btn-group pull-right">
                        @include('custo.actions')
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</div>
