<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Restaurant;
use  App\Models\Category;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('auth.register', compact("categories"));
        
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'restaurant_name' => ['required', 'string', 'max:255', 'unique:'.Restaurant::class],
            'p_iva' => ['required', 'numeric', 'digits:11', 'unique:'.Restaurant::class],
            'address' => ['required', 'string', 'max:255', 'unique:'.Restaurant::class],
            'picture' => ['nullable', 'image', 'mimes:jpg,png,jpeg'],
            'categories'=> ["nullable",'exists:categories,id']
          ], 
          [
            'name.required' => 'Nome e cognome dell\'utente sono obbligatori',
            'name.string' => 'Nome e cognome dell\'utente devono essere una stringa',
  
            'email.required' => 'La mail è obbligatoria',
            'email.string' => 'L\'indirizzo email deve essere una stringa',
            'email.unique' => 'L\'indirizzo email inserito risulta essere già registrato',

            'password.required' =>'La password è obbligatoria',
  
            'restaurant_name.required' => 'Il nome della tua attività è obbligatoria',
            'restaurant_name.string' => 'Il nome della tua attività deve essere una stringa',

            'p_iva.required' => 'La partita Iva è obbligatoria',
            'p_iva.numeric' => 'La partita Iva deve essere un numero di 11 cifre',
            'p_iva.unique' => 'La partita Iva inserita risulta essere già registrata',

            'address.required' => 'L\'indirizzo è obbligatorio',
            'address.string' => 'L\'indirizzo deve essere una stringa',
            'address.unique' => 'L\'indirizzo inserito risulta essere già registrato',
            
            'picture.image' => 'Il file caricato deve essere un\' immagine',
            'picture.mimes' => 'Le estensioni dei file accettate sono: jpg,png,jpeg.',
            
          ]);
        $data = $request->all();
        
        if(Arr::exists($data, 'picture' )) { //$data = array mentre 'picture' = chiave che stai cercando
          $path = Storage::put('uploads/restaurants', $data['picture']); //Metti in public/storage/uploads/restaurants l' immagine che riceviamo
          $data['picture'] = $path; //METODO 2, nella chiave 'picture' mettici il $path che hai appena salvato alla riga sopra
        }
        else $data['picture'] = null;
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $restaurant = Restaurant::create([
            'user_id' => $user->id,
            'p_iva' => $request->p_iva,
            'restaurant_name' => $request->restaurant_name,
            'address' => $request->address,
            'picture' => $data['picture'],
        ]);
        // $restaurant = new Restaurant();
        // $restaurant->fill($data);
        // $restaurant->save();
        if(Arr::exists($data, "categories")) $restaurant->categories()->attach($data["categories"]);
        
        
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}