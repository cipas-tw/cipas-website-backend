<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//後台
define('HEAD_TITLE', '不當黨產處理委員會');
define('FOOTER_COMPANY', '不當黨產處理委員會');
define('FOOTER_COMPANY_URL', 'http://www.cipas.gov.tw/');
define('FOOTER_YEAR', '2017');

$config['alertSuccess'] = 'success';
$config['alertWarning'] = 'warning';
$config['alertInfo'] = 'info';
$config['alertDanger'] = 'danger';

$config['status'] = array(0=>'不啟用', 1=>'啟用');
$config['sliderBannerType'] = array(1=>'圖片', 2=>'直播語音', 3=>'Youtube');
$config['sidebarPermissionType'] = array('A'=>'檢視', 'B'=>'新增', 'C'=>'修改', 'D'=>'刪除');
$config['sidebarPermissionController'] = array('index'=>'A', 'create'=>'B', 'typeEdit'=>'C', 'edit'=>'C', 'deleteAction'=>'D', 'addMainForm'=>'A', 'detail'=>'A', 'sortAjax'=>'C', 'deleteDetailAction'=>'D');

$config['frontEndUrl'] = 'http://cipas-dev.unidyna.com/';

$config['alertAddSuccess'] = '新增成功！';
$config['alertUpdateSuccess'] = '更新成功！';
$config['alertDeleteSuccess'] = '刪除成功！';
$config['alertDBError'] = '資料寫入失敗，請重新輸入';


// 檔案路徑
$config['uploadUrl'] = 'https://storage.googleapis.com/cipas/';
$config['uploadPath'] = 'public/cipas-uploads/';
$config['tmpPath'] = 'tmp/';
$config['deletePath'] = 'delete/';

$config['purchasePath'] = 'purchase/';
$config['policyPath'] = 'policy/';
$config['budgetPath'] = 'budget/';
$config['salesPath'] = 'sales/';
$config['filesPath'] = 'files/';
$config['newsPath'] = 'news/';
$config['rulePath'] = 'rule/';
$config['orgRulesPath'] = 'orgRules/';
$config['historyStoryPath'] = 'historyStory/';
$config['declarationPath'] = 'declaration/';
$config['journalPath'] = 'journal/';
$config['videoPath'] = 'video/';
$config['collectPlanPath'] = 'collectPlan/';
$config['administrativeActPath'] = 'administrativeAct/';
$config['hearingPath'] = 'hearing/';
$config['commissionerPath'] = 'commissioner/';
$config['sliderBannerPath'] = 'sliderBanner/';
$config['repossessPath'] = 'repossess/';
$config['rewardPath'] = 'reward/';
$config['photoPath'] = 'photo/';
$config['litigationPath'] = 'litigation/';
$config['lawPath'] = 'law/';
$config['notesPublishPath'] = 'notespublish/';
$config['aboutPath'] = 'about/';

// 縮圖尺寸
$config['defultCropSize'] = array(
	//0 => array('path'=> '', 'width'=> 1024, 'height'=> 1024)
	0 => array('path'=> '800/', 'width'=> 800, 'height'=> 540),
	1 => array('path'=> '320/', 'width'=> 320, 'height'=> 216)
);

$config['sliderCropSize'] = array(
	0 => array('path'=> '800/', 'width'=> 800, 'height'=> 540),
	1 => array('path'=> '200/', 'width'=> 200, 'height'=> 120),
	2 => array('path'=> '724/', 'width'=> 724, 'height'=> 407)
);

$config['commissionerCropSize'] = array(
	0 => array('path'=> '416/', 'width'=> 416, 'height'=> 480),
	1 => array('path'=> '104/', 'width'=> 104, 'height'=> 120)
);

$config['keyFileName'] = array('ubmsys.key', 'ubmsys_hmac.key');