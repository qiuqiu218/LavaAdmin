@extends('layouts.default')

@section('content')
<ul class="layui-nav layui-nav-tree">
  @foreach ($data as $item)
    @can('menu_'.$item->id)
    <li class="layui-nav-item">
      <a href="{{$item->route ? url($item->route) : 'javascript:;'}}" target="content">{{$item->title}}</a>
      @if (count($item->children))
        <dl class="layui-nav-child">
          @foreach ($item->children as $children)
            @can('menu_'.$children->id)
              <dd><a href="{{$children->route ? url($children->route) : 'javascript:;'}}" target="content">{{$children->title}}</a></dd>
            @endcan
          @endforeach
        </dl>
      @endif
    </li>
    @endcan
  @endforeach
</ul>
@endsection