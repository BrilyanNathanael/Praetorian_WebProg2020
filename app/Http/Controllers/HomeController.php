<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Item;
use App\Category;
use App\Order;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $user = Auth::user();
        $cart = 0;
        $item = Item::all();
        $category = Category::all();
        $products = Item::count();
        $categories = Category::count();
        if($user){
            if($user->id_admin == 1)
            {
                $users = User::count();
                $items = Item::count();
                $order = Order::count();
                $orders = Order::all();
                $fee = 0;
                foreach($orders as $o)
                {
                    $fee += $o->price;
                }
                return view('admin.home',compact('user','users','items','order', 'fee'));
            }
            return view('home',compact('user','item', 'category', 'products', 'categories'));
        }
        return view('home',compact('item', 'category' ,'products', 'categories'));
    }
}
