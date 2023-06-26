<?php

namespace App\Http\Livewire\Token;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function view;

class ShowTokens extends Component
{
    public $name;
    public $token;
    public $tokens;

    protected $rules = [
        'name' => 'required',
    ];

    public function create()
    {
        $this->validate();
        $token = Auth::user()->createToken($this->name);
        $this->token = $token->plainTextToken;
        $this->mount();
    }

    public function mount()
    {
        $this->tokens = Auth::user()->tokens;
    }

    public function delete($tokenId)
    {
        Auth::user()->tokens()->where('id', $tokenId)->delete();
        $this->mount();
    }

       public function render()
    {
        return view('livewire.token.show-tokens');
    }
}
