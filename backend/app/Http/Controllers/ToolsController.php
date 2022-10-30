<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;

class ToolsController extends Controller
{
    public function store(Request $request){
        $fields = $request->validate([
            'url' => 'required|string',
            'image' => 'required|string',
            'description' => 'string',
        ]);

        $tool = Tool::create([
            'url' => $fields['url'],
            'image' => $fields['image'],
            'description' => $fields['description'],
        ]);

        $response = [
            'tool' => $tool,
        ];

        return response($response, 201);
    }

    public function show(){
        $tools = Tool::all();
        return $tools;
    }

    public function destroy($id){
        return Tool::findorFail($id)->delete();
    }
}
