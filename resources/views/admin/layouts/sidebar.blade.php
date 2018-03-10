<div id="sidebar" class="sidebar sidebar-transparent">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img src="{{ asset(!empty(session('adminDetail.headimg')) ? session('adminDetail.headimg') : 'asset_admin/assets/img/user-1.jpg') }}" alt="{{ session('adminDetail.name') }}" /></a>
                </div>
                <div class="info">
                    {{ session('adminDetail.name') }}
                    <small>{{ session('adminDetail.email') }}</small>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->

        <!-- begin sidebar nav -->
        <ul class="nav">
            @foreach($adminMenus as $adminMenu)
                <li class="has-sub">
                    <a href="javascript:;">
                        @if(isset($adminMenu['child']))
                            <b class="caret pull-right"></b>
                        @endif

                        @if(!empty($adminMenu['class']))
                            <i class="{{ $adminMenu['class'] }}"></i>
                        @endif
                        <span>{{ $adminMenu['name'] }}</span>
                    </a>
                    @if(isset($adminMenu['child']))
                        <ul class="sub-menu">
                            @foreach($adminMenu['child'] as $menus)
                                <li class="has-sub @if($menus['url'] == Request::path()) active @endif">
                                    <a href="{{ url($menus['url']) }}">
                                        @if(isset($menus['child']))
                                            <b class="caret pull-right"></b>
                                        @endif
                                        {{ $menus['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
             @endforeach
                    <!-- begin sidebar minify button -->
                    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
                    <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->

    </div>
    <!-- end sidebar scrollbar -->
</div>
<script>
    var activeNode = $('.active');
    activeNode.parents('li').addClass('active');
</script>