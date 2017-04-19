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
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td></td>
                    <td>Nom du forum</td>
                    <td>Icone</td>
                    <td>Couleur</td>
                    <td>Sujets</td>
                    <td style="width: 175px">Action</td>
                </tr>
                </thead>
                <tbody>
                @foreach($channels as $channel)
                    <tr>
                        <td>{!! $channel->id !!}</td>
                        <td><a href="{{ action('Administration\ChannelsController@channel', $channel) }}">{!! $channel->title !!} </a></td>
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
        </div>
    </div>
@endsection

