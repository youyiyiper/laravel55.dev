<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Krajee JQuery Plugins - &copy; Kartik</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('plugin/bootstrap-fileinput/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('plugin/bootstrap-fileinput/themes/explorer-fa/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="{{ asset('plugin/bootstrap-fileinput/js/plugins/sortable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugin/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugin/bootstrap-fileinput/js/locales/zh.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugin/bootstrap-fileinput/themes/explorer-fa/theme.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugin/bootstrap-fileinput/themes/fa/theme.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
	<div class="container kv-main">
        <label>多语言多文件上传</label>
		<div class="file-loading">
			<input id="upload" name="upload[]" type="file" multiple>
		</div>
	</div>

	<script>
	    $('#upload').fileinput({
	        theme: 'fa',
	        language: 'zh',
	        uploadUrl: "{{ url('test/doUpload') }}",
	        uploadAsync: false,
	        allowedFileExtensions: ['jpg', 'png', 'gif'],
	        browseLabel: '选择文件',
            removeLabel: '删除文件',
            removeTitle: '删除选中文件',
            cancelLabel: '取消',
            cancelTitle: '取消上传',
            uploadLabel: '上传',
            uploadTitle: '上传选中文件',
            dropZoneTitle: "请通过拖拽图片文件放到这里",
            dropZoneClickTitle: "或者点击此区域添加图片",
            removeFromPreviewOnError:true,
            showUpload: true, //是否显示上传按钮
            showRemove: true, //显示移除按钮
            showPreview: true, //是否显示预览
            showCaption: false,//是否显示标题
            browseClass: "btn btn-primary", //按钮样式
            dropZoneEnabled: true,//是否显示拖拽区域
	    }).on("fileuploaded", function (event, data, previewId, index) {
	    	alert('i = ' + index + ', id = ' + previewId);
	    	if(data.response.code == 0){
	    		alert(data.response.data);
	    	}
  		}).on('filepredelete', function(event, key, jqXHR, data) {  
            console.log('Key = ' + key);  
            console.log(jqXHR);  
            console.log(data);   
        });  
    </script>
</body>
</html>