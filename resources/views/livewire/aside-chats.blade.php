<li class="border-bottom px-3 border-dark-subtle">
    <a href="{{ route('groups.show', ['group' => $group->id]) }}" class="list-group-item list-group-item-action py-3 lh-tight" aria-current="true">
        <div class="d-flex w-100 align-items-center justify-content-between">
            <strong class="mb-1">{{ Str::limit($group->name, 20) }}</strong>
            <small>{{ $group->posts->last() ? $group->posts->last()->created_at->format("Y/m/d") : "" }}</small>
        </div>
        <div class="col-10 mb-1 small">
            @if($group->posts->last())
                @if($group->posts->last()->user_id != null)
                    <small class="mb-1">{{ $group->posts->last() ? Str::limit($group->posts->last()->user->name, 10) . ": " : "" }} </small>
                @endif
            @endif
            {{ $group->posts->last() ? Str::limit($group->posts->last()->message, 30) : "" }}
        </div>
    </a>
</li>
