@extends('layouts.admin')

@section('content')
    <div class="nav-left">
        <h2 style="color:white;">{{Auth::user()->name}}</h2>
        <div class="kotak" style="background-color:#cd000f;width:3em;height:.5em;border-radius:10px;margin-bottom:.5em;"></div>
        <a href="/">Dashboard</a>
        <a href="/admin/items">List Item</a>
        <a href="/admin/users">Users</a>
        <a href="/admin/sales">Sold Item</a>
        <a href="/admin/create" class="active">Create Item</a>
        <a href="/admin/category">Create Category</a>
    </div>
    @if($count == 0)
    <div class="oops">
        <h2>Oopss..</h2>
        <h2>You have to <a href="/admin/category">create category first</a></h2>
    </div>
    @else
    <div class="content-tambahBarang">
        <div class="form-barang">
            <form action="/admin/create" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="tambah-barang">
                    <h2>Create Item</h2>
                    <div class="kotak"></div>
                </div>
                <div class="form-group" style="display:flex;flex-direction:column;">
                    <label for="image">Image : </label>
                    <input type="file" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="name">Name  : </label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="stock">Stock Barang  : </label>
                    <input type="text" id="stock" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}">
                    @error('stock')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Price : </label>
                    <div class="price" style="display:flex;flex-direction:row;">
                        <h3 style="margin-right:.8em;">Rp.</h3>
                        <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                    </div>
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Category : </label>
                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}">
                        @foreach($category as $c)
                        <option value="{{$c->id}}">{{$c->category}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="button">
                    <button type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
    @endif
@endsection