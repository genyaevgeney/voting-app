<?php

namespace App\Http\Livewire;

use App\Exceptions\DuplicateVoteException;
use App\Exceptions\VoteNotFoundException;
use App\Models\Idea;
use Livewire\Component;

class IdeaIndex extends Component
{
    public $idea;
    public $hasVoted;
    public $hasDonated;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->hasVoted = $idea->voted_by_user;
    }

    public function vote()
    {
        if (! auth()->check()) {
            return redirect(route('login'));
        }

        if ($this->hasVoted) {
            try {
                $this->idea->removeVote(auth()->user());
            } catch (VoteNotFoundException $e) {
                // do nothing
            }
            $this->hasVoted = false;
        } else {
            try {
                $this->idea->vote(auth()->user());
            } catch (DuplicateVoteException $e) {
                // do nothing
            }
            $this->hasVoted = true;
        }
    }

    public function render()
    {
        return view('livewire.idea-index');
    }
}