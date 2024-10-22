@extends('layouts.simple.master')
@section('title', 'Users Table')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Users</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Users Table</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Hoverable rows</h5>
                        <span>Use a class <code>table-hover</code> to enable a hover state on table rows within a <code>tbody</code>.</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Role</th>
                                <th scope="col">Country</th>
                            </tr>
                            </thead>
                            <tbody>
                            <input hidden="" {{$i = 0}}>
                            @foreach($models as $model)
                                <tr>
                                    <th scope="row">{{++$i}}</th>
                                    <td>{{$model->name}}</td>
                                    <td>{{$model->surname}}</td>
                                    <td>{{$model->phone}}</td>
                                    <td>Admin</td>
                                    <td>UZB</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
