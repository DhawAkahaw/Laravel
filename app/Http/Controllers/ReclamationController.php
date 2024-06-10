<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Reclamation;

class ReclamationController extends Controller
{
    public function add(Request $request, $id)
    {
        $request->validate([
            'offre' => 'required|string',
            'Service' => 'required|string',
            'Category' => 'required|string',
            'Motif_rec' => 'required|string',
            'gsm' => '|string',
            'Message' => 'nullable|string',
            'Image' => 'nullable|max:2048',
        ]);

        $reclamation = new Reclamation();
        $reclamation->Ticket = uniqid();
        $reclamation->client_id = $id; // assuming you are using the user ID from the path parameter
        $reclamation->offre = $request->input('offre');
        $reclamation->Service = $request->input('Service');
        $reclamation->Category = $request->input('Category');
        $reclamation->Motif_rec = $request->input('Motif_rec');
        $reclamation->gsm = $request->input('gsm');
        $reclamation->Message = $request->input('Message');

        if ($request->hasFile('Image')) {
            $filePath = $request->file('Image')->store('public/reclamations');
            $reclamation->Image = Storage::url($filePath);
        }

        $reclamation->save();

        try {
            
            return response()->json(['message' => 'Reclamation déposé avec success'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create complain', 'error' => $e->getMessage()], 500);
        }
    }

    public function history($id)
    {
        $rec = Reclamation::where('client_id', $id)->get();
        return response()->json([
            'status' => 200,
            'reclamation' => $rec
        ]);
    }


}
