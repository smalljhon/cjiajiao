<?php
if(!isset($GLOBALS['_vars'])) $GLOBALS['_vars'] = array(); 
$fields = array();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $cfg_soft_lang; ?>" />
<title><?php echo $GLOBALS['_vars']['spacename'];  echo $GLOBALS['_vars']['curtitle']; ?></title>
<meta name="author" content="<?php echo $GLOBALS['_vars']['uname']; ?>"/>
<link href="space/person/blue/style.css" rel="stylesheet" type="text/css" />
<link href="blue/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
//δ��¼��ʾ��head
if(!$cfg_ml->IsLogin()) {
?>
<div id="headTop" class="aGray grayA">
  <div class="logo" onclick="location='/'" title="��վ��ҳ"> </div>
  <div id="topBar">
    <ul class="userMenu green">
      <li><a href="../" title="��վ��ҳ">��վ��ҳ</a></li>
      <li><a href="../member/index_do.php?fmdo=user&dopost=regnew" title="ע��">ע��</a></li>
      <li><a href="../member/login.php" title="��¼">��¼</a></li>
      <li class="help"><a href="http://help.dedecms.com" title="DEDECMS ��������">����</a></li>
    </ul>
    <span>
    <script type="text/javascript">
      var now=(new Date()).getHours();
			if(now>0&&now<=6){
				document.write("��ҹ�ã�");
			}else if(now>6&&now<=11){
				document.write("���Ϻã�");
			}else if(now>11&&now<=14){
				document.write("����ã�");
			}else if(now>14&&now<=18){
				document.write("����ã�");
			}else{
				document.write("���Ϻã�");
			}
			</script>
    <i>�ο�</i>�����ѡ��</span> </div>
</div>
<?php
}
//��¼����ʾ��head
else {
?>
<div id="headTop" class="aGray grayA">
  <div class="logo" onclick="location='/'" title="��վ��ҳ"> </div>
  <div id="topBar">
    <ul class="userMenu green">
      <li><a href="../" title="��վ��ҳ">��վ��ҳ</a></li>
      <li><a href="../member/edit_baseinfo.php" title="�ҵ�����">�ҵ�����</a></li>
      <li><a href="<?php echo $myurl; ?>" title="�ҵĿռ�">�ҵĿռ�</a></li>
      <li><a href="../member/index_do.php?fmdo=login&dopost=exit" title="ע��">ע��</a></li>
      <li class="help"><a href="http://help.dedecms.com" title="DEDECMS ��������">����</a></li>
    </ul>
    <span>
    <script type="text/javascript">
           	var now=(new Date()).getHours();
			if(now>0&&now<=6){
				document.write("��ҹ�ã�");
			}else if(now>6&&now<=11){
				document.write("���Ϻã�");
			}else if(now>11&&now<=14){
				document.write("����ã�");
			}else if(now>14&&now<=18){
				document.write("����ã�");
			}else{
				document.write("���Ϻã�");
			}
			</script>
    <i><?php echo $cfg_ml->M_UserName?></i></span> </div>
</div>
<?php
}
?>
<div id="head" class="wrapper">
  <div id="spaceName" class="whiteA aWhite">
    <h1><a href="<?php echo $GLOBALS['_vars']['userurl']; ?>"><?php echo $GLOBALS['_vars']['spacename']; ?></a></h1>
    <p><?php echo $myurl; ?></p>
  </div>
  <ul id="navMenu" class="fLeftChild">
    <li class="thisClass"><a href="index.php?uid=<?php echo $GLOBALS['_vars']['userid_e']; ?>"><span>��ҳ</span></a></li>
    <li><a href="index.php?uid=<?php echo $GLOBALS['_vars']['userid_e']; ?>&action=article"><span>����</span></a></li>
    <?php
		foreach($_vars['bloglinks'] as $k=>$v)
		{
			if($k==2) {
				echo "		<li><a href=\"index.php?uid={$_vars['userid_e']}&action=album\"><span>���</span></a></li>\r\n";
			}
			else {
				echo "		<li><a href=\"index.php?uid={$_vars['userid_e']}&action=archives&channelid={$k}\"><span>{$v}</span></a></li>\r\n";
			}
		}
		?>
    <li><a href="index.php?uid=<?php echo $GLOBALS['_vars']['userid_e']; ?>&action=infos"><span>��������</span></a></li>
    <li><a href="index.php?uid=<?php echo $GLOBALS['_vars']['userid_e']; ?>&action=guestbook"><span>���԰�</span></a></li>
  </ul>
</div>
<div id="navChild"></div>
<div class="clearfix"></div>