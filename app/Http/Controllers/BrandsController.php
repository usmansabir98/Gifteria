<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = Brand::orderBy('name')->paginate(10);;
        

         return $brands->toJson();
        // return view('brands.index')->with('brands',$brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('brands.create');
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
        
        // // Create Brand
        // $brand = new Brand;
        // $brand->name = $request->input('name');
        // $brand->description = $request->input('description');
        // $brand->save();
       // return redirect('/brands')->with('success', 'Brand Created');
       $validatedData = $request->validate(['name' => 'required',
       'description' => 'required',]);

       $brand = Brand::create([
        'name' => $validatedData['name'],
        'description' => $validatedData['description'],
        ]);

        return response()->json('Brand created!');
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
        $brand = Brand::find($id);
       // return response ()->json($brands);
      //  return view('brands.show')->with('brand',$brand);
        return $brand->toJson();
        
        

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
        $brand = Brand::find($id);
         return response ()->json($brands);
        //return view('brands.edit')->with('brand',$brand);
        
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
        // // Create Brand
        // $brand =  Brand::find($id);
        // $brand->name = $request->input('name');
        // $brand->description = $request->input('description');
        // $brand->save();
        // return redirect('/brands')->with('success', 'Brand Updated');

  
        Brand::find($id)->update(['name' => $request->input('name'),'description' => $request->input('description')]);
        return response()->json('Brand Updated!');

    }
     
    // public function markAsCompleted(Brand $brand)
    // {
    //     $brand->is_completed = true;
    //     $brand->update();
  
    //     return response()->json('Brand updated!');
    // }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $brand = Brand::find($id);
        
        $brand->delete();
       // return redirect('/brands')->with('success', 'Brand Removed');
        return response()->json('Brand deleted!');
    }
    
}
