@foreach($categories as $cat)
    <li>
        <a href="#" class="category" data-cat-id="{{$cat->id}}" data-category-name= {{$cat->name}}>{{$cat->name}}</a>
        @if(count($cat->subCategory) > 0)
            <ul>
                @include('bot.categories', ['categories' => $cat->subCategory])
            </ul>
        @endif
    </li>
@endforeach
