<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dispatch;
use App\Models\Worker;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index()
    {
        $workers=Worker::get();
        return view("worker.index",compact("workers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("worker.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "password"=>"required",
        ],[
            "name.required"=>"エラーが発生しました",
            "email.required"=>"エラーが発生しました",
            "password.required"=>"エラーが発生しました",
        ]);
        $memo=$request->memo?$request->memo:null;
        Worker::query()->create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>$request->password,
            "memo"=>$memo,
        ]);
        return redirect(route("worker_create"))->with(["message"=>"人材情報が登録されました"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $worker=Worker::query()->find($id);
        $dispatchs=Dispatch::query()->where("worker_id",$worker->id)->first();
        if (isset($dispatchs)) {
            foreach ($dispatchs as $dispatch) {
                $dispatch->delete();
            }
        }
        $worker->delete();
        return redirect(route("worker_index"));
    }
}
