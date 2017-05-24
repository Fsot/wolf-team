<?php

namespace wolfteam\Http\Controllers\Administration;

use Illuminate\Http\Request;
use wolfteam\Http\Controllers\Controller;
use wolfteam\Http\Requests\BlackWordRequest;
use wolfteam\Http\Requests\DeletedBlackWordsRequest;
use wolfteam\Models\BlackWord;

class BlackWordsController extends Controller
{

    public function index()
    {
        $words = BlackWord::all();
        return view('blackwords.index', compact('words'));
    }

    public function store(BlackWordRequest $request)
    {
        $words = array_filter(explode(',', $request->words));
        $bw = BlackWord::all();
        foreach ($words as $word){
            $word = trim($word, " \t\n\r\0\x0B");
            if($bw->count() > 0){
                foreach($bw as $b){
                    if($b->word != $word){
                        $blackword = new BlackWord();
                        $blackword->word = $word;
                        $blackword->save();
                    }
                }
            }else{
                $blackword = new BlackWord();
                $blackword->word = $word;
                $blackword->save();
            }
        }

        return redirect()->back()->with('success', 'Votre liste de mots noir a été mise à jour.');
    }

    public function destroy(DeletedBlackWordsRequest $request)
    {
        $blackword = BlackWord::findOrFail($request->id);
        if($blackword){
            $d = $blackword->delete();
            if($d){
                return redirect()->back()->with('success', 'Ce mot a bien été autorisé sur votre forum.');
            }
        }
        return redirect()->back()->with('success', 'Erreur sur l\'enregistrementt des données.');
    }
}
