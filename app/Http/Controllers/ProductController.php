<?php

namespace App\Http\Controllers;
use App\Product;
use App\ProductImage;
use App\Brand;
use App\EventCategory;
use App\ProductCategory;
use Illuminate\Support\Facades\Storage;


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
        $products = Product::orderBy('name')->paginate(20);
        // 
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
        
       //
        
       $this->validate($request, [
        'name' => 'required',
        'description' => 'required',
        'productcategory' => 'required',
        //'eventcategory' => 'required',
        'brand' => 'required',
        'cover_image' => 'image|nullable|max:1999'
        
        
    ]);
    
 
        $product = new Product;
        $product->name = $request->input('name');
    
        $product->description = $request->input('description');
        $product->brand_id = $request->input('brand');
        $product->product_category_id = $request->input('productcategory');
        
        $product->user_id = 1; 

        
        $product->save();

      //event categories
       $eventcategories= $request->input('event_category');

            $event_category = EventCategory::find($eventcategories);

            $product->eventCategories()->attach($event_category);

        //cover image in productImage table
        $product_cover_image = new ProductImage;
     
       // Handle File Upload
       if($request->hasFile('cover_image')){
        // Get filename with the extension
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore= $filename.'_'.time().'.'.$extension;
        // Upload Image
        $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
    } 
        else {
            $fileNameToStore = 'noimage.jpg';
        }
        $product_cover_image->imageurl = $fileNameToStore;
        $product_cover_image->cover_flag = 1;
        $product_cover_image->product_id = $product->id;
        $product_cover_image->save();
    

        return redirect('/products')->with('success', 'Product Created');
         //return response ()->json($eventcategories);

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
            //'description' => 'required',
            'productcategory' => 'required',
            //'eventcategory' => 'required',
            'brand' => 'required',
            
            
        ]);
        
     
        $product = Product::find($id);
        $product->name = $request->input('name');
       
         $product->description = $request->input('description');
        $product->brand_id = $request->input('brand');
        $product->product_category_id = $request->input('productcategory');
        $product->user_id = 1; 

        
        
         
        //get all event categories of a product to remove records in the middle table
        $event_categories = $product->eventCategories;

         foreach($event_categories as $eventcategory)
       {
        $event_category= EventCategory::find($eventcategory);
        $product->eventCategories()->detach($event_category);
       }
       //adding new records in middle table
        $eventcategories= $request->input('event_category');
 
         $event_category = EventCategory::find($eventcategories);
 
         $product->eventCategories()->attach($event_category);

         //cover image in productImage table
        $product_cover_image = new ProductImage;
     
        // Handle File Upload
        if($request->hasFile('cover_image')){
         // Get filename with the extension
         $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
         // Get just filename
         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
         // Get just ext
         $extension = $request->file('cover_image')->getClientOriginalExtension();
         // Filename to store
         $fileNameToStore= $filename.'_'.time().'.'.$extension;
         // Upload Image
         $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
         } 
        if($request->hasFile('cover_image')){

              //get all covers  of a product to remove records in the imageproduct table
              $images = $product->productImages;

              foreach($images as $image)
              {
                      if($image->cover_flag==1) {
                      Storage::delete('public/cover_images/'.$image->imageurl);
                      $image->delete(); }
                          
                  
              }
         $product_cover_image->imageurl = $fileNameToStore;
         $product_cover_image->cover_flag = 1;
         $product_cover_image->product_id = $product->id;
         $product_cover_image->save();

              
        }

        $product->save();

       
      

       return redirect('/products')->with('success', 'Product Updated');
      // return response()->json($request->input('eventcategory'));
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
       
        //get all event categories of a product to remove records in the middle table
        $event_categories = $product->eventCategories;

         foreach($event_categories as $eventcategory)
       {
        $event_category= EventCategory::find($eventcategory);
        $product->eventCategories()->detach($event_category);
       }
        


       //get all covers and other imgs of a product to remove records in the imageproduct table
       $images = $product->productImages;

       foreach($images as $image)
     {
            
            Storage::delete('public/cover_images/'.$image->imageurl);
            $image->delete();
                
        
     }
      
       
       //del the product
        $product->delete();

        return redirect('/products')->with('success', 'Product Removed');
    }
}
