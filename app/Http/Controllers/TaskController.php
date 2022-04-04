<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //session()->forget('pagination');
        $id = auth()->id();
        $data = $data = Task::all("*")->where('addedBy', $id);
        $no_of_tasks = count($data);
        $pagination = session()->get('pagination');
        if($pagination){
            $data = DB::select("SELECT * FROM tasks WHERE tasks.addedBy = $id LIMIT $pagination,7;");
        }
        else{
            $data = DB::select("SELECT * FROM tasks WHERE tasks.addedBy = $id LIMIT 7;");
        }
        return view('Task.index', ['data' => $data, 'no_of_tasks' => $no_of_tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            "title"  => "required|string|min:6|max:40",
            "content" => "required|string|min:6|max:100",
            "image" => "mimes:jpeg,jpg,png,gif|required|max:10000",
            "startDate" => "required|after:yesterday",
            "endDate" => "required|after:".$request->startDate,
        ]);
        $data['addedBy'] = auth()->id();
        $FileName = time().rand().'.'.$request->image->extension();
        if($request->image->move(public_path('uploads'),$FileName)){
            $data['image'] =  $FileName;
        }
        else {
            $this->message(false, '', 'Error , please try again');
            return redirect(url('/Task/create'));
        }
        $op = Task::create($data);
        $this->message($op, 'Task was created successfully', 'Error try again');
        return redirect(url('/1'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userId = auth()->id();
        $data = DB::select("SELECT * from tasks where id = $id AND addedBy = $userId");
        return view('Task.edit', [ 'data' => $data[0] ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userId = auth()->id();
        $old_image = DB::select("SELECT * from tasks where id = $id AND addedBy = $userId")[0]->image;
        $data = $this->validate($request,[
            "title"  => "required|string|min:6|max:40",
            "content" => "required|string|min:6|max:100",
            "image" => "nullable|image|mimes:png,jpg|max:10000",
            "startDate" => "required",
            "endDate" => "required|after:".$request->startDate,
        ]);
        $data['addedBy'] = $userId;

        if($request->hasFile('image')){
            $FileName = time().rand().'.'.$request->image->extension();
            if($request->image->move(public_path('uploads'),$FileName)){
                $data['image'] =  $FileName;
                unlink(public_path('uploads/'.$old_image));
            };
        }
        else {
            $data['image'] = $old_image;
        };

        $op = Task::where('id', $id)->where('addedBy', $userId)->update($data);
        $this->message($op, 'Task was edited successfully', 'Error try again');
        return redirect(url('/1'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Task::find($id);
        $userId = auth()->id();
        $op = Task::where('id', $id)->where('addedBy', $userId)->delete();
        if($op){
            $this->message(true, 'Task was deleted successfully', '');
            unlink(public_path('uploads/'.$data->image));
        }
        else {
            $this->message(false, '', 'Error please try again');
        }
        return redirect(url('/1'));
    }
    public function taskDone (Request $request)
    {
        $data = $this->validate($request,[
            "id"  => "required|numeric",
        ]);
        $id = $data['id'];
        $userId = auth()->id();
        $status = DB::select("SELECT * from tasks where id = $id AND addedBy = $userId")[0]->status;
        if($status == true){
            Task::where('id', $id)->where('addedBy', $userId)->update(['status' => false]);
        }
        else {
            Task::where('id', $id)->where('addedBy', $userId)->update(['status' => true]);
        }
        return redirect()->back();
    }
}
