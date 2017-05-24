@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-info">
            Ce forum utilise la syntaxe markdown. Si vous n'êtes pas à l'aise avec syntaxe vous pouvez suivre le sujet du forum.
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Editer le sujet : <strong>{!!  $thread->title !!}</strong></h2>
                @include('forums.form', ['action' => 'update_thread'])
            </div>
        </div>
    </div>
@endsection