@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(isset($users))
                            @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$loop->index+1}}</th>
                                <td>{{$user->name}}</td>
                                <td><a href="/chat/{{$user->id}}">chat</a></td>
                            </tr>
                          @endforeach
                        @endif
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
