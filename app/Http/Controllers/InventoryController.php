<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Product;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $inventories = Inventory::orderBy('id')->paginate(20);
        // 
        return view('inventory.index')->with('inventories',$inventories);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = Product::all();
        return view('inventory.create')->with('products',$products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'batchcode' => 'required',
            'price' => 'required',
            'quantity' => 'required',
          
            // 'product' => 'required',
           'isexpirable' => 'required',
            //'expirydate' => 'required'
            
            
        ]);
        
     
            $inventory_item = new Inventory;
            $inventory_item->batch_code = $request->input('batchcode');
            $inventory_item->expiry_date = $request->input('expirydate');
            $inventory_item->price = $request->input('price');
            $inventory_item->quantity = $request->input('quantity');


           $inventory_item->product_id = $request->input('product');
          //  $inventory_item->product_id = 36;
            $inventory_item->is_expirable = $request->input('isexpirable');
    
    
            
            $inventory_item->save();

            return redirect('/inventory')->with('success', 'Inventory item Created');
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
        $inventory = Inventory::find($id);
        // 
        return view('inventory.show')->with('inventory',$inventory);
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
        $products = Product::all();
        $inventory_item = Inventory::find($id);
        return view('inventory.edit')->with('inventory_item',$inventory_item)->with('products',$products);;
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
        //
        $this->validate($request, [
        //     'batchcode' => 'required',
        //     'price' => 'required',
        //     'quantity' => 'required',
          
        //     // 'product' => 'required',
        //    'isexpirable' => 'required',
        //     //'expirydate' => 'required'
            
            
        ]);
        
     
            $inventory_item = Inventory::find($id);
            $inventory_item->batch_code = $request->input('batchcode');
            $inventory_item->expiry_date = $request->input('expirydate');
            $inventory_item->price = $request->input('price');
            $inventory_item->quantity = $request->input('quantity');


           $inventory_item->product_id = $request->input('product');
          //  $inventory_item->product_id = 36;
            $inventory_item->is_expirable = $request->input('isexpirable');
    
    
            
            $inventory_item->save();

            return redirect('/inventory')->with('success', 'Inventory item Updated');
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
        $inventory_item = Inventory::find($id);
        $inventory_item->delete();

        return redirect('/inventory')->with('success', 'Inventory item Removed');
    }
}
