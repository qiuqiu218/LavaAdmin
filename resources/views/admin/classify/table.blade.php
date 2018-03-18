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
  <td align="center">
    <button class="layui-btn layui-btn-xs layui-btn-normal" route="{{ url('admin/classify/'.$item->id.'/edit?table_id='.$item->table_id) }}">编辑</button>
    <button class="layui-btn layui-btn-xs layui-btn-danger" url="{{ url('admin/classify/'.$item->id) }}">删除</button>
  </td>
</tr>
@if (count($item->children))
  @each('admin.classify.table', $item->children, 'item')
@endif