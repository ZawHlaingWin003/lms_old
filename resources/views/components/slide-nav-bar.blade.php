<div class="offcanvas offcanvas-start" tabindex="-1" id="slide_nav_bar" aria-labelledby="slide_nav_bar">
    <div class="offcanvas-header">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <ul class="list-group list-group-flush px-4">
        <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action active">
            Dashboard
        </a>
        @if (auth()->user()->isAdmin())
            <a href="{{ route('admin.siteAdministration') }}" class="list-group-item list-group-item-action">
                Site Administration
            </a>
        @endif
        <a href="{{ route('index.calender') }}" class="list-group-item list-group-item-action">
            Schedule Calendar
        </a>
    </ul>
</div>
