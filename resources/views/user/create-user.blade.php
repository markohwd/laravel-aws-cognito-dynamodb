@extends('layout.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            @include('layout.sidebar')
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            <h3>New User</h3>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                              @endif

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ URL::route('hyper-user-create') }}"}}">
                      @csrf
                        <fieldset>

                            <div class="row">
                                <div class="col-md-6">

                                        <!-- Text input-->
                                        <div class="form-group">
                                          <label class="col-md-12 control-label" for="textinput">Name</label>  
                                          <div class="col-md-12">
                                            <input id="" name="name" type="text" placeholder="Enter Name" class="form-control input-md">
                                            @if ($errors->has('name'))
                                              <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                           
                                          </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="form-group">
                                          <label class="col-md-12 control-label" for="textinput">Email</label>  
                                          <div class="col-md-12">
                                            <input id="" name="email" type="text" placeholder="Enter email" class="form-control input-md">
                                            @if ($errors->has('email'))
                                              <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                          <span class="help-block"></span>  
                                          </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="form-group">
                                          <label class="col-md-12 control-label" for="textinput">Password</label>  
                                          <div class="col-md-12">
                                            <input id="" name="password" type="password" placeholder="Enter password" class="form-control input-md">
                                            @if ($errors->has('password'))
                                              <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                          <span class="help-block"></span>  
                                          </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="form-group">
                                          <label class="col-md-12 control-label" for="textinput">Confirm Password</label>  
                                          <div class="col-md-12">
                                            <input id="" name="password_confirmation" type="password" placeholder="Confirm password" class="form-control input-md">
                                            @if ($errors->has('password_confirmation'))
                                              <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                          <span class="help-block"></span>  
                                          </div>
                                        </div>

                                       

                                </div>
                                <div class="col-md-6">

                                    <!-- Select Basic -->
                                        <div class="form-group">
                                          <label class="col-md-12 control-label" for="selectbasic">Select Organization</label>
                                          <div class="col-md-12">
                                            <select id="" name="organization" class="form-control">
                                              @foreach ($hyperorganizations as $hyperorganization)
                                                <option value="{{ $hyperorganization->id }}">{{ $hyperorganization->name }}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-md-12 control-label" for="selectbasic">Select Role</label>
                                          <div class="col-md-12">
                                            <select id="" name="role" class="form-control">
                                                <option value="User">User</option>
                                                <option value="Admin">Admin</option>
                                            </select>
                                          </div>
                                        </div>


                                        <!-- Text input-->
                                        <div class="form-group">
                                          <label class="col-md-12 control-label" for="textinput">Photo URL</label>  
                                          <div class="col-md-12">
                                          <input id="textinput" name="photourl" type="text" placeholder="Add http://" class="form-control input-md">
                                          <span class="help-block"> </span>  
                                          </div>
                                        </div>
                                </div>
                            </div>


                        

                        

                        </fieldset>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            <!--
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            -->
                            </div>
                        </div>


                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
