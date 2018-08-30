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
                            <h3>Organizations</h3>
                        </div>
                        <div class="col-md-1">
                            <a href="{{ URL::route('hyper-organization-new') }}"><button class="btn btn-primary btn-sm btn-block">New</button></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    @if(session()->has('message-error'))
                        <div class="alert alert-danger">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                      <table class="table">
                            @foreach ($hyperorganizations as $organization)
                                    <tr>
                                      <th scope="col">{{ $organization->name }}</th>
                                      <th scope="col">{{ $organization->type }}</th>
                                      <th scope="col">{{ $organization->plan }}</th>
                                      <th scope="col">{{ $organization->location }}</th>
                                      <th scope="col">
                                        <form method="POST" action="{{ URL::route('hyper-organization-get') }}"}}">
                                            <input  name="id" type="hidden" value="{{ $organization->id }}">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                {{ __('View') }}
                                            </button>
                                            @csrf
                                        </form>
                                      </th>

                                    </tr>
                            @endforeach
                      </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
