<?php

namespace App\Http\Controllers;

use App\Mail\ResetMail;
use App\Models\Email;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function add(Request $request, $clientId) {
        $fields = $request->validate([
            'mail' => 'required|string',
            'domaine' => 'required|string',
            'mail_rec' => 'nullable|string',
            
        ]);
        
        $fields['State'] = 'Actif';  
        $fields['client_id'] = $clientId;

        try {
            $mail = Email::create($fields);
            return response()->json(['mail' => $mail ,'message' => 'Migration déposé avec success'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create DemandeTransfertLigne', 'error' => $e->getMessage()], 500);
        }
    }

    public function maillist($id)
    {
        $mail = Email::where('client_id', $id)->get();
        return response()->json([
            'status' => 200,
            'mail' => $mail
        ]);
    }

  
    

}
