<li>
    @if(Auth::user() && Auth::user()->isAdmin())
        <form style="display: inline-block;" onsubmit="return confirm('Are you sure?')" action="{{ route('category.destroy', $category->id) }}" method="get">
            <input class="btn btn-small btn-danger" type="submit" value="x">
        </form>
    @endif
    <a href="{{ route('category.categories',['category' => $category->slug]) }}">{{ $category->name }}</a>
    @if (!$category->child->isEmpty())
        <ul>
            @foreach($category->child as $category)
                @include('category.list', $category)
            @endforeach
        </ul>
    @endif
</li>