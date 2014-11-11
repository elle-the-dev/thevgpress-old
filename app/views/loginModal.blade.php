<section id="login-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <header class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Login @ The VG Press</h4>
            </header>
            <form method="post" action="{{ URL::to('loginPost') }}" class="form-horizontal ajax">
                <div class="modal-body">
                    @include ('reportBagMessages', array('messages' => Messaging::get('errors.login-errors'), 'id' => 'login-errors', 'class' => 'danger'))
                    <div class="form-group">
                        {{ Form::label('username', 'Username', array('class' => 'col-sm-2 control-label')) }}
                        <div class="col-sm-10">
                            {{ Form::text('username', '', array('placeholder' => 'username', 'class' => 'form-control', 'tabindex' => 50, 'autofocus')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('password', 'Password', array('class' => 'col-sm-2 control-label')) }}
                        <div class="col-sm-10">
                            {{ Form::password('password', array('placeholder' => 'password', 'class' => 'form-control', 'tabindex' => 51)) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('remember', false, array('tabindex' => 52)) }}
                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="login-window-footer" class="modal-footer">
                    <div>
                        <a href="{{ URL::to('join') }}">Create an Account</a>
                        <a href="{{ URL::to('forgot-password') }}">Forgot Password?</a>
                        {{ Form::button('Close', array('class' => 'btn btn-default btn-close', 'data-dismiss' => 'modal')) }}
                        {{ Form::submit('Login', array('class' => 'btn btn-primary')) }}
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
