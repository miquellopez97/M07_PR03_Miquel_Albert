<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Http\Middleware\CreateApartmentValidation;
use App\Http\Middleware\UpdateApartmentValidation;
use App\Http\Middleware\ShowOneApartmentValidation;
use App\Models\Platform;
use Illuminate\Support\Facades\Validator;

class ApartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(CreateApartmentValidation::class, ['only' => ['store']]);
        $this->middleware(UpdateApartmentValidation::class, ['only' => ['update']]);
        $this->middleware(ShowOneApartmentValidation::class, ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::all();
        foreach ($apartments as $apartment) {
            $apartment->user;
            $apartment->apartmentPlatform;
        }
        return response()->json($apartments, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo($request);
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
        if (is_numeric($value)) {
            $apartment = Apartment::where('id', $value)->first();
            $apartment->user;
            $apartment->apartmentPlatform;
            return response()->json($apartment, 200);
        } else {
            echo($value);
            $apartments = Apartment::where('city', $value)->get();
            foreach ($apartments as $apartment) {
                $apartment->user;
                $apartment->apartmentPlatform;
            }
            return response()->json($apartments, 200);
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
        $apartments = Apartment::where('rented_price', '>=', 1000)->get();
        foreach ($apartments as $apartment) {
            $apartment->user;
        }
        return response()->json($apartments, 200);
    }

    public function apartamentsRented(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'rented' => 'required|boolean'
        ]);

        // echo($validatedData->validated());

        if (!$validatedData->fails()) {
            $apartments = Apartment::where('rented', '=', $request->rented)->get();
            foreach ($apartments as $apartment) {
                $apartment->user;
            }
            return response()->json($apartments, 200);
        } else {
            return response()->json('Error de validación', 400);
        }
    }

    public function platform(Request $request)
    {

        $request->validate([
            'platform_id' => 'required|numeric'
        ]);

        $platforms =  Platform::where('id', $request->platform_id)->get();
        $apartment = null;

        foreach ($platforms as $platform) {
            $apartments = $platform->apartmentPlatform;
            foreach ($apartments as $apartment) {
                $apartment->user;
            }
        }

        return response()->json($apartments, 200);
    }
}
