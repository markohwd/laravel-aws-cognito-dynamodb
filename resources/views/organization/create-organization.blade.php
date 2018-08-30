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
                        <div class="col-md-12">
                            <h3>New Organization</h3>

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
                    <form method="POST" action="{{ URL::route('hyper-organization-create') }}"}}">
                      @csrf
                        <fieldset>

                            <div class="row">
                                <div class="col-md-6">

                                        <!-- Text input-->
                                        <div class="form-group">
                                          <label class="col-md-12 control-label" for="textinput">Organization Name</label>  
                                          <div class="col-md-12">
                                            <input id="" name="name" type="text" placeholder="Enter Organization" class="form-control input-md">
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
                                              <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                          </div>
                                        </div>

                                        <!-- Select Basic -->
                                        <div class="form-group">
                                          <label class="col-md-12 control-label" for="selectbasic">Select Plan</label>
                                          <div class="col-md-12">
                                            <select id="" name="plan" class="form-control">
                                              <option value="viewer">Viewer</option>
                                              <option value="basic">Basic</option>
                                            </select>
                                          </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="form-group">
                                          <label class="col-md-12 control-label" for="textinput">Location</label>  
                                          <div class="col-md-12">
                                          <input id="textinput" name="location" type="text" placeholder="City, State (ie NY), Country" class="form-control input-md">
                                          <span class="help-block"></span>  
                                          </div>
                                        </div>



                                </div>
                                <div class="col-md-6">

                                        

                                        <!-- Select Basic -->
                                        <div class="form-group">
                                          <label class="col-md-12 control-label" for="selectbasic">Category ID</label>
                                          <div class="col-md-12">
                                            <select id="selectbasic" name="category" class="form-control">
                                              @foreach ($hypercategories as $hypercategory)
                                                <option value="{{ $hypercategory->id }}">{{ $hypercategory->name }}</option>
                                              @endforeach


                                              
                                            </select>
                                          </div>
                                        </div>

                                        <!-- Select Basic -->
                                        <div class="form-group">
                                          <label class="col-md-12 control-label" for="selectbasic">Select Type</label>
                                          <div class="col-md-12">
                                            <select id="" name="type" class="form-control">
                                              <option value="brand">Brand</option>
                                              <option value="content">Content</option>
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

                                        <!-- Text input-->
                                        <div class="form-group">
                                          <label class="col-md-12 control-label" for="textinput">Logo URL</label>  
                                          <div class="col-md-12">
                                          <input id="textinput" name="logourl" type="text" placeholder="Add http://" class="form-control input-md">
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
