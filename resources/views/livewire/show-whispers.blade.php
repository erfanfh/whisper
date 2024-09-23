<div wire:poll >
    @foreach($posts as $post)
        <div class="d-flex flex-row justify-content-start  my-3 @if((auth()->user()->id == $post->user->id)) justify-content-end @endif" >
            @if(!(auth()->user()->id == $post->user->id))
                <a href="{{ route('profile.show', $post->user->username) }}">
                    <img alt="Profile" class="post-user-prof rounded-circle"
                         src="{{ asset('Images/Profiles/' . $post->user->profile->image) }}">
                </a>
            @endif
            <div
                @if(auth()->user()->id == $post->user->id) style="background-color: #D1E8FF;"
                @else style="background-color: #E5E7EB" @endif class="d-flex flex-column p-4 post-sec col-10 col-md-6">
                <div class="d-flex justify-content-between align-items-center mb-10">
                    <div>
                        <div style="grid-gap: 5px" class="d-flex">
                            <div class="d-flex align-items-center mb-10 sender">
                                @if(!(auth()->user()->id == $post->user->id))
                                    <a style="color: black" href="{{ route('profile.show', $post->user->username) }}">
                                        <div class="fw-bold">
                                            @if(empty(auth()->user()->contacts->where('belongs_id', $post->user->id)->all()))
                                                    {{ $post->user->username }}
                                            @else
                                                {{ auth()->user()->contacts->where('belongs_id', $post->user->id)->first()->name }}
                                            @endif
                                        </div>
                                    </a>
                                @endif
                                <div style="color: #555"
                                     class="x-small date-time">{{ $post->created_at->format('j/m/Y, H:i') }}</div>
                                @if($post->edited)
                                    <div class="x-small date-time">Edited</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(auth()->user()->id == $post->user->id)
                        <div class="d-flex edit-sec x-small">
                            <a style="color: gray" href="{{ route('posts.edit', $post) }}">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <span style="color: #cbd5e0">|</span>
                            <form action="{{ route('posts.destroy', $post) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-but"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="mt-10">
                    {{ $post->message }}
                </div>
            </div>
        </div>
    @endforeach
</div>
