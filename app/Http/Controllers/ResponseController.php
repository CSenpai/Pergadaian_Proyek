<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          
    }        

    /**
     * Display the specified resource.
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($pegadaian_id)
    {
        // ambil data response yang bakal dimunculin, data yang diambil data response yang pegadaian_id nya sama kaya $pegadaian_id dari path dinamis {pegadaian_id}
        // kalau ada 
        $pegadaian = Response::where('pegadaian_id', $pegadaian_id)->first();
        $pegadaianId = $pegadaian_id;
        return view('response.response', compact('pegadaian', 'pegadaianId'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $pegadaian_id)
    {
        $request->validate([
            'type' => 'required',
            'location' => 'nullable',
        ]);
        Response::updateOrCreate(
            [
                'pegadaian_id' => $pegadaian_id,
            ],
            [
                'type' => $request->type,
                'location' => $request->location,
            ]
        );
        return redirect()->route('data')->with('responseSuccess', 'berhasil mengubah response');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Response $response)
    {
        //
    }
}
