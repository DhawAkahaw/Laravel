<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

use App\Models\Facture;
use Illuminate\Support\Facades\Log;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($clientId)
    {
        $factures = Facture::where('client_id', $clientId)->get();
        return response()->json($factures);



    }



    public function updateResteAPayer(Request $request, $id)
    {
        try {
            $facture = Facture::findOrFail($id);
            $facture->update(['reste_a_payer' => '0']);

            return response()->json(['message' => 'Reste a payer updated successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error updating reste a payer: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    

    public function monf($id)
    {
        $facture = Facture::where('client_id', $id)->get();
        return response()->json([
            'status' => 200,
            'facture' => $facture
        ]);
    }
    public function add(Request $request, $clientId) {
        $fields = $request->validate([
            
            'montant_a_payer'=> 'required|string',
            'reste_a_payer'=> 'required|string',
            'prise_en_charge'=> 'required|string',
            
        ]);
    
        $echeance = Carbon::now()->addMonth()->format('Y-m-d');
        
        do {
            $numero_facture = mt_rand(100000, 999999);
        } while (Facture::where('numero_facture', $numero_facture)->exists());
    
        $facture = Facture::create([
            'client_id' => $clientId,
            'montant_a_payer' => $fields['montant_a_payer'],
            'numero_facture' => $numero_facture,
            'reste_a_payer' => $fields['reste_a_payer'],
            'prise_en_charge' => $fields['prise_en_charge'],
            'echeance' => $echeance,
        ]);
        try {
            // Generate PDF from the view
            $pdf = Pdf::loadView('facture', compact('facture'));
            $pdfPath = 'public/client_' . Str::random(10) . '.pdf';
            Storage::put($pdfPath, $pdf->output());
    
            // Update the path for saving in the database
            $facture->pdf_facture = Storage::url($pdfPath);
            $facture->save();
        } catch (\Exception $e) {
            Log::error('PDF generation or saving failed: ' . $e->getMessage());
            return response(['error' => 'Could not generate or save PDF'], 500);
        }
    
        $response = [
            'Facture' => $facture,
        ];
    
        return response($response, 201);
    }

    
    
 
public function addauto(Request $request, $clientId) {
    

    $echeance = Carbon::now()->addMonth()->format('Y-m-d');
    
    do {
        $numero_facture = mt_rand(100000, 999999);
    } while (Facture::where('numero_facture', $numero_facture)->exists());

    $facture = Facture::create([
        'client_id' => $clientId,
        'montant_a_payer' => '75.000',
        'numero_facture' => $numero_facture,
        'reste_a_payer' => '75.000',
        'prise_en_charge' => 'Non',
        'echeance' => $echeance,
    ]);
    try {
        // Generate PDF from the view
        $pdf = Pdf::loadView('facture', compact('facture'));
        $pdfPath = 'public/client_' . Str::random(10) . '.pdf';
        Storage::put($pdfPath, $pdf->output());

        // Update the path for saving in the database
        $facture->pdf_facture = Storage::url($pdfPath);
        $facture->save();
    } catch (\Exception $e) {
        Log::error('PDF generation or saving failed: ' . $e->getMessage());
        return response(['error' => 'Could not generate or save PDF'], 500);
    }

    $response = [
        'Facture' => $facture,
    ];

    return response($response, 201);
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