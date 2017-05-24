{!! Form::model($channel,['files' => 'true', 'url' => action('Administration\ChannelsController@'.$action, ['channel' => $channel]), 'method' => $action == "store" ? 'Post' : 'Put', 'class' => 'form-horizontal'])  !!}

<div class="content-box">
    <div class="content-box-wrapper">

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <label>Titre du sujet</label>
                {!! Form::text('title', null,['class' => 'form-control input-lg', 'placeholder' => 'Règles de bonne conduite'])  !!}
                @if ($errors->has('title'))
                    <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('categorie') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <label>Catégorie</label>
                {!! Form::select('categorie', $categories, null, ['class' => 'form-control'])  !!}
                @if ($errors->has('categorie'))
                    <span class="help-block"><strong>{{ $errors->first('categorie') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <label>Couleur</label>
                {!! Form::select('color', $color, null, ['class' => 'form-control'])  !!}
                @if ($errors->has('color'))
                    <span class="help-block"><strong>{{ $errors->first('color') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('block') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <label>{!! Form::checkbox('block', null, $channel->block)  !!} Bloquer le forum</label>
                @if ($errors->has('block'))
                    <span class="help-block"><strong>{{ $errors->first('block') }}</strong></span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="content-box">
    <hr>
    <div class="content-box-wrapper">
        <div class="form-group">
            <div class="col-md-12">
                {!! Form::submit('Sauvegarder', ['class' => 'btn btn-lg btn-primary btn-block'])  !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <a href="{!! action('Administration\ChannelsController@index') !!}" class="btn btn-lg btn-default btn-block">Retour à la liste des sujets</a>
            </div>
        </div>
    </div>
</div>


{!! Form::close() !!}