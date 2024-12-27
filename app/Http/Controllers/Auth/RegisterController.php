<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('adm');
//    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    /**
     * Creador de usuarios por parte del administrador
     */
    protected function nuevo(Request $request)
    {
        $Ingreso = new User();
        $Ingreso->name = $request['name'];
        $Ingreso->email = $request['email'];
        $Ingreso->rol = $request['rol'];
        $Ingreso->password = Hash::make($request['password']);
        $Ingreso->save();
        return redirect()->route('lsus')->with('mensajeOk',$Ingreso->name.' Se cargó correctamente.');
    }

    protected function mus(Request $request, User $u)
    {
        $Mus = User::find($u->id);
        $Mus->password = Hash::make($request['password']);
        $Mus->save();
        return redirect()->route('lsus')->with('mensajeOk',$Mus->name.' Ha cambiado la clave.');        
    }
}
