@extends('admin.layouts.master')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-left">
            <li><a href="/admin">首页</a></li>
            <li class="active">标签列表</li>
        </ol>
        <!-- end breadcrumb -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="table-basic-5">
                    <div class="panel-heading">
                        @include('admin.layouts.panel-btn')
                        <h4 class="panel-title">标签列表</h4>
                    </div>
                    <div class="panel-body">
                        <a href="{{ url('admin/tag/create') }}">
                            <button type="button" class="btn btn-primary m-r-5 m-b-5"><i class="fa fa-plus-square-o"></i> 新增</button>
                        </a>
                        <table class="table table-bordered table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>添加时间</th>
                                    <th>更新时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td>{{$tag->id}}</td>
                                        <td>{{$tag->name}}</td>
                                        <td>{{$tag->created_at}}</td>
                                        <td>{{$tag->updated_at}}</td>
                                        <td>
                                            <a href="{{ url('admin/tag',[$tag->id,'edit']) }}"><button type="button" class="btn btn-success btn-xs"><i class="fa fa-pencil"> 编辑</i></button></a>

                                            <a href="javascript:;" data-id="{{ $tag->id }}" class="btn btn-danger btn-xs destroy">
                                                <i class="fa fa-trash"> 删除</i>
                                                <form action="{{ url('admin/tag',[$tag->id]) }}" method="POST" name="delete_item_{{ $tag->id }}" style="display:none">
                                                {{ method_field('DELETE') }}{{ csrf_field() }}
                                                </form>
                                            </a>
                                        </td>
                                    </tr>                                    
                                @endforeach                                
                            </tbody>
                        </table>
                        {{$tags->links()}}
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-6 -->
        </div>
        <!-- end row -->
    </div>
@endsection

@section('admin-js')
    <script src="{{ asset('asset_admin/assets/plugins/gritter/js/jquery.gritter.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.js') }}"></script>
    <script>
        $(function(){
            //通知信息
            @if (session()->has('flash_notification_message'))
                $.gritter.add({
                    title: '操作消息！',
                    text: '{!! session('flash_notification_message') !!}'
                });
            @endif

            //删除
            $(document).on('click','.destroy',function(){
                var _delete_id = $(this).attr('data-id');
                swal({
                        title: "确定删除？",
                        text: "删除将不可逆，请谨慎操作！",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        cancelButtonText: "取消",
                        confirmButtonText: "确定",
                        closeOnConfirm: false
                    },
                    function () {
                        $('form[name=delete_item_'+_delete_id+']').submit();
                    }
                );
            });
        });
    </script>

@endsection