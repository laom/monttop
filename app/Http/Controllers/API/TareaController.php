<?php

namespace App\Http\Controllers\API;

use App\Tarea;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tareas = Tarea::where('user_id',auth()->id())->orderBy('created_at', 'desc')->get();
        $tareas = Tarea::where('user_id',auth()->id())->get();
        $data = response()->json($tareas);
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tarea = new Tarea();
        $tarea->description = $request->description;
        $tarea->user_id = auth()->id();
        $tarea->save();

        return $tarea;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $tarea = Tarea::find($id);
        $tarea->description = $request->description;
        $tarea->save();
        
        return $tarea;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarea = Tarea::find($id);
        $tarea->delete();
    }
}
