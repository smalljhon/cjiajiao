<?php
/**
 * 学员信息管理操作
 *
 * @version        $Id: member_do.php 1 13:47 2010年7月19日Z tianya $
 * @package        DedeCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, DesDev, Inc.
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__)."/config.php");
require_once(DEDEINC."/oxwindow.class.php");
if(empty($dopost)) $dopost = '';
if(empty($fmdo)) $fmdo = '';
$ENV_GOBACK_URL = isset($_COOKIE['ENV_GOBACK_URL']) ? 'info_list.php' : '';

$field = empty($_GET['field'])?'':$_GET['field'];
$value = empty($_GET['value'])?'':trim($_GET['value']);
//列表中修改状态
$act = empty($_GET['act'])?'':trim($_GET['act']);

if(!empty($field)&&!empty($value)){
	$update_time = mktime();
	$setSql = "";
	$mid = intval($_GET['mid']);

	if($field == 'remark'){
		$setSql .= "remark = '{$value}',";
	}else if($field == 'ac_feedback'){
		$setSql .= "ac_feedback = '{$value}',";
	}else if($field == 'try_feedback'){
		$setSql .= "try_feedback = '{$value}',";
	}else if($field == "huifang_record"){
		$setSql .= "huifang_record = '{$value}',";
	}

	$setSql .= "updatetime = " . $update_time;
	$query = "UPDATE `#@__member_xueyuan` SET " . $setSql . " where mid = " . $mid;
            
    $rs = $dsql->ExecuteNoneQuery2($query);
    //echo $query;
    if($rs==1){
    	//ShowMsg('成功更改会员资料！', 'info_list.php');
    	exit();
    }else{
    	//ShowMsg('更新失败！', 'info_list.php');
    	exit();
    }
}

if(!empty($act) && $act=="change_status"){
	$status = empty($_GET['status'])?'':trim($_GET['status']);
	$mid = empty($_GET['mid'])?'':intval($_GET['mid']);
	
	$uptime = mktime();
	
	$updateSql .= "status='$status',";
	
	if($status == "试讲中"){
		$updateSql .= "ac_time='$uptime',";
	}elseif($status == "安排中"){
		$updateSql .= "ac_time='',";
	}
	
	//修改状态的同时，需要修改更新时间时间，如果状态为试讲中则需要改变接单时间
	$query = "UPDATE `#@__member_xueyuan` SET ".
            $updateSql
            ."updatetime='$uptime' WHERE mid=$mid";

    $rs = $dsql->ExecuteNoneQuery2($query);
    //echo $query;
    if($rs==1){
    	echo "更新成功";
    	exit();
    }else{
    	echo "更新失败";
    	exit();
    }
}

/*----------------
function __DelMember()
删除会员
----------------*/
if($dopost=="delinfo")
{
    //CheckPurview('member_Del');
    if($fmdo=='yes')
    {
        $id = preg_replace("#[^0-9]#", '', $id);
        $safecodeok = substr(md5($cfg_cookie_encode.$randcode),0,24);
        if($safecodeok!=$safecode)
        {
        	ShowMsg("请填写正确的安全验证串！","info_do.php?id={$id}&dopost=delinfo");
        	exit();
        }
        if(!empty($id))
        {
        	$rs = $dsql->ExecuteNoneQuery2("DELETE FROM `#@__member_xueyuan` WHERE mid IN (".str_replace("`",",",$id).") ");
        	if($rs<=0){
        		ShowMsg("删除失败！",$ENV_GOBACK_URL);
        		exit;
        	}
        		
        }
        ShowMsg("成功删除一个会员！",$ENV_GOBACK_URL);
        exit();
    }
    $randcode = mt_rand(10000,99999);
    $safecode = substr(md5($cfg_cookie_encode.$randcode),0,24);
    $wintitle = "学员信息管理-删除学员信息";
    $wecome_info = "<a href='".$ENV_GOBACK_URL."'>学员信息管理</a>::删除学员信息";
    $win = new OxWindow();
    $win->Init("info_do.php","js/blank.js","POST");
    $win->AddHidden("fmdo","yes");
    $win->AddHidden("dopost",$dopost);
    $win->AddHidden("id",$id);
    $win->AddHidden("randcode",$randcode);
    $win->AddHidden("safecode",$safecode);
    $win->AddTitle("你确实要删除(ID:".$id.")这个学员信息?");
    $win->AddMsgItem("安全验证串：<input name='safecode' type='text' id='safecode' size='16' style='width:200px' />&nbsp;(复制本代码： <font color='red'>$safecode</font> )","30");
    $winform = $win->GetWindow("ok");
    $win->Display();
}else if($dopost=="delmembers"){
    CheckPurview('member_Del');
    if($fmdo=='yes')
    {
        $safecodeok = substr(md5($cfg_cookie_encode.$randcode),0,24);
        if($safecodeok!=$safecode)
        {
            ShowMsg("请填写正确的安全验证串！","member_do.php?id={$id}&dopost=delmembers");
            exit();
        }
        if(!empty($id))
        {
            //删除用户信息
            
            $rs = $dsql->ExecuteNoneQuery2("DELETE FROM `#@__member` WHERE mid IN (".str_replace("`",",",$id).") And matt<>10 ");    
            if($rs > 0)
            {
                $dsql->ExecuteNoneQuery("DELETE FROM `#@__member_tj` WHERE mid IN (".str_replace("`",",",$id).") ");
                $dsql->ExecuteNoneQuery("DELETE FROM `#@__member_space` WHERE mid IN (".str_replace("`",",",$id).") ");
                $dsql->ExecuteNoneQuery("DELETE FROM `#@__member_company` WHERE mid IN (".str_replace("`",",",$id).") ");
                $dsql->ExecuteNoneQuery("DELETE FROM `#@__member_person` WHERE mid IN (".str_replace("`",",",$id).") ");

                //删除用户相关数据
                $dsql->ExecuteNoneQuery("DELETE FROM `#@__member_stow` WHERE mid IN (".str_replace("`",",",$id).") ");
                $dsql->ExecuteNoneQuery("DELETE FROM `#@__member_flink` WHERE mid IN (".str_replace("`",",",$id).") ");
                $dsql->ExecuteNoneQuery("DELETE FROM `#@__member_guestbook` WHERE mid IN (".str_replace("`",",",$id).") ");
                $dsql->ExecuteNoneQuery("DELETE FROM `#@__member_operation` WHERE mid IN (".str_replace("`",",",$id).") ");
                $dsql->ExecuteNoneQuery("DELETE FROM `#@__member_pms` WHERE toid IN (".str_replace("`",",",$id).") Or fromid IN (".str_replace("`",",",$id).") ");
                $dsql->ExecuteNoneQuery("DELETE FROM `#@__member_friends` WHERE mid IN (".str_replace("`",",",$id).") Or fid IN (".str_replace("`",",",$id).") ");
                $dsql->ExecuteNoneQuery("DELETE FROM `#@__member_vhistory` WHERE mid IN (".str_replace("`",",",$id).") Or vid IN (".str_replace("`",",",$id).") ");
                $dsql->ExecuteNoneQuery("DELETE FROM `#@__feedback` WHERE mid IN (".str_replace("`",",",$id).") ");
                $dsql->ExecuteNoneQuery("UPDATE `#@__archives` SET mid='0' WHERE mid IN (".str_replace("`",",",$id).")");
            }
            else
            {
                ShowMsg("无法删除此会员，如果这个会员是管理员关连的ID，<br />必须先删除这个管理员才能删除此帐号！",$ENV_GOBACK_URL,0,3000);
                exit();
            }
        }
        ShowMsg("成功删除这些会员！",$ENV_GOBACK_URL);
        exit();
    }
    $randcode = mt_rand(10000, 99999);
    $safecode = substr(md5($cfg_cookie_encode.$randcode), 0, 24);
    $wintitle = "会员管理-删除会员";
    $wecome_info = "<a href='".$ENV_GOBACK_URL."'>会员管理</a>::删除会员";
    $win = new OxWindow();
    $win->Init("member_do.php", "js/blank.js", "POST");
    $win->AddHidden("fmdo", "yes");
    $win->AddHidden("dopost", $dopost);
    $win->AddHidden("id",$id);
    $win->AddHidden("randcode", $randcode);
    $win->AddHidden("safecode", $safecode);
    $win->AddTitle("你确实要删除(ID:".$id.")这个会员?");
    $win->AddMsgItem(" 安全验证串：<input name='safecode' type='text' id='safecode' size='16' style='width:200px' /> (复制本代码： <font color='red'>$safecode</font>)","30");
    $winform = $win->GetWindow("ok");
    $win->Display();
}
/*----------------
function __Recommend()
推荐会员
----------------*/
else if ($dopost=="recommend")
{
    CheckPurview('member_Edit');
    $id = preg_replace("#[^0-9]#", "", $id);
    if($matt==0)
    {
        $dsql->ExecuteNoneQuery("UPDATE `#@__member` SET matt=1 WHERE mid='$id' AND matt<>10 LIMIT 1");
        ShowMsg("成功设置一个会员推荐！",$ENV_GOBACK_URL);
        exit();
    }
    else
    {
        $dsql->ExecuteNoneQuery("UPDATE `#@__member` SET matt=0 WHERE mid='$id' AND matt<>10 LIMIT 1");
        ShowMsg("成功取消一个会员推荐！",$ENV_GOBACK_URL);
        exit();
    }
}
/*----------------
 function __EditUser()
增添需求信息
 ----------------*/
else if ($dopost=='addInfo')
{
	//CheckPurview('member_Edit');
	//if(!isset($_POST['id'])) exit('Request Error!');
	$msg = "";
	$ok = true;
	
	$city = trim($city);
	$bus_stop = trim($bus_stop);
	$requirement = trim($requirement);
	$info_fee = trim($info_fee);
	$contact_name1 = trim($contact_name1);
	$tel1 = trim($tel1);
	$from_source = trim($from_source);


	if(empty($bianhao)){
		$msg .= "编号不能为空\r\n";
		$ok=false;
	}
	if(empty($city)){
		$msg .= "城市不能为空\r\n";
		$ok=false;
	}
	/*if(empty($bus_stop)){
		$msg .= "站点不能为空\r\n";
		$ok=false;
	}*/
	/*
	if(empty($requirement)){
		$msg .= "需求信息不能为空";
		$ok=false;
	}
	*/
	/*
	if(empty($info_fee)){
		$msg .= "信息费不能为空";
		$ok=false;
	}
	*/
	/*
	if(empty($contact_name1)){
		$msg .= "联系人1不能为空\r\n";
		$ok=false;
	}
	if(empty($tel1)){
		$msg .= "联系方式1不能为空\r\n";
		$ok=false;
	}
	*/
	/*
	if(empty($from_source)){
		$msg .= "来源不能为空\r\n";
		$ok=false;
	}
*/
	if(!ok){
		ShowMsg($msg, 'info_add.php?id='.$id);
		exit();
	}
	 
	$uptime=mktime();
	//编号自动生成
	$cityRow = $dsql->GetOne("SELECT * FROM `#@__city` WHERE city_name='" .$city . "'");
	do{
		$randnum = sprintf("%04d",mt_rand(1,9999));
		$bianhao = $cityRow['city_pre'] . $randnum;
		$member_xueyuan = $dsql->GetOne("SELECT * FROM `#@__member_xueyuan` WHERE bianhao = '" . $bianhao . "'");
	}while(!empty($member_xueyuan));
	/*
	if(!empty($try_time))
		$try_time = strtotime($try_time);
	if(!empty($huifang_time))
		$huifang_time = strtotime($huifang_time);
*/
	$query = "INSERT INTO `#@__member_xueyuan`(`bianhao`,`city`,`bus_stop`,`requirement`,`info_fee`,`contact_name1`,`tel1`,".
	"`contact_name2`,`tel2`,`remark`,`from_source`,`info_cond`,`createtime`,`updatetime`) VALUES('$bianhao','$city','$bus_stop','$requirement',".
	"'$info_fee','$contact_name1','$tel1','$contact_name2','$tel2','$remark','$from_source','$info_cond','$uptime','$uptime')";
	
	$rs = $dsql->ExecuteNoneQuery2($query);
	//echo $rs."rs";
	if($rs==1){
		ShowMsg('成功新增会员信息', "info_list.php?act=addDone&city=".$city,0,1000);
		exit();
	}else{
		ShowMsg('新增失败', "info_list.php",0,1000);
		exit();
	}
	
}
/**
复制信息
**/
else if ($dopost=='copy')
{
	//CheckPurview('member_Edit');
	//if(!isset($_POST['id'])) exit('Request Error!');
	if(!isset($_GET['id'])) exit('Request Error!');
	$id = intval($_GET['id']);

	$oldInfo = $dsql->GetOne("Select * From `#@__member_xueyuan` WHERE mid = " . $id);

	$city = $oldInfo['city'];
	$bus_stop = $oldInfo['bus_stop'];
	$requirement = $oldInfo['requirement'];
	$info_fee = $oldInfo['info_fee'];
	$contact_name1 = $oldInfo['contact_name1'];
	$tel1 = $oldInfo['tel1'];
	$from_source = $oldInfo['from_source'];
	$contact_name2 = $oldInfo['contact_name2'];
	$tel2 = $oldInfo['tel2'];
	$remark = $oldInfo['remark'];
	$info_cond = $oldInfo['info_cond'];
	$uptime=mktime();
	//编号自动生成
	$cityRow = $dsql->GetOne("SELECT * FROM `#@__city` WHERE city_name='" .$city . "'");
	do{
		$randnum = sprintf("%04d",mt_rand(1,9999));
		$bianhao = $cityRow['city_pre'] . $randnum;
		$member_xueyuan = $dsql->GetOne("SELECT * FROM `#@__member_xueyuan` WHERE bianhao = '" . $bianhao . "'");
	}while(!empty($member_xueyuan));
	/*
	if(!empty($try_time))
		$try_time = strtotime($try_time);
	if(!empty($huifang_time))
		$huifang_time = strtotime($huifang_time);
*/
	$query = "INSERT INTO `#@__member_xueyuan`(`bianhao`,`city`,`bus_stop`,`requirement`,`info_fee`,`contact_name1`,`tel1`,".
	"`contact_name2`,`tel2`,`remark`,`from_source`,`info_cond`,`createtime`,`updatetime`) VALUES('$bianhao','$city','$bus_stop','$requirement',".
	"'$info_fee','$contact_name1','$tel1','$contact_name2','$tel2','$remark','$from_source','$info_cond','$uptime','$uptime')";
	
	$rs = $dsql->ExecuteNoneQuery2($query);
	//echo $rs."rs";
	if($rs==1){
		//header("Location:info_list.php");
		ShowMsg('复制信息成功', "info_list.php?act=copyok&city=".$city,0,1000);
		exit();
	}else{
		ShowMsg('复制失败', "info_list.php",0,1000);
		exit();
	}
	
}
/*----------------
function __EditUser()
更改需求消息
----------------*/
else if ($dopost=='editInfo')
{
    //CheckPurview('member_Edit');
    if(!isset($_POST['id'])) exit('Request Error!');
    $msg = "";
    $ok = true;
    $bianhao = trim($bianhao);
	$city = trim($city);
	$bus_stop = trim($bus_stop);
	$requirement = trim($requirement);
	$info_fee = trim($info_fee);
	$contact_name1 = trim($contact_name1);
	$tel1 = trim($tel1);
	$from_source = trim($from_source);
	//$status = trim($status);

	$ac_feedback = trim($ac_feedback);
	$try_feedback = trim($try_feedback);
	$huifang_record = trim($huifang_record);
	$remark = trim($remark);

	if(empty($bianhao)){
		$msg .= "编号不能为空\r\n";
		$ok=false;
	}
	if(empty($city)){
		$msg .= "城市不能为空\r\n";
		$ok=false;
	}
	if(empty($bus_stop)){
		$msg .= "车站不能为空\r\n";
		$ok=false;
	}
	if(empty($requirement)){
		$msg .= "需求信息不能为空";
		$ok=false;
	}
	if(empty($info_fee)){
		$msg .= "信息费不能为空";
		$ok=false;
	}
	if(empty($contact_name1)){
		$msg .= "联系人1不能为空\r\n";
		$ok=false;
	}
	if(empty($tel1)){
		$msg .= "联系方式1不能为空\r\n";
		$ok=false;
	}
	if(empty($status)){
		$msg .= "状态不能为空\r\n";
		$ok=false;
	}
	
	if(empty($from_source)){
		$msg .= "来源不能为空\r\n";
		$ok=false;
	}
    
    if(!ok){
    	ShowMsg($msg, 'info_view.php?id='.$id);
    	exit();
    }
    	
    $uptime=mktime();
    if(!empty($ac_time))
    	$ac_time = (strtotime($ac_time)>0)?strtotime($ac_time):'';
    if(!empty($try_time))
    	$try_time = (strtotime($try_time)>0)?(strtotime($try_time)>0):'';
    if(!empty($huifang_time))
    	$huifang_time = (strtotime($huifang_time)>0)?(strtotime($try_time)>0):'';
    
    $query = "UPDATE `#@__member_xueyuan` SET
            bianhao = '$bianhao',
            city = '$city',
            bus_stop = '$bus_stop',
            requirement = '$requirement',
            info_fee = '$info_fee',
            contact_name1 = '$contact_name1',
            tel1 = '$tel1',
            contact_name2 = '$contact_name2',
            tel2 = '$tel2',
            remark = '$remark',
            from_source='$from_source',
            ac_time = '$ac_time', 
            ac_feedback='$ac_feedback',
            try_time='$try_time' ,
            try_feedback='$try_feedback' ,
            huifang_time='$huifang_time' ,
            huifang_record='$huifang_record' ,
            updatetime='$uptime' ,
            info_cond='$info_cond'
             WHERE mid=$id";
    $rs = $dsql->ExecuteNoneQuery2($query);
    //echo $query;
    if($rs==1){
    	ShowMsg('成功更改会员资料！', 'info_list.php?act=modify_direct&city='.$city,0,1000);
    	exit();
    }else{
    	ShowMsg('更新失败！', 'info_list.php',0,1000);
    	exit();
    }
}
/*--------------
function __LoginCP()
登录会员的控制面板
----------*/
else if ($dopost=="memberlogin")
{
    CheckPurview('member_Edit');
    PutCookie('DedeUserID',$id,1800);
    PutCookie('DedeLoginTime',time(),1800);
    if(empty($jumpurl)) header("location:../member/index.php");
    else header("location:$jumpurl");
} else if ($dopost == "deoperations")
{
    $nid = preg_replace('#[^0-9,]#', '', preg_replace('#`#', ',', $nid));
    $nid = explode(',', $nid);
    if(is_array($nid))
    {
        foreach ($nid as $var)
        {
            $query = "DELETE FROM `#@__member_operation` WHERE aid = '$var'";
            $dsql->ExecuteNoneQuery($query);
        }
        ShowMsg("删除成功！","member_operations.php");
        exit();
    }
} else if ($dopost == "upoperations")
{
    $nid = preg_replace('#[^0-9,]#', '', preg_replace('#`#', ',', $nid));
    $nid = explode(',', $nid);
    if(is_array($nid))
    {
        foreach ($nid as $var)
        {
            $query = "UPDATE `#@__member_operation` SET sta = '1' WHERE aid = '$var'";
            $dsql->ExecuteNoneQuery($query);
            ShowMsg("设置成功！","member_operations.php");
            exit();
        }
    }
} else if($dopost == "okoperations")
{
    $nid = preg_replace('#[^0-9,]#', '', preg_replace('#`#', ',', $nid));
    $nid = explode(',', $nid);
    if(is_array($nid))
    {
        foreach ($nid as $var)
        {
            $query = "UPDATE `#@__member_operation` SET sta = '2' WHERE aid = '$var'";
            $dsql->ExecuteNoneQuery($query);
            ShowMsg("设置成功！","member_operations.php");
            exit();
        }
    }
}