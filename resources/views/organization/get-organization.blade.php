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
                            <h3>Organization</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ URL::route('hyper-organization-create') }}"}}">
                      @csrf
                        <fieldset>

                            <div class="row">
                                <div class="col-md-3">
                                  <img src="{{ $hyperorganization->photoUrl }}" alt="..." class="img-thumbnail"><br>
                                  <h4>{{ $hyperorganization->name }}<h5> <br>
                                </div>

                                <div class="col-md-8">

                                  <strong>Created at: </strong> {{ date('d-m-Y H:i:s', strtotime($hyperorganization->createdAt))  }}
                                  
                                  <strong>Plan: </strong> {{ $hyperorganization->plan }} <br>
                                  <strong>Type: </strong> {{ $hyperorganization->type }} <br>

                                  <strong>Logo: </strong> {{ $hyperorganization->logoUrl }} <br>

                                  <strong>Slug: </strong>{{ $hyperorganization->slug }} <br>
                                  <strong>Email: </strong> {{ $hyperorganization->email }} <br>
                                  <strong>Location: </strong> {{ $hyperorganization->location }} <br>
                                  <strong>PhotoUrl: </strong> {{ $hyperorganization->photoUrl }} <br>

                                  <strong>bucket: </strong> {{ $hyperorganization->bucket }} <br>
                                  <strong>Category Id: </strong> 

                                  @foreach ($hypercategories as $hypercategory)
                                                @if ( $hyperorganization->categoryId == $hypercategory->id)
                                                    {{ $hypercategory->name }}
                                                @endif
                                  @endforeach <br>

                                </div>
                            </div>

                            <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                      <a href="{{ URL::route('hyper-organization-edit', array('id'=> $hyperorganization->id )) }}"><button type="button" class="btn btn-info btn-large">Edit</button></a>

                                      <a href="{{ URL::route('hyper-organization-delete', array('id'=> $hyperorganization->id )) }}" onclick="return confirm('Are you sure you want to delete {{ $hyperorganization->name }}? This cannot be undone')"><button type="button" class="btn btn-danger btn-large">Delete</button></a>
                                    </div>
                                </div>


                            <hr>

                            <div class="row">
                              <div class="col-md-8">
                                <h4>Organization Users</h4>

                            <div class="table-responsive">
                              <table class="table">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                </tr>
                                    @foreach ($hyperorganizationusers as $organizationuser)
                                      
                                        @foreach ($hyperusers as $hyperuser)

                                          @if ( $organizationuser->userId == $hyperuser->id )

                                            <tr>
                                                <th scope="col">{{ $hyperuser->name }}</th>
                                                <th scope="col">{{ $hyperuser->email }}</th>
                                                <th scope="col">
			                                        <form method="POST" action="{{ URL::route('hyper-user-get') }}"}}">
			                                            <input  name="id" type="hidden" value="{{ $hyperuser->id }}">
			                                            <button type="submit" class="btn btn-primary btn-sm">
			                                                {{ __('View') }}
			                                            </button>
			                                            @csrf
                                        			</form>
                                    			</th>
                                            </tr>

                                          @endif

                                        @endforeach

                                    @endforeach
                              </table>
                            </div>


                              </div>

                            </div>


                        

                        

                        </fieldset>

                        <div class="form-group row mb-0">

                        </div>


                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
