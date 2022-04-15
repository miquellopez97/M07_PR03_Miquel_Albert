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
    public function show($value)
    {
        if (is_numeric($value)){
            $apartment = Apartment::where('id', $value)->first();
            return response()->json($apartment, 200);
        } else {
            return response()->json(Apartment::where('city', $value)->get(), 200);
        }
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

    public function platform($platform)
    {
        return response()->json(Apartment::where('platform_id', '=', $platform)->get(), 200);
    }
}
