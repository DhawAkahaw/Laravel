<?php

namespace App\Http\Controllers;

use MongoDB\BSON\ObjectId;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Produit;
use App\Models\Contrat;
use App\Models\Client;


class ProduitController extends Controller
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

    public function add($id)
    {
        try {
            $objectId = new ObjectId($id);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Invalid ID format'], 400);
        }

        $client = Client::where('_id', $objectId)->first();

        if (!$client) {
            return response()->json(['status' => 'error', 'message' => 'Client with ID ' . $id . ' not found'], 404);
        }

        $contrats = Contrat::where('client_id', $id)->get();

        foreach ($contrats as $contrat) {
            $nom_commercial = $contrat->id;
            
            
            $existingProduit = Produit::where('reference_contrat', $nom_commercial)->first();
        
            if (!$existingProduit) {

                $maxRefProduitContrat = Produit::max('ref_produit_contrat');
                $uniqueRefProduitContrat = $maxRefProduitContrat ? $maxRefProduitContrat + 1 : 1;
                $etat = $contrat->etat == '1' ? 'En cours' : 'your_default_etat_value';
                $produit = new Produit([
                    'reference_contrat' => $contrat->id,
                    'ref_produit_contrat' => $uniqueRefProduitContrat,
                    'reference' => $client->tel,
                    'nom_commercial' => $contrat->designation,
                    'etat' => $etat,
                    'etat_service' => '',
                ]);
        
                $produit->save();
            }
        }
        

        return response()->json([
            'status' => 200,
            'xd'=> 'mena ',
            'message' => 'Produits created successfully',
        ]);
    }



    public function look()
    {
        $produit = Produit::all();
        return response()->json([
            'status' => 200,
            'produit' => $produit
        ]);
    }





    
    public function monc($id)
    {
        $contract = Contrat::where('client_id', $id)->get();
        return response()->json([
            'status' => 2002,
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

