<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item</title>
    <link rel="stylesheet" href="/css/view.css">
    <link rel="stylesheet" href="/fontawesome/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <section class="item-page">
        <div class="header">
            <nav>
                <div class="nav-left">
                    <a href="/">
                        <h2>Mesunda</h2>
                    </a>
                </div>
                <div class="nav-right">
                    <a href="/">Home</a>
                    <a href="/">Items</a>
                    <a href="/cart">
                        Cart
                    </a>
                    <div class="dropdown">
                        <button class="drop-user">
                            {{Auth::user()->name}}
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="drop-content">
                            <a href="/transaction">Transaction</a>
                            <a href="/logout">Logout</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="item-content">
            <img src="{{'/storage/images/' . $item->image}}" alt="">
            <div class="item">
                <div class="name-item">
                    <h1>{{$item->name}}</h1>
                </div>
                <div class="list">
                    <h2>CATEGORY</h2>
                    <p>{{$item->category->category}}</p>
                </div>
                <div class="list">
                    <h2>PRICE</h2>
                    <h4>Rp {{number_format($item->price,0,'.','.')}}</h4>
                </div>
                <div class="list-stk">
                    <div class="list-cnt">
                        <h2>STOCK</h2>
                        <p class="stock">{{$item->stock}}</p>
                    </div>
                    @if($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                </div>
                <div class="button-list">
                    <div class="kembali">
                        <a href="/">Back</a>
                    </div>
                    <div class="cart">
                        <form action="/cart" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input type="hidden" name="name" value="{{ $item->name }}">
                            <input type="hidden" name="price" value="{{ $item->price }}">
                            <input type="hidden" name="stock" value="{{ $item->stock }}">
                            <input type="submit" value="Add to cart">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="footer-list">
                <div class="nav-footer">
                    <div class="nav-foot-left">
                        <a href="/">Home</a>
                        <a href="/">Items</a>
                    </div>
                    <div class="nav-foot-right">
                        <a href="/cart">Cart</a>
                        <a href="/transaction">Transactions</a>
                    </div>
                </div>
                <div class="contact">
                    <a href="https://www.instagram.com/">
                        <img src="/asset/instagram.png" alt="">
                    </a>
                    <a href="https://www.facebook.com/">
                        <img src="/asset/facebook.png" alt="">
                    </a>
                    <a href="https://www.whatsapp.com/">
                        <img src="/asset/whatsapp.png" alt="">
                    </a>
                </div>
            </div>
            <div class="foots">
                <h2>Mesunda</h2>
                <div class="foots-ident">
                    <p>&copy Web Programming Praetorian 2020</p>
                    <p>by Brilyan Nathanael R</p>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script></body>

</html>