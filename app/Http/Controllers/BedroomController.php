<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBedroomRequest;
use App\Models\Bedroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $bedrooms = Bedroom::paginate(4);
        $enum = Bedroom::get_enum_values_size_beds();
        return Inertia::render('Bedrooms/index', ['bedrooms' => $bedrooms, 'enum_size_beds' => $enum]);
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
    public function update(StoreBedroomRequest $request,Bedroom $bedroom)
    {
        $validated = $request->validated();
        return $validated;
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
    }
}
