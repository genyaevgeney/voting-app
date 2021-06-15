<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use Livewire\Component;
use Livewire\WithPagination;

class IdeasIndex extends Component
{
    use WithPagination;

    public $category;
    public $search;

    protected $queryString = [
        'category',
        'search',
    ];

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::all();

        return view('livewire.ideas-index', [
            'ideas' => Idea::when(
                    $this->category && $this->category !== 'All Categories',
                    function ($query) use ($categories) {
                        return $query->where(
                            'category_id',
                            $categories->pluck('id', 'name')->get($this->category)
                        );
                    }
                )->when(strlen($this->search) >= 3, function ($query) {
                    return $query->where('title', 'like', '%'.$this->search.'%');
                })
                ->orderBy('id', 'desc')
                ->simplePaginate(Idea::PAGINATION_COUNT),
            'categories' => $categories,
        ]);
    }
}