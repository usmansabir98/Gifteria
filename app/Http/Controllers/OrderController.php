<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\Inventory;
use App\OrderStatus;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
       // return $orders ->toJson();
       if($request->input('user')!=NULL) {
            $orders = Order::where('user_id',$request->input('user'))->get();
       }
       else {
            $orders = Order::all();
       }
       $ORDERS = [];    

       
       foreach($orders as $order) { 
                     
                    //getting names of each order item
                    $i = 0; $name =[];
                    foreach($order ->inventories as $inventory){
                    $name[$i]= $inventory->product->name;
                    $i++;
                }
         ///end names

          /// attributes in order_inventory mapping        
         $order_inventories = DB::table('order_inventory')->where('order_id',$order->id)->get();
         $j = 0;
         $ord_inv =[]; 

                   foreach($order_inventories as $order_inventory){
                    $inv = array(
                        "quantity" => $order_inventory->quantity , 
                        "subTotal" => $order_inventory->subTotal, 
                        "name" => $name[$j],
                        "inventory_item_id" => $order_inventory->inventory_item_id,
                    );
                    $j++;
                    array_push($ord_inv, $inv);   //pushing subarray of items into main array of items
                } //end foreach
        
          /// end order_inventory mapping  
          
         $orderstatus=OrderStatus::find($order->status_id);  //getting status of order

        $ord = array (
            'id' => $order->id,
            'user_name' => $order->user->name,
            'items' => $ord_inv, //items with with their subtotal and quantity and inventoryitemid(middle table attr)
            'date_of_order' => $order->date_of_order,
            'expected_delivery_date' => $order->expected_delivery_date,
            'total_cost' => $order ->total_cost,
            'additional info' => $order->additional_info,
            'billing_address' => $order->billing_address,
            'postal_code' => $order->postal_code,
            'status' => $orderstatus->name
        );

        array_push($ORDERS, $ord);
        $event = []; //empty it before next order
        $ord_inv = []; 
       // $name = [];
    
      } //end foreach


      return $ORDERS;
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

    //   $order = Order::create([
    //     'user_id' => '1','date_of_order' => '2019-06-30','expected_delivery_date' => '2019-06-30','total_cost'=>
    //      '600', 'additional_info'=> 'mg','billing_address'=>'gmgh','postal_code'=>'5990','status_id'=>'1'
    //      ]);

    $order = Order::create([
        'user_id' => $request->input('user'),
        'date_of_order' => $request->input('date_of_order'),
        'expected_delivery_date' => $request->input('expected_delivery_date'),
        'total_cost'=> '600',
        'additional_info'=> $request->input('additional_info'),
        'billing_address'=>$request->input('billing_address'),
        'postal_code'=>$request->input('postal_code'),
        'status_id'=>'1'
         ]);


        //inventory mapping 
       $orderinventories= $request->input('inventories');

          foreach($orderinventories as $orderinventory )   { 

            $orderinvent = Inventory::find($orderinventory->id);
            //$order->inventories()->attach($orderinventory, array("quantity"=>2, "subTotal"=>1000));
            $order->inventories()->save($orderinventory, ['order_id'=>$order->id,'inventory_item_id' =>$orderinventory->id ,'quantity'=>2, 'subTotal'=>1000]);
          
        }  //end for each
             
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
        $order = Order::find($id);
          
                    //getting names of each order item
                    $i = 0; $name =[];
                    foreach($order ->inventories as $inventory){
                    $name[$i]= $inventory->product->name;
                    $i++;
                }
         ///end names

          /// attributes in order_inventory mapping        
         $order_inventories = DB::table('order_inventory')->where('order_id',$order->id)->get();
         $j = 0;
         $ord_inv =[]; 
         
                   foreach($order_inventories as $order_inventory){
                    $inv = array(
                        "quantity" => $order_inventory->quantity , 
                        "subTotal" => $order_inventory->subTotal, 
                        "name" => $name[$j],
                        "inventory_item_id" => $order_inventory->inventory_item_id,
                    );
                    $j++;
                    array_push($ord_inv, $inv);   //pushing subarray of items into main array of items
                } //end foreach
        
          /// end order_inventory mapping  
          
         $orderstatus=OrderStatus::find($order->status_id);  //getting status of order

        return [
            'id' => $order->id,
            'user_name' => $order->user->name,
            'items' => $ord_inv, //items with with their subtotal and quantity inventoryitemid(middle table attr)
            'date_of_order' => $order->date_of_order,
            'expected_delivery_date' => $order->expected_delivery_date,
            'total_cost' => $order ->total_cost,
            'additional info' => $order->additional_info,
            'billing_address' => $order->billing_address,
            'postal_code' => $order->postal_code,
            'status' => $orderstatus->name,

        ];
    
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
            
            $order = Order::find($id);
                
            //getting names of each order item
            $i = 0; $name =[];
            foreach($order ->inventories as $inventory){
            $name[$i]= $inventory->product->name;
            $i++;
        }
        ///end names

        /// attributes in order_inventory mapping        
        $order_inventories = DB::table('order_inventory')->where('order_id',$order->id)->get();
        $j = 0;
        $ord_inv =[]; 

            foreach($order_inventories as $order_inventory){

            $inv = array(
                "quantity" => $order_inventory->quantity , 
                "subTotal" => $order_inventory->subTotal, 
                "name" => $name[$j],
                "inventory_item_id" => $order_inventory->inventory_item_id,
            );
            $j++;
            array_push($ord_inv, $inv);   //pushing subarray of items into main array of items
        } //end foreach

        /// end order_inventory mapping  

        $orderstatus=OrderStatus::find($order->status_id);  //getting status of order

        return [
        'id' => $order->id,
        'user_name' => $order->user->name,
        'items' => $ord_inv, //items with with their subtotal and quantity and inventoryitemid(middle table attr)
        'date_of_order' => $order->date_of_order,
        'expected_delivery_date' => $order->expected_delivery_date,
        'total_cost' => $order ->total_cost,
        'additional info' => $order->additional_info,
        'billing_address' => $order->billing_address,
        'postal_code' => $order->postal_code,
        'status' => $orderstatus->name,

        ];
        //return view('orders.edit')->with('order',$order);
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
    

        $order = Order::find($id)->update([
            'user_id' => $request->input('user_id'),
            'date_of_order' => $request->input('date_of_order'),
            'expected_delivery_date' => $request->input('expected_delivery_date'),
            'total_cost'=> '600',
            'additional_info'=> $request->input('additional_info'),
            'billing_address'=>$request->input('billing_address'),
            'postal_code'=>$request->input('postal_code'),
            'status_id'=>'1'
             ]);
    
    
            //inventory mapping 
           $orderinventories= $request->input('inventories');
    
              foreach($orderinventories as $orderinventory )   { 
    
                $orderinvent = Inventory::find($orderinventory->id);
                //$order->inventories()->attach($orderinventory, array("quantity"=>2, "subTotal"=>1000));
                $order->inventories()->save($orderinventory, ['order_id'=>$order->id,'inventory_item_id' =>$orderinventory->id ,'quantity'=>2, 'subTotal'=>1000]);
              
            }  //end for each
    
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
