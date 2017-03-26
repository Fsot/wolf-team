@extends('layouts.app')

@section('content')
    <div class="container">
        @include('profils.header')
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>Mon profil</h3>
                        <ul class="list-unstyled">
                            <li>Prénom : <strong>{!! $data['profil']->firstname !!}</strong></li>
                            <li>Nom : <strong>{!! $data['profil']->lastname !!}</strong></li>
                            <li>Date d'anniversaire :</li>
                            <li>Date d'inscription :</li>
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