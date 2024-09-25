<form wire:submit.prevent="registerUser()">
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control @error('name') border border-danger @enderror"  wire:model="name">
        <div class="form-text text-danger">
            @error('name')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Username</label>
        <div class="input-group flex-nowrap">
            <input type="text" class="form-control @error('username') inputWithError border border-danger @enderror" wire:model.live="username" palceholder="Username">
        </div>
        <div class="form-text text-danger">
            @error('username')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control @error('email') inputWithError border border-danger @enderror" wire:model.live="email">
        <div class="form-text text-danger">
            @error('email')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control @error('password') inputWithError border border-danger @enderror"" wire:model="password">
        <div class="form-text text-danger">
            @error('password')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" class="form-control" wire:model="password_confirmation">
        <div class="form-text text-danger">
            @error('password_confirmation')
            {{ $message }}
            @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-secondary">Register</button>
</form>
