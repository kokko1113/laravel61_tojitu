<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dispatch;
use App\Models\Event;
use App\Models\Worker;
use Illuminate\Http\Request;

class DispatchController extends Controller
{
    public function index()
    {
        $dispatchs = Dispatch::get();
        return view("dispatch.index", compact("dispatchs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::get();
        $workers = Worker::get();
        return view("dispatch.create", compact("events", "workers"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "event_name" => "required",
            "worker_name" => "required",
        ], [
            "event_name.required" => "エラーが発生しました",
            "worker_name.required" => "エラーが発生しました",
        ]);
        $event_id = Event::query()->where("name", $request->event_name)->first()->id;
        $memo = $request->memo ? $request->memo : null;
        $workers = $request->worker_name;
        foreach ($workers as $worker) {
            $worker_id = Worker::query()->where("name", $worker)->first()->id;
            Dispatch::query()->create([
                "event_id" => $event_id,
                "worker_id" => $worker_id,
                "permit" => false,
                "memo" => $memo,
            ]);
        }
        return redirect(route("dispatch_create"))->with(["message" => "派遣情報が登録されました"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dispatch = Dispatch::query()->find($id);
        $dispatch->delete();
        return redirect(route("dispatch_index"));
    }
}
