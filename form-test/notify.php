<?php
/// 文件上传后的服务端异步回调（又拍云存储系统自动尝试3次请求）
/// (回调过来的所有信息均为 UTF-8 编码，签名验证的时候需要注意编码是否一致)
$form_api_secret = 'xxxxxx'; /// 表单 API 功能的密匙（请访问又拍云管理后台的空间管理页面获取）

if(!isset($_POST['code']) || !isset($_POST['message']) || !isset($_POST['url']) || !isset($_POST['time'])){
	header('HTTP/1.1 403 Not Access');
	die();
}
if(isset($_POST['sign'])){ /// 正常签名
	if(md5("{$_POST['code']}&{$_POST['message']}&{$_POST['url']}&{$_POST['time']}&".$form_api_secret) == $_POST['sign']){
		/// 合法的上传回调
		if($_POST['code'] == '200'){
			/// 上传成功
			/// 进行用户上传文件的记录等操作
			die('ok');
		}else{
			/// 上传失败
			die('false');
		}
	}else{
		/// 回调的签名错误
		header('HTTP/1.1 403 Not Access');
		die();
	}
}elseif(isset($_POST['non-sign'])){ /// 缺少操作员密码的签名
	if(md5("{$_POST['code']}&{$_POST['message']}&{$_POST['url']}&{$_POST['time']}&") == $_POST['non-sign']){
		/// 合法的上传回调

		/// 上传失败
		die('false');
	}else{
		/// 回调的签名错误
		header('HTTP/1.1 403 Not Access');
		die();
	}
}else{
	header('HTTP/1.1 403 Not Access');
	die();
}