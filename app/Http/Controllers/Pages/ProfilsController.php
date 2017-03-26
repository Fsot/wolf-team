<?php

namespace wolfteam\Http\Controllers\Pages;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use wolfteam\Http\Controllers\Controller;
use wolfteam\Models\User;

class ProfilsController extends Controller
{

    protected $data;
    protected $wording = [
        'error' => [
            'edit_noAccessProfil' => 'Vous ne pouvez pas accèder à ce profil'
        ],
        'title' => [
            'index' => 'Bonjour ',
            'edit' => ' vous pouvez éditer votre profil ...',
        ]
    ];
    protected $class = [
        'title_name' => 'text-info'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $this->data  = [
            'user'      => $user,
            'profil'    => $user->profil,
            'wording'   => [
                'title'     => $this->wording['title']['index'] . "<span class='".$this->class['title_name']."'>" .$user->name. "</span>"
            ],
            'button'    => [
                0 => $this->generate_button(action('Pages\ProfilsController@edit', $user->name),'btn btn-info','Editer mon profil','ion ion-person'),
                1 => $this->generate_button(null,'btn btn-default','Administration du site','ion ion-gear-b'),
            ]
        ];

        return view('profils.index', ['data' => $this->data]);
    }

    public function edit($name){
        $user = User::where('name', $name)->first();
        if($user){
            $this->data['profil'] = $user->profil;
            if($this->data['profil']->user_id == Auth::id()){

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
