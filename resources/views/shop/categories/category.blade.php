@auth
    @if(auth()->user()->role === 'admin')
    <form class="CategoryDeleteForm" method="POST" action="{{route('CategoryEdit.destroy', $category->id)}}">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <li>
            <a href="{{ route('shop', ['category' => $category->id]) }}">{{ $category->name }}</a>
        </li>
        <button class="CategoryDeleteButton">X</button>
    </form>
    @else
        <div class="CategoryDeleteForm">
            <li>
                <a href="{{ route('shop', ['category' => $category->id]) }}">{{ $category->name }}</a>
            </li>
        </div>
    @endif
@endauth
@guest
    <div class="CategoryDeleteForm">
        <li>
            <a href="{{ route('shop', ['category' => $category->id]) }}">{{ $category->name }}</a>
        </li>
    </div>
@endguest

@if ($category->subcategories->isNotEmpty())
    <ul class="category">
        @each('shop.categories.category', $category->subcategories, 'category')
    </ul>
@endif
