<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggController extends Controller
{
    public function add(Request $request, $clientId) {
        $fields = $request->validate([
            'Sugg_context' => 'required|string',
            'Subject' => 'required|string',
            'Message' => 'required|string', 
        ]);

        $fields['Ticket'] = uniqid();  
        $fields['client_id'] = $clientId;
    
        try {
            $sug = suggestion::create($fields);
            return response()->json(['message' => 'Enquête de satisfaction déposé avec success','suggestion' => $sug], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create suggestion', 'error' => $e->getMessage()], 500);
        }

        
    }

    public function history($id)
    {
        $suggestion = Suggestion::where('client_id', $id)->get();
        return response()->json([
            'status' => 200,
            'suggestion' => $suggestion
        ]);
    }

   
        
    

}
