<?php
/// (回调中的所有信息均为 UTF-8 编码，签名验证的时候需要注意编码是否一致)
$bucket = 'pubimgs'; /// 空间名
$form_api_secret = 'xxxxxx'; /// 表单 API 功能的密匙（请访问又拍云管理后台的空间管理页面获取）

$options = array();
$options['bucket'] = $bucket; /// 空间名
$options['expiration'] = time()+600; /// 授权过期时间
$options['save-key'] = '/{year}/{mon}/{random}{.suffix}'; /// 文件名生成格式，请参阅 API 文档
$options['allow-file-type'] = 'jpg,jpeg,gif,png'; /// 控制文件上传的类型，可选
$options['content-length-range'] = '0,1024000'; /// 限制文件大小，可选
$options['image-width-range'] = '100,1024000'; /// 限制图片宽度，可选
$options['image-height-range'] = '100,1024000'; /// 限制图片高度，可选
//$options['return-url'] = 'http://localhost/form-test/return.php'; /// 页面跳转型回调地址
//$options['notify-url'] = 'http://a.com/form-test/notify.php'; /// 服务端异步回调地址, 请注意该地址必须公网可以正常访问

$policy = base64_encode(json_encode($options));
$sign = md5($policy.'&'.$form_api_secret); /// 表单 API 功能的密匙（请访问又拍云管理后台的空间管理页面获取）

?>
<form action="http://v0.api.upyun.com/<?php echo $bucket?>/" method="post" enctype="Multipart/form-data">
	<input type="hidden" name="policy" value="<?php echo $policy?>">
	<input type="hidden" name="signature" value="<?php echo $sign?>">
	<input type="file" name="file">
	<input type="submit">
</form>