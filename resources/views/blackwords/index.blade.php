@extends('layouts.admin')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>
                Liste des mots noir
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-8">
            <div class="x_panel">
                <div class="x_title">
                    <h4>Mots noir actif sur le forum</h4>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <h3>
                    @foreach($words as $word)
                        <button onclick="event.preventDefault(); if(confirm('Voulez-vous autoriser ce mots dans le forum ?')){document.getElementById('deletedBlackWord-{!! $word->id !!}').submit()}" class="btn btn-lg btn-danger" data-toggle="tooltip" data-placement="top" data-original-title="Autoriser ce mot">{!! $word->word !!}</button>
                    @endforeach
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="x_panel">
                <div class="x_title">
                    <h4>Ajouter un mot noir</h4>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! Form::open(['url' => action('Administration\BlackWordsController@store'), 'method' => 'post']) !!}
                        <div class="form-group">
                            {!! Form::text('words',null,['class'=> 'form-control input-lg', 'placeholder' => 'Mots noir ... ']) !!}
                            <em>Si vous souhaitez mettre plusieurs mots, séparer les avec une virgule.</em>
                        </div>

                        {!! Form::submit('Sauvegarder', ['class' => 'btn btn-lg btn-default']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @foreach($words as $word)
        {!! Form::open(['url' => action('Administration\BlackWordsController@destroy'), 'method' => 'delete','id' => 'deletedBlackWord-'.$word->id]) !!}
        {!! Form::hidden('id', $word->id) !!}
        {!! Form::close() !!}
    @endforeach
@endsection