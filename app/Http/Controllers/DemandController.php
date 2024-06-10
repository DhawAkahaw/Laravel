<?php
namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class DemandController extends Controller
{

    



    public function add(Request $request, $clientId) {
        $fields = $request->validate([
            'Reference' => 'required|string',
            'Motif_demand' => 'required|string',
            'Message' => 'nullable|string',
        ]);

        $fields['Ticket'] = uniqid();
        $fields['Service'] = 'idk';
        $fields['State'] = 'In progress';
        $fields['created_@'] = new Date();
        $fields['client_id'] = $clientId;  // Add the client ID

        try {
            $demand = Demande::create($fields);
            return response()->json(['Migration' => $demand ,'message' => 'Demande déposé avec success'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create demand', 'error' => $e->getMessage()], 500);
        }
    }

   /*public function history($id) {
        $demands = Demande::where('client_id', $id)
            ->select(['Ticket', 'Service', 'Motif_demand', 'created_at', 'State' , 'client_id'])
            ->get();
        return response()->json([
            'status' => 200,
            'demands' => $demands
        ]);
    }*/

    public function history($id)
    {
        $demand = Demande::where('client_id', $id)->get();
        return response()->json([
            'status' => 200,
            'demand' => $demand
        ]);
    }

   
        
    public function login(Request $request) {
        
    
        $demand = Demande::where('code_Client', $request->code_Client)->first();
    
        if(!$client) {
            return response()->json([
                'message' => 'Informations incorrectes'
            ], 401);
        }
    
        // Assuming $name is a valid field in your Client model
        $clientinfo = $client;
    
        $token = $client->createToken('myapptoken')->plainTextToken;
    
        return response()->json([
            'status' => 200,
            'client' => $clientinfo, 
            'token' => $token,
            'message' => 'Connecté avec succès!',  
        ]);
    }


}
