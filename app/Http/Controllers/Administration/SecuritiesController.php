<?php

namespace wolfteam\Http\Controllers\Administration;


use wolfteam\Http\Controllers\Controller;
use wolfteam\Models\LoginAttempt;

class SecuritiesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('securities.index');
    }

    public function user()
    {
        $loginAttemtps = LoginAttempt::paginate(20);
        $paginate = $this->view_paginate($loginAttemtps);

        return view('securities.user', compact('loginAttemtps', 'paginate'));
    }

    public function drop_user_connexion()
    {
        $loginAttemtps = LoginAttempt::truncate();
        return redirect()->back()->with('success', 'Votre journal de connexion a été vidé');
    }
}
