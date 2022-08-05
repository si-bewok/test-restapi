<?php

namespace App\Http\Controllers;

use App\Models\Shopping;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Shopping::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $shopping = Shopping::create($request->all());

        $response = [
            'message' => 'Data successfully created.',
            'data' => [
                'created_at' => $shopping['created_at'],
                'id' => $shopping['id'],
                'name' => $shopping['name']
            ]
        ];
        
        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shopping $shopping)
    {
        return $shopping;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shopping $shopping)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $shopping->update($request->all());

        $response = [
            'message' => 'Data successfully updated.'
        ];
        
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shopping $shopping)
    {
        $shopping->delete();

        $response = [
            'message' => 'Data successfully deleted.'
        ];

        return response()->json($response, 200);
    }
}
