<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\View\View;

class CharacterController extends Controller
{
    /**
     * @property Character $character
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('character/index');
    }

    public function edit(Character $character) {
        return view('character/edit', compact('character'));
    }
}
