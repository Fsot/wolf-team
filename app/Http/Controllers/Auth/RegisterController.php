<?php

namespace wolfteam\Http\Controllers\Auth;

use wolfteam\Models\Profil;
use wolfteam\Notifications\RegisteredUser;
use wolfteam\Models\User;
use wolfteam\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    protected $wording = [
        'if_registered'         => 'Votre compte a bien été créé !',
        'confirmation_success'  => 'Votre compte a bien été activé !',
        'confirmation_fail'     => "Ce lien n'est pas valide !",
    ];

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
    protected $redirectTo = '/profil';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $user->notify(new RegisteredUser());

        return redirect('/login')->with('success', $this->wording['if_registered']);
    }

    public function confirm(Request $request, $id, $token)
    {
        $user = User::whereRaw('id = '.$id)->where('confirmation_token', $token)->first();
        if ($user){
            $user->update([
                'confirmation_token' => null,
            ]);
            $this->createProfil(['id' => $user->id]);
            $this->guard()->login($user);
            return $this->registered($request, $user)
                ?: redirect($this->redirectPath())->with('success', $this->wording['confirmation_success']);;
        }
        else{
            return redirect('/login')->with('error', $this->wording['confirmation_fail']);
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirmation_token' => str_replace('/', '', bcrypt(str_random(16))),
        ]);
    }

    protected function createProfil(array $data)
    {
        return Profil::create([
            'user_id' => $data['id']
        ]);
    }
}
