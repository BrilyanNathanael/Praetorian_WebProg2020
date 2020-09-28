@extends('layouts.admin')

@section('content')
    <div class="nav-left">
        <h2 style="color:white;">{{Auth::user()->name}}</h2>
        <div class="kotak" style="background-color:#cd000f;width:3em;height:.5em;border-radius:10px;margin-bottom:.5em;"></div>
        <a href="/">Dashboard</a>
        <a href="/admin/items">List Item</a>
        <a href="/admin/users">Users</a>
        <a href="/admin/sales">Sold Item</a>
        <a href="/admin/create">Create Item</a>
        <a href="/admin/category" class="active">Create Category</a>
    </div>
    <div class="content-kategori">
        <form action="/admin/category" method="POST">
            @csrf
            <div class="tambah-kategori">
                <h2>Create Category</h2>
                <div class="kotak"></div>
            </div>
            <div class="form-group">
                <label for="category">Category : </label>
                <input type="text" id="category" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}">
            </div>
            <div class="form-group" id="button">
                <button type="submit">Save</button>
            </div>
        </form>
    </div>
@endsection