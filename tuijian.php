<?php
session_start();
require_once (dirname(__FILE__) . "/include/common.inc.php");
//CheckPurview('info_List');
require_once(DEDEINC."/datalistcp.class.php");
setcookie("ENV_GOBACK_URL",$dedeNowurl,time()+3600,"/");

//获取所在城市
$city = isset($_SESSION['city'])? $_SESSION['city'] : '厦门';
//获取城市下面推荐的明星和推荐学员

$sql  = "SELECT m.*,litpic,description,sfz,qtzj,zgz,work_experience,prize_good from `#@__member` as m left join `#@__archives` as a on m.mid=a.mid where (m.spacesta = 2 or m.spacesta = 3) and m.city = '" . $city . "' order by m.spacesta desc";
//echo $sql;
//更改之后不需要从archives中查找description 等信息，换句话说如果没有设置详细信息也可以展示出来
//$sql  = "SELECT * FROM `#@__member` where (spacesta = 2 or spacesta = 3) and city = '$city' order by spacesta desc";
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
function getFirst($name){
	return mb_substr($name,0,1,'utf-8');
}
function userPic($pic){
	if(empty($pic))
		$img = "<img src='/uploads/male.png' style='width:100%'/>";
	else
		$img = "<img src= '".$pic."'/ style='width:100%'>";
	return $img;
}
function rankSta($spacesta){
	$rank = array('2'=>'推荐教员','3'=>'明星教员');
	return $rank[$spacesta];
}
function biaoqian($biaoqian){
	$tags = "";
	if(!empty($biaoqian)){
		$biaoqians = explode(" ",$biaoqian);
		//删除多余空格
		$biaoqians = array_filter($biaoqians);
		foreach($biaoqians as $one)
			$tags.=("<span class='label label-default'>".$one."</span>&nbsp;&nbsp;");
	}
	if(empty($tags))
		$tags = "暂无标签";
	return $tags;
}