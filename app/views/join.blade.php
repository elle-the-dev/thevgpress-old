{{ Form::open(array('url' => URL::to('joinPost'), 'class' => 'form-horizontal ajax')) }}

<div class="form-group required">
    {{ Form::label('username', 'Username', array('class' => 'col-sm-1 control-label')) }}
    <div class="col-sm-11">
        {{ Form::text('username', '', array('placeholder' => 'username', 'class' => 'form-control', 'autofocus')) }}
    </div>
</div>

<div class="form-group required">
    {{ Form::label('password', 'Password', array('class' => 'col-sm-1 control-label')) }}
    <div class="col-sm-11">
        {{ Form::password('password', array('placeholder' => 'password', 'class' => 'form-control')) }}
    </div>
</div>
<div class="form-group required">
    {{ Form::label('password_confirmation', 'Confirm Password', array('class' => 'col-sm-1 control-label')) }}
    <div class="col-sm-11">
        {{ Form::password('password_confirmation', array('placeholder' => 'confirm password', 'class' => 'form-control')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('email', 'Email', array('class' => 'col-sm-1 control-label')) }}
    <div class="col-sm-11">
        {{ Form::email('email', '', array('placeholder' => 'email', 'class' => 'form-control')) }}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-1 col-sm-11">
        {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
    </div>
</div>

{{ Form::close() }}
