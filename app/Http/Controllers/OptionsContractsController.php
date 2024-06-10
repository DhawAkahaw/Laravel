<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Options_Contrat;
use Illuminate\Support\Facades\Log;

class OptionsContractsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    // OptionsContractsController.php
    public function add(Request $request) {
        $fields = $request->validate([
            'contrat_id'=> 'required|string',
            'designation'=> 'required|string',
            'prix'=> 'required|string',
        ]);

        $option = Options_Contrat::create([
            'contrat_id' => $fields['contrat_id'],
            'designation' => $fields['designation'],
            'prix' => $fields['prix'],
        ]);

        $response = [
            'options' => $option,
        ];

        return response($response, 201);
    }







    public function look()
    {
        $option = Options_Contrat::all(); // Fetch all options
        return response()->json([
            'status' => 200,
            'option' => $option
        ]);
    }

    public function updateResteAPayer(Request $request, $id)
    {
        try {
            $option = Options_Contrat::findOrFail($id);
            $option->update(['contrat_id' => $id]);

            return response()->json(['message' => 'you now got the option'], 200);
        } catch (\Exception $e) {
            Log::error('Error getting the: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    public function addp(Request $request) {
        $fields = $request->validate([
            'contrat_id'=> 'required|string',
            'designation'=> 'required|string',
            'prix'=> 'required|string',
        ]);
    
        $option = Options_Contrat::create([
            'contrat_id' => $fields['contrat_id'],
            'designation' => $fields['designation'],
            'prix' => $fields['prix'],
        ]);

    
        $response = [
            'options' => $option,
        ];
    
        return response($response, 201);
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}