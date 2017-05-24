@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">{!! $thread->title !!}</h2>
            </div>
        </div>
        <a href="{{ action('Pages\ForumsController@channel', $thread->channel->slug) }}" class="btn btn-default pull-right">Retour</a>
        <br>
        <hr>
        <div class="row">
            <div class="col-md-2">
                <a href="{{ action('Pages\ProfilsController@index', $thread->user->name) }}">
                    <img src="{!! $subject->user->profil->avatar($thread->user->name)  !!}" alt="" class="img-circle img-thumbnail">
                </a>
            </div>
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if(Auth::check())
                            @if(Auth::user()->id == $thread->user_id OR Auth::user()->can('edit_other_message'))
                                <div class="btn-group pull-right">
                                    <a href="{!! action('Pages\ForumsController@edit_thread', $thread->id) !!}" class="btn btn-default"><i class="glyphicon glyphicon-pencil"></i></a>
                                </div>
                            @endif
                        @endif
                        <h5><strong>{!! $thread->user->name !!},</strong> {!! $thread->created_at !!}@if(Auth::check() && $thread->user_id != Auth::id() && $thread->destroy != 1 && $thread->moderate != 1) - <small><a href="{!! action('Pages\ForumsController@advertissement', $thread->answer_id) !!}" class="text-danger">Signaler</a></small>@endif</h5>
                        <hr>
                        @if($subject->moderate == 1)
                            <div class="alert alert-info">
                                <p><small><i class="glyphicon glyphicon-pushpin"></i> Ce message a été modéré par notre équipe. Une partie de son contenu a été modifié ou supprimer</small></p>
                            </div>
                        @endif
                        {!! $subject->text !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3><strong>{!! $count_answers !!} réponses</strong></h3>
            </div>
        </div>
        <hr>
        @foreach($answers as $answer)
           <div class="row">
               <div class="col-md-2">
                   <a href="{{ action('Pages\ProfilsController@index', $answer->user->name) }}">
                       <img src="{!! $answer->user->profil->avatar($answer->user->name)  !!}" alt="" class="img-circle img-thumbnail">
                   </a>
               </div>
               <div class="col-md-10">
                   <div class="panel panel-default">
                       <div class="panel-body">
                           @if(Auth::check())
                               @if(Auth::user()->id == $answer->user_id OR Auth::user()->can('edit_other_message'))
                                   <div class="btn-group pull-right">
                                       <a href="{!! action('Pages\ForumsController@edit_message', $answer->id) !!}" class="btn btn-default"><i class="glyphicon glyphicon-pencil"></i></a>
                                   </div>
                               @endif
                           @endif
                           <h5><strong>{!! $answer->user->name !!},</strong> {!! $answer->created_at !!} @if(Auth::check() && $answer->user_id != Auth::id() && $answer->destroy != 1 && $answer->moderate != 1)- <small><a href="{!! action('Pages\ForumsController@advertissement', $answer->id) !!}" class="text-danger">Signaler</a></small>@endif</h5>
                           <hr>
                           @if($answer->moderate == 1)
                                <div class="alert alert-info">
                                    <p><small><i class="glyphicon glyphicon-pushpin"></i> Ce message a été modéré par notre équipe. Une partie de son contenu a été modifié ou supprimer</small></p>
                                </div>
                               {!! $answer->text !!}
                           @elseif($answer->destroy == 1)
                               <div class="alert alert-danger">
                                   <p><small><i class="glyphicon glyphicon-pushpin"></i> Ce message a été bloquer par notre équipe.</small></p>
                               </div>
                           @else
                               {!! $answer->text !!}
                           @endif
                       </div>
                   </div>
               </div>
           </div>
        @endforeach

        @if(Auth::check())
            <div class="row">
                <div class="col-md-12">
                    <h3>Répondre</h3>
                    <div class="alert alert-info">
                        Ce forum utilise la syntaxe markdown. Si vous n'êtes pas à l'aise avec syntaxe vous pouvez suivre le sujet du forum.
                    </div>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {!! Form::model($thread, ['url' => action('Pages\ForumsController@answer', $thread), 'action' => 'post']) !!}
                    <textarea name="content" id="mdeditor"></textarea>
                    {!! Form::submit('Répondre', ['class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        @else
            <div class="alert alert-success">
                Il faut être connecté pour répondre à ce sujet. <a href="{{ url('/login') }}" class="btn btn-success btn-xs pull-right">Se connecter</a>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
               {!! $paginate !!}
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection