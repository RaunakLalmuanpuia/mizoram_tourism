<?php

namespace App\Observers;

use App\Models\Agent;
use App\Models\AgentRating;

class AgentRatingObserver
{
    /**
     * Handle the AgentRating "created" event.
     *
     * @param  \App\Models\AgentRating  $agentRating
     * @return void
     */
    public function created(AgentRating $agentRating)
    {
        $totalRatings=AgentRating::where('agents_id',$agentRating->agents_id)->sum('vote');
        $ratingCount=AgentRating::where('agents_id',$agentRating->agents_id)->count();
        $averageRating=$totalRatings/$ratingCount;
        $agent=Agent::findOrFail($agentRating->agents_id);
        $agent->average_ratings=number_format($averageRating,1);
        $agent->save();
    }

    /**
     * Handle the AgentRating "updated" event.
     *
     * @param  \App\Models\AgentRating  $agentRating
     * @return void
     */
    public function updated(AgentRating $agentRating)
    {
        //
    }

    /**
     * Handle the AgentRating "deleted" event.
     *
     * @param  \App\Models\AgentRating  $agentRating
     * @return void
     */
    public function deleted(AgentRating $agentRating)
    {
        //
    }

    /**
     * Handle the AgentRating "restored" event.
     *
     * @param  \App\Models\AgentRating  $agentRating
     * @return void
     */
    public function restored(AgentRating $agentRating)
    {
        //
    }

    /**
     * Handle the AgentRating "force deleted" event.
     *
     * @param  \App\Models\AgentRating  $agentRating
     * @return void
     */
    public function forceDeleted(AgentRating $agentRating)
    {
        //
    }
}
