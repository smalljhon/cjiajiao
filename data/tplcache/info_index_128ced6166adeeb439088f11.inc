<?php
if(!isset($GLOBALS['_vars'])) $GLOBALS['_vars'] = array(); 
$fields = array();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $cfg_soft_lang; ?>">
<title>ѧԱ��Ϣ����</title>

<!-- �� Bootstrap ���� CSS �ļ� -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- ��ѡ��Bootstrap�����ļ���һ�㲻�����룩 -->
<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link href="./templets/default/css/base.css" rel="stylesheet" type="text/css">
<!-- jQuery�ļ��������bootstrap.min.js ֮ǰ���� -->
<script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>

<!-- ���µ� Bootstrap ���� JavaScript �ļ� -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script language="javascript" src="js/member.js"></script>
<style type="text/css">
.rb{ border-right:1px solid #666666 }
.tb{ border-top:1px solid #666666 }
</style>
</head>
<body background='images/allbg.gif' leftmargin='8' topmargin='8' style="font-family='΢���ź�'">
<!-- ͷ��nav -->
<?php include $this->CompilerInclude("header_nav.htm");
 ?>
<!-- ͷ��nav -->
<div class="header" style="background-image: url(http://static.bootcss.com/expo/img/d/dd/2de797545de56274f03a5920eb3a1.jpg)">
  <div class="logoimg">
    <a href="" title="Bootstrap ��վ��ѡ"><img src="" alt="Bootstrap ��վ��ѡ" width="78"></a>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
      <div class="logotxt"><h1><a href="info_index.php">College�ҽ�</a></h1></div> 
      <h2 class="site-name text-center">��Ϣ��ѡ<span>www.cjiajiao.com</span></h2>

    </div>
  </div>

</div>
</div>
<div class="container">
	<?php $i = 0;
$atts = array();
$atts['tagname'] = 'datalist';
$blockValue = $this->refObj->GetArcList($atts,$this->refObj,$fields); 
if(is_array($blockValue)){
foreach( $blockValue as $key=>$fields )
{
 $i++;?>
		<div class="col-xs-12 col-md-4 col-sm-6" style="float:left;<?php if($i%3==1) echo 'clear:both;';?>">
			<div class="thumbnail" >
      			<div class="caption">
        			<h3 style="text-align:center;color:#2586fa">��ţ�<?php echo $fields['mid']; ?></h3>
        			<p style="padding-bottom:20px;font-size:15px;"><?php echo $fields['requirement']; ?></p>
        			<p style="padding-bottom:20px;font-size:12px;"><span class="label label-default">Ҫ��</span>&nbsp;&nbsp;<?php echo $fields['info_cond']; ?></p>
        			<p style="border-bottom:1px solid #eee;padding-bottom:20px;font-size:10px;text-align:left">
        			<span class="label label-default">վ��</span>&nbsp;&nbsp;<?php echo $fields['bus_stop']; ?>&nbsp;&nbsp;
        			</p>
        			<p style="text-align:center">
        			<a class="btn btn-lg btn-default btn-getting-started" href="javascript:void" role="button">��Ϣ�� &nbsp;&nbsp;<?php echo $fields['info_fee']; ?></a></p>
      			</div>
    		</div>
		</div>
		<?php
}
}?>

</div>

<tr bgcolor="#F9FCEF"> 
 <td height="36" colspan="9" align="center">
	<?php
$atts = array();
$atts['tagname'] = 'pagelist';
$atts['listsize'] = '6';
 echo $this->refObj->GetPageList($atts,$this->refObj,$fields); 
?>

 </td>
</tr>
</table>
</form>
<!-- ͷ��nav -->
<?php include $this->CompilerInclude("footer.htm");
 ?>
<!-- ͷ��nav -->
</body>
</html>