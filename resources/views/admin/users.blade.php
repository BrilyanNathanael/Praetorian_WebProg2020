@extends('layouts.admin')

@section('content')
    <div class="nav-left">
        <h2 style="color:white;">{{Auth::user()->name}}</h2>
        <div class="kotak" style="background-color:#cd000f;width:3em;height:.5em;border-radius:10px;margin-bottom:.5em;"></div>
        <a href="/">Dashboard</a>
        <a href="/admin/items">List Item</a>
        <a href="/admin/users" class="active">Users</a>
        <a href="/admin/sales">Sold Item</a>
        <a href="/admin/create">Create Item</a>
        <a href="/admin/category">Create Category</a>
    </div>
    <div class="content-pengguna">
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $u)
                @if($u->id_admin == 1)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$u->name}}</td>
                    <td>{{$u->email}}</td>
                    <td>{{$u->phone_number}}</td>
                    <td>Admin</td>
                </tr>
                @else
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$u->name}}</td>
                    <td>{{$u->email}}</td>
                    <td>{{$u->phone_number}}</td>
                    <td>Member</td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
@endsection