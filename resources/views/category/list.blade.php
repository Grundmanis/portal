<li>
    <a href="{{ route('category.categories',['category' => $category->slug]) }}">{{ $category->name }}</a>
    @if (!$category->child->isEmpty())
        <ul>
            @foreach($category->child as $category)
                @include('category.list', $category)
            @endforeach
        </ul>
    @endif
</li>