<tr>
  <td>{{$item['id']}}</td>
  <td>{{$item['title']}}</td>
  <td>{{$item['description']}}</td>
  <td>{{$item['route']}}</td>
  <td>{{$item['type']}}</td>
  <td align="center">
    <button class="layui-btn layui-btn-xs layui-btn-normal" route="{{ url('admin/menu/'.$item['id'].'/edit') }}" edit>编辑</button>
    <button class="layui-btn layui-btn-xs layui-btn-danger" remove>删除</button>
  </td>
</tr>
@if (count($item['children']))
  @each('admin.menu.table', $item['children'], 'item')
@endif