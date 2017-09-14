/**
 * 执行查询
 */
function toSearch(){
    var param = new Array();
    j = 0;
    $('#search input').each( function (e) {
        var val = $(this).val();
        var key = $(this).attr('name');
        var condition = $(this).attr('condition');
        if (val.length > 0 && key.length > 0 && condition.length > 0) {
            param[j] = key + '=+' + val + '&+' + condition;
            j++;
        }
    } );

    if (param.length > 0) {
        data_table.search(param.join('#+')).draw(false);
    }
}

//点击查询
$('#search_btn').click(function(){
    toSearch();
});

//回车键查询
$('#search input').on('keyup',function(e){
    if(e.keyCode !== 13){
        return false;
    }
    toSearch();
})