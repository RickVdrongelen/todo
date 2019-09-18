<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TaskController extends Controller
{
    public function index() {
        $tasks = Todo::all();

        dd($tasks);

        return view('tasks', [
            'tasks' => $tasks
        ]);
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if($validator->fails()) {
            return redirect('/')
            ->withInput()
            ->withErrors($validator);
        }

        $task = new Todo;
        $task->name = $request->name;
        $task->save();

        return redirect('/');
    }

    public function destroy(int $id) {
        Todo::findOrFail($id)->delete();

        return redirect('/');
    }
}
