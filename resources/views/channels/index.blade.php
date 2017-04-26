@extends('layouts.admin')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>
                Liste des forums
            </h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <a href="{!! action('Administration\ChannelsController@create') !!}" class="btn btn-info">Ajouter un forum</a>
                @if($settings->where('name','forum_on')->first()->value == 0)
                    <a href="{!! action('Administration\ChannelsController@activate_forum') !!}" class="btn btn-success"><i class="glyphicon glyphicon-off"></i></a></h2>
                @else
                    <a href="{!! action('Administration\ChannelsController@desactivate_forum') !!}" class="btn btn-danger"><i class="glyphicon glyphicon-off"></i></a></h2>
                @endif
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-8">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Tous mes forums</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @foreach($channels as $k => $c)
                        <h3>{!! $k !!}</h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td></td>
                                <td>Nom du forum</td>
                                <td>Catégorie</td>
                                <td>Icone</td>
                                <td>Couleur</td>
                                <td>Sujets</td>
                                <td style="width: 175px">Action</td>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($c as $channel)
                                    <tr>
                                        <td>{!! $channel->id !!}</td>
                                        <td><a href="{{ action('Administration\ChannelsController@channel', $channel) }}">{!! $channel->title !!} </a></td>
                                        <td>{!! $channel->categorie->title !!}</td>
                                        <td>{!! $channel->icon !!} </td>
                                        <td>{!! $channel->color !!} </td>
                                        <td style="text-align: center">{!! $channel->threads->count() !!} </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ action('Administration\ChannelsController@channel', $channel->id) }}" class="btn btn-xs btn-success">Voir</a>
                                                <a href="{{ action('Administration\ChannelsController@edit', $channel->id) }}" class="btn btn-xs btn-info">Editer</a>
                                                <a href="" class="btn btn-xs btn-danger">Supprimer</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h4>Catégorie de forum</h4>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>Ajouter une catégorie de forum</p>
                    {!! Form::open(['url' => action('Administration\ChannelsController@store_categorie'), 'method' => 'post']) !!}
                    <div class="form-group">
                        {!! Form::text('title', null, ['class' => 'input-lg form-control']) !!}
                    </div>
                    {!! Form::submit('Enregistrer la catégorie', ['class' => 'btn btn-info']) !!}
                    {!! Form::close() !!}
                    <hr>
                    <h4>Toutes mes catégories</h4>
                    @foreach($categories as $category)
                        <span class="label label-default">{!! $category->title !!}</span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="x_panel">
                <div class="x_title">
                    <h4>Messages signalés</h4>
                </div>
                <div class="x_content">
                    <ul class="list-unstyled">
                        @foreach($msg_adv as $m)
                            <li>
                                <p>Message de : <strong>{!! $m->user->name !!}</strong>, <em><small>{!! $m->created_at !!}</small></em></p>
                                <p><strong>{!! \Illuminate\Support\Str::limit($m->text,100) !!}</strong></p>
                                <div class="btn-group btn-group-xs">
                                    <a href="#" class="btn btn-info" id="msg-{!! $m->id !!}" data-url="{!! action('Administration\MessagesController@__get_message', $m->id) !!}" data-msg="{!! $m->id !!}" onclick="get_message(this, event)" data-toggle="modal" data-target=".bs-example-modal-lg">Voir le message en entier</a> <!-- TODO A faire -->
                                    <a href="{!! action('Administration\MessagesController@do_nothing', $m) !!}" class="btn btn-success">Ne rien faire</a>
                                    <a href="{!! action('Administration\MessagesController@do_moderate', $m) !!}" class="btn btn-warning">Modérer</a>
                                    <a href="" class="btn btn-danger">Supprimer</a> <!-- TODO A faire -->
                                </div>
                                <hr>
                            </li>
                        @endforeach
                    </ul>
                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="modalTitle"></h4>
                                </div>
                                <div class="modal-body" id="modalContent"></div>
                                <div class="modal-footer">
                                    <div class="btn-group">
                                        <a href="" id="doNothig" type="button" class="btn btn-success">Ne rien faire</a>
                                        <a href="" id="doModerate" type="button" class="btn btn-warning">Moderer</a>
                                        <a type="button" class="btn btn-danger">Supprimer</a>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function get_message(elem){
            (function ($) {
                var msg = elem.getAttribute('data-msg'), url = elem.getAttribute('data-url');
                var object = $('#'+elem.id);
                var do_nothing = object[0].parentElement.children[1].getAttribute('href');
                var do_moderate = object[0].parentElement.children[2].getAttribute('href');

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType:'html',
                    success : function(response){ // code_html contient le HTML renvoyé
                        var modalTitle = $('#modalTitle'),modalContent = $('#modalContent'), doNothing = $('#doNothig'), doModerate = $('#doModerate');
                        var data = jQuery.parseJSON(response);
                        modalTitle.text(data.user.name + ', '+data.msg.created_at);
                        modalContent.html(data.msg.text);
                        doNothing.attr('href', do_nothing);
                        doModerate.attr('href', do_moderate);
                    }
                });
            })(jQuery)
        }
    </script>
@endsection

