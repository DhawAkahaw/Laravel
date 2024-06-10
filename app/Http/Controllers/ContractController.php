<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Contrat;

class ContractController extends Controller
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

    public function add(Request $request) {
        $fields = $request->validate([
            'client_id'=> 'required|string',
            'reference_contrat'=> 'required|string',
            'designation'=> 'required|string',
            'date_de_debut'=> 'required|string',
            'etat'=> 'required|string',
        ]);
    
        $contrat = Contrat::create([
            'client_id' => $fields['client_id'],
            'reference_contrat' => $fields['reference_contrat'],
            'designation' => $fields['designation'],
            'date_de_debut' => $fields['date_de_debut'],
            'etat' => $fields['etat'],
        ]);
    
        $response = [
            'contrat' => $contrat,
        ];
    
        return response($response, 201);
    }

    public function monc($id)
    {
        $contract = Contrat::where('client_id', $id)->get();
        return response()->json([
            'status' => 200,
            'contract' => $contract
        ]);
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