@extends('layouts.app')

@section('content')
    <div class="container">
        @include('profils.header')
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="avatar pull-right">
                            <img src="{!! $data['profil']->avatar !!}" alt="">
                        </div>
                        <h3>Mon profil</h3>
                        <ul class="list-unstyled">
                            <li>Prénom : <strong>{!! $data['profil']->firstname !!}</strong></li>
                            <li>Nom : <strong>{!! $data['profil']->lastname !!}</strong></li>
                            <li>Date d'anniversaire : <strong>Le {!! $data['profil']->birthday !!}</strong></li>
                            <li>Date d'inscription : <strong>{!! $data['user']->created_at !!}</strong></li>
                        </ul>
                        <hr>
                        <h3>Mes jeux</h3>
                        <ul>
                            <li>jeux</li>
                            <li>jeux</li>
                            <li>jeux</li>
                            <li>jeux</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">

            </div>
        </div>
    </div>
@endsection