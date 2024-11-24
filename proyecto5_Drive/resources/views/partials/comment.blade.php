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
                    Eliminar
                </button>
            </form>
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
