<?php
require_once(dirname(__FILE__)."/config.php");
//CheckPurview('info_List');
require_once(DEDEINC."/datalistcp.class.php");
setcookie("ENV_GOBACK_URL",$dedeNowurl,time()+3600,"/");
 
if(empty($dopost)) $dopost = '';

if($dopost == 'set_status'){
	$id = intval($_GET['mid']);
	$status = trim($_GET['status']);
	$deal_result = trim($_GET['result']);
	if(empty($status)){
		echo '����ʧ��';
		exit;
	}
	$query = "UPDATE `#@__requirements` SET deal_status = '" . $status . "', deal_content='$deal_result', deal_time=NOW() where mid = " .$id;		
	$rs = $dsql->ExecuteNoneQuery2($query);
	if($rs==1){
		echo '����״̬�ɹ�';
		exit;	
	}else{
		echo '����״̬ʧ��';
		exit;
	}
		
}


$sql  = "SELECT * FROM `#@__requirements` where 1=1 order by mid desc";

$dlist = new DataListCP();//��ҳ��

$dlist->SetTemplet(DEDEADMIN."/templets/yuyue.htm");
$dlist->SetSource($sql);
$dlist->display();
//����״̬
function Status($status)
{
	//�˿�״̬
	$dealSta = array(1=>'δ����', 2=>'�Ѵ���');
	$html = "<select class='deal_status' name='deal_status' style='width:80px'>";
           
    foreach($dealSta as $k=>$v)
    {
         if($status==$v) $html.="<option value='$v' selected>$v</option>\r\n";
         else $html.="<option value='$v'>$v</option>\r\n";
    }

    $html.='</select>';
	return $html;
}

function GetMemberName($rank,$mt)
{
	global $MemberTypes;
	if(isset($MemberTypes[$rank]))
	{
		if($mt=='ut') return " <font color='red'>��������".$MemberTypes[$rank]."</font>";
		else return $MemberTypes[$rank];
	} else {
		if($mt=='ut') return '';
		else return $mt;
	}
}

function GetMAtt($m)
{
	if($m<1) return '';
	else if($m==10) return "&nbsp;<font color='red'>[����Ա]</font>";
	else return "&nbsp;<img src='images/adminuserico.gif' wmidth='16' height='15'><font color='red'>[��]</font>";
}