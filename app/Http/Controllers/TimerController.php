<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Timer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TimerController extends Controller
{
    public function store(Request $request, int $id) //todo: fix
    {
        $data = $request->validate(['name' => 'required|between:3,100']);

        $timer = Project::mine()->findOrFail($id)
            ->timers()
            ->save(new Timer([
                'name' => $data['name'],
                'user_id' => auth()->id(), //todo: task_id
                'start_time' => new Carbon,
            ]));

        return $timer->with('project')->find($timer->id);
    }

    public function running() //todo: fix
    {
        return Timer::with('project')->mine()->running()->first() ?? [];
    }

    public function stopRunning() //todo: fix
    {
        if ($timer = Timer::mine()->running()->first()) {
            $timer->update(['end_time' => new Carbon]);
        }

        return $timer;
    }
}
