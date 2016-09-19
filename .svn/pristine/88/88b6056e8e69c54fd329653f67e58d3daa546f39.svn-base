<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <div class="nav">
    <ul class="cc">
        <li><a href="{:U('Manager/goods')}" >商品管理</a></li>
        <li  class="current"><a href="{:U('Manager/goods_add')}" >添加商品</a></li>
      </ul>
</div>
  <form name="myform" action="{:U('Manager/goods_add')}" method="post" class="J_ajaxForm">
  <div class="table_full">
  <table width="100%" class="table_form">
  	
		<tr>
			<th width="120">名称</th> 
			<td><input type="text" name="name"  class="input" id="name"/></td>
		</tr>
		<tr>
			<th width="120">场次</th> 
			<td>
			<input type='text' name="paynum"  class="input" id="paynum" value="0" /> 场（ 0为无限次 ） ,
			上架<input type="checkbox" name="putstatus"  class="input" id="putstatus" value="1" checked="checked" />,
			允许晒单<input type="checkbox" name="single"  class="input" id="single" value="0" checked="checked" />
			自动开启场次<input type="checkbox" name="autopay"  class="input" id="autopay" value="1" checked="checked" />
			</td>
		</tr>
		<tr>
			<th width="120">所属商家ID</th> 
			<td>
				<select name="sid" id="sid">
				<option value="0">==平台商品==</option>
				<foreach name="shops" item="vo">
	            <option value="{$vo.id}">{$vo.name}</option>
	            </foreach>
	          </select>
			</td>
		</tr>
		<tr>
			<th width="120">价格</th> 
			<td><input type="number" name="money"  class="input" id="money"/></td>
		</tr>
		
		<tr>
			<th width="120">原价</th> 
			<td><input type='number' name="orgprice"  class="input" id="orgprice"/></td>
		</tr>
		<tr>
			<th width="120">类型</th> 
			<td><select name="typeid" id="typeid">
			<foreach name="type" item="vo">
            <option value="{$vo.id}">{$vo.typename}</option>
            </foreach>
          </select></td>
		</tr>
		<tr class="upfileBox">
			<th width="120">缩略图</th> 
			<td><input type="text" name="thumb"  class="input" style="width: 300px;" id="thumb"/> 
				<input type="file" name="upload" value="" />
				<div class="imgshow"></div>
				</td>
		</tr>
		<tr class="upfileBox">
			<th width="120">轮换图1</th> 
			<td><input type="text" name="pic[]"  class="input" style="width: 300px;"/> 
				<input type="file" name="upload" value="" /><div class="imgshow"></div></td>
		</tr>
		<tr class="upfileBox">
			<th width="120">轮换图2</th> 
			<td><input type="text" name="pic[]"  class="input" style="width: 300px;"/> 
				<input type="file" name="upload" value="" /><div class="imgshow"></div></td>
		</tr>
		<tr class="upfileBox">
			<th width="120">轮换图3</th> 
			<td><input type="text" name="pic[]"  class="input" style="width: 300px;"/> 
				<input type="file" name="upload" value="" />
				<div class="imgshow"></div>
				</td>
		</tr>

		<tr>
			<th width="120">详情</th> 
			<td><span class="must_red">*</span><div id='content_tip'></div><script type="text/plain" id="content" name="detail"><p></p></script>
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