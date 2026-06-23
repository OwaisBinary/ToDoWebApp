<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDo;

class ToDoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);
        ToDo::create($request->all());
        return redirect()->route('home');
    }

  

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $toDo = ToDo::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $toDo->update([
            'title' => $request->input('title'),
        ]);
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $toDo = ToDo::findOrFail($id);
        $toDo->delete();
        return redirect()->route('home');
    }

    public function toggle(string $id)
    {
        $toDo = ToDo::findOrFail($id);
        $toDo->status = $toDo->status === 'pending' ? 'completed' : 'pending';
        $toDo->save();
        return redirect()->route('home');
    }
}
