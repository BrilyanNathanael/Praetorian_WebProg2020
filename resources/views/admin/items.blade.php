@extends('layouts.admin')

@section('content')
    <div class="nav-left">
        <h2 style="color:white;">{{Auth::user()->name}}</h2>
        <div class="kotak" style="background-color:#cd000f;width:3em;height:.5em;border-radius:10px;margin-bottom:.5em;"></div>
        <a href="/">Dashboard</a>
        <a href="/admin/items" class="active">List Item</a>
        <a href="/admin/users">Users</a>
        <a href="/admin/sales">Sold Item</a>
        <a href="/admin/create">Create Item</a>
        <a href="/admin/category">Create Category</a>
    </div>
    <div class="content-barang">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Stock</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($item as $i)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                        <img src="{{'/storage/images/' . $i->image}}" alt="" width="50px" height="60px">
                    </td>
                    <td>{{$i->name}}</td>
                    <td>{{$i->category->category}}</td>
                    <td>{{$i->stock}}</td>
                    <td>Rp {{number_format($i->price,0,'.','.')}}</td>
                    <td>
                        <a href="/admin/edit/{{$i->id}}" class="edit">Edit</a>
                        <form action="/admin/delete/{{$i->id}}" method="POST">
                            @method('delete')
                            @csrf
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
    </div>
@endsection