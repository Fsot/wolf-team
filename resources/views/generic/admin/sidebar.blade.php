<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{!! url('/') !!}" class="site_title"><span>Wolf Team</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="{!! Auth::user()->profil->avatar(Auth::user()->name) !!}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Bonjour ,</span>
                @if(Auth::check())
                    <h2>{!! Auth::user()->name !!}</h2>
                @endif
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br>
        <br>
        <br>
        <br>
        <br>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> Forum <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{!! action('Administration\ChannelsController@index') !!}">Liste des forums</a></li>
                            <li><a href="{!! action('Administration\ChannelsController@create') !!}">Ajouter un forum</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-home"></i> Utilisateurs <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{!! action('Administration\UsersController@index') !!}">Liste des utilisateurs</a></li>
                            <li><a>Rôles<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="">
                                    <li><a href="{!! action('Administration\RolesController@index') !!}">Liste des rôles</a></li>
                                    <li><a href="{!! action('Administration\RolesController@create') !!}">Ajouter un rôle</a></li>
                                </ul>
                            </li>
                            <li><a>Permissions<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="">
                                    <li><a href="{!! action('Administration\PermissionsController@index') !!}">Liste des permissions</a></li>
                                    <li><a href="{!! action('Administration\PermissionsController@create') !!}">Ajouter une permission</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

    </div>
</div>
