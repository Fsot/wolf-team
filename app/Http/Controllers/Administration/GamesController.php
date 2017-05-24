<?php
/**
 * Created by PhpStorm.
 * User: antoinefissot
 * Date: 23/05/2017
 * Time: 11:08
 */

namespace wolfteam\Http\Controllers\Administration;


use wolfteam\Http\Controllers\Controller;

class GamesController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        return view('games.admin.index');
    }

}