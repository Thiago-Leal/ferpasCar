<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th style="width: 10px">#</th>
            <th>Nome</th>
            <th>Data de Criação</th>
            <th></th>
        </tr>
        @foreach ($tipo_pagamentos as $key => $tipo_pagamento)
            <tr>
                <td>{{$tipo_pagamento->id}}.</td>
                <td>{{$tipo_pagamento->name}}</td>
                <td>{!! date('d/m/Y', strtotime($tipo_pagamento->created_at)) !!}</td>                
                <td>
                    <div class="btn-group pull-right">
                        @include('tipo_pagamento.actions')
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</div>
