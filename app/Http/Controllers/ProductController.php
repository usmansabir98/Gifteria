<?php

namespace App\Http\Controllers;
use App\Product;
use App\Brand;
use App\EventCategory;
use App\ProductCategory;


use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::orderBy('name')->paginate(10);
        

         //return response ()->json($products);
         return view('products.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //
        //categories who  have parent/main category are themselves not main
        $product_categories = ProductCategory::whereNotNULL('main_category')->get();
        $brands = Brand::all();
        $event_categories = EventCategory::all();
        return view('products.create')->with('brands',$brands)->with('product_categories',$product_categories)->with('event_categories',$event_categories);
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
        
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'productcategory' => 'required',
            //'eventcategory' => 'required',
            'brand' => 'required',
            
            
        ]);
        
        // Create 
        $product = Product::find($id);
        $product->name = $request->input('name');
        //$product->description = $request->input('description');
        $product->description = 'k;f';
        $product->brand_id = $request->input('brand');
        $product->product_category_id = $request->input('productcategory');
        //$product->eventCategories = $request->input('eventcategory');
        $product->user_id = 1; 

        
        $product->save();

        // $product_event_category = new ProductEventCategory;

        // $product_event_category->product_id= $product->id;
        // $product_event_category->eventcategory_id= $request->input('eventcategory');

        

        return redirect('/products')->with('success', 'Product Created');
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
        $product = Product::find($id);
        //return response ()->json($event_categories);
        return view('products.show')->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $product_categories = ProductCategory::whereNotNULL('main_category')->get();
        $brands = Brand::all();
        $event_categories = EventCategory::all();
        $product= Product::find($id);
        
        return view('products.edit')->with('product',$product)->with('brands',$brands)->with('product_categories',$product_categories)->with('event_categories',$event_categories);
        
        
       // return response ()->json($product);
     
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
            'name' => 'required',
            'description' => 'required',
            'productcategory' => 'required',
            //'eventcategory' => 'required',
            'brand' => 'required',
            
            
        ]);
        
        // Create 
        $product = new Product;
        $product->name = $request->input('name');
        //$product->description = $request->input('description');
        $product->description = $request->input('description');
        $product->brand_id = $request->input('brand');
        $product->product_category_id = $request->input('productcategory');
        //$product->eventCategories = $request->input('eventcategory');
        $product->user_id = 1; 

        
        $product->save();

        // $product_event_category = new ProductEventCategory;

        // $product_event_category->product_id= $product->id;
        // $product_event_category->eventcategory_id= $request->input('eventcategory');

        

        return redirect('/products')->with('success', 'Product Created');
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
        $product = Product::find($id);
        
        $product->delete();
        return redirect('/products')->with('success', 'Product Removed');
    }
}
