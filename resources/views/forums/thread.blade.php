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
                        <h5><strong>{!! $thread->user->name !!},</strong> {!! $thread->created_at !!} - <small><a href="" class="text-danger">Signaler</a></small></h5>
                        <hr>
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
                           <h5><strong>{!! $answer->user->name !!},</strong> {!! $answer->created_at !!} - <small><a href="" class="text-danger">Signaler</a></small></h5>
                           <hr>
                           {!! $answer->text !!}
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