@inject("menu", "App\Presenter\Admin")

<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-2 left-aside">
                {!! $menu->renderMenu() !!}
            </div>
            <div class="column is-10 right-aside">
                @yield("content")
            </div>
        </div>
    </div>
</section>