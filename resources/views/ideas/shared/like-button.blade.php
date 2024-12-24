<div>
    @auth()
    @if (Auth::user()->likesIdea($idea))
    <form method="GET" action="{{ route('ideas.unlike', $idea->id) }}">
        @csrf
        @method('get')
    <button type="submit" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
        </span> {{ $idea->likes_count }} </button>
    </form>
    @else
    <form method="GET" action="{{ route('ideas.like', $idea->id) }}">
        @csrf
        @method('get')
    <button type="submit" class="fw-light nav-link fs-6"> <span class="far fa-heart me-1">
        </span> {{ $idea->likes_count }} </button>
    </form>
    @endif
    @endauth

    @guest
    <a href = {{ route('login') }} class="fw-light nav-link fs-6"> <span class="far fa-heart me-1">
        </span> {{ $idea->likes_count }} </a>
    @endguest
</div>
