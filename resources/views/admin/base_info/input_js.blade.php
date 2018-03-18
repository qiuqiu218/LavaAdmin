@if ($fields->contains('type', '单图上传'))
  <script src="{{ asset('js/admin/base_info/image.js?'.time()) }}"></script>
@endif
@if ($fields->contains('type', '多图上传'))
  <script src="{{ asset('js/admin/base_info/images.js?'.time()) }}"></script>
@endif
@if ($fields->contains('type', '单文件上传'))
  <script src="{{ asset('js/admin/base_info/file.js?'.time()) }}"></script>
@endif
@if ($fields->contains('type', '多文件上传'))
  <script src="{{ asset('js/admin/base_info/files.js?'.time()) }}"></script>
@endif
@if ($fields->contains('type', '日期'))
  <script src="{{ asset('js/admin/base_info/date.js?'.time()) }}"></script>
@endif
@if ($fields->contains('type', '编辑器'))
  <script src="{{ asset('js/admin/base_info/editor.js?'.time()) }}"></script>
@endif
@if ($fields->contains('type', '联动下拉框'))
  <script src="{{ asset('js/admin/base_info/linkage_select.js?'.time()) }}"></script>
@endif

