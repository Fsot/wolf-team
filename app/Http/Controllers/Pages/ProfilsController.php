<?php

namespace wolfteam\Http\Controllers\Pages;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use wolfteam\Http\Controllers\Controller;
use wolfteam\Http\Requests\UpdateProfilRequest;
use wolfteam\Models\Profil;
use wolfteam\Models\User;

class ProfilsController extends Controller
{

    protected $data;
    protected $wording = [
        'error' => [
            'edit_noAccessProfil' => "Vous n'avez pas accés à ce profil !",
            'edit_profil_unauthorized' => "Avez vous le droit d'effectuer cette action ? ",
            'profil_dont_exist' => "Ce profil ne semble pas existé. "
        ],
        'success' => [
            'profil_updated' => 'Votre profil a bien été mis à jour.'
        ],
        'title' => [
            'index' => 'Bonjour',
            'edit' => ' vous pouvez désormais éditer votre profil !',
        ]
    ];
    protected $class = [
        'title_name' => 'text-info'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth')->except('index');
    }

    public function index($username)
    {
        $user = User::where('name', $username)->first();

        if(isset($user->profil)){
            $this->data  = [
                'user'      => $user,
                'profil'    => $user->profil,
                'wording'   => [
                    'title'     => "Profil de <span class='".$this->class['title_name']."'>" .$user->name. "</span>"
                ]
            ];

            if (Auth::check()){
                $this->data['wording'] =  [
                    'title'     => $this->wording['title']['index'] . " <span class='".$this->class['title_name']."'>" .$user->name. "</span>"
                ];

                $this->data['button'] = [
                    0 => $this->generate_button(action('Pages\ProfilsController@edit', $user->name),'btn btn-info','Editer mon profil','ion ion-person'),
                    1 => $this->generate_button(null,'btn btn-default','Administration du site','ion ion-gear-b'),
                ];
            }
            return view('profils.index', ['data' => $this->data]);
        }
        else{
            return redirect('/')->with('error', $this->wording['error']['profil_dont_exist']);
        }

    }

    public function edit($name){

        $user = User::where('name', $name)->first();

        if ($user->id != Auth::id()){ return abort(404); }

        if($user){
            $this->data['profil'] = $user->profil;

            if($this->data['profil']->user_id == Auth::id()){

                $this->data['user'] = $user;
                $this->data['wording'] = [
                    'title'     => "<span class='".$this->class['title_name']."'>" .$user->name. "</span>" . $this->wording['title']['edit']
                ];

                return view('profils.edit', ['data' => $this->data ]);

            }else{

                return redirect()->back()->with('error', $this->wording['error']['edit_noAccessProfil']);

            }
        }else{
            return abort(404);
        }

    }

    public function update(UpdateProfilRequest $request, $profil_id)
    {
        $profil = Profil::where('id',$profil_id)->first();
        if($profil){
            if($profil->user_id == Auth::id()){


                $profil->firstname = $request->firstname;
                $profil->lastname = $request->lastname;
                $profil->birthday = $request->birthday;
                $profil->avatar   = $request->avatar;

                $profil->save();

                return redirect()->action('Pages\ProfilsController@index', Auth::user()->name)->with('success', $this->wording['success']['profil_updated']);
            }
        }else{
            return redirect()->back()->with('error', $this->wording['error']['edit_profil_unauthorized']);
        }
    }

    protected function generate_button($link, $class, $text, $icon)
    {
        return [
                'link'  => $link,
                'class' => $class,
                'text'  => $text,
                'icon'  => $icon
        ];
    }
}
