<!-- 导航左侧 -->
<ul class="navbar-nav mr-auto">
@if(count($categories) > 0)
    @foreach($categories as $category)
    <!-- <li class="nav-item {{ active_class(if_route('topics.index')) }}"><a class="nav-link" href="{{ route('topics.index') }}">广场</a></li> -->
    <li class="nav-item {{ active_class(if_route('categories.show') && if_route_param('key', $category->des_key)) }}"><a class="nav-link" href="{{ route('categories.show', $category->des_key) }}">{{$category->name}}</a></li>
    @endforeach
@endif
</ul>
