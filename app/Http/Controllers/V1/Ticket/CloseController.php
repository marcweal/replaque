<?php

namespace App\Http\Controllers\V1\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class CloseController extends Controller
{
    /**
     * CloseController constructor.
     */
    public function __construct()
    {
        // Authentication required for this endpoint.
        $this->middleware('auth');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ticket $ticket
     * @return \App\Http\Resources\TicketResource
     */
    public function __invoke(Request $request, Ticket $ticket)
    {
        $ticket->update([
            'closed_at' => Date::now(),
        ]);

        return new TicketResource($ticket);
    }
}
