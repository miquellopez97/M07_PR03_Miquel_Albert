<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Middleware\CreateApartmentValidation;
use App\Http\Middleware\UpdateApartmentValidation;

class ApartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(CreateApartmentValidation::class, ['only' => ['store']]);
        $this->middleware(UpdateApartmentValidation::class, ['only' => ['update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Apartment::all(), 200);
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
    public function store(Request $request)
    {
        // dd($request->all());
        $apartment = Apartment::create($request->all());

        return response()->json($apartment, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::where('id', $id)->first();
        return response()->json($apartment, 200);

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
    public function update(Request $request, $id)
    {
        $apartment = Apartment::find($id);
        $apartment->fill($request->all())->save();
        return response()->json($apartment, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartment = Apartment::find($id);
        $apartment->forceDelete();
        return response()->noContent();
    }

    public function apartamentsPremium()
    {
        return response()->json(Apartment::where('rented_price', '>=', 1000)->get(), 200);
    }

    public function apartamentsRented()
    {
        return response()->json(Apartment::where('rented', '=', 1)->get(), 200);
    }
}
