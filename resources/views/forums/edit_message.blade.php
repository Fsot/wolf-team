@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-info">
            Ce forum utilise la syntaxe markdown. Si vous n'êtes pas à l'aise avec syntaxe vous pouvez suivre le sujet du forum.
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Editer votre message</h2>
                {!! Form::model($msg, ['url' => action('Pages\ForumsController@update_message', $msg), 'method' => 'put', 'class' => 'form-horizontal']) !!}
                    {!! Form::textarea('content', $msg->text, ['id' => 'mdeditor']) !!}
                    {!! Form::submit('Modifier votre message', ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection