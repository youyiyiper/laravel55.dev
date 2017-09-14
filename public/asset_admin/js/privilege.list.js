data_table = null;
$(document).ready(function () {
    var url = '/admin/privilege';
    var lang = {
        "sProcessing": "处理中...",
        "sLengthMenu": "每页 _MENU_ 项",
        "sZeroRecords": "没有匹配结果",
        "sInfo": "当前显示第 _START_ 至 _END_ 项，共 _TOTAL_ 项。",
        "sInfoEmpty": "当前显示第 0 至 0 项，共 0 项",
        "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
        "sInfoPostFix": "",
        "sSearch": "搜索:",
        "sUrl": "",
        "sEmptyTable": "没有查到数据",
        "sLoadingRecords": "载入中...",
        "sInfoThousands": ",",
        "oPaginate": {
            "sFirst": "首页",
            "sPrevious": "上页",
            "sNext": "下页",
            "sLast": "末页",
            "sJump": "跳转"
        },
        "oAria": {
            "sSortAscending": ": 以升序排列此列",
            "sSortDescending": ": 以降序排列此列"
        }
    };
    data_table = $('#data_table').DataTable({
        "processing": true,
        "pageLength": 20,
        "pagingType": "full_numbers",
        "paging": true,   //false关闭分页
        "dom": '<"top"i>rt<"bottom"lp><"clear">', //将分页插件和本地搜索放在左下角
        'language':lang,
        "serverSide": true,
        "searching": true,   //false关闭本地搜索 会关闭搜索框
        'searchDelay':300,//搜索延时
        // 'search':{
        //     regex : true//是否开启模糊搜索
        // },
        "ajax": {
            'url' : url
        },
        "order": [[ 4, "desc" ]], //指定列排序从0开始
        'lengthMenu':[20,30,50,100],
        "columns": [
            {"data": "id","name" : "id","orderable" : true,"searchable":false},
            {"data": "name","name" : "name","orderable" : true,"searchable":false},
            {"data": "flag","name": "flag","orderable" : true,"searchable":false},
            {"data": "desc","name": "desc","orderable" : false,"searchable":false},
            {"data": "created_at","name": "created_at","orderable" : true,"searchable":false},
            {"data": "updated_at","name": "updated_at","orderable" : true,"searchable":false},
            {"data": "button","name": "button",'type':'html',"orderable" : false,"searchable":false}
        ]
    });
});