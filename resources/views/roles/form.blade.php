{!! Form::model($role,['files' => 'true', 'url' => action('Administration\RolesController@'.$action, ['profil' => $role]), 'method' => $action == "store" ? 'Post' : 'Put', 'class' => 'form-horizontal'])  !!}

<div class="content-box">
    <h3 class="content-box-header content-box-header-alt bg-default">
        <i class="glyph-icon icon-linecons-cog"></i>
        <span class="header-wrapper">
                Ajouter un role
        </span>
    </h3>
    <div class="content-box-wrapper">

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <label>Nom du role</label>
                {!! Form::text('name', null,['class' => 'form-control input-lg', 'placeholder' => 'gamer'])  !!}
                @if ($errors->has('name'))
                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
                <em>Le nom du role ne doit contenir aucun espace ni de caractère spéciaux. Seul les - et les _ sont accépté.</em>
            </div>
        </div>

        <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <label>Nom du role à afficher:</label>
                {!! Form::text('display_name', null,['class' => 'form-control input-lg', 'placeholder' => 'The Gamer'])  !!}
                @if ($errors->has('display_name'))
                    <span class="help-block"><strong>{{ $errors->first('display_name') }}</strong></span>
                @endif
                <em>Le nom du role à afficher peut contenir des espaces et des caractères spéciaux</em>
            </div>
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <label>Déscription :</label>
                {!! Form::text('description', null,['class' => 'form-control input-lg'])  !!}
                @if ($errors->has('description'))
                    <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
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
                <a href="{!! action('Administration\RolesController@index') !!}" class="btn btn-lg btn-default btn-block">Retour à la liste des roles</a>
            </div>
        </div>
    </div>
</div>


{!! Form::close() !!}