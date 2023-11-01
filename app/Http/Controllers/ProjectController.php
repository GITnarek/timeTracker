<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Models\Project;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    /**
     * @return array
     */
    public function index(): array
    {
        $projects = Project::all();

        return $projects->toArray();
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('projects.create');
    }

    /**
     * @param StoreRequest $request
     * @return bool|array
     */
    public function store(StoreRequest $request): bool|array //todo: check and fix
    {
        $requestData = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ];

        $data = array_merge($requestData, ['user_id' => auth()->id()]);

        $project = Project::query()->create($data);

        return $project ? array_merge($project->toArray(), ['timers' => []]) : false;
    }

    /**
     * @param $id
     * @return array
     */
    public function show($id): array
    {
        $project = Project::query()->where('id', $id)->get();

        return $project->toArray();
    }

    /**
     * @param $id
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function edit($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $project = Project::query()->where('id', $id)->get();

        return view('projects.edit', compact('project'));
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $id): RedirectResponse
    {

        Project::query()->where('id', $id)->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        return redirect()->route('projects.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $project = Project::query()->where('id', $id);

        $project->delete();

        return redirect()->route('projects.index');
    }
}
