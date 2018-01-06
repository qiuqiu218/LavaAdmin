<div>
  @for ($i = 0; $i < $item->depth; $i++)
    <span class="layui-inline d-padding-l-25"></span>
  @endfor
  <input type="checkbox" name="permission[]" title="{{$item->title}}" value="{{'menu_'.$item->id}}"{{ $item->checked ? ' checked' : '' }}>
</div>
@if (count($item->children))
  @each('admin.role.menu', $item->children, 'item')
@endif