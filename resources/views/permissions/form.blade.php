{!! Form::model($permission,['files' => 'true', 'url' => action('Administration\PermissionsController@'.$action, ['profil' => $permission]), 'method' => $action == "store" ? 'Post' : 'Put', 'class' => 'form-horizontal'])  !!}

<div class="content-box">
    <h3 class="content-box-header content-box-header-alt bg-default">
        <i class="glyph-icon icon-linecons-cog"></i>
        <span class="header-wrapper">
                Ajouter une permission
        </span>
    </h3>
    <div class="content-box-wrapper">

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <label>Nom de la permission</label>
                {!! Form::text('name', null,['class' => 'form-control input-lg', 'placeholder' => 'edit_post'])  !!}
                @if ($errors->has('name'))
                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
                <em>Le nom de la permission ne doit contenir aucun espace ni de caractère spéciaux</em>
            </div>
        </div>

        <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <label>Nom de la permission à afficher:</label>
                {!! Form::text('display_name', null,['class' => 'form-control input-lg', 'placeholder' => 'editer des articles sur le blog'])  !!}
                @if ($errors->has('display_name'))
                    <span class="help-block"><strong>{{ $errors->first('display_name') }}</strong></span>
                @endif
                <em>Le nom de la permission à afficher peut contenir des espaces et des caractères spéciaux</em>
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
                <a href="{!! action('Administration\PermissionsController@index') !!}" class="btn btn-lg btn-default btn-block">Retour à la liste des roles</a>
            </div>
        </div>
    </div>
</div>


{!! Form::close() !!}