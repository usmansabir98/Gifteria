<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductCategory;
class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product_categories = ProductCategory::orderBy('name')->paginate(10);
        

         //return response ()->json($brands);
         return view('productcategories.index')->with('product_categories',$product_categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //categories who do not have parent/main category are themselves main
        $maincategories = ProductCategory::whereNull('main_category')->get();
        return view('productcategories.create')->with('maincategories',$maincategories);
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
            
            
        ]);
        
        // Create 
        $product_category = new ProductCategory;
        $product_category->name = $request->input('name');
        $product_category->description = $request->input('description');

       if($request->input('maincategory')) {
        $product_category->main_category = $request->input('maincategory');
         }
       else{
           $product_category->main_category =NULL;
         }
        
        $product_category->save();
        return redirect('/productcategories')->with('success', 'ProductCategory Created');
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
        $product_category = ProductCategory::find($id);
        //return response ()->json($event_categories);
        return view('productcategories.show')->with('product_category',$product_category);

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
        $product_category= ProductCategory::find($id);
       // return response ()->json($brands);
        return view('productcategories.edit')->with('product_category',$product_category);

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
            
        ]);
        
        // Create Brand
        $product_category = ProductCategory::find($id);
        $product_category->name = $request->input('name');
        $product_category->description = $request->input('description');
       
        

        $product_category->save();
        return redirect('/productcategories')->with('success', 'Event Category Updated');
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
        $product_category = ProductCategory::find($id);
        
        $product_category->delete();
        return redirect('/productcategories')->with('success', 'Product Category Removed');
    }
}
