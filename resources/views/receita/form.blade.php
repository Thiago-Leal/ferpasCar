<div class="row">
    <div class="col-md-4">
        <div class="form-group {!! $errors->has('tipo_receita_id') ? 'has-error' : '' !!}">
            {!! Form::label('tipo_receita_id', 'Tipo de Receita') !!}
            {!! Form::select('tipo_receita_id', [''=>'']+App\Models\TipoReceita::pluck('name','id')->all(), !empty($receita->tipo_receita_id)?$receita->tipo_receita_id:null, ['class'=>'form-control', 'onChange'=>'changeValue(this.value)']) !!}
            {!! $errors->first('tipo_receita_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {!! $errors->has('tipo_pagamento_id') ? 'has-error' : '' !!}">
            {!! Form::label('tipo_pagamento_id', 'Tipo de Pagamento') !!}
            {!! Form::select('tipo_pagamento_id', [''=>'']+App\Models\TipoPagamento::pluck('name','id')->all(), !empty($receita->tipo_pagamento_id)?$receita->tipo_pagamento_id:null, ['class'=>'form-control']) !!}
            {!! $errors->first('tipo_pagamento_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
 </div>
 <div class="row">
    <div class="col-md-4">
        <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
            {!! Form::label('name', 'Nome') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group {!! $errors->has('valor') ? 'has-error' : '' !!}">
            {!! Form::label('valor', 'Valor') !!}
            {!! Form::text('valor', number_format(@$receita->valor, 2, ',', '.'), ['class'=>'form-control', 'id'=>'valor']) !!}
            {!! $errors->first('valor', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>