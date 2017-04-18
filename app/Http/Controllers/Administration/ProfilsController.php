<?php
/**
 * Created by PhpStorm.
 * User: antoinefissot
 * Date: 03/04/2017
 * Time: 09:04
 */

namespace wolfteam\Http\Controllers\Administration;


use wolfteam\Http\Controllers\Controller;

class ProfilsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

    }
}