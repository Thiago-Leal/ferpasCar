<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th style="width: 10px">#</th>
            <th>Nome</th>
            <th>Valor</th>
            <th>Data de Criação</th>
            <th></th>
        </tr>
        @foreach ($tipo_receitas as $key => $tipo_receita)
            <tr>
                <td>{{$tipo_receita->id}}.</td>
                <td>{{$tipo_receita->name}}</td>
                <td>R$ {{number_format($tipo_receita->valor, 2, ',', '.')}}</td>
                <td>{!! date('d/m/Y', strtotime($tipo_receita->created_at)) !!}</td>                
                <td>
                    <div class="btn-group pull-right">
                        @include('tipo_receita.actions')
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</div>
