<div class="form-container">
    <form wire:submit="post">
        @csrf
        <div class="form-group">
            <textarea class="form-control mb-3" wire:model="message" placeholder="Say you're in love with me..." rows="3"></textarea>
        </div>
        @error('message')
        <div class="alert alert-secondary">
            {{ $message }}
        </div>
        @enderror
        <button type="submit">Whisper</button>
    </form>
</div>
