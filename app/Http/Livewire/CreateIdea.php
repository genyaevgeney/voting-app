<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use App\Models\MediaFile;
use App\Models\Donation;
use Illuminate\Http\Response;
use App\Rules\CheckUserBalance;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateIdea extends Component
{
    use WithFileUploads;

    public $category;
    public $title;
    public $description;
    public $amount;
    public $files;

    protected $rules;

    public function __construct()
    {
        $this->rules = [
            'title' => 'required|min:4',
            'category' => 'required|integer|exists:categories,id',
            'description' => 'required|min:4',
            'amount' => ['required', new CheckUserBalance],
            'files.*' => 'mimes:jpeg,jpg,jpe,png,svg,svgz,jpgv,mp4,mp4v,mpg4,ogv',
            'files' => 'max:3'
        ];
    }

    public function createIdea()
    {
        if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();
        // dd(pathinfo($this->files[0]->getFilename(), PATHINFO_EXTENSION));

        $percent = config('ideas.percent');
        $collectedAmount = $this->amount * ($percent / 100);
        $user = auth()->user();

        $idea = Idea::create([
            'user_id' => $user->id,
            'category_id' => $this->category,
            'title' => $this->title,
            'description' => $this->description,
            'amount' => $this->amount
        ]);

        if ($this->files) {
            foreach ($this->files as $file) {
                $filePath = $file->store('public');
                $fileName = str_replace("public/", "", $filePath);

                MediaFile::create([
                    'idea_id' => $idea->id,
                    'name' => $fileName
                ]);
            }
        }

        Donation::create([
            'idea_id' => $idea->id,
            'user_id' => $user->id,
            'amount' => $collectedAmount
        ]);

        $user->balance -= $collectedAmount;
        $user->save();
        session()->flash('success_message', 'Idea was added successfully!');
        $this->reset();

        return redirect()->route('idea.index');
    }

    public function render()
    {
        return view('livewire.create-idea', [
            'categories' => Category::all(),
        ]);
    }
}