{{--@foreach($categories as $cat)--}}
{{--    <ul id="myUL">--}}
{{--        <li>--}}
{{--            <span class="{{count($cat->subCategory)>0 ? "caret" : ""}}">--}}
{{--               <a href="#" class="category" data-cat-id="{{$cat->id}}"> {{$cat->name}}</a>--}}
{{--            </span>--}}
{{--            @if(count($cat->subCategory)>0)--}}
{{--                <ul class="nested">--}}
{{--                    @include('bot.categories', ['categories' => $cat->subCategory])--}}
{{--                </ul>--}}
{{--            @endif--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--@endforeach--}}
@foreach($categories as $cat)
    <li>
        <span class="category" data-cat-id="{{$cat->id}}">{{$cat->name}}</span>
        @if(count($cat->subCategory) > 0)
            <ul>
                @include('bot.categories', ['categories' => $cat->subCategory])
            </ul>
        @endif
    </li>
@endforeach
