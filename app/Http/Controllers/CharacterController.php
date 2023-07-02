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

    public function show(Character $character) {
        return view('character/show', compact('character'));
    }

    public function edit(Character $character) {
        return $character;
    }
}
