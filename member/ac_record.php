<?php
/**
 * @version        $Id: edit_baseinfo.php 1 8:38 2010年7月9日Z tianya $
 * @package        DedeCMS.Member
 * @copyright      Copyright (c) 2007 - 2010, DesDev, Inc.
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__)."/config.php");
CheckRank(0,0);
$menutype = 'config';
if(!isset($dopost)) $dopost = '';

//获取接单记录
$dsql->SetQuery("Select * From `#@__ac_record` where user_id =" . $cfg_ml->M_ID);
$dsql->Execute();

$aclist;
while($row = $dsql->GetArray())
{
	$aclist[] = $row;
}

//如果是提交接单记录
if($dopost=='add')
{
    //判断数据的正确性
    if(isset($bianhao)) 
    	$bianhao = htmlspecialchars_decode($bianhao);
    if(isset($ac_feedback))
    	$ac_feedback = htmlspecialchars_decode($ac_feedback);
    
    if(empty($bianhao)){
    	ShowMsg('信息编号不能为空','-1');
    	exit();
    }
    if(empty($ac_feedback)){
    	ShowMsg('接单反馈不能为空','-1');
    	exit();
    }
	if(empty($try_time)){
    	ShowMsg('试讲时间不能为空','-1');
    	exit();
    }
	if(empty($try_address)){
    	ShowMsg('试讲地址不能为空','-1');
    	exit();
    }
    
    //该编号的正在安排中的信息是否存在
    $info = $dsql->GetOne("SELECT * FROM `#@__member_xueyuan` WHERE bianhao = '" . $bianhao . "'");
    if(empty($info)){
    	ShowMsg('不存在编号为'.$bianhao.'的学员信息，有可能该信息已经被他人接下','ac_record.php',0,1000);
    	exit;
    }
    //$ac_time = mktime();
    $info_id = $info['mid'];
    $info_bianhao = $info['bianhao'];
    $user_id = $cfg_ml->M_ID;
	$try_time = strtotime($try_time);
    
    //查看是否已经提交过反馈
    $ac_record = $dsql->GetOne("SELECT * FROM `#@__ac_record` WHERE info_bianhao= '" . $bianhao . "' AND user_id = " . $user_id);
    if(empty($ac_record))
    	//添加到数据库
    $query = "INSERT INTO `#@__ac_record`(`user_id`,`info_id`,`info_bianhao`,`ac_feedback`,`try_time`,`try_address`) VALUES('$user_id','$info_id','$info_bianhao','$ac_feedback','$try_time','$try_address')";
    else
    	$query = "UPDATE `#@__ac_record` SET ac_feedback = '$ac_feedback', try_time='$try_time', try_address='$try_address' WHERE info_bianhao= '" . $bianhao . "' AND user_id = " . $user_id;        
    
    $rs = $dsql->ExecuteNoneQuery2($query);
    //echo $rs."rs";
    if($rs==1){
    	 // 清除会员缓存
    	//$cfg_ml->DelCache($cfg_ml->M_ID);
    	$dsql->ExecuteNoneQuery("UPDATE `#@__member_xueyuan` SET ac_feedback = '" . $ac_feedback . "'," . "ac_mid = " . $cfg_ml->M_ID .
    			", try_time = '" . $try_time . "', try_address = '". $try_address ."' WHERE bianhao = '" . $info_bianhao . "'");
    	ShowMsg('接单记录增加成功','ac_record.php',0,1000);
    	exit();
    }else{
    	ShowMsg('接单记录增加失败','ac_record.php',0,1000);
    	exit();
    }
   
}
include(DEDEMEMBER."/templets/ac_record.htm");