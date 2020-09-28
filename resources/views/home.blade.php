<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesunda</title>
    <link rel="stylesheet" href="/css/home-page.css">
    <link rel="stylesheet" href="/fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

</head>

<body>
    <section class="homepage">
        <div class="header">
            <nav>
                <div class="nav-left">
                    <a href="/">
                        <h2>Mesunda</h2>
                    </a>
                </div>
                @auth
                <div class="nav-right">
                    <a href="#home">Home</a>
                    <a href="#item">Items</a>
                    <a href="cart">
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
                @endauth
                @guest
                <div class="nav-right">
                    <a href="/login">Login</a>
                    <a href="/register">Register</a>
                </div>
                @endguest
            </nav>
        </div>
        <div class="carousel" id="home">
            <div class="img">
                <img src="/asset/2253.jpg" alt="">
                <div class="background"></div>
            </div>
            <div class="img">
                <img src="/asset/2567.jpg" alt="">
                <div class="background"></div>
            </div>
            <div class="img">
                <img src="/asset/carousel2.jpg" alt="">
                <div class="background"></div>
            </div>
        </div>
        <div class="arrow-prev">
            <span><i class="fas fa-angle-left"></i></span>
        </div>
        <div class="arrow-next">
            <span><i class="fas fa-angle-right"></i></span>
        </div>
        <div class="container">
            <hr>
            <div class="section-kategori">
                <div class="kategori">
                    <div class="kategori-left">
                        <h2>Category</h2>
                        @if($categories > 3)
                        <div class="kategoris">
                            @foreach($category as $c)
                            <a href="">
                                <div class="kategori-list">
                                    <span>
                                        {{$c->category}}
                                    </span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <div class="prev">
                            <span><i class="fas fa-angle-left"></i></span>
                        </div>
                        <div class="next">
                            <span><i class="fas fa-angle-right"></i></span>
                        </div>
                        @else
                        <div class="category-less">
                            @foreach($category as $c)
                            <a href="">
                                <div class="kategori-list">
                                    <span>
                                        {{$c->category}}
                                    </span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="kategori-right">
                        <img src="/asset/21914.jpg" alt="">
                    </div>
                </div>
            </div>
            <hr>

            <div class="items" id="item">
                <h1>All Items</h1>
                @if($products < 5)
                    <div class="items-less">
                    @foreach($item as $i)
                        <a href="/view/{{$i->id}}">
                            <div class="item-content">
                                <img src="{{'/storage/images/' . $i->image}}" alt="">
                                <div class="content">
                                    <p>{{$i->name}}</p>
                                    <strong>Stock : {{$i->stock}}</strong><br>
                                    <strong>Price : Rp {{number_format($i->price,0,'.','.')}}</strong>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    </div>
                @else
                    <div class="items-list">
                    @foreach($item as $i)
                        <a href="/view/{{$i->id}}">
                            <div class="item-content">
                                <img src="{{'/storage/images/' . $i->image}}" alt="">
                                <div class="content">
                                    <p>{{$i->name}}</p>
                                    <strong>Stock : {{$i->stock}}</strong><br>
                                    <strong>Price : Rp {{number_format($i->price,0,'.','.')}}</strong>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    </div>
                    <div class="prev-item">
                        <span><i class="fas fa-angle-left"></i></span>
                    </div>
                    <div class="next-item">
                        <span><i class="fas fa-angle-right"></i></span>
                    </div>
                @endif
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

    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="/js/carousel.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scroll/16.1.0/smooth-scroll.js"></script>
		<script>
			var scroll = new SmoothScroll('a[href*="#"]',{
				speed:1500
			});
		</script>
</body>

</html>