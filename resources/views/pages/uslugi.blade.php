<section id="services">
    <div class="container">
        <div class="row">
            <div class="services">
                @if(count($children))
                    @include('layouts.templates.leftSideBar')
                @endif
                @include('pages.' . $page->viewName)
            </div>
        </div>
    </div>
</section>
