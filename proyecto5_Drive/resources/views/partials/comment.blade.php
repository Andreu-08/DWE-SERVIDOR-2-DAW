<article class="media">
    <div class="media-content">
        <div class="content">
            <p>
                <strong>{{ $comment->user->name }}</strong>
                <small>{{ $comment->created_at->format('d/m/Y H:i') }}</small>
                <br>
                {{ $comment->content }}
            </p>
            @can('delete', $comment)
            <form method="POST" action="{{ route('comment.delete', ['comment' => $comment->id]) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="button is-danger is-small is-rounded is-outlined">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 50 50"><g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"><path stroke="#344054" d="M25 22.917v12.5m8.333-20.834v-6.25A2.083 2.083 0 0 0 31.25 6.25h-12.5a2.083 2.083 0 0 0-2.083 2.083v6.25z"/><path stroke="#e11414" d="M8.333 14.583h33.334zm27.23 27.23l1.937-27.23h-25l1.938 27.23a2.083 2.083 0 0 0 2.083 1.937h16.958a2.084 2.084 0 0 0 2.084-1.938"/></g></svg>
                </button>
            </form>
            @endcan
            @can('reply', $comment)
            <button 
                class="button is-primary is-small is-rounded is-outlined reply-button" 
                data-comment-id="{{ $comment->id }}" 
                data-comment-author="{{ $comment->user->name }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path fill="#19ae1b" d="M12 21a9 9 0 1 0-9-9c0 1.488.36 2.89 1 4.127L3 21l4.873-1c1.236.639 2.64 1 4.127 1" opacity="0.16"/><path fill="#19ae1b" d="m4 16.127l.98.201a1 1 0 0 0-.092-.66zM7.873 20l.459-.888a1 1 0 0 0-.66-.092zM3 21l-.98-.201a1 1 0 0 0 1.181 1.18zm17-9a8 8 0 0 1-8 8v2c5.523 0 10-4.477 10-10zM4 12a8 8 0 0 1 8-8V2C6.477 2 2 6.477 2 12zm8-8a8 8 0 0 1 8 8h2c0-5.523-4.477-10-10-10zM4.888 15.668A7.96 7.96 0 0 1 4 12H2c0 1.651.4 3.211 1.112 4.586zM12 20a8 8 0 0 1-3.668-.888l-.918 1.776A9.96 9.96 0 0 0 12 22zm-8.98-4.074l-1 4.873l1.96.402l1-4.873zm.181 6.054l4.873-1l-.402-1.96l-4.873 1z"/><path stroke="#19ae1b" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 9.001v6m-3-3h6"/></g></svg>
            </button>
        @endcan

        </div>

        <!-- Mostrar comentarios anidados -->
        @if ($comment->replies->count())
            <div class="nested-comments" style="margin-left: 20px;">
                @foreach ($comment->replies as $reply)
                    @include('partials.comment', ['comment' => $reply])
                @endforeach
            </div>
        @endif
    </div>
</article>
