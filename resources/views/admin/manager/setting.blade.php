@extends('admin.layouts.master')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/croppic/assets/css/croppic.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-left">
            <li><a href="/admin">首页</a></li>
            <li class="active"><a href="{{url('admin/manager/setting')}}">管理员设置</a></li>
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
                        <h4 class="panel-title">管理员设置</h4>
                    </div>
                    @include('layouts.flash')
                    <div class="panel-body">
                        <a href="{{ url('admin/manager/changePwd') }}">
                            <button type="button" class="btn btn-primary m-r-5 m-b-5"><i class="fa fa-plus-square-o"></i> 修改密码</button>
                        </a>

                        <table class="table table-bordered table-hover" id="datatable">
                            <tr>
                                <th>名称：</th>
                                <td>{{ session('adminDetail.name') }}</td>
                            </tr>
                            <tr>
                                <th>邮箱：</th>
                                <td>{{ session('adminDetail.email') }}</td>
                            </tr>      
                            <tr>
                                <th>头像：</th>
                                <td>
                                    <div id="croppic" title="修改头像"></div>
                                    <input type="hidden" name="headimg" id="headimg" value="">
                                </td>
                            </tr>                                                           
                        </table>
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
    <script src="{{ asset('asset_admin/assets/plugins/croppic/assets/js/jquery.mousewheel.min.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/croppic/assets/js/croppic.min.js') }}"></script>

    <script>
        var eyeCandy = $('#croppic');

        @if(!empty(session('adminDetail.headimg')))
            eyeCandy.css({'background-image':'url({{env("APP_URL")."/".session("adminDetail.headimg")}})'});
        @endif
        
        var croppedOptions = {
            uploadUrl: "{{url('admin/crop/upload')}}",
            cropUrl: "{{url('admin/crop/handle')}}",
            outputUrlId:'headimg',
            onAfterImgCrop:function(){ 
                var headimg_url = $('#headimg').val();
                if(headimg_url.length > 0){
                    var url = "{{url('admin/manager/setting')}}";
                    $.get(
                        url,
                        {headimg:headimg_url,_token:"{{ csrf_token() }}"},
                        function(result){
                            if(result.code == 0 ){
                                window.location = url;
                            }
                        }
                    );
                }
            },
            cropData:{
                'width' : eyeCandy.width(),
                'height': eyeCandy.height()
            }
        };
        var cropperBox = new Croppic('croppic', croppedOptions);
        cropperBox.reset()
    </script>
@endsection