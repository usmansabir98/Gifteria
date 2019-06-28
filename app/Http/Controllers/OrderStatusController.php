<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\OrderStatus;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orderstatuses = OrderStatus::all();
        return view ('orderstatuses.index')->with('orderstatuses',$orderstatuses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orderstatuses.create');
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
            'description' => 'required',
            'name' => 'required',

            
            
        ]);

        $orderstatus = New OrderStatus;
        $orderstatus->name = $request->input('name');
        $orderstatus->description = $request->input('description');
        $orderstatus->save();

        return redirect('/orderstatus')->with('success', 'Order Status created');
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
        $orderstatus = OrderStatus::find($id);
        return view('orderstatuses.show')->with('orderstatus',$orderstatus);
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
        $orderstatus = OrderStatus::find($id);
        return view('orderstatuses.edit')->with('orderstatus',$orderstatus);
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

        $orderstatus = OrderStatus::find($id);
        $orderstatus->name = $request->input('name');
        $orderstatus->description = $request->input('description');
        $orderstatus->save();

        return redirect('/orderstatus')->with('success', 'Order Status Updated');
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
        
        $orderstatus = OrderStatus::find($id);
    
        $orderstatus->delete();

        return redirect('/orderstatus')->with('success', 'Order Status Deleted');
    }
}
