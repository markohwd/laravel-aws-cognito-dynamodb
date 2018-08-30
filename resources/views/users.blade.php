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
                            <h3>Users</h3>
                        </div>
                        <div class="col-md-1">
                            <a href="{{ URL::route('hyper-user-new') }}" class="btn btn-primary btn-sm">New</a>
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
                            @foreach ($hyperusers as $user)
                                    <tr>
                                      <th scope="col">{{ $user->name }}</th>
                                      <th scope="col">{{ $user->email }}</th>
                                      <th scope="col">
                                        <form method="POST" action="{{ URL::route('hyper-user-get') }}"}}">
                                            <input  name="id" type="hidden" value="{{ $user->id }}">
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
