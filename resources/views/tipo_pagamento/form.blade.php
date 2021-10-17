<div class="row">
    <div class="col-md-6">
        <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
            {!! Form::label('name', 'Nome') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>