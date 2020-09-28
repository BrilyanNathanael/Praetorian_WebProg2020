<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Order;
use Auth;
class AdminController extends Controller
{
    public function items()
    {
        $item = Item::all();
        return view('admin.items', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $count = Category::count();
        return view('admin.create',compact('category','count'));
    }


    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function sales()
    {
        $user = Auth::user();
        $order = Order::all();
        $count = Order::count();
        $groupInvoice = $order->groupBy('order_id');
        return view('admin.sales', compact('groupInvoice','user','count'));
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

        $customer = User::find($order->user_id);
        return view('admin.detail',compact('order','orders', 'items', 'customer', 'totalItems', 'totalPrice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = array(
            'name.required' => 'Please input the name item',
            'name.min' => 'Min: 5 characters',
            'name.max' => 'Max: 80 characters',
            'stock.required' => 'Please input the stock',
            'stock.integer' => 'Input must be integer',
            'price.required' => 'Please input the price',
            'price.regex' => 'Input must be integer',
        );
        $request->validate([
            'name' => 'required|min:5|max:80',
            'stock' => 'required|integer',
            'price' => 'required|regex:/[0-9]/',
            'image' => 'required',
        ],$message);

        $image = $request->file('image');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('storage/images'), $name);

        $item = Item::create([
            'category_id' => $request->category,
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'image' => $name,
        ]);

        return redirect('/admin/items');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $category = Category::all();
        return view('admin.edit',compact('item','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = array(
            'name.min' => 'Min: 5 characters',
            'name.max' => 'Max: 80 characters',
            'stock.integer' => 'Input must be integer',
            'price.regex' => 'Input must be integer',
        );
        $request->validate([
            'name' => 'min:5|max:80',
            'stock' => 'integer',
            'price' => 'regex:/[0-9]/',
        ],$message);

        if($request->hasFile('image'))
        {
            $item = Item::findOrFail($id)->first();
            Storage::delete('images/' . $item->image);

            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/images'), $name);

            Item::where('id',$id)
                    ->update([
                        'category_id' => $request->category,
                        'name' => $request->name,
                        'price' => $request->price,
                        'price' => $request->price,
                        'image' => $name,
                    ]);
        }
        else
        {
            Item::where('id',$id)
                ->update([
                    'category_id' => $request->category,
                    'name' => $request->name,
                    'price' => $request->price,
                    'stock' => $request->stock
                ]);
        }
        
        return redirect('/admin/items');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::where('id',$id)->first();
        Storage::delete('images/' . $item->image);
        
        Item::where('id',$id)->delete();
        return redirect('/admin/items');
    }
}
