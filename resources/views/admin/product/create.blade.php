@extends('layouts.default')

@section('content')
  @if ($product_classify_id > 0)
    @include('admin.product.form')
  @else
    @include('admin.product.select')
  @endif
@endsection

@section('script')
  @parent
  <script src="{{ asset('js/admin/base_info/linkage_select.js?'.time()) }}"></script>
  <script src="{{ asset('js/admin/base_info/editor.js?'.time()) }}"></script>
  <script src="{{ asset('js/admin/base_info/image.js?'.time()) }}"></script>
  <script src="{{ asset('js/admin/base_info/images.js?'.time()) }}"></script>
@endsection