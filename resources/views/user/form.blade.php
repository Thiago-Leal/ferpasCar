<div class="row">
    <div class="col-md-4">
        <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
            {!! Form::label('name', 'Nome') !!} : {{$user->name}}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
            {!! Form::label('email', 'Email/Login') !!} : {{$user->email}}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
            {!! Form::label('password', 'Nova Senha') !!}
            {!! Form::password('password', null, ['class'=>'form-control']) !!}
            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group {!! $errors->has('password_confirmation') ? 'has-error' : '' !!}">
            {!! Form::label('password_confirmation', 'Confirmação de Senha') !!}
            {!! Form::password('password_confirmation', null, ['class'=>'form-control']) !!}
            {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>