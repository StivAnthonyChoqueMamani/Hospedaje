<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBedroomRequest;
use App\Models\Bedroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;

class BedroomController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  string  $column
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bedrooms = Bedroom::
            where('status', 'available')
            ->orWhere('status', 'undefined')
            ->paginate(4);
        $enum_size_beds = Bedroom::get_enum_values_size_beds();
        $enum_status = Bedroom::get_enum_values_status();
        return Inertia::render('Bedrooms/index', [
            'bedrooms' => $bedrooms, 
            'enum_size_beds' => $enum_size_beds,
            'enum_status' => $enum_status,
        ]);
    }

    /**
     * Display a listing of the resource.
     * @param  int  $search
     * @param  string  $column
     * @param  object  $param
     * @return \Illuminate\Http\Response
     */
    public function search($search,$column)
    {
        $search = urldecode($search);
        if ($search == 'na') {
            $bedrooms = Bedroom::paginate(3);
            return Inertia::render('Bedrooms/index', ['bedrooms' => $bedrooms]);
        } else {
            $bedrooms = Bedroom::where($column, $search)->paginate(3);
            return Inertia::render('Bedrooms/index', ['bedrooms' => $bedrooms]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBedroomRequest $request)
    {
        $validate = $request->validated();
        $bedroom = Bedroom::create($validate);
        $bedroom -> save();
        return $this->index();
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBedroomRequest $request,Bedroom $id)
    {
        $validateData = $request->validated();
        $changes = array_diff($id->toArray(),$validateData);
        $id->update($validateData);
        // return redirect(URL::previous());
        return Redirect::to(URL::previous())->with(['bedroom_editado'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bedroom $id)
    {
        $id->status = "not available";
        $id->save();
        return Redirect::to(URL::previous());
    }
}
