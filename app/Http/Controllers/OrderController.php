<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\Inventory;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::all();
        //return response() ->json($orders);
        return $orders ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //items available in inventory
        $inventories = Inventory::all();
        return view('orders.create')->with('inventories',$inventories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        /*
        $this->validate($request, [
            // 'name' => 'required',
            // 'description' => 'required',
            
        ]);
        // Create Order
        $order = new Order;
        // $order->user_id = 1;
        // $order->$status_id = $request->input('status');
        // $order->date_of_order = $request->input('date_of_order');
        // $order->expected_delivery_date = $request->input('expected_delivery_date');
        // $order->total_cost = $request->input('total_cost');
        // $order->additional_info = $request->input('additional_info');
        // $order->billing_address = $request->input('billing_address');
        // $order->postal_code= $request->input('postal_code');

         $order->user_id = 1;
         $order->status_id = 1;
        $order->date_of_order = '2019-06-30';
         $order->expected_delivery_date = '2019-07-03';
        $order->total_cost = '5000';   
        $order->additional_info = 'jzlgkz';
        $order->billing_address = 'xmglr';
       $order->postal_code= '123';
       $order->save();  
       */
// for api
    //   $validatedData = $request->validate(['billing_address' => 'required',
    //   'postal_code' => 'required']);

      $order = Order::create([
        'user_id' => '1','date_of_order' => '2019-06-30','expected_delivery_date' => '2019-06-30','total_cost'=>
         '600', 'additional_info'=> 'mg','billing_address'=>'gmgh','postal_code'=>'5990','status_id'=>'1'
         ]);

        //inventory mapping
       $orderinventories= $request->input('inventories');
    
       $orderinventory = Inventory::find($orderinventories);

       //$order->inventories()->attach($orderinventory, array("quantity"=>2, "subTotal"=>1000));
       $order->inventories()->save($orderinventory, ['order_id'=>$order->id,'quantity'=>2, 'subTotal'=>1000]);

        return response()->json('Order Placed!');
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
        $order = Order::find($id);
        //return response() ->json($orders);
        return $order ->toJson();
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $order= Order::find($id);
       // return response ()->json($brands);
        return view('orders.edit')->with('order',$order);
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
        
        Order::find($id)->update(['user_id' => '1','date_of_order' => '2019-06-30','expected_delivery_date' => '2019-06-30','total_cost'=>
        '600', 'additional_info'=> 'mg','billing_address'=>'gmghq','postal_code'=>'5990','status_id'=>'1'
        ]);
        return response()->json('Order Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $order = Order::find($id);
       
        //get all inventory items of an order to remove records in the middle table
        $order_inventories = $order->inventories;

         foreach($order_inventories as $order_inventory)
       {
        $order_inventory=Inventory::find($order_inventory);
        $order->inventories()->detach($order_inventory);
       }

       $order->delete();

        return response()->json('Order Deleted');
    }
}