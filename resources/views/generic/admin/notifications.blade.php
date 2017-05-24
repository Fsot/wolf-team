
@if(Auth::user()->notifications->count() > 0)
    <li role="presentation" class="dropdown">
        <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" onclick="markRead()">
            <i class="fa fa-bell"></i>
            @if(Auth::user()->unreadNotifications->count() > 0) <span class="badge bg-green">{!! Auth::user()->unreadNotifications->count() !!}</span>@endif
        </a>
        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
            @if(Auth::user()->notifications->count() > 0)
                <li>
                    <a href="{!! action('NotificationsController@destroyNotification') !!}" class="btn btn-xs btn-default">Supprimer toutes les notifications</a>
                </li>
            @endif
            @foreach(Auth::user()->notifications as $notification)
                @if($notification->type == 'wolfteam\Notifications\AlertedMessageAdmin')
                    <li @if(empty($notification->read_at)) style="background-color: #e3e8ef" @endif>
                                        <span>
                                            <span>Un message a été signalé</span>
                                            <span class="time">{!! $notification->created_at->diffForHumans() !!}</span>
                                        </span>
                        <hr>
                        <span class="message">
                                            <a href="{!! action('Administration\ChannelsController@index') !!}" class="btn btn-xs btn-default">Moderer le message</a>
                                        </span>
                    </li>
                @endif
                @if($notification->type == 'wolfteam\Notifications\ModeratedForumMessage')
                    <li @if(empty($notification->read_at)) style="background-color: #e3e8ef" @endif>
                                        <span>
                                            <span>Modération de votre message</span>
                                            <span class="time">{!! $notification->created_at->diffForHumans() !!}</span>
                                        </span>
                        <hr>
                        <span class="message">
                                            <strong>Raison de la modération : </strong>
                                            <p>{!! $notification->data['doModerate'] !!}</p>
                                        </span>
                        <a href="{!! action('Pages\ForumsController@thread', $notification->data['thread']) !!}" class="text-info"><em>Voir le message</em></a>
                    </li>
                @endif
            @endforeach
        </ul>
    </li>
@endif
