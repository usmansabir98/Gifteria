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
        //$inventories = Inventory::orderBy('id')->paginate(20);
        // 
        //return view('inventory.index')->with('inventories',$inventories);
            
            $inventories = Product::
            join('brands' , 'products.brand_id' , '=' , 'brands.id')->
            join('inventories', 'inventories.product_id', '=', 'products.id') ->
            join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
            ->select('inventories.*','brands.name as brand_name', 'product_categories.name as product_category_name')
            ->orderBy('inventories.id')
            ->get() ;

        //return $inventories-> toJson();
           
        $INVENTORIES = [];  
         
         
         foreach ($inventories as $inventory)  {

            $INV = Product::find($inventory->product_id);  
            ///event categories
            $i = 0;
            foreach($INV ->eventCategories as $eventcategory){
                $event[$i]= $eventcategory->name;
                $i++;
            }
            
            //cover image
            $coverimage= '';
            foreach($INV ->productImages as $image){
                if($image->cover_flag == 1)
                $coverimage= $image->imageurl;
            }
            //name
            // $name='';
            // $name = $INV->name;
            
            //array of each record
            $inv = array (
                'id' => $inventory->id,
                'name' => $name = $INV->name,
                'brand' => $inventory->brand_name,
                 // to fill with the photos,
                 'event_category' => $event,
                 'cover_image' => $coverimage,
                'product_category' => $inventory->product_category_name,
                'quantity' => $inventory->quantity,
                'price' => $inventory->price,
                'batch_code' => $inventory->batch_code,
                'is_expirable' => $inventory->is_expirable,'expiry_date' => $inventory->expiry_date,
                
            );

            array_push($INVENTORIES, $inv);
            $event = []; //empty it before next item
            $coverimage = ''; //empty it before next item
            $name=''; //empty it before next item

       
        } //end foreach

           
       // return $products->toJson();

       return $INVENTORIES ;

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
        /*
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
            return redirect('/inventory')->with('success', 'Inventory item Created'); */

            $validatedData = $request->validate(['batchcode' => 'required',
            'price' => 'required', 'quantity' => 'required', 'isexpirable' => 'required',]);

       $inventory_item = Inventory::create([
        'batch_code' => $validatedData['batchcode'],
        'expiry_date' => $request->input('expirydate'),
        'price' => $validatedData['price'],
        'product_id' => $request->input('product'),
        'quantity' => $validatedData['quantity'],
        'is_expirable' => $validatedData['isexpirable'],
       
        ]);

        return response()->json('inventory item created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $inventory = Inventory::find($id);
        // 
       // return view('inventory.show')->with('inventory',$inventory);
      // return $inventory->toJson();

      //event categories
    $i = 0; $event =[];
    foreach($inventory->product->eventCategories as $eventcategory){
        $event[$i]= $eventcategory->name;
        $i++;
   }
    
       //cover image
    $coverimage= '';$image1='';$image2='';$image3='';
    foreach($inventory->product->productImages as $image){
        if($image->cover_flag == 1)
        $coverimage= $image->imageurl;
        elseif($image->cover_flag == 2)
        $image1= $image->imageurl;
        elseif($image->cover_flag == 3)
        $image2= $image->imageurl;
        elseif($image->cover_flag == 4)
        $image3= $image->imageurl;
    }
       return [
        'id' => $inventory->id,
        'inventory_item_name' => $inventory->product->name,
        'inventory_item_product_category' => $inventory->product->productCategory->name,
       'price' =>$inventory->price,
       'quantity' =>$inventory->quantity,
       'batch_code' =>$inventory->batch_code,
       'is_expirable' =>$inventory->is_expirable,
       'expiry_date' => $inventory->expiry_date,
        'inventory_item_product_brand' => $inventory->product->brand->name,
        'created_at' => $inventory->created_at,
        'updated_at' => $inventory->updated_at,
        'product_event_category' =>$event,
        'product_cover_image' => $coverimage,
        'product_image1' => $image1,
        'product_image2' => $image2,
        'product_image3' => $image3,
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
        // $products = Product::all();
        // $inventory_item = Inventory::find($id);
        // return view('inventory.edit')->with('inventory_item',$inventory_item)->with('products',$products);

        $inventory = Inventory::find($id);

      
        return [
            'id' => $inventory->id,
            'quantity' => $inventory->quantity,
            'price' => $inventory->price,
            'batch_code' => $inventory->batch_code,
            'is_expirable' => $inventory->is_expirable,
            'expiry_date' => $inventory->expiry_date,
            'created_at' => $inventory->created_at
        ];
        
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
       
        
     
           /* $inventory_item = Inventory::find($id);
            $inventory_item->batch_code = $request->input('batchcode');
            $inventory_item->expiry_date = $request->input('expirydate');
            $inventory_item->price = $request->input('price');
            $inventory_item->quantity = $request->input('quantity');
           $inventory_item->product_id = $request->input('product');
            $inventory_item->is_expirable = $request->input('isexpirable');
          $inventory_item->save();
         return redirect('/inventory')->with('success', 'Inventory item Updated'); */

         Inventory::find($id)->update([
            'batch_code' => $request->input('batchcode'),
            'expiry_date' => $request->input('expirydate'),
            'price' => $$request->input('price'),
            'product_id' => $request->input('product'),
            'quantity' =>$request->input('quantity'),
           
            ]);

            return response()->json('inventory item updated');
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

        return response()->json('inventory item deleted');
        //return redirect('/inventory')->with('success', 'Inventory item Removed');
    }
}
