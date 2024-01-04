    @if($comment->accepted=='1')
        <li>
            <div class="comment-div">
                <div class="author">
                    Użytkownik: {{ $comment->author->nickname }}
                    @auth
                        @if(auth()->user()->role === 'admin' or $comment->author == auth()->user())
                            <form class="CategoryDeleteForm" method="POST" action="{{route('comments.destroy', $comment->id)}}">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button class="CategoryDeleteButton">X</button>
                            </form>
                        @endif
                    @endauth
                </div>
            <p>{{ $comment->text }}</p>

            <div class="reply-button" onclick="toggleReplyForm(this)">Odpowiedz</div>
            <div class="reply-container">
                <form class="CategoryDeleteForm" method="POST" action="{{route('comments.update', $comment->id)}}">
                    {{csrf_field()}}
                    {{ method_field('PUT') }}
                <input type="hidden" name="product_id" value="{{ $comment->product->id }}">
                <textarea class="CommentTextArea" placeholder="Twoja odpowiedź" name="comment_text"></textarea>
                <button class="save_order_button">Dodaj odpowiedź</button>
                </form>
            </div>
            </div>
        </li>
    @elseif($comment->author == auth()->user() or auth()->user()->role === 'admin')
        <li>
            <div class="comment-div unauthorized">
                <div class="author">
                    Użytkownik: {{ $comment->author->nickname }}
                    @if(auth()->user()->role === 'admin')
                        <form class="CategoryDeleteForm" method="POST" action="{{route('commentsAccept.update', $comment->id)}}">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <button class="">Acceptuj</button>
                        </form>
                    @endif
                    <form class="CategoryDeleteForm" method="POST" action="{{route('comments.destroy', $comment->id)}}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="CategoryDeleteButton">X</button>
                    </form>

                </div>
                <p>{{ $comment->text }}</p>
                <p style="color:red;">Komentarz w trakcie weryfikacji</p>
            </div>
        </li>
    @endif

@if ($comment->parent_comment->isNotEmpty() and $comment['accepted'] == '1')
    <ul class="comment">
        @each('shop.products.comment', $comment->parent_comment, 'comment')
    </ul>
@endif
