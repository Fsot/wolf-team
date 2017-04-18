<?php
/**
 * Created by PhpStorm.
 * User: antoinefissot
 * Date: 12/04/2017
 * Time: 09:17
 */

namespace wolfteam\Http\Controllers\Administration;


use wolfteam\Http\Controllers\Controller;
use wolfteam\Http\Requests\UpdateChannelRequest;
use wolfteam\Models\Channel;
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
        $channels = Channel::all();
        $settings = Setting::where('name', 'like', 'forum%')->get();
        return view('channels.index', compact('channels', 'settings'));
    }

    public function create()
    {
        $channel = new Channel();
        $color = $this->color;
        $icon = $this->icon;
        return view('channels.create', compact('channel','color','icon'));
    }

    public function store(UpdateChannelRequest $request)
    {
        isset($request->block) ? $request->block = true : $request->block = false ;

        $channel = $this->created([
            'title' => $request->title,
            'slug'  => $request->slug,
            'color'  => $request->color,
            'icon'  => 'test',
            'block' => $request->block
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
                return view('channels.edit', compact('channel','icon','color'));
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
                    'block' => $request->block
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

    protected function created($data)
    {
        return Channel::create($data);
    }
}