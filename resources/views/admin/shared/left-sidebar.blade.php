<div class="card overflow-hidden">
    <div class="card-body pt-3">
        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
            <li class="nav-item">
                <a class=" {{ Route::is('dashboard.admin') ? 'text-white bg-primary rounded' : '' }} nav-link text-dark"
                    href="{{ route('dashboard.admin') }}">
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a class=" {{ Route::is('dashboard.users.index') ? 'text-white bg-primary rounded' : '' }} nav-link text-dark"
                    href="{{ route('dashboard.users.index') }}">
                    <span>Users</span></a>
            </li>

            <li class="nav-item">
                <a class=" {{ Route::is('dashboard.ideas.index') ? 'text-white bg-primary rounded' : '' }} nav-link text-dark"
                    href="{{ route('dashboard.ideas.index') }}">
                    <span>Ideas</span></a>
            </li>

            <li class="nav-item">
                <a class=" {{ Route::is('dashboard.comments.index') ? 'text-white bg-primary rounded' : '' }} nav-link text-dark"
                    href="{{ route('dashboard.comments.index') }}">
                    <span>Comments</span></a>
            </li>


        </ul>
    </div>
    <div class="card-footer text-center py-2">
        <a class="btn btn-link btn-sm" href="{{ route('change.lang', 'en') }}">en</a>
        <a class="btn btn-link btn-sm" href="{{ route('change.lang', 'es') }}">es</a>
        <a class="btn btn-link btn-sm" href="{{ route('change.lang', 'fr') }}">fr</a>
    </div>
</div>
