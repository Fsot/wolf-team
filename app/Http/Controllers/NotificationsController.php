<?php
/**
 * Created by PhpStorm.
 * User: antoinefissot
 * Date: 27/04/2017
 * Time: 15:47
 */

namespace wolfteam\Http\Controllers;

use Auth;
use Illuminate\Notifications\Notifiable;
use wolfteam\Models\User;

class NotificationsController extends Controller
{
    use Notifiable;

    public function __markread()
    {
        Auth::user()->unreadNotifications->markAsRead();
    }

    public function destroyNotification()
    {
        Auth::user()->notifications()->delete();
        return redirect()->back()->with('success', 'Vos notifications on été supprimées');
    }
}

