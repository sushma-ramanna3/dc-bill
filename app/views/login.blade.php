@extends('layouts.main')

@section('content')
    <div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Please sign in</h3>
        </div>
          <div class="panel-body">
            {{ Form::open(array('route'=>'sessions.store')) }}
              <fieldset>
               <div class="form-group">
                {{ Form::text('email', null, array('class'=>'form-control','placeholder'=>'E-mail', 'Required'=>'true')) }}
              </div>
              <div class="form-group">
              {{ Form::password('password', array('class'=>'form-control','placeholder'=>'Password', 'Required'=>'true')) }}
              </div>
              <div class="checkbox">
                  <label>
                    <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                  </label>
                </div>
              {{ Form::submit('Login', array('class' => 'btn btn-lg btn-success btn-block')) }}
            </fieldset>
            {{ Form::close() }}
          </div>
      </div>
    </div>
  </div>
@stop