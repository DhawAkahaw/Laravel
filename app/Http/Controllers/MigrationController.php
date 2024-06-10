<?php
namespace App\Http\Controllers;

use App\Models\Demande_Migration;
use Illuminate\Http\Request;

class MigrationController extends Controller
{
    public function add(Request $request, $clientId) {
        $fields = $request->validate([
            'Contract'=>'required|string',
            'current_offre' => 'required|string',
            'desired_offre' => 'required|string',
        ]);

        $fields['Ticket'] = uniqid();  
        $fields['gsm'] = $fields['Contract'];
        $fields['remarque'] = '  . ';
        $fields['State'] = 'In progress';  
        $fields['client_id'] = $clientId;

        try {
            // Create a new migration with the validated data
            $migration = Demande_Migration::create($fields);
        
            // Return a success response with the newly created migration
            return response()->json(['Migration' => $migration ,'message' => 'Migration déposé avec success'], 201);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during creation
            return response()->json(['message' => 'Failed to create Migration', 'error' => $e->getMessage()], 500);
        }
    }

    public function history($id)
    {
        $migration = Demande_Migration::where('client_id', $id)->get();
        return response()->json([
            'status' => 200,
            'migration' => $migration
        ]);
    }

   
        
    
}
