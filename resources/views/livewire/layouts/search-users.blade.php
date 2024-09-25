<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true"
     wire:ignore.self>
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="searchModalLabel">Search user</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="d-flex" role="search" wire:submit.prevent="searchUser()">
                    <input type="text" class="form-control me-2 w-50" placeholder="Search users ..." aria-label="Search"
                           wire:model.live="search">
                </form>
                @forelse($users as $user)
                    @if($user->id != auth()->user()->id)
                        <div wire:loading.class.delay="opacity-50" class="d-flex flex-column p-4 my-3 post-sec border">
                            <div class="d-flex justify-content-between align-items-center mb-10">
                                <div class="d-flex gap-3">
                                    <a href="{{ route('profile.show', $user->username) }}">
                                        <img alt="Profile" class="post-user-prof rounded-circle"
                                             src="{{ asset('Images/Profiles/' . $user->profile->image) }}">
                                    </a>
                                    <div style="grid-gap: 5px" class="d-flex">
                                        <div class="d-flex align-items-center mb-10 sender">
                                            <a style="color: black" href="{{ route('profile.show', $user->username) }}">
                                                <div class="fw-bold">
                                                    @if(auth()->user()->contacts->where('belongs_id', $user->id)->first())
                                                        {{ auth()->user()->contacts->where('belongs_id', $user->id)->first()->name }}
                                                        <i class="fa fa-user-friends"></i>
                                                    @else
                                                        {{ $user->username }}
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="align-items-center d-flex h-100 justify-content-center">
                        <img width="300" src="{{ asset('Images/no-results.png') }}" alt="no result found">
                    </div>
                @endforelse
                @empty($users)
                    @if($users->hasMorePages())
                        <div wire:click="loadMore()" class="btn btn-outline-secondary">More</div>
                    @endif
                @endempty
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            // Re-open the modal when Livewire re-renders
            Livewire.on('openModal', function () {
                var searchModal = new bootstrap.Modal(document.getElementById('searchModal'));
                searchModal.show();
            });
        });

        // Emit 'openModal' event after search action
        Livewire.on('searchUserCompleted', function () {
            Livewire.emit('openModal');
        });
    </script>
</div>
