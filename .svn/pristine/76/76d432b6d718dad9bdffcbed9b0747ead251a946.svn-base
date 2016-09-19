<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <div class="nav">
    <ul class="cc">
        <li><a href="{:U('Homeannouce/index')}" >公告管理</a></li>
        <li  class="current"><a href="javascript:void()" >添加公告</a></li>
      </ul>
</div>
  <form name="myform" action="{:U('Homeannouce/annouce_add')}" method="post" class="J_ajaxForm">
  <div class="table_full">
  <table width="100%" class="table_form">
  	
		<tr>
			<th width="120">公告标题</th> 
			<td><input type="text" name="title"  class="input" id="name"/></td>
		</tr>

		<tr class="upfileBox">
			<th width="120">详情</th> 
			<td><span class="must_red">*</span><div id='content_tip'></div><script type="text/plain" id="content" name="content"><p></p></script>
                <script type="text/javascript">
                //编辑器路径定义
                var editorURL = GV.DIMAUB;
                </script>
                <script type="text/javascript"  src="/statics/js/ueditor/editor_config.js"></script>
                <script type="text/javascript"  src="/statics/js/ueditor/editor_all_min.js"></script>
<script type="text/javascript">
 var editorcontent = UE.getEditor('content',{  
                            textarea:'info[content]',
                            toolbars:[[
            'fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
            'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
            'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
            'directionalityltr', 'directionalityrtl', 'indent', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
            'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
            'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
            'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',
            'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
            'print', 'preview', 'searchreplace', 'help', 'drafts'
        ]],
                            autoHeightEnabled:false
                      });
                      editorcontent.ready(function(){
                            editorcontent.execCommand('serverparam', {
                                  'catid': '',
                                  '_https':'/',
                                  'isadmin':'1',
                                  'module':'Content',
                                  'uid':'1',
                                  'groupid':'0',
                                  'sessid':'1453976713',
                                  'authkey':'13f026c840109208d104903b313593e6',
                                  'allowupload':'1',
                                  'allowbrowser':'1',
                                  'alowuploadexts':''
                             });
                             editorcontent.setHeight(300);
                      });
                      
</script> </td>
		</tr>
		<tr class="upfileBox">
			<th width="120">公告图标：</th>
				<td><input type="text" name="icon" class="input"
								 placeholder="" /> <input type="file"
								name="upload" value="" />
				<div class="imgshow"></div></td>
		</tr>
	</table>
  </div>
   <div class="">
      <div class="btn_wrap_pd">             
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">添加</button>
      </div>
    </div>
  </form>
</div>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="./statics/js/jquery.ajaxfileupload.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	$(function() {
		$('.upfileBox input[type="file"]').ajaxfileupload({
			'action': '/?g=DuoBao&m=Upload',
			'onComplete': function(response) {
				if(response.status == 1){
					
					$(this).parent().find('.input').val(response.path);
					$(this).parent().find('.imgshow').html('<img src="'+response.path+'" height="40"/>');
				}else{
					alert('上传失败，请联系管理员')
				}
				
			}
		});
	})
</script>
<script src="{$config_siteurl}statics/js/common.js"></script>
</body>
</html>