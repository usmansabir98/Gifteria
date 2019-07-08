<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;

use App\EventCategory;
class EventCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $event_categories = EventCategory::orderBy('name');
        
        $data = Datatables::of($event_categories)
                ->editColumn('name', '<a href="eventcategory/{{$id}}">{{$name}}</a>')
                ->toJson();

         return $data;
         //return view('eventcategories.index')->with('event_categories',$event_categories);
    }

    public function all()
    {
        //
        $event_categories = EventCategory::orderBy('name')->get();
         return $event_categories->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('eventcategories.create');
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
        // $event_category = new EventCategory;
        // $event_category->name = $request->input('name');
        // $event_category->description = $request->input('description');
        // $event_category->save();
        // return redirect('/eventcategories')->with('success', 'EventCategory Created');
        $validatedData = $request->validate(['name' => 'required',
       'description' => 'required',]);

       $event_category = EventCategory::create([
        'name' => $validatedData['name'],
        'description' => $validatedData['description'],
        ]);

        return response()->json('Event Category created!');
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
        $event_category = EventCategory::find($id);
        //return response ()->json($event_categories);
        //return view('eventcategories.show')->with('event_category',$event_category);
        return $event_category->toJson();

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
        $event_category= EventCategory::find($id);
       // return response ()->json($brands);
        return view('eventcategories.edit')->with('event_category',$event_category);

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
        // $event_category = EventCategory::find($id);
        // $event_category->name = $request->input('name');
        // $event_category->description = $request->input('description');
        // $event_category->save();
        // return redirect('/eventcategories')->with('success', 'Event Category Updated');

        EventCategory::find($id)->update(['name' => $request->input('name'),'description' => $request->input('description')]);
        return response()->json('Event Category Updated!');
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
        $event_category = EventCategory::find($id);
        
        $event_category->delete();
        //return redirect('/eventcategories')->with('success', 'Event Category Removed');
        return response()->json('EventCategory deleted!');
    }
}
