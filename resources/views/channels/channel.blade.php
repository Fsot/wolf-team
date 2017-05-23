@extends('layouts.admin')

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>Liste des sujets dans le forum <strong>{!!  $channel->title !!}</strong> </h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <a href="{!! action('Administration\ChannelsController@index') !!}" class="btn btn-default">Retour</a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Tous les sujets</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
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
                            <td>Nom du sujet</td>
                            <td class="text-center">Messages</td>
                            <td>Dernier message</td>
                            <td style="width: 135px">Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($threads as $thread)
                            <tr>
                                <td>
                                    {!! $thread->id !!}
                                    @if($thread->destroy == 1) <button type="button" class="btn btn-success btn-xs" onclick="event.preventDefault(); document.getElementById('unlock-{!! $thread->id !!}').submit();"><i class="fa fa-unlock-alt"></i></button>
                                        {!! Form::open(['url' => action('Administration\MessagesController@unlockMessages', $thread->messages->where('id',$thread->answer_id)->first()->id), 'method' => 'put', 'id' => 'unlock-'.$thread->id]) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </td>
                                <td>
                                    <a href="{!! action('Administration\ThreadsController@thread', $thread) !!}">{!! $thread->title !!}</a>
                                    @if($thread->destroy == 1)
                                        <span class="label label-danger">Ce message est bloqué</span>
                                    @endif
                                </td>
                                <td class="text-center">{!! $thread->messages->whereNotIn('id', $thread->answer_id)->count() !!}</td>
                                <td>
                                    @if($thread->messages->last()->id != $thread->answer_id)
                                        De <strong>{!! $thread->messages->last()->user->name !!}</strong>,
                                        De <strong>{!! $thread->messages->last()->user->name !!}</strong>,
                                        <i><small>{!! $thread->messages->last()->created_at !!}</small></i>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{!! action('Administration\ThreadsController@thread', $thread) !!}" class="btn btn-xs btn-info">Voir</a>
                                        <a href="#" class="btn btn-xs btn-danger" onclick="event.preventDefault(); document.getElementById('destroy_thread-form').submit();">Supprimer</a>
                                        {!! Form::open(['url' => action('Administration\ThreadsController@destroy_thread', $thread), 'method' => 'delete', 'id' => 'destroy_thread-form']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection