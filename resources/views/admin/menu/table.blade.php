<tr data-parentId="{{$item->parent_id}}" data-id="{{$item->id}}" data-status="fold" class="{{ $item->depth !== 0 ? 'layui-hide' : '' }}">
  <td>{{$item->id}}</td>
  <td>
    <a href="javascript:;">
      @for ($i = 0; $i < $item->depth; $i++)
        <span class="layui-inline d-padding-l-25"></span>
      @endfor
      {!! count($item->children) ? '<i class="layui-icon">&#xe623;</i>' : '' !!}{{$item->title}}
    </a>
  </td>
  <td>{{$item->description}}</td>
  <td>{{$item->route}}</td>
  <td>{{$item->type}}</td>
  <td align="center">
    <button class="layui-btn layui-btn-xs layui-btn-normal" route="{{ url('admin/menu/'.$item->id.'/edit') }}">编辑</button>
    @if ($item->type !== '系统菜单')
    <button class="layui-btn layui-btn-xs layui-btn-danger" url="{{ url('admin/menu/'.$item->id) }}">删除</button>
    @endif
  </td>
</tr>
@if (count($item->children))
  @each('admin.menu.table', $item->children, 'item')
@endif