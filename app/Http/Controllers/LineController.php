<?php

namespace App\Http\Controllers;

use App\Models\Demande_Transfert_Ligne;
use Illuminate\Http\Request;

class LineController extends Controller
{
    public function add(Request $request, $clientId) {
        $fields = $request->validate([
            'adsl_num' => 'required|string',
            'new_num_tel' => 'required|string',
            'state_line_prop' => 'nullable|boolean',
            'nic' => 'nullable|string',
            'rue'=>'nullable|string',
            'gouvernorat' => 'nullable|string',
            'delegation' => 'nullable|string',
            
            'ville' => 'nullable|string',
            'code_postal' => 'nullable|string',
            'tel'=> 'required|string',
            'NOM'=>'nullable|string',
            'CIN'=>'nullable|string',
        ]);
        

        $fields['Ticket'] = uniqid();  
        $fields['prev_num'] = $fields['tel'];
       
        $fields['State'] = 'In progress';  
        $fields['Remarque'] = 'azeaze';
        $fields['client_id'] = $clientId;

        try {
            // Create a new demande transfert ligne with the validated data
            $demandeTransfertLigne = Demande_Transfert_Ligne::create($fields);
        
            // Return a success response with the newly created demande transfert ligne
            return response()->json(['Line' => $demandeTransfertLigne ,'message' => 'Demande de transfert de ligne déposé avec success'], 201);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during creation
            return response()->json(['message' => 'Failed to create DemandeTransfertLigne', 'error' => $e->getMessage()], 500);
        }
    }

    public function history($id)
    {
        $line = Demande_Transfert_Ligne::where('client_id', $id)->get();
        return response()->json([
            'status' => 200,
            'line' => $line
        ]);
    }

   
        
   

}
