<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th style="width: 10px">#</th>
            <th>Nome</th>
            <th>Valor</th>
            <th>Tipo de Receita</th>
            <th>Tipo de Pagamento</th>
            <th>Data de Criação</th>
            <th></th>
        </tr>
        @foreach ($receitas as $key => $receita)
            <tr>
                <td>{{$receita->id}}.</td>
                <td>{{$receita->name}}</td>
                <td>R$ {{number_format($receita->valor, 2, ',', '.')}}</td>
                <td>{{@$receita->tipo_receita->name}}</td>
                <td>{{@$receita->tipo_pagamento->name}}</td>
                <td>{!! date('d/m/Y H:i:s', strtotime($receita->created_at)) !!}</td>                
                <td>
                    <div class="btn-group pull-right">
                        @include('receita.actions')
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</div>
