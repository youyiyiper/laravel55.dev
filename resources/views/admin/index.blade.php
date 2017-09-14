@extends('admin.layouts.master')

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-left">
            <li><a href="javascript:;">Home</a></li>
            <li><a href="javascript:;">面包屑</a></li>
            <li class="active">面包屑</li>
        </ol>
        <!-- end breadcrumb -->

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        @include('admin.layouts.panel-btn')
                        <h4 class="panel-title">面板标题</h4>
                    </div>
                    <div class="panel-body">
                        面板内容
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection