<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * TicketController constructor.
     */
    public function __construct()
    {
        // Authentication required for these endpoints.
        $this->middleware('auth')->except('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $tickets = Ticket::query()
            ->when($request->has('filter.plaque_id'), function ($query) use ($request) {
                $query->where('plaque_id', '=', $request->input('filter.plaque_id'));
            })
            ->paginate();

        return TicketResource::collection($tickets);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\TicketResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'plaque_id' => ['required', 'exists:plaques,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $ticket = Ticket::create([
            'plaque_id' => $request->plaque_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return new TicketResource($ticket);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ticket $ticket
     * @return \App\Http\Resources\TicketResource
     */
    public function show(Request $request, Ticket $ticket)
    {
        return new TicketResource($ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ticket $ticket
     * @return \App\Http\Resources\TicketResource
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'plaque_id' => ['required', 'exists:plaques,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $ticket->update([
            'plaque_id' => $request->has('plaque_id') ? $request->plaque_id : $ticket->plaque_id,
            'name' => $request->has('name') ? $request->name : $ticket->name,
            'description' => $request->has('description') ? $request->description : $ticket->description,
        ]);

        return new TicketResource($ticket);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ticket $ticket
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Ticket $ticket)
    {
        $ticket->delete();

        return response()->json(['message' => 'Ticket deleted']);
    }
}
