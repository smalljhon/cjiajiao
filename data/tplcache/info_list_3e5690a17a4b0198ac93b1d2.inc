<?php
if(!isset($GLOBALS['_vars'])) $GLOBALS['_vars'] = array(); 
$fields = array();
 
	if($show_mode == 'table'){
		//echo "table";
		echo '';
	}else{
		//echo "text";
		echo '';
	}
	?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $cfg_soft_lang; ?>">
<title>ѧԱ��Ϣ����</title>
<link href="css/base.css" rel="stylesheet" type="text/css">
<script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script language="javascript" src="js/member.js"></script>
<style type="text/css">
.rb{ border-right:1px solid #666666 }
.tb{ border-top:1px solid #666666 }
</style>
</head>
<body background='images/allbg.gif' leftmargin='8' topmargin='8'>
<table style="display:none">

<?php
           		foreach($feeStatistic as $k=>$data)
           		{
					echo "<tr>";
           			echo "<td>{$k}</td><td>{$data}</td>";
					echo "</tr>";
           		}
           	  ?>
</table>
<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#D6D6D6" style="margin-bottom:6px">
  <tr>
    <td height="30" align="center" bgcolor="#F9FCEF"> 
  <form action="info_list.php" name="form1" method="get" id="condForm">
	  <table border="0" cellspacing="0" cellpadding="3">
      <tr>
          <td>�ؼ��֣�</td>
          <td><input name="keyword" type="text" id="keyword" size="12" style="width:120px" value="<?php echo $GLOBALS['keyword']; ?>" /></td>
          <td>&nbsp;����</td>
          <td>
		        <select name="sortkey" id="sortkey" style="width:120px" onchange="changeCond()">
              <?php echo $GLOBALS['sort_form']; ?>
			  <option value="mid">mid/����ʱ��</option>
			  <option value="updatetime">����ʱ��</option>
              <option value="try_time">�Խ�ʱ��</option>
              <option value="huifang_time">�ط�ʱ��</option>
            </select>
          </td>
           <!-- ״̬ -->
           <td>
		      <select name="info_sta" id="info_sta" style="width:150px" onchange="changeCond()">
              <option value=''>--����״̬--</option>
              <?php
           		foreach($staArr as $k=>$v)
           		{
           			if($info_sta==$v) echo "<option value='$v' selected>$v</option>\r\n";
           			else echo "<option value='$v'>$v</option>\r\n";
           		}
           	  ?>
            </select></td>
            <!-- ���� -->
             <td>
		      <select name="city" id="city" style="width:150px" onchange="changeCond()">
               <option value=''>--����--</option>
              <?php
           		foreach($cityArr as $k=>$v)
           		{
           			if($city==$v) echo "<option value='$v' selected>$v</option>\r\n";
           			else echo "<option value='$v'>$v</option>\r\n";
           		}
           	  ?>
            </select></td>
          <!-- ��Դ -->
          <td>
          	<select name="info_from" id="info_from" style="width:100px" onchange="changeCond()">
               <option value=''>--��Ϣ��Դ--</option>
               <?php
           		foreach($InfoSourceModel as $k=>$v)
           		{
           			if($info_from==$v) echo "<option value='$v' selected>$v</option>\r\n";
           			else echo "<option value='$v'>$v</option>\r\n";
           		}
           	   ?>
             </select>
          </td>
          <!-- ��ʾ��ʽ -->
          <td>
		  <?php echo $show_mode;?>
          	<select name="show_mode" id="show_mode" style="width:100px" onchange="changeCond()">
               <option value="table" <?php if($show_mode=='table') echo 'selected';?>>����</option>
              <option value="text" <?php if($show_mode=='text') echo 'selected';?>>����</option>
             </select>
          </td>
         
         <td>
           <input name="imageField" class="np" type="image" src="images/button_search.gif" width="60" height="22" border="0" />
          </td>
        </tr>
      </table>
	  </form>
    </td>
  </tr>
</table>
<form name="form2">
<table width="98%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#cfcfcf">
  <tr> 
  <td height="28" colspan="16" background="images/tbg.gif">
   <table width="99%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td width="29%" style="padding-left:10px;"><strong>ѧԱ��Ϣ�б�</strong></td>
       <td width="71%" align="right">
          <a href="info_list.php">����ѧԱ��Ϣ</a> |
          <a href="info_list.php?info_sta=������">������</a> |
          <a href="info_list.php?info_sta=�Խ���">�Խ���</a> |
          <a href="info_list.php?info_sta=�Խ��ɹ�">�Խ��ɹ�</a> |
          <a href="info_list.php?info_sta=�ѻط�">�ѻط�</a> |
          <a href="info_list.php?info_sta=����">����</a> |
          <a href="info_list.php?info_sta=������">������</a> &nbsp;
       </td>
     </tr>
  </table>
 </td>
</tr>
  <tr bgcolor="#FEFCEF" height="30" align="center"> 
    <!-- <td width="2%">ѡ��</td> -->
    <!--<td width="3%">mid</td>-->
    <td width="5%">���</td>
    <td width="6%">��������</td>
	<td width="5%">����</td>
    <td width="34%">��Ϣ</td>
    <td width="14%">��ϵ��ʽ</td>
    <td width="5%">��Ϣ��</td>
    <td width="5%">״̬</td>
    <!--<td width="5px">��Դ</td>-->
    <td width="10%">��ע</td>
    <!--<td width="5%">����ʱ��</td>
    <td width="10%">�ӵ�����</td>-->
    <td width="5%">�Խ�ʱ��</td>
    <td width="5%">�Խ�����</td>
    <!--<td width="5%">�ط�ʱ��</td>
    <td width="8%">�ط÷���</td>-->
    <td width="8%">����</td>
  </tr>
<?php
$atts = array();
$atts['tagname'] = 'datalist';
$blockValue = $this->refObj->GetArcList($atts,$this->refObj,$fields); 
if(is_array($blockValue)){
foreach( $blockValue as $key=>$fields )
{
 
	if($show_mode == 'table'){
?>
<tr height="26" align="center" bgcolor="#FFFFFF" onMouseMove="javascript:this.bgColor='#FCFDEE';"
  	 onMouseOut="javascript:this.bgColor='#FFFFFF';"> 
  <!-- <td><input name="mid" type="checkbox" id="mid" value="<?php echo $fields['mid']; ?>" class="np" /></td> -->
  <!--<td><?php echo $fields['mid']; ?></td>-->
  <td><?php echo $fields['bianhao']; ?></td>
  <td><?php echo MyDate('y-m-d H:i',$fields['createtime']); ?></td>
  <td><?php echo $fields['city']; ?></td>
  <td style="text-align:left"><span style="color:red">��Ϣ:</span><?php echo $fields['requirement']; ?>
  <br/><span style="color:red">վ��:</span><?php echo $fields['bus_stop']; ?>
  <br/><span style="color:red">Ҫ��:</span><?php echo $fields['info_cond']; ?></td>
  <td><?php echo $fields['contact_name1']; ?>:<?php echo $fields['tel1']; ?><br/>
	<?php if($fields['contact_name2']!=""){  echo $fields['contact_name2']; ?>:<?php echo $fields['tel2'];  } ?>
  </td>
  <td><?php echo $fields['info_fee']; ?></td>
  <!-- ״̬ -->
  <td>
	<?php echo Status($fields['status']); ?>
	<input type="hidden" id="<?php echo $fields['mid']; ?>" value="<?php echo $fields['mid']; ?>"/>
  </td>
<!--<td> <?php echo $fields['from_source']; ?></td>-->
<td> <?php echo $fields['remark']; ?></td>
<!--<td> <?php echo MyDate('y-m-d H:i',$fields['updatetime']); ?></td>-->
<!--<td> <!--<textarea name="ac_feedback_<?php echo $fields['mid']; ?>" id="ac_feedback_<?php echo $fields['mid']; ?>" onblur="update_field(<?php echo $fields['mid']; ?>,'ac_feedback')"><?php echo $fields['ac_feedback']; ?></textarea>--><!--<?php echo $fields['ac_feedback']; ?></td>-->
<td>
<?php if($fields['try_time']>0){  echo MyDate('y-m-d H:i',$fields['try_time']);  } ?>
</td>
<td>
<?php echo $fields['try_status']; ?>
</td>
<!--<td><?php echo $fields['try_feedback']; ?></td>
<td> 
<?php if($fields['huifang_time']!=""){  echo MyDate('y-m-d H:i',$fields['huifang_time']);  } ?>
</td>
<td> <?php echo $fields['huifang_record']; ?></td>-->
<!-- c���� -->
  <td align="center">
    <a href="info_view.php?id=<?php echo $fields['mid']; ?>">�༭</a>|<br/> 
    <a href="info_do.php?id=<?php echo $fields['mid']; ?>&dopost=delinfo">ɾ��</a>|<br/> 
	<a href="info_do.php?id=<?php echo $fields['mid']; ?>&dopost=copy">����</a>
  </td>
</tr>
<?php }else{
?>
<p>
���:<?php echo $fields['bianhao']; ?><br/>
��Ϣ:<?php echo $fields['requirement']; ?><br/>
�ص�:<?php echo $fields['bus_stop']; ?><br/>
Ҫ��:<?php echo $fields['info_cond']; ?><br/>
��Ϣ��:<?php echo $fields['info_fee']; ?><br/><br/>
</p>
<?php
}

}
}?> 
<!-- 
<tr bgcolor="#ffffff"> 
 <td height="36" colspan="9">
	&nbsp;
	<a href="javascript:selAll()" class="coolbg">ȫѡ</a>
	<a href="javascript:noSelAll()" class="coolbg">ȡ��</a>
	<a href="javascript:delArc(0)" class="coolbg">&nbsp;ɾ��&nbsp;</a>
</td>
</tr>
 -->
<tr bgcolor="#F9FCEF"> 
 <td height="36" colspan="16" align="center">
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
function changeCond(){
	document.getElementById('condForm').submit();
}
//����һЩ�ֶ�
function update_field(id, field){
	var value = document.getElementById(field + "_" + id).value;
	$.ajax({
		type:'get',
		url:"info_do.php",
		data:"mid=" + id + "&value=" + value + "&field="+field,
		dataType : 'text',
		success : function(){
		}
	});
}
//ֱ���޸�״̬
function change_status(id){
	 
}
$(document).ready(function(){
	$(".info_status").change(function(){
		var status = $(this).children('option:selected').val();
		var mid = $(this).next().val();
		$.ajax({
			type:'get',
			url:"info_do.php",
			data:"act=change_status&mid=" + mid + "&status=" + status,
			dataType : 'text',
			success : function(res){
				alert(res);
			}
	});
	});
});
</script>
</html>