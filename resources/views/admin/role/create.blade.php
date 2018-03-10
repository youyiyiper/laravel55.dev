@extends('admin.layouts.master')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
    <style type="text/css">
        #permission li{
           list-style:none;
        } 
        #permission .level1{
            margin-left:60px;
        }
        #permission .level2{
            margin-left:100px;
        }
        #permission .level3{
            margin-left:140px;
        }
        #permission .level4{
            margin-left:180px;
        }
        #permission .level5{
            margin-left:220px;
        }
        #permission .level6{
            margin-left:260px;
        }                
    </style>
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-left">
            <li><a href="/admin">首页</a></li>
            <li><a href="{{url('admin/role')}}">角色列表</a></li>
            <li class="active">新增角色</li>         
        </ol>
        <!-- end breadcrumb -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                    <div class="panel-heading">
                        @include('admin.layouts.panel-btn')
                        <h4 class="panel-title">新增角色</h4>
                    </div>
                    @include('layouts.flash')
                    <div class="panel-body panel-form">
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/role') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2" for="name">角色 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <input class="form-control" type="text" name="name" placeholder="角色名称" value="{{ old('name') }}" data-parsley-required="true" data-parsley-required-message="请输入角色名称" data-parsley-length="[2,30]" data-parsley-length-message="角色名称长度2~30字符" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2" for="desc">描述 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <input class="form-control" type="text" name="desc" placeholder="描述"  value="{{ old('desc') }}" data-parsley-required="true" data-parsley-required-message="请输入角色描述" data-parsley-length="[2,30]" data-parsley-length-message="角色描述名称长度2~30字符"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2" for="status">状态 * :</label>
                                <div class="col-md-4 col-sm-4">
                                    <input type="checkbox" checked="checked" name="status" data-render="switchery" data-theme="purple" value="1"/>
                                </div>
                            </div>                                 
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2" for="permission">权限 * :</label>
                                <div class="col-md-10 col-sm-10">
                                    <p>
                                        <a href="javascript:checkAll();" class="btn btn-sm btn-primary m-r-5"><i class="fa fa-check"></i> 全选</a>
                                        <a href="javascript:checkReverse();" class="btn btn-sm btn-inverse m-r-5"><i class="fa fa-magic"></i> 反选</a>
                                    </p>
                                    <hr>

                                    <div class="row" id="permission">
                                        <ul>
                                            @foreach($privileges as $value)
                                            <li class="level{{$value['level']}}" id="{{$value['id']}}" pid="{{$value['pid']}}">
                                                <input type="checkbox" name="permission[]" data-render="switchery" data-theme="purple" value="{{$value['id']}}" />{{$value['name']}}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2"></label>
                                <div class="col-md-4 col-sm-4">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </div>
                            </div>
                        </form>
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
    <script src="{{ asset('asset_admin/assets/plugins/parsley/dist/parsley.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/switchery/switchery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            renderSwitcher();
        });

        function renderSwitcher(){
            if ($('[data-render=switchery]').length !== 0) {
                $('[data-render=switchery]').each(function() {
                    var themeColor = '#00acac';
                    if ($(this).attr('data-theme')) {
                        switch ($(this).attr('data-theme')) {
                            case 'red': themeColor = '#ff5b57'; break;
                            case 'blue': themeColor = '#348fe2'; break;
                            case 'purple': themeColor = '#727cb6'; break;
                            case 'orange': themeColor = '#f59c1a'; break;
                            case 'black': themeColor = '#2d353c'; break;
                        }
                    }
                    var option = {};
                    option.color = themeColor;
                    option.secondaryColor = ($(this).attr('data-secondary-color')) ? $(this).attr('data-secondary-color') : '#dfdfdf';
                    option.className = ($(this).attr('data-classname')) ? $(this).attr('data-classname') : 'switchery';
                    option.disabled = ($(this).attr('data-disabled')) ? true : false;
                    option.disabledOpacity = ($(this).attr('data-disabled-opacity')) ? parseFloat($(this).attr('data-disabled-opacity')) : 0.5;
                    option.speed = ($(this).attr('data-speed')) ? $(this).attr('data-speed') : '0.3s';
                    var switchery = new Switchery(this, option);
                });
            }
        }

        //全选
        function checkAll(){
            $("#permission input[type=checkbox]").each(function() {
                if(!this.checked) this.click();
            });
        }

        //反选
        function checkReverse() {
            $("#permission input[type=checkbox]").each(function() {
                this.click();
            });
        }
    </script>
@endsection