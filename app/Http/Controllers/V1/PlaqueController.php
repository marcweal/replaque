<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Plaque;
use Illuminate\Http\Request;
use App\Http\Resources\PlaqueResource;

class PlaqueController extends Controller
{
    /**
     * PlaqueController constructor.
     */
    public function __construct()
    {
        // Authentication required for these endpoints.
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $plaques = Plaque::paginate();

        return PlaqueResource::collection($plaques);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\PlaqueResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address_line_1' => ['required', 'string', 'max:255'],
            'address_line_2' => ['string', 'max:255'],
            'address_line_3' => ['string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'string', 'max:255'],
            'lat' => ['numeric'],
            'lng' => ['numeric'],
            'unveiler' => ['required', 'string', 'max:255'],
            'date_unveiled' => ['required', 'date_format:Y-m-d'],
            'sponsor' => ['required', 'string', 'max:255'],
            'comments' => ['string'],
        ]);

        $plaque = Plaque::create([
            'name' => $request->name,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'address_line_3' => $request->address_line_3,
            'city' => $request->city,
            'postcode' => $request->postcode,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'unveiler' => $request->unveiler,
            'date_unveiled' => $request->date_unveiled,
            'sponsor' => $request->sponsor,
            'comments' => $request->comments,
        ]);

        return new PlaqueResource($plaque);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Plaque $plaque
     * @return \App\Http\Resources\PlaqueResource
     */
    public function show(Request $request, Plaque $plaque)
    {
        return new PlaqueResource($plaque);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Plaque $plaque
     * @return \App\Http\Resources\PlaqueResource
     */
    public function update(Request $request, Plaque $plaque)
    {
        $request->validate([
            'name' => ['string', 'max:255'],
            'address_line_1' => ['string', 'max:255'],
            'address_line_2' => ['string', 'max:255'],
            'address_line_3' => ['string', 'max:255'],
            'city' => ['string', 'max:255'],
            'postcode' => ['string', 'max:255'],
            'lat' => ['numeric'],
            'lng' => ['numeric'],
            'unveiler' => ['string', 'max:255'],
            'date_unveiled' => ['date_format:Y-m-d'],
            'sponsor' => ['string', 'max:255'],
            'comments' => ['string'],
        ]);

        $plaque->update([
            'name' => $request->has('name') ? $request->name : $plaque->name,
            'address_line_1' => $request->has('address_line_1') ? $request->address_line_1 : $plaque->address_line_1,
            'address_line_2' => $request->has('address_line_2') ? $request->address_line_2 : $plaque->address_line_2,
            'address_line_3' => $request->has('address_line_3') ? $request->address_line_3 : $plaque->address_line_3,
            'city' => $request->has('city') ? $request->city : $plaque->city,
            'postcode' => $request->has('postcode') ? $request->postcode : $plaque->postcode,
            'lat' => $request->has('lat') ? $request->lat : $plaque->lat,
            'lng' => $request->has('lng') ? $request->lng : $plaque->lng,
            'unveiler' => $request->has('unveiler') ? $request->unveiler : $plaque->unveiler,
            'date_unveiled' => $request->has('date_unveiled') ? $request->date_unveiled : $plaque->date_unveiled,
            'sponsor' => $request->has('sponsor') ? $request->sponsor : $plaque->sponsor,
            'comments' => $request->has('comments') ? $request->comments : $plaque->comments,
        ]);

        return new PlaqueResource($plaque);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Plaque $plaque
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Plaque $plaque)
    {
        $plaque->tickets()->delete();
        $plaque->delete();

        return response()->json(['message' => 'Plaque deleted']);
    }
}
