<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function index()
    {
        $reactions = Reaction::orderBy('id', 'desc')->paginate(10);
        return view('admin.reaction.index', compact('reactions'));
    }
}
