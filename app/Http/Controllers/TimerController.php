<?php

namespace App\Http\Controllers;

use App\Http\Requests\Timer\StoreRequest;
use App\Models\Project;
use App\Models\Timer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TimerController extends Controller
{
    public function store(StoreRequest $request, int $id) //todo: fix
    {
        $timer = Project::mine()->findOrFail($id)
            ->timers()
            ->save(new Timer([
                'name' => 'Timer', //todo from request
                'start_time' => new Carbon,
                'end_time' => new Carbon,
//                'task_id' =>
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
