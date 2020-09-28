<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Auth;
use Cart;
use Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Order;
use App\Category;

class ShopController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $prc = 0;
        $qtty = 0;
        $i = 0;
        foreach(Cart::content() as $item)
        {
            if($item->options->user_id === Auth::user()->id)
            {
                $prc = $prc + ($item->price * $item->qty);
                $qtty += $item->qty;
                $i++;
            }
        }
        return view('cart', compact('user', 'prc', 'qtty', 'i'));
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('view', compact('item'));
    }
    
    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            $cart_id = $cartItem->options->user_id;
            if($cart_id === Auth::user()->id){
                return $cartItem->id === $request->id;
            }
        });

        if (!$duplicates->isEmpty()) {
            return redirect('cart')->withSuccessMessage('Item is already in your cart!');
        }
        if($request->stock == 0){
            return redirect()->back()->with(['error' => 'Sorry the item is out of stock, please wait until the item is restocked again']);
        }
        $user_id = Auth::user()->id;
        Cart::add($request->id, $request->name, 1, $request->price,['user_id' => $user_id])->associate('App\Item');
            
        return redirect('cart')->withSuccessMessage('Item was added to your cart!');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|min:1'
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false]);
        }

        $cart = Cart::update($id, $request->quantity);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Cart::remove($id);
        return redirect('cart');
    }

    public function checkout(Request $request)
    {
        $id = IdGenerator::generate(['table' => 'orders', 'field' => 'order_id', 'length' => 10, 'prefix' =>'INV-']);
        foreach(Cart::content() as $row)
        {
            if($row->options->user_id == Auth::user()->id){
                $item = Item::find($row->id);

                $message = array(
                    'address.required' => 'Please input address',
                    'address.min' => 'Min: 10 characters',
                    'address.max' => 'Max: 100 characters',
                    'pos.required' => 'Please input postal code',
                    'pos.regex' => 'Input must be integer',
                    'pos.min' => 'Please input a postal code consisting of 5 digit numbers',
                    'pos.max' => 'Please input a postal code consisting of 5 digit numbers',
                );
                $request->validate([
                    'address' => 'required|min:10|max:100',
                    'pos' => 'required|regex:/[0-9]/|min:5|max:5',
                ],$message);

                $user_id = Auth::user()->id;
                Order::create([
                    'order_id' => $id,
                    'user_id' => $user_id,
                    'address' => $request->address,
                    'pos' => $request->pos,
                    'category' => $row->model->category->category,
                    'name' => $row->name,
                    'quantity' => $row->qty,
                    'price' => $row->price,
                ]);
                
                $jumlah = $item->stock - $row->qty;
                item::where('id', $row->id)
                    ->update([
                        'name' => $row->name,
                        'price' => $row->price,
                        'stock' => $jumlah,
                    ]);
                Cart::remove($row->rowId);
            }
        }
        return redirect('/');
    }

    public function transaction()
    {
        $user = Auth::user();
        $order = Order::all();
        $groupInvoice = $order->groupBy('order_id');
        $item = 0;
        $transaction = 0;
        foreach(Cart::content() as $row)
        {
            if($row->options->user_id === Auth::user()->id){
                $item += $row->qty;
            }
        }
        foreach($order as $o)
        {
            if($o->user_id == Auth::user()->id)
            {
                $transaction++;
            }
        }
        return view('transaction',compact('groupInvoice','user', 'item', 'transaction'));
    }

    public function detail($id)
    {
        $order = Order::find($id);
        $orders = Order::where('order_id', $order->order_id)->get();
        $user = Auth::user();
        $items = 0;
        $totalItems  = 0;
        $totalPrice = 0;
        foreach($orders as $o)
        {
            $totalItems = $totalItems + $o->quantity;
            $totalPrice = $totalPrice + ($o->price * $o->quantity);
        }

        foreach(Cart::content() as $row){
            if($row->options->user_id === Auth::user()->id){
                $items += $row->qty;
            }
        }
        return view('detail',compact('order','orders', 'items', 'user','totalItems','totalPrice'));
    }

}
