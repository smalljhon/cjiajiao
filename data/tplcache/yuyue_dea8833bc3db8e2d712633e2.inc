<?php
if(!isset($GLOBALS['_vars'])) $GLOBALS['_vars'] = array(); 
$fields = array();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $cfg_soft_lang; ?>">
<title>申请退款记录</title>
<link href="css/base.css" rel="stylesheet" type="text/css">
<script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script language="javascript" src="js/member.js"></script>
<style type="text/css">
.rb{ border-right:1px solid #666666 }
.tb{ border-top:1px solid #666666 }
</style>
</head>
<body background='images/allbg.gif' leftmargin='8' topmargin='8'>
<!--筛选结果-->
<form name="form2" action="fee_back.php" method="post">
<table width="1200px" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#cfcfcf">
  <tr bgcolor="#FEFCEF" height="30" align="center"> 
    <!-- <td width="2%">选择</td> -->
    <td width="5%">编号</td>
    <td width="5%">城市</td>
    <!-- <td width="5%">姓名</td> -->
    <td width="5%">电话</td>
    <td width="10%">年级</td>
    <td width="15%">学科</td>
    <td width="4%">提交时间</td>
    <td width="4%">处理时间</td>
	<td width="5%">处理状态</td>
    <td width="18%">处理结果说明</td>
    <!--<td>操作</td>-->
  </tr>
<?php
$atts = array();
$atts['tagname'] = 'datalist';
$blockValue = $this->refObj->GetArcList($atts,$this->refObj,$fields); 
if(is_array($blockValue)){
foreach( $blockValue as $key=>$fields )
{
?> 
<tr height="26" align="center" bgcolor="#FFFFFF" onMouseMove="javascript:this.bgColor='#FCFDEE';"
  	 onMouseOut="javascript:this.bgColor='#FFFFFF';"> 
  <td><?php echo $fields['mid']; ?></td>
  <!--<td><?php echo $fields['tel']; ?></td>-->
  <td><?php echo $fields['city']; ?></td>
  
  <td><?php echo $fields['tel']; ?></td>
  <td><?php echo $fields['nianji']; ?></td>
  <td><?php echo $fields['subject']; ?></td>
  <td><?php echo $fields['apply_time']; ?></td>
	<td><?php echo $fields['deal_time']; ?></td>
  <td>
  <?php echo Status($fields['deal_status']); ?>
  <input type="hidden" id="<?php echo $fields['mid']; ?>" value="<?php echo $fields['mid']; ?>"/>
  </td>
  <td><textarea id="result<?php echo $fields['mid']; ?>" name="result<?php echo $fields['mid']; ?>"><?php echo $fields['deal_content']; ?></textarea>
  </td>
  
</tr>
<?php
}
}?> 

<tr bgcolor="#F9FCEF"> 
 <td height="36" colspan="15" align="center">
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
</body>
<script type="text/javascript">
$(document).ready(function(){
	$(".deal_status").change(function(){
		var status = $(this).children('option:selected').val();
		var mid = $(this).next().val();
		var result = document.getElementById("result"+mid).value;
		$.ajax({
			type:'get',
			url:"yuyue.php",
			data:"dopost=set_status&mid=" + mid + "&status=" + status + "&result="+result,
			dataType : 'text',
			success : function(res){
				alert(res);
				window.location.reload();
			}
	});
	});
});
</script>
</html>