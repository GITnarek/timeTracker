<?php

namespace App\Http\Controllers;

use App\Enums\EnumHelper;
use App\Enums\Tasks\StatusesEnum;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        dd($projects->toArray());
//        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(StoreRequest $request) //todo: check and fix
    {
        $requestData = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ];

        $data = array_merge($requestData, ['user_id' => auth()->id()]);

        $project = Project::create($data);

        return $project ? array_merge($project->toArray(), ['timers' => []]) : false;
    }

    public function show($project_id)
    {
        $project = Project::query()->where('id', $project_id)->get();

        dd($project->toArray());

        return view('projects.show', compact('project'));
    }

    public function edit($project_id)
    {
        $project = Project::query()->where('id', $project_id)->get();

        return view('projects.edit', compact('project'));
    }

    public function update(UpdateRequest $request, $project_id)
    {
        $project = Project::query()->where('id', $project_id)->get();

        $requestData = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ];

        $project->update($requestData);

        return redirect()->route('projects.index');
    }

    public function destroy($project_id)
    {
        $project = Project::query()->where('id', $project_id)->get();

        $project->delete();

        return redirect()->route('projects.index');
    }

    public function getStatuses()
    {
        $statuses = EnumHelper::values(StatusesEnum::cases());

        echo '<pre>';
        var_dump($statuses);
//        return view('project.statuses', compact('statuses'));
    }
}
