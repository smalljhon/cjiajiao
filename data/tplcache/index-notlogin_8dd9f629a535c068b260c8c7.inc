<?php
if(!isset($GLOBALS['_vars'])) $GLOBALS['_vars'] = array(); 
$fields = array();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $cfg_soft_lang; ?>" />
<title><?php echo $cfg_webname; ?>- ��Ա��¼</title>
<link href="templets/style/div.css" rel="stylesheet" type="text/css" />
<link href="templets/style/IN365hls2.9.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="templets/style/header2_9.css"></head>
<link href="templets/style/login.css" rel="stylesheet" type="text/css" />
<!-- �� Bootstrap ���� CSS �ļ� -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- ��ѡ��Bootstrap�����ļ���һ�㲻�����룩 -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- jQuery�ļ��������bootstrap.min.js ֮ǰ���� -->
<script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>

<!-- ���µ� Bootstrap ���� JavaScript �ļ� -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script language="javascript" src="../dede/js/member.js"></script>
<style type="text/css">
.rb{ border-right:1px solid #666666 }
.tb{ border-top:1px solid #666666 }
</style>


<script src="templets/js/j.js" language="javascript" type="text/javascript"></script>
<script type="text/javascript">
function changeAuthCode() {
	var num = 	new Date().getTime();
	var rand = Math.round(Math.random() * 10000);
	num = num + rand;
	$('#ver_code').css('visibility','visible');
	if ($("#vdimgck")[0]) {
		$("#vdimgck")[0].src = "../include/vdimgck.php?tag=" + num;
	}
	return false;
}

</script>
</head>
<body>
<!-- ͷ��nav -->

<!-- ͷ��nav -->
<div id="content" class="container">
	<div class="row" id="ny-member-nr" style="margin:0 auto">
	<div class="col-md-offset-3 col-md-6">
	
	<div class="panel panel-default" style="margin-top:30px">
  		<div class="panel-heading">��¼</div>
  		<div class="panel-body">
  		<div class="row" style="text-align:center;margin-bottom:20px">
  			<img src="../templets/default/images/logo.jpg" style="width:300px;height:200px;"/>
  			</div>
    		<form name='form1' method='POST' action='/member/index_do.php' class="form-horizontal">
      <input type="hidden" name="fmdo" value="login">
      <input type="hidden" name="dopost" value="login">
      <input type="hidden" name="gourl" value="<?php if(!empty($gourl)) echo $gourl;?>">
      
       <div class="form-group">
    	<label for="txtUsername" class="col-sm-3 control-label">�û���</label>
    		<div class="col-sm-9">
      			<input id="txtUsername" class="text login_from from-control" type="text" name="userid" style="width:70%">
    		</div>
  		</div>
  		<div class="form-group">
   		 	<label for="txtPassword" class="col-sm-3 control-label">��&nbsp;&nbsp;&nbsp;��</label>
    		<div class="col-sm-9">
      			<input id="txtPassword" class="text  form-control" type="password" name="pwd" style="width:70%"/>
    		</div>
  		</div>
  		<div class="form-group">
   		 	<label for="vdcode" class="col-sm-3 control-label">��֤��</label>
    		<div class="col-sm-9">
      			 <input id="vdcode" class="text login_from3 form-control" type="text" style="width: 100px; text-transform: uppercase;" name="vdcode"/>
          		<img id="vdimgck" align="absmiddle" onclick="this.src=this.src+'?'" style="cursor: pointer;" alt="�����壿�������" src="../include/vdimgck.php"/>
           		�����壿 <a href="#" onclick="changeAuthCode();">�������</a>
    		</div>
  		</div>
  		<div class="form-group">
  			<label for="ra1" class="col-sm-3 control-label">��Ч��</label>
    		<div class="col-sm-9">    			
      			<div class="checkbox">
        			<input type="radio" value="2592000" name="keeptime" id="ra1"/>
          			<label for="ra1">һ����</label>
          			<input type="radio" checked="checked" value="604800" name="keeptime" id="ra2"/>
          			<label for="ra2">һ��</label>
          			<input type="radio" value="86400" name="keeptime"  id="ra3"/>
          			<label for="ra3">һ��</label>
          			<input type="radio" value="0" name="keeptime"  id="ra4"/>
          			<label for="ra4">��ʱ</label></li>
     			 </div>
    		</div>
  		</div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" id="btnSignCheck" class="button2 btn btn-default" type="submit">��&nbsp;¼</button><!--  <a href="../member/resetpassword.php">�������룿</a> -->
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      	û���˺ţ�&nbsp;&nbsp;<a href="/member/index_do.php?fmdo=user&dopost=regnew">���ע��</a>
    </div>
  </div>

    </form>
  		</div>
	</div>
	</div>
	</div>

</div>

<?php include("../templets/default/footer.htm"); ?>

</body>
</html>