<div class="page-header">
    <h2><strong>{!! $data['wording']['title'] !!}</strong></h2>
<<<<<<< HEAD
=======
    @if(Auth::check() && isset($data['button']))
>>>>>>> dev-users
    <div class="btn-group btn-group-sm" role="group" aria-label="...">
        @foreach($data['button'] as $button)
            <a href="{!! $button['link'] !!}" type="button" class="{!! $button['class'] !!}">
                <span class="{!! $button['icon'] !!}"></span> {!! $button['text'] !!}
            </a>
        @endforeach
    </div>
<<<<<<< HEAD
=======
    @endif
>>>>>>> dev-users
</div>