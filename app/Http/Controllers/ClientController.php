<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;
 use Illuminate\Support\Facades\File;
use App\Models\Client;
use App\Models\Email;

class ClientController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }

    public function add(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
            'last_name' =>'required|string',
            'rue' =>'required|string',
            'gouvernorat' =>'required|string',
            'delegation' =>'required|string',
            'localite' =>'required|string',
            'ville' =>'required|string',
            'code_postal' =>'required|string',
            'tel' =>'required|string',
            'gsm' =>'required|string',
            'login' =>'required|string',
            'picture' =>'required|string',
            'code_Client' =>'required|string',
            'type_Client' =>'required|string',
        ]);

        $client = Client::create([
            'name' => $fields['name'],
            'last_name' => $fields['last_name'],
            'rue' => $fields['rue'],
            'gouvernorat' => $fields['gouvernorat'],
            'delegation' => $fields['delegation'],
            'localite' => $fields['localite'],
            'ville' => $fields['ville'],
            'code_postal' => $fields['code_postal'],
            'tel' => $fields['tel'],
            'gsm' => $fields['gsm'],
            'login' => $fields['login'],
            'picture' => $fields['picture'],
            'code_Client' => $fields['code_Client'],
            'type_Client' => $fields['type_Client'],
            'password' => bcrypt($fields['password'])
        ]);

        $mail = Email::create([
        'mail'=>$client->login,
        'mail_rec'=>' ',
        'client_id'=>$client->_id,
        'State'=>' test'
        ]);

        $token = $client->createToken('myapptoken')->plainTextToken;

        $response = [
            'Client' => $client,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout()
    {
        //Pour effacer l'entrée de cache de token associée au compte qui s'est déconnecté
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Vous avez été déconnecté avec succès'
        ]);
    }
 


    
    public function login(Request $request)
    {

        //validation des requêtes
        $validator = Validator::make($request->all(), [
            'mail' => 'required',
            'password' => 'required' 

        ]);

        //Si la validation échoue, une réponse d'erreur sera renvoyée
        if ($validator->fails()) {

            return response()->json([
                'validation_errors' => $validator->messages(),
            ]);
        } else {
            //vérification des données saisies


            
            $client = Email::where('mail', $request->mail)->first();

            if (!$client) {
                return response()->json([
                    'message' => 'Informations incorrectes'
                ], 401);
            }
            
            $code = Client::where('_id', $client->client_id)->first();
            $pass = $code->password;
            if(!$client || ($request->password !== $pass)) {
                return response()->json([
                    'message' => 'Informations incorrectes'

                ], 401);
            }
            else {
                $clientinfo = $code;
    
                $token = $code->createToken('myapptoken')->plainTextToken;
            
                return response()->json([
                    'status' => 200,
                    'client' => $clientinfo, 
                    'token' => $token,
                    'message' => 'Connecté avec succès!',  
                ]);
            }
    }
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
        $client = Client::findOrFail($id); // Find the client by ID
        
        // Update the client's information
        $data = $request->except('picture'); // Exclude picture from the data
        
        if ($request->hasFile('picture')) {
            $path = $client->picture;
            if (File::exists($path)) {

                File::delete($path);
            }
            $file = $request->file('picture');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('img/client/', $filename);
            $client->picture = 'img/client/' . $filename;
        }

        
        $client->update($data);
        
        return response()->json(['message' => 'Mise à jour du profil réussie'], 200);
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

      //Pour obtenir l'utilisateur actuellement connecté
      public function getCurrentUser()
      {
          $id = auth()->user()->_id;
          $currentuser = Client::find($id);
          if ($currentuser) {
              return response()->json([
                  'status' => 200,
                  'currentuser' => $currentuser
              ]);
          } else {
              return response()->json([
                  'status' => 404,
                  'message' => 'Aucun utilisateur trouvé'
              ]);
          }
      }


      public function forgotpassword(Request $request)
      {
          // Validation des requêtes
          $validator = Validator::make($request->all(), [
              'login' => 'required|email'
          ]);
      
          // Si la validation échoue, une réponse d'erreur sera renvoyée
          if ($validator->fails()) {
              return response()->json([
                  'validation_errors' => $validator->messages()
              ]);
          }
      
          // Vérification de l'utilisateur
          $client = Client::where('login', $request->login)->first();
          if (!$client) {
              \Log::error('User not found for login: ' . $request->login);
              return response()->json([
                  'status' => 401,
                  'message' => 'Aucun utilisateur trouvé'
              ]);
          }
      
          // Envoi d'un lien de vérification par login
          $status = Password::broker('client')->sendResetLink($request->only('login'));
      
          if ($status == Password::RESET_LINK_SENT) {
              return response()->json([
                  'status' => 200,
                  'message' => 'Lien de récupération de mot de passe envoyé avec succès',
              ]);
          } else {
              // Log the status for debugging
              \Log::error('Password reset email failed to send', ['status' => $status, 'email' => $request->login]);
      
              // Si login n'a pas été envoyé, une réponse d'erreur sera renvoyée
              return response()->json([
                  'status' => 404,
                  'message' => "E-mail n'a pas été envoyé"
                   
              ]);
          }
      }
      
      
      
 

    public function resetforgottenpassword(Request $request)
    {
        //validation des requêtes
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'password' => 'required',
        ]);

        //Si la validation échoue, une réponse d'erreur sera renvoyée
        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->messages()
            ]);
        } else {
            $status = Password::broker('client')->reset(
                $request->only('password', 'password_confirmation', 'token'),
                function ($user) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($request->password),
                        'remember_token' => Str::random(60),
                    ])->save();

                    $user->tokens()->delete();
                    event(new PasswordReset($user));
                }
            );
            if ($status == Password::PASSWORD_RESET) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Votre mot de passe à été réinitialisé avec succès'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "Mot de passe n'a pas été réinitialisé"
                ]);
            }
        }
    }

  
}