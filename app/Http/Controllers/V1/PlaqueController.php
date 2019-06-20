<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Plaque;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // TODO: Get paginated collection of Plaque models.
        // https://laravel.com/docs/5.8/pagination#paginating-query-builder-results
        $plaques = DB::table('plaques')->paginate(15);

        // TODO: Return a JSON response of the paginated set.
        // https://laravel.com/docs/5.8/eloquent-resources#pagination
        return json_encode($plaques);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO: Validate the request
        // https://laravel.com/docs/5.8/validation#quick-writing-the-validation-logic

        // TODO: Store the Plaque record in the database.
        // https://laravel.com/docs/5.8/eloquent#inserting-and-updating-models

        // TODO: Return a JSON response of the Plaque.
        // https://laravel.com/docs/5.8/eloquent-resources#writing-resources
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Plaque $plaque
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Plaque $plaque)
    {
        // TODO: Return a JSON response of the Plaque.
        // https://laravel.com/docs/5.8/eloquent-resources#writing-resources
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Plaque $plaque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plaque $plaque)
    {
        // TODO: Validate the request.
        // https://laravel.com/docs/5.8/validation#quick-writing-the-validation-logic

        // TODO: Update the Plaque record in the database.
        // https://laravel.com/docs/5.8/eloquent#inserting-and-updating-models

        // TODO: Return a JSON response of the Plaque.
        // https://laravel.com/docs/5.8/eloquent-resources#writing-resources
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Plaque $plaque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Plaque $plaque)
    {
        // TODO: Delete the related ticket records in the database.
        // https://laravel.com/docs/5.8/eloquent-relationships#one-to-many

        // TODO: Delete the Plaque record in the database.
        // https://laravel.com/docs/5.8/eloquent#deleting-models

        // TODO: Return a resource deleted JSON response.
        // https://laravel.com/docs/5.8/responses#json-responses
    }
}
