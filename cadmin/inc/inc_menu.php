<?php
/**
 * 后台管理菜单项
 *
 * @version        $Id: inc_menu.php 1 10:32 2010年7月21日Z tianya $
 * @package        DedeCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, DesDev, Inc.
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__)."/../config.php");

//载入可发布频道
$addset = '';

//检测可用的内容模型
if($cfg_admin_channel = 'array' && count($admin_catalogs) > 0)
{
    $admin_catalog = join(',', $admin_catalogs);
    $dsql->SetQuery(" SELECT channeltype FROM `#@__arctype` WHERE id IN({$admin_catalog}) GROUP BY channeltype ");
}
else
{
    $dsql->SetQuery(" SELECT channeltype FROM `#@__arctype` GROUP BY channeltype ");
}
$dsql->Execute();
$candoChannel = '';
while($row = $dsql->GetObject())
{
    $candoChannel .= ($candoChannel=='' ? $row->channeltype : ','.$row->channeltype);
}
if(empty($candoChannel)) $candoChannel = 1;
$dsql->SetQuery("SELECT id,typename,addcon,mancon FROM `#@__channeltype` WHERE id IN({$candoChannel}) AND id<>-1 AND isshow=1 ORDER BY id ASC");
$dsql->Execute();
while($row = $dsql->GetObject())
{
    $addset .= "  <m:item name='{$row->typename}' ischannel='1' link='{$row->mancon}?channelid={$row->id}' linkadd='{$row->addcon}?channelid={$row->id}' channelid='{$row->id}' rank='' target='main' />\r\n";
}
//////////////////////////

$adminMenu1 = $adminMenu2 = '';
if($cuserLogin->getUserType() >= 10)
{
    $adminMenu1 = "<m:top item='1_' name='频道模型' display='block' rank='t_List,t_AccList,c_List,temp_One'>
  <m:item name='内容模型管理' link='mychannel_main.php' rank='c_List' target='main' />
  <m:item name='单页文档管理' link='templets_one.php' rank='temp_One' target='main'/>
  <m:item name='联动类别管理' link='stepselect_main.php' rank='c_Stepseclect' target='main' />
  <m:item name='自由列表管理' link='freelist_main.php' rank='c_List' target='main' />
  <m:item name='自定义表单' link='diy_main.php' rank='c_List' target='main' />
</m:top>
";
$adminMenu2 = "<m:top item='7_' name='模板管理' display='none' rank='temp_One,temp_Other,temp_MyTag,temp_test,temp_All'>
  <m:item name='默认模板管理' link='templets_main.php' rank='temp_All' target='main'/>
  <m:item name='标签源码管理' link='templets_tagsource.php' rank='temp_All' target='main'/>
  <m:item name='自定义宏标记' link='mytag_main.php' rank='temp_MyTag' target='main'/>
  <m:item name='智能标记向导' link='mytag_tag_guide.php' rank='temp_Other' target='main'/>
  <m:item name='全局标记测试' link='tag_test.php' rank='temp_Test' target='main'/>
</m:top>

<m:top item='10_' name='系统设置' display='none' rank='sys_User,sys_Group,sys_Edit,sys_Log,sys_Data'>
  <m:item name='系统基本参数' link='sys_info.php' rank='sys_Edit' target='main' />
  <m:item name='系统用户管理' link='sys_admin_user.php' rank='sys_User' target='main' />
  <m:item name='SQL命令行工具' link='sys_sql_query.php' rank='sys_Data' target='main' />
  <m:item name='城市列表' link='city_list.php' rank='c_List' target='main' />
  <m:item name='新增城市' link='city_add.php' rank='c_List' target='main' />
</m:top>


    ";
}
$remoteMenu = ($cfg_remote_site=='Y')? "<m:item name='远程服务器同步' link='makeremote_all.php' rank='sys_ArcBatch' target='main' />" : "";
$menusMain = "
-----------------------------------------------

<m:top item='1_' name='常用操作' display='block'>
  
  <m:item name='单页面管理' link='templets_one.php'  target='main' />
  
  <m:item name='所有教员档案列表' link='content_list.php' rank='a_List,a_AccList' target='main' />
  <m:item name='等审核的教员档案' link='content_list.php?arcrank=-1' rank='a_Check,a_AccCheck' target='main' />
</m:top>
<m:top item='1_' name='附件管理' display='none' rank='sys_Upload,sys_MyUpload,plus_文件管理器'>
  <m:item name='附件数据管理' link='media_main.php' rank='sys_Upload,sys_MyUpload' target='main' />
  <m:item name='文件式管理器' link='media_main.php?dopost=filemanager' rank='plus_文件管理器' target='main' />
</m:top>

<m:top item='3_' name='采集管理' display='none' rank='co_NewRule,co_ListNote,co_ViewNote,co_Switch,co_GetOut'>
  <m:item name='采集节点管理' link='co_main.php' rank='co_ListNote' target='main' />
  <m:item name='临时内容管理' link='co_url.php' rank='co_ViewNote' target='main' />
  <m:item name='导入采集规则' link='co_get_corule.php' rank='co_GetOut' target='main'/>
  <m:item name='监控采集模式' link='co_gather_start.php' rank='co_GetOut' target='main'/>
  <m:item name='采集未下载内容' link='co_do.php?dopost=coall' rank='co_GetOut' target='main'/>
</m:top>



<m:top item='5_' name='自动任务' notshowall='1'  display='block' rank='sys_MakeHtml'>
  <m:item name='一键更新网站' link='makehtml_all.php' rank='sys_MakeHtml' target='main' />
  <m:item name='更新系统缓存' link='sys_cache_up.php' rank='sys_ArcBatch' target='main' />
  {$remoteMenu}
</m:top>

<m:top item='5_' name='HTML更新' notshowall='1' display='none' rank='sys_MakeHtml'>
  <m:item name='更新主页HTML' link='makehtml_homepage.php' rank='sys_MakeHtml' target='main' />
  <m:item name='更新栏目HTML' link='makehtml_list.php' rank='sys_MakeHtml' target='main' />
  <m:item name='更新文档HTML' link='makehtml_archives.php' rank='sys_MakeHtml' target='main' />
  <m:item name='更新网站地图' link='makehtml_map_guide.php' rank='sys_MakeHtml' target='main' />
  <m:item name='更新RSS文件' link='makehtml_rss.php' rank='sys_MakeHtml' target='main' />
  <m:item name='获取JS文件' link='makehtml_js.php' rank='sys_MakeHtml' target='main' />
  <m:item name='更新专题HTML' link='makehtml_spec.php' rank='sys_MakeHtml' target='main' />
</m:top>

<m:top item='6_' name='会员管理' display='none' rank='member_List,member_Type'>
  <m:item name='注册教师列表' link='member_main.php' rank='member_List' target='main' />
 
</m:top>

$adminMenu2



<m:top mapitem='9' item='9_' name='学员信息管理' display='block' rank='info_List,info_Add'>
  <m:item name='学员信息列表' link='info_list.php' rank='info_List' target='main' />
  <m:item name='新增学员信息' link='info_add.php' rank='info_Add' target='main' />
  <m:item name='退款申请记录' link='fee_back.php' rank='feeback_List' target='main' />
  <m:item name='家长预约记录' link='yuyue.php' rank='yuyue_List' target='main' />
</m:top>
-----------------------------------------------
";