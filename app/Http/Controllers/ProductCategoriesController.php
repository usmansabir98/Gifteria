<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;


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
        $product_categories = ProductCategory::orderBy('name');
        
        $data = Datatables::of($product_categories)
                ->editColumn('name', '<a href="productcategory/{{$id}}">{{$name}}</a>')
                ->toJson();

         return $data;

         //return response ()->json($product_categories);
        // return view('productcategories.index')->with('product_categories',$product_categories);
        //  return $product_categories->toJson();
    }

    public function all()
    {
        //
        $product_categories = ProductCategory::orderBy('name')->get();
         return $product_categories->toJson();
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
        // $this->validate($request, [
        //     'name' => 'required',
        //     'description' => 'required',
            
            
        // ]);
        
        // Create 
    //     $product_category = new ProductCategory;
    //     $product_category->name = $request->input('name');
    //     $product_category->description = $request->input('description');

    //    if($request->input('maincategory')) {
    //     $product_category->main_category = $request->input('maincategory');
    //      }
    //    else{
    //        $product_category->main_category =NULL;
    //      }
        
    //     $product_category->save();
       // return redirect('/productcategories')->with('success', 'ProductCategory Created');

        $validatedData = $request->validate(['name' => 'required',
        'description' => 'required',]);

        if($request->input('maincategory')) {
            $main_category = $request->input('maincategory');
             }
           else{
            $main_category =NULL;
             }
 
        $product_category = ProductCategory::create([
         'name' => $validatedData['name'],
         'description' => $validatedData['description'],
         'main_category' => $main_category
         
         ]);
 
         return response()->json('Main category created!');
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
        //return view('productcategories.show')->with('product_category',$product_category);
        return $product_category->toJson();

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
        $maincategories = ProductCategory::whereNull('main_category')->get();
        $product_category= ProductCategory::find($id);
       // return response ()->json($brands);
        return view('productcategories.edit')->with('product_category',$product_category)->with('maincategories',$maincategories);;

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
        // $this->validate($request, [
        //     'name' => 'required',
        //     'description' => 'required',
            
        // ]);
        
        // // Create Brand
        // $product_category = ProductCategory::find($id);
        // $product_category->name = $request->input('name');
        //$product_category->main_category = $request->input('maincategory');
        // $product_category->description = $request->input('description');
       
        

        // $product_category->save();
        // return redirect('/productcategories')->with('success', 'Event Category Updated');


        ProductCategory::find($id)->update(['name' => $request->input('name'),
        'description' => $request->input('description'), 'main_category' => $request->input('main_category')]);
        return response()->json('Product Category Updated!');
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
       // return redirect('/productcategories')->with('success', 'Product Category Removed');
        return response()->json('ProductCategory deleted!');
    }
}
