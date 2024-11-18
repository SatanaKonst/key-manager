@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Серверы</h2>
            </div>
            <div class="pull-right">
                @can('role-create')
                    <a class="btn btn-success btn-sm mb-2" href="{{ route('servers.create') }}">
                        <i class="fa fa-plus"></i> Новый сервер
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>
                <td>Id</td>
                <td>Server Group Id</td>
                <td>Name</td>
                <td>Login</td>
                <td>Port</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($servers as $server)
                <tr>
                    <td>{{$server->id}}</td>
                    <td>{{$server->server_group_id}}</td>
                    <td>{{$server->name}}</td>
                    <td>{{$server->login}}</td>
                    <td>{{$server->port}}</td>
                    <td>
                        <a href="" class="btn btn-info btn-sm">Show</a>
                        <a href="" class="btn btn-success btn-sm">Edit</a>
                        <a href="" class="btn btn-danger btn-sm">Remove</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
