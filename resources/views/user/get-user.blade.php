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
                            <h3>User Info</h3>
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
                                        <strong>Created At:</strong> {{ $hyperuser->createdAt }}<br>
                                        <strong>Email:</strong> {{ $hyperuser->email }}<br>
                                        <strong>Name:</strong> {{ $hyperuser->name }}<br>
                                        <strong>Photo URL:</strong> {{ $hyperuser->photoUrl }}<br>                                       
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>

                        </fieldset>



                        </form>

                        <hr>
                            <div class="row">
                                <div class="col-md-6">
                                  <a href="{{ URL::route('hyper-user-edit', array('id'=> $hyperuser->id )) }}"><button type="button" class="btn btn-primary btn-large">Edit</button></a>
                                  <a href="{{ URL::route('hyper-user-edit-password', array('id'=> $hyperuser->id )) }}"><button type="button" class="btn btn-secondary btn-large">Change Password</button></a>

                                  <a href="{{ URL::route('hyper-user-delete', array('id'=> $hyperuser->id )) }}" onclick="return confirm('Are you sure you want to delete {{ $hyperuser->name }}? This cannot be undone')"><button type="button" class="btn btn-danger btn-large">Delete</button></a>
                                </div>
                            </div>

                        

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
