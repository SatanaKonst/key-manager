@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Новый сервер</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary btn-sm mb-2" href="{{ route('servers.index') }}"><i
                        class="fa fa-arrow-left"></i> Назад</a>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('servers.store') }}">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Server group id:</strong>
                    <input type="number" name="server_group_id" placeholder="Server group id" class="form-control" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Private SSH Key:</strong>
                    <br/>
                    <textarea name="ssh_key" class="form-control" placeholder="Private SSH Key" required></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Server name:</strong>
                    <br/>
                    <input type="text" name="name" class="form-control" placeholder="Server name" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <br/>
                    <textarea name="descriptions" class="form-control" placeholder="Description"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Login:</strong>
                    <br/>
                    <input type="text" name="login" class="form-control" placeholder="Login" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Port:</strong>
                    <br/>
                    <input type="text" name="port" class="form-control" placeholder="Port" value="22">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                <button type="submit" class="btn btn-primary btn-sm mb-3">
                    <i class="fa-solid fa-floppy-disk"></i> Submit
                </button>
            </div>
        </div>
    </form>
@endsection
