<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/cart.css">
    <link rel="stylesheet" href="/fontawesome/css/all.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <section class="cart-page">
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
        @if($i > 0)
        <div class="shopping">
            <div class="carts">
                @foreach(Cart::content() as $c)
                @if($c->options->user_id == Auth::user()->id)
                <div class="cart-list">
                    <div class="cart-lister">
                        <img src="{{'/storage/images/' . $c->model->image}}" alt="">
                        <div class="cart-content">
                            <div class="name-delete">
                                <h2>{{$c->name}}</h2>
                                <div class="delete">
                                    <form action="{{ url('cart', [$c->rowId]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit">
                                            <img src="/asset/trash.png" alt="">
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <p>Rp {{number_format($c->price,0,'.','.')}}</p>
                            @if($c->qty > $c->model->stock)
                                <input type="number" min="1" max="{{$c->model->stock}}" class="quantity" data-id="{{$c->rowId}}" value="{{$c->qty}}"
                                    style="width:3em;">
                                <span style="display:flex;flex-direction:column;">
                                    <strong style="color:red;font-size:9px;">Stock: {{$c->model->stock}},</strong>
                                    <strong style="color:red;font-size:9px;">Please reduce the number</strong>
                                </span>
                            @else
                                <input type="number" min="1" max="{{$c->model->stock}}" class="quantity" data-id="{{$c->rowId}}" value="{{$c->qty}}" style="width:3em;">
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <div class="total-prices">
                <h2>Total Price</h2>
                <div class="red-line"></div>
                <div class="total">
                    <p>Total</p>
                    <p>Rp {{number_format($prc,0,'.','.')}}</p>
                </div>
                <div class="buy">
                    <button type="button" data-toggle="modal" data-target="#exampleModal">
                        Buy ({{$qtty}})
                    </button>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: 40em;transform: translate(-10%, 20%);">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Checkout Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="">
                            <div class="modal-body">
                                <form action="/checkout" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="address" class="address">{{ __('Address : ') }}</label>
                                    <div class="input-address">
                                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autofocus>

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pos">Postal Code : </label>
                                    <div class="input-pos">
                                        <input id="pos" type="text" class="form-control @error('pos') is-invalid @enderror" name="pos" value="{{ old('pos') }}" autofocus>

                                        @error('pos')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="pay">
                                    <button type="submit">Pay</button>
                                </div>
                                </form>
                                <div class="list-item">
                                    <h2>Your Items</h2>
                                    <div class="item-content">
                                        @foreach(Cart::content() as $c)
                                        @if($c->options->user_id == Auth::user()->id)
                                            <hr>
                                            <img src="{{'/storage/images/' . $c->model->image}}" alt="">
                                            <p>{{$c->name}} x{{$c->qty}}</p>
                                            <hr>
                                        @endif
                                        @endforeach
                                    </div>
                                    <div class="total-pay">
                                        <strong>Total</strong>
                                        <strong>Rp {{number_format($prc,0,'.','.')}}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="no-cart">
            <img src="/asset/null-1.png" alt="" width="300px">
            <p>It seems that your cart is empty...</p>
        </div>
        @endif
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        (function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.quantity').on('change', function() {
                var id = $(this).attr('data-id')
                $.ajax({
                    type: "PATCH",
                    url: '{{ url("/cart") }}' + '/' + id,
                    data: {
                        'quantity': this.value,
                    },
                    success: function(data) {
                        window.location.href = '{{ url('/cart') }}';
                    }
                });

}           );

        })();


    </script>
</body>

</html>