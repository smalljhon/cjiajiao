<?php
session_start();
require_once (dirname(__FILE__) . "/include/common.inc.php");
//CheckPurview('info_List');
require_once(DEDEINC."/datalistcp.class.php");
setcookie("ENV_GOBACK_URL",$dedeNowurl,time()+3600,"/");

//获取所在城市
$city = isset($_SESSION['city'])? $_SESSION['city'] : '厦门';
//获取城市下面推荐的明星和推荐学员

$sql  = "SELECT m.*,litpic,description,sfz,qtzj,zgz,work_experience,prize_good from `#@__member` as m,`#@__archives` as a where (m.spacesta = 2 or m.spacesta = 3) and m.mid = a.mid and m.city = '" . $city . "' order by m.spacesta desc";
$dlist = new DataListCP();//分页用
$dlist->SetParameter('city',$city);
$dsql->SetQuery($sql);
$dsql->Execute();

$dlist->SetTemplet("./templets/home/recommend.html");
$dlist->SetSource($sql);
$dlist->display();
function emptyConvert($value){
	return (empty($value))?"无":$value;
}