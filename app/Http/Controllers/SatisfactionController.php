<?php

namespace App\Http\Controllers;

use App\Models\Enquete_Satisfaction;
use Illuminate\Http\Request;

class SatisfactionController extends Controller
{
    public function add(Request $request,$clientId)
    {
        $validatedData = $request->validate([
            'question1' => 'required|string',
            'question2' => 'required|string',
            'question3' => 'required|string',
            'question4' => 'required|string',
            'question5' => 'required|string',
        ]);
        
        $fields['client_id'] = $clientId;

        

        try {
            // Create a new suggestion with the validated data
            $enqueteSatisfaction = Enquete_Satisfaction::create($validatedData);
    
            // Return a success response with the newly created suggestion
            return response()->json(['message' => 'Suggestions déposé avec success','suggestion' => $enqueteSatisfaction], 201);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during creation
            return response()->json(['message' => 'Failed to create suggestion', 'error' => $e->getMessage()], 500);
        }
    }

   

}
