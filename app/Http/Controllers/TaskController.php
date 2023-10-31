<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Project;
use App\Models\Task;

class TaskController extends Controller
{
    public function index($project_id)
    {
        $project = Project::with('tasks')
            ->where('id', $project_id)
            ->get();

        dd($project->toArray());
        $tasks = Task::all();

        dd($tasks->toArray());

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(StoreRequest $request) //todo: fix
    {
        $requestData = [
            'sysname' => $request->get('sysname'),
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'status' => $request->get('status'),
            'priority' => $request->get('priority'),
            'type' => $request->get('type'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'estimated_time' => $request->get('estimated_time'),
            'spent_time' => $request->get('spent_time'),
        ];

        Task::create($requestData);

        return redirect()->route('tasks.index');
    }

    public function show($project_id, $task_id)
    {
        $tasks = Task::with('project')
            ->where('project_id', $project_id)
            ->where('id', $task_id)
            ->get();

        dd($tasks->toArray());

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(UpdateRequest $request, Task $task) //todo: fix
    {
        $requestData = [
            'sysname' => $request->get('sysname'),
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'status' => $request->get('status'),
            'priority' => $request->get('priority'),
            'type' => $request->get('type'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'estimated_time' => $request->get('estimated_time'),
            'spent_time' => $request->get('spent_time'),
        ];

        $task->update($requestData);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
