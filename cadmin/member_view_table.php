<?php
/**
 * ��Ա�鿴
 *
 * @version        $Id: member_view.php 1 14:15 2010��7��20��Z tianya $
 * @package        DedeCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, DesDev, Inc.
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require(dirname(__FILE__)."/config.php");
//CheckPurview('member_Edit');
$ENV_GOBACK_URL = isset($_COOKIE['ENV_GOBACK_URL']) ? "member_main.php" : '';
$id = preg_replace("#[^0-9]#", "", $id);
//ȥ��member������Ϣ��archives�е���ϸ��Ϣ
$row = $dsql->GetOne("select  uname,sex,mobile,school,zhuanye,nianji,qq,city,litpic,description,work_experience,prize_good".
		" from #@__member as m left join #@__archives as a on m.mid=a.mid where m.mid='$id'");
/*
$staArr = array(
    -10=>'�ȴ���֤�ʼ�',
    -2=>'�����û�(����)',
    -1=>'δͨ�����',
     0=>'���ͨ������ʾ��д������Ϣ',
     1=>'û��д��ϸ����',
     2=>'����ʹ��״̬'
);*/
$staArr = array(
     0=>'ע���Ա',
     1=>'��˽�Ա',
     2=>'�Ƽ���Ա',
	 3=>'���ǽ�Ա'
);
//�������û��ǹ���Ա�ʺţ��������㹻Ȩ�޵��û����ܲ���
if($row['matt']==10) CheckPurview('sys_User');

if($row['uptime']>0 && $row['exptime']>0)
{
    $mhasDay = $row['exptime'] - ceil((time() - $row['uptime'])/3600/24)+1;
} else {
    $mhasDay = 0;
}
include DedeInclude('templets/member_view_table.html');