<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookmarksController extends Controller
{
    public function store($toolId){

        return Auth::id();

        $bookmark = Bookmark::create([
            'tool_id' => $toolId,
            'user_id' => 12,
        ]);

        // 'user_id' => Auth::id(),

        $response = [
            'bookmark' => $bookmark,
        ];

        return response($response, 201);
    }
}
