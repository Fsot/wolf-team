@extends('layouts.admin')

@section('content')
    <div class="page-title">
        @if($thread->messages->where('id', $thread->answer_id)->first()->destroy == 1)
            <div class="alert alert-info">
                <h4><i class="glyphicon glyphicon-pushpin"></i> Ce message est bloqué. Seul les administrateurs du site peuvent y avoir accées.</h4>
                <button type="button" class="btn btn-success btn-xs" onclick="event.preventDefault(); document.getElementById('unlock-{!! $thread->id !!}').submit();"><i class="fa fa-unlock-alt"></i></button>
                {!! Form::open(['url' => action('Administration\MessagesController@unlockMessages', $thread->messages->where('id',$thread->answer_id)->first()->id), 'method' => 'put', 'id' => 'unlock-'.$thread->id]) !!}
                {!! Form::close() !!}
            </div>
        @endif
        <div class="title_left">
            <h3>{!! $thread->title !!}</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <a href="{!! action('Administration\ChannelsController@index') !!}" class="btn btn-default btn-sm">Retour à tous les forums</a>
                <a href="{!! action('Administration\ChannelsController@channel', $thread->channel_id) !!}" class="btn btn-default btn-sm">Retour</a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-1 text-center">
            <img src="{!! $thread->messages->where('id', $thread->answer_id)->first()->user->profil->avatar($thread->messages->where('id', $thread->answer_id)->first()->user->name) !!}" alt="">
            <p>{!! $thread->messages->where('id', $thread->answer_id)->first()->user->name !!}</p>
        </div>
        <div class="col-md-11">
            <div class="x_panel">
                <div class="x_title">
                    {!! $thread->messages->where('id', $thread->answer_id)->first()->created_at !!}
                </div>
                <div class="x_content">
                    {!! $thread->messages->where('id', $thread->answer_id)->first()->text !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h4><strong>{!! $thread->messages->whereNotIn('id',$thread->answer_id)->count() !!} réponses</strong></h4>
            <hr>
        </div>
    </div>
    @foreach($thread->messages->whereNotIn('id',$thread->answer_id) as $answer)
        <div class="row">
            <div class="col-md-1 text-center">
                <img src="{!! $answer->user->profil->avatar($answer->user->name) !!}" alt="" class="img-circle">
                <p>{!! $answer->user->name !!}</p>
            </div>
            <div class="col-md-11">
                <div class="x_panel">
                    <div class="x_title">
                        {!! $answer->created_at !!}
                    </div>
                    <div class="x_content">
                        @if($answer->alert == true)
                            <div class="alert alert-block alert-info">
                                <p><small><i class="glyphicon glyphicon-pushpin"></i> Ce message a été signalé</small></p>
                                <div class="btn-group btn-group-xs">
                                    <a href="{!! action('Administration\MessagesController@do_nothing', $answer) !!}" class="btn btn-success">Ne rien faire</a>
                                    <a href="{!! action('Administration\MessagesController@do_moderate', $answer) !!}" class="btn btn-warning">Modérer</a>
                                    <a href="#" onclick="event.preventDefault();if(confirm('Voulez-vous bloquer ce message ?')){document.getElementById('doDestroy-form-{!! $answer->id !!}').submit();}" class="btn btn-danger">Bloquer</a>
                                    {!! Form::open(['url' => action('Administration\MessagesController@lockMessages', $answer) , 'method' => 'PUT', 'style' => 'display: none;', 'id' => 'doDestroy-form-'.$answer->id.'']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        @elseif($answer->moderate == 1)
                            <div class="alert alert-info">
                                <p><small><i class="glyphicon glyphicon-pushpin"></i> Ce message a été modéré par notre équipe. Une partie de son contenu a été modifié ou supprimer</small></p>
                            </div>
                        @elseif($answer->destroy == 1)
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="alert alert-danger">
                                        <p><small><i class="glyphicon glyphicon-pushpin"></i> Ce message a été bloquer</small></p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    {!! Form::open(['url' => action('Administration\MessagesController@unlockMessages', $answer->id), 'method' => 'put']) !!}
                                        {!! Form::submit('Débloquer le message', ['class' => 'btn btn-success btn-lg pull-right']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        @endif
                        {!! $answer->text !!}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection