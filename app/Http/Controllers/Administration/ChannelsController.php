<?php
/**
 * Created by PhpStorm.
 * User: antoinefissot
 * Date: 12/04/2017
 * Time: 09:17
 */

namespace wolfteam\Http\Controllers\Administration;


use wolfteam\Http\Controllers\Controller;
use wolfteam\Http\Requests\UpdateCategorieRequest;
use wolfteam\Http\Requests\UpdateChannelRequest;
use wolfteam\Models\Categorie;
use wolfteam\Models\Channel;
use wolfteam\Models\Message;
use wolfteam\Models\Setting;
use wolfteam\Models\Thread;

class ChannelsController extends Controller
{

    protected $color =  [
        'white' => 'Blanc',
        'blue' => 'Bleu',
        'black' => 'Noir',
        'red' => 'Rouge',
        'green' => 'Vert',
        'yellow' => 'Jaune',
        'orange' => 'Orange',
    ];
    protected $icon = [
        'classique' => 'Classique',
        'important' => 'Important',
        'fixed' => 'Fixer',
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $channels = [];
        $c = Channel::all();
        $categories = Categorie::where('type', 'forum')->get();
        foreach ($categories as $category) {
            $channels[$category->title] = $c->where('categorie_id', $category->id);
        }
        $settings = Setting::where('name', 'like', 'forum%')->get();
        $msg_adv = Message::where('alert', 1)->get();
        $total_subject = Thread::count();
        $total_msg = Message::count();
        $total_moderate = Message::where('moderate', 1)->count();
        $total_destroy = Message::where('destroy', 1)->count();
        return view('channels.index', compact('channels', 'settings', 'categories', 'msg_adv', 'total_destroy', 'total_moderate', 'total_msg', 'total_subject'));
    }

    public function create()
    {
        $channel = new Channel();
        $color = $this->color;
        $icon = $this->icon;
        $categories = Categorie::where('type', 'forum')->pluck('title', 'id');
        return view('channels.create', compact('channel','color','icon', 'categories'));
    }

    public function store(UpdateChannelRequest $request)
    {
        isset($request->block) ? $request->block = true : $request->block = false ;

        $channel = $this->created([
            'title' => $request->title,
            'slug'  => $request->slug,
            'color'  => $request->color,
            'icon'  => 'test', // TODO a modif
            'block' => $request->block,
            'categorie_id' => $request->categorie
        ]);

        if($channel){
            return redirect()->action('Administration\ChannelsController@index')->with('success', 'Le sujet a bien été créé');
        }
    }

    public function edit($data)
    {
        if($data){
            $channel = Channel::findOrFail($data);
            if($channel) {
                $color = $this->color;
                $icon= $this->icon;
                $categories = Categorie::where('type', 'forum')->pluck('title', 'id');
                return view('channels.edit', compact('channel','icon','color', 'categories'));
            }
        }
    }

    public function update(UpdateChannelRequest $request, $id)
    {
        if($id)
        {
            $channel = Channel::findOrFail($id);
            if($channel){
                isset($request->block) ? $request->block = true : $request->block = false ;
                $update = $channel->update([
                    'title' => $request->title,
                    'color' => $request->color,
                    'icon' => $request->icon,
                    'block' => $request->block,
                    'categorie_id' => $request->categorie
                ]);
                if($update == true){
                    return redirect()->action('Administration\ChannelsController@index')->with('success', 'Le sujet a bien été modifié');
                }
            }
        }
        return redirect()->action('Administration\ChannelsController@index')->with('error', 'Le sujet n\'a pas été modifié');
    }

    public function channel($channel){
        if($channel){
            $channel = Channel::findOrFail($channel);
            if($channel){
                $threads = Thread::where('channel_id', $channel->id)->get();
                foreach ($threads as $thread){
                    foreach ($thread->messages as $msg){
                        if($thread->answer_id == $msg->id){
                            if($msg->destroy == 1){
                                $thread->destroy = 1;
                            }
                        }
                    }
                }
                if(isset($threads)){
                    return view('channels.channel', compact('threads', 'channel'));
                }
            }
        }
    }

    public function activate_forum()
    {
        $setting = Setting::where('name','forum_on')->first();
        if($setting){
            $setting->value = 1 ;
            $setting->save();
        }else{
            Setting::create([
                'name' => 'forum_on',
                'value' => 1
            ]);
        }
        return redirect()->back()->with('success', 'Le forum a été activé.');
    }

    public function desactivate_forum()
    {
        $setting = Setting::where('name','forum_on')->first();
        if($setting){
            $setting->value = 0 ;
            $setting->save();
        }else{
            Setting::create([
                'name' => 'forum_on',
                'value' => 0
            ]);
        }
        return redirect()->back()->with('success', 'Le forum a été désactivé.');
    }

    public function store_categorie(UpdateCategorieRequest $request)
    {
        $persist_categorie = Categorie::create([
           'title' => $request->title,
            'slug' => $request->slug,
            'type' => 'forum'
        ]);

        if($persist_categorie == true){
            return redirect()->back()->with('success', 'La catégorie a bien été sauvegardée');
        }
    }

    public function destroy_channel($channel)
    {
        if($channel){
            if(is_numeric($channel)){
                $delete = Channel::where('id', $channel)->delete();
                if($delete){
                    return redirect()->back()->with('success', 'Votre channel a bien été supprimé.');
                }
            }
        }
        return redirect()->back()->with('error', 'Erreur sur la suppression de votre channel.');
    }

    public function destroy_category($category_id)
    {
        if($category_id){
            if(is_numeric($category_id)){
                $category = Categorie::findOrFail($category_id);
                if($category){
                    Channel::where('categorie_id', $category->id)->delete();
                    $d = $category->delete();
                    if($d){
                        return redirect()->back()->with('success', 'Votre catégorie a bien été suprimée.');
                    }
                }
            }
        }
        return redirect()->back()->with('error', 'Erreur sur la supréssion de la catégorie.');
    }

    protected function created($data)
    {
        return Channel::create($data);
    }
}