<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="{{ $idea->user->getImageURL() }}" alt={{ $idea->user->name }}>
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', $idea->user_id) }}"> {{ $idea->user->name }}
                        </a></h5>
                </div>
            </div>
            <div>
                @if(auth()->user()->id === $idea->user_id || auth()->user()->is_admin)
            <form action="{{ route('ideas.destroy',$idea) }}" method="POST">
                @csrf
                @method('delete')
                <a class="mx-2" href = "{{ route('ideas.edit',$idea->id) }}">Edit</a>
                @endif
                <a href = "{{ route('ideas.show',$idea->id) }}">View</a>
                @if(auth()->user()->id === $idea->user_id || auth()->user()->is_admin)
                <button class="ms-1 btn btn-danger">X</button>
                @endif
            </form>
            </div>
        </div>
    </div>



    <div class="card-body">
        @if($editting ?? false)
        <form action="{{ route('ideas.update', $idea->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="mb-3">
                <textarea name="content" class="form-control" id="content" rows="3"> {{ $idea->content }} </textarea>
                @error('content')
                    <span class="d-block fs-6 text-danger mt-2"> {{ $message }} </span>
                @enderror
            </div>
            <div class="">
                <button type="submit" class="btn btn-dark mb-2 btn-sm"> Update </button>
            </div>
        </form>
        @else
        <p class="fs-6 fw-light text-muted">
            {{ $idea->content }}
        </p>
        @endif
        <div class="d-flex justify-content-between">
            @include('ideas.shared.like-button')
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $idea->created_at->diffForHumans() }} </span>
            </div>
        </div>
        @include('ideas.shared.comments-box')
    </div>

</div>
