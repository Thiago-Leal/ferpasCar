<div class="row">
    <div class="col-md-4">
        <div class="form-group {!! $errors->has('tipo_custo_id') ? 'has-error' : '' !!}">
            {!! Form::label('tipo_custo_id', 'Tipo de Custo') !!}
            {!! Form::select('tipo_custo_id', [''=>'']+App\Models\TipoCusto::pluck('name','id')->all(), !empty($custo->tipo_custo_id)?$custo->tipo_custo_id:null, ['class'=>'form-control ']) !!}
            {!! $errors->first('tipo_custo_id', '<p class="help-block">:message</p>') !!}
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
            {!! Form::text('valor', number_format(@$custo->valor, 2, ',', '.'), ['class'=>'form-control']) !!}
            {!! $errors->first('valor', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>