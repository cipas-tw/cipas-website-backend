/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50713
 Source Host           : localhost
 Source Database       : cipas

 Target Server Type    : MySQL
 Target Server Version : 50713
 File Encoding         : utf-8

 Date: 09/04/2017 15:09:07 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `about`
-- ----------------------------
DROP TABLE IF EXISTS `about`;
CREATE TABLE `about` (
  `about_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `about_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `about_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `about_responsibility_descriptionl` varchar(255) DEFAULT NULL COMMENT '執掌說明',
  `about_organization_descriptionl` varchar(255) DEFAULT NULL COMMENT '組織說明',
  `about_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `about_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `about_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `about_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `about_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `about_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`about_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `about_file`
-- ----------------------------
DROP TABLE IF EXISTS `about_file`;
CREATE TABLE `about_file` (
  `about_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `about_id` int(11) DEFAULT NULL COMMENT '對應 about 資料表，資料庫流水號',
  `about_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `about_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `about_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `about_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `about_file_sort` tinyint(4) NOT NULL DEFAULT '1' COMMENT '排序',
  `about_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `about_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `about_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `about_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`about_file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `administrative_actions`
-- ----------------------------
DROP TABLE IF EXISTS `administrative_actions`;
CREATE TABLE `administrative_actions` (
  `adm_act_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `adm_act_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `adm_act_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `adm_act_title` varchar(255) DEFAULT NULL COMMENT '案由',
  `adm_act_orig_filename` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `adm_act_filename` varchar(255) DEFAULT NULL COMMENT '封面圖片檔名',
  `adm_act_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `adm_act_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `adm_act_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `adm_act_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `adm_act_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  PRIMARY KEY (`adm_act_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `administrative_actions_note`
-- ----------------------------
DROP TABLE IF EXISTS `administrative_actions_note`;
CREATE TABLE `administrative_actions_note` (
  `adm_act_note_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `adm_act_id` int(11) DEFAULT NULL COMMENT '對應 administrative_act.adm_act_id 資料表，資料庫流水號',
  `adm_act_note_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `adm_act_note_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `adm_act_note_hyperlinks` varchar(255) DEFAULT NULL COMMENT '連結',
  `adm_act_note_date` date DEFAULT NULL COMMENT '新增時間',
  `adm_act_note_content` text COMMENT '內文',
  `adm_act_note_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `adm_act_note_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `adm_act_note_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `adm_act_note_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`adm_act_note_id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `albums`
-- ----------------------------
DROP TABLE IF EXISTS `albums`;
CREATE TABLE `albums` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `photo_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `photo_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `photo_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `photo_sort` tinyint(4) NOT NULL DEFAULT '1' COMMENT '排序',
  `photo_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `photo_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `photo_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `photo_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `albums_file`
-- ----------------------------
DROP TABLE IF EXISTS `albums_file`;
CREATE TABLE `albums_file` (
  `photo_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `photo_id` int(11) DEFAULT NULL COMMENT '對應 photo 資料表，資料庫流水號',
  `photo_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `photo_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `photo_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `photo_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `photo_file_sort` tinyint(4) NOT NULL DEFAULT '1' COMMENT '排序',
  `photo_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `photo_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `photo_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `photo_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`photo_file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `articles`
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `news_type_id` int(11) NOT NULL COMMENT '對應 news_type 資料表，資料庫流水號',
  `news_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `news_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `news_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `news_content` longtext COMMENT '內文',
  `news_orig_filename` varchar(255) DEFAULT NULL COMMENT '圖片原檔名',
  `news_filename` varchar(255) DEFAULT NULL COMMENT '圖片真實檔名',
  `news_show_date` date DEFAULT NULL COMMENT '發佈日期',
  `news_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `news_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `news_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `news_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `news_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  `news_sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `articles_file`
-- ----------------------------
DROP TABLE IF EXISTS `articles_file`;
CREATE TABLE `articles_file` (
  `news_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `news_id` int(11) DEFAULT NULL COMMENT '對應 news 資料表，資料庫流水號',
  `news_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `news_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `news_file_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `news_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `news_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `news_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `news_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `news_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `news_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`news_file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=270 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `articles_type`
-- ----------------------------
DROP TABLE IF EXISTS `articles_type`;
CREATE TABLE `articles_type` (
  `news_type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `news_type_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `news_type_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `news_type_name` varchar(255) DEFAULT NULL COMMENT '名稱',
  `news_type_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `news_type_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `news_type_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `news_type_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`news_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `backend_menu`
-- ----------------------------
DROP TABLE IF EXISTS `backend_menu`;
CREATE TABLE `backend_menu` (
  `backend_menu_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `backend_menu_parent_id` int(11) DEFAULT NULL COMMENT '父單元Id',
  `backend_menu_icon` varchar(20) DEFAULT NULL COMMENT '單元樣式',
  `backend_menu_name` varchar(20) DEFAULT NULL COMMENT '單元名稱',
  `backend_menu_controller` varchar(30) DEFAULT NULL COMMENT '單元Controller 名稱',
  `backend_menu_func` varchar(15) DEFAULT NULL,
  `backend_menu_link` varchar(30) DEFAULT NULL,
  `backend_menu_sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `backend_menu_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  PRIMARY KEY (`backend_menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `backend_menu`
-- ----------------------------
BEGIN;
INSERT INTO `backend_menu` VALUES ('1', '0', 'icon-settings', '系統設定', '', '', null, '1', '0'), ('2', '1', 'icon-user', '使用者管理', 'users', 'index', null, '3', '0'), ('3', '36', 'icon-user', '本會委員管理', 'members', 'index', null, '5', '0'), ('4', '38', 'icon-list', '主管法規條文管理', 'regulations', 'index', null, '20', '0'), ('5', '0', 'icon-picture', '首頁輪播牆管理', 'banners', 'index', null, '99', '0'), ('6', '37', 'icon-loop', '調查進度管理', 'investigations', 'index', null, '8', '0'), ('7', '0', 'icon-book-open', '新聞與公告管理', 'articles', 'index', null, '6', '0'), ('8', '0', 'icon-paper-plane', '申報事項', '', '', null, '99', '1'), ('9', '37', 'icon-calculator', '申報事項說明管理', 'declarationexplain', 'lists', null, '12', '0'), ('10', '37', 'icon-doc', '已申報事項管理', 'declarations', 'index', null, '13', '0'), ('11', '39', 'icon-layers', '期刊文獻管理', 'journals', 'index', null, '28', '0'), ('12', '0', 'icon-reload', '回復權利事項', '', '', null, '99', '1'), ('13', '37', 'icon-list', '回復權利事項條文管理', 'repossesslist', 'index', null, '16', '0'), ('14', '37', 'icon-doc', '已回復權利事項管理', 'recoveries', 'index', null, '17', '0'), ('15', '0', 'icon-badge', '獎勵舉發事項', '', '', null, '99', '1'), ('16', '37', 'icon-list', '獎勵舉發事項條文管理', 'rewardlist', 'lists', null, '14', '0'), ('17', '37', 'icon-doc', '已獎勵舉發事項管理', 'rewards', 'index', null, '15', '0'), ('18', '38', 'icon-users', '組織規程管理', 'organic_rules', 'index', null, '19', '0'), ('19', '37', 'icon-lock', '行政處分管理', 'administrative_actions', 'index', null, '10', '0'), ('20', '37', 'icon-microphone', '聽證程序管理', 'hearings', 'index', null, '9', '0'), ('21', '37', 'icon-bulb', '相關訴訟管理', 'litigations', 'index', null, '11', '0'), ('22', '40', 'icon-graduation', '史料故事管理', 'stories', 'index', null, '31', '0'), ('23', '39', 'icon-like', '施政計畫管理', 'policies', 'index', null, '23', '0'), ('24', '39', 'icon-handbag', '業務統計管理', 'statistics', 'index', null, '24', '0'), ('25', '39', 'icon-notebook', '預算書及決算書管理', 'budgets', 'index', null, '25', '0'), ('26', '40', 'icon-note', '徵集計劃管理', 'collect', 'index', null, '30', '0'), ('27', '38', 'icon-info', '本會解釋管理', 'interpretations', 'index', null, '21', '0'), ('28', '39', 'icon-basket', '採購契約管理', 'purchases', 'index', null, '26', '0'), ('29', '39', 'icon-film', '影音內容管理', 'videos', 'index', null, '27', '0'), ('30', '41', 'icon-arrow-down', '檔案下載管理', 'downloads', 'index', null, '34', '0'), ('31', '0', 'icon-fire', '熱門搜尋', 'keywords', 'index', null, '99', '0'), ('32', '39', 'icon-link', '連結管理', 'links', 'index', null, '99', '0'), ('33', '41', 'icon-question', '常見問答管理', 'questions', 'index', null, '33', '0'), ('34', '1', 'icon-user', '權限管理', 'permissions', 'index', null, '2', '0'), ('35', '0', 'icon-picture', '圖集管理', 'albums', null, null, '99', '0'), ('36', '0', 'icon-user', '關於本會', null, null, null, '4', '0'), ('37', '0', 'icon-handbag', '本會業務', null, null, null, '7', '0'), ('38', '0', 'icon-list', '法令函釋', null, null, null, '18', '0'), ('39', '0', 'icon-like', '公開資訊', null, null, null, '22', '0'), ('40', '0', 'icon-graduation', '史料徵集', null, null, null, '29', '0'), ('41', '0', 'icon-question', '便民服務', null, null, null, '32', '0'), ('43', '37', 'icon-handbag', '記事上稿管理', 'notespublish', 'index', null, '12', '0'), ('44', '0', 'icon-link', '連結管理', 'related_links', 'index', null, '35', '0'), ('45', '36', 'icon-contact', '聯絡資訊管理', 'contact', 'index', null, '5', '0'), ('46', '36', 'icon-about', '執掌與組織管理', 'about', 'index', null, '5', '0');
COMMIT;

-- ----------------------------
--  Table structure for `banners`
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `slider_banner_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `slider_banner_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `slider_banner_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `slider_banner_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `slider_banner_orig_filename` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `slider_banner_filename` varchar(255) DEFAULT NULL COMMENT '圖片檔名',
  `slider_banner_url` varchar(255) DEFAULT NULL COMMENT '圖片/影片連結',
  `slider_banner_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '輪播類型 1:圖片 2:直播語音 3:Youtube 預設1',
  `slider_banner_sort` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `slider_banner_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `slider_banner_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `slider_banner_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `slider_banner_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`slider_banner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `budgets`
-- ----------------------------
DROP TABLE IF EXISTS `budgets`;
CREATE TABLE `budgets` (
  `budget_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `budget_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `budget_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `budget_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `budget_orig_filename` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `budget_filename` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `budget_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `budget_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `budget_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `budget_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`budget_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ci_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `collect`
-- ----------------------------
DROP TABLE IF EXISTS `collect`;
CREATE TABLE `collect` (
  `collect_plan_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `collect_plan_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `collect_plan_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `collect_plan_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `collect_plan_content` longtext COMMENT '內文',
  `collect_plan_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `collect_plan_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `collect_plan_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `collect_plan_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `collect_plan_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  PRIMARY KEY (`collect_plan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `collect_file`
-- ----------------------------
DROP TABLE IF EXISTS `collect_file`;
CREATE TABLE `collect_file` (
  `collect_plan_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `collect_plan_id` int(11) DEFAULT NULL COMMENT '對應 org_rules 資料表，資料庫流水號',
  `collect_plan_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `collect_plan_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `collect_plan_file_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `collect_plan_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `collect_plan_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `collect_plan_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `collect_plan_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `collect_plan_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `collect_plan_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`collect_plan_file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `contact`
-- ----------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `contact_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `contact_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `contact_mail` varchar(255) DEFAULT NULL COMMENT '意見信箱',
  `contact_telephone` varchar(32) DEFAULT NULL COMMENT '聯絡電話',
  `contact_fax` varchar(32) DEFAULT NULL COMMENT '傳真號碼',
  `contact_address_zh_TW` varchar(255) DEFAULT NULL COMMENT '聯絡地址',
  `contact_address_en_US` varchar(255) DEFAULT NULL COMMENT '聯絡地址-英',
  `contact_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `contact_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `contact_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `contact_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `declaration_explain`
-- ----------------------------
DROP TABLE IF EXISTS `declaration_explain`;
CREATE TABLE `declaration_explain` (
  `declaration_explain_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `declaration_explain_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `declaration_explain_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `declaration_explain_content` longtext COMMENT '內文',
  `declaration_explain_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `declaration_explain_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `declaration_explain_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `declaration_explain_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`declaration_explain_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `declarations`
-- ----------------------------
DROP TABLE IF EXISTS `declarations`;
CREATE TABLE `declarations` (
  `declaration_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `declaration_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `declaration_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `declaration_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `declaration_content` longtext COMMENT '內文',
  `declaration_show_date` date DEFAULT NULL COMMENT '發佈日期',
  `declaration_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `declaration_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `declaration_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `declaration_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `declaration_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  PRIMARY KEY (`declaration_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `declarations_file`
-- ----------------------------
DROP TABLE IF EXISTS `declarations_file`;
CREATE TABLE `declarations_file` (
  `declaration_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `declaration_id` int(11) DEFAULT NULL COMMENT '對應 org_rules 資料表，資料庫流水號',
  `declaration_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `declaration_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `declaration_file_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `declaration_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `declaration_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `declaration_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `declaration_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `declaration_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `declaration_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`declaration_file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `downloads`
-- ----------------------------
DROP TABLE IF EXISTS `downloads`;
CREATE TABLE `downloads` (
  `files_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `files_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `files_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `files_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `files_orig_filename` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `files_filename` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `files_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `files_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `files_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `files_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `files_sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`files_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `hearings`
-- ----------------------------
DROP TABLE IF EXISTS `hearings`;
CREATE TABLE `hearings` (
  `hearing_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `hearing_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `hearing_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `hearing_title` varchar(255) DEFAULT NULL COMMENT '案由',
  `hearing_orig_filename` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `hearing_filename` varchar(255) DEFAULT NULL COMMENT '封面圖片檔名',
  `hearing_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `hearing_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `hearing_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `hearing_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `hearing_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  PRIMARY KEY (`hearing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `hearings_note`
-- ----------------------------
DROP TABLE IF EXISTS `hearings_note`;
CREATE TABLE `hearings_note` (
  `hearing_note_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `hearing_id` int(11) DEFAULT NULL COMMENT '對應 hearing.hearing_id 資料表，資料庫流水號',
  `hearing_note_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `hearing_note_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `hearing_note_hyperlinks` varchar(255) DEFAULT NULL COMMENT '連結',
  `hearing_note_date` date DEFAULT NULL COMMENT '新增時間',
  `hearing_note_content` text COMMENT '內文',
  `hearing_note_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `hearing_note_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `hearing_note_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `hearing_note_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`hearing_note_id`)
) ENGINE=InnoDB AUTO_INCREMENT=937 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `interpretations`
-- ----------------------------
DROP TABLE IF EXISTS `interpretations`;
CREATE TABLE `interpretations` (
  `rule_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `rule_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `rule_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `rule_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `rule_content` longtext COMMENT '內文',
  `rule_show_date` date DEFAULT NULL COMMENT '發佈日期',
  `rule_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `rule_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `rule_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `rule_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `rule_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  PRIMARY KEY (`rule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `interpretations_file`
-- ----------------------------
DROP TABLE IF EXISTS `interpretations_file`;
CREATE TABLE `interpretations_file` (
  `rule_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `rule_id` int(11) DEFAULT NULL COMMENT '對應 org_rules 資料表，資料庫流水號',
  `rule_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `rule_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `rule_file_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `rule_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `rule_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `rule_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `rule_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `rule_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `rule_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`rule_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `investigations`
-- ----------------------------
DROP TABLE IF EXISTS `investigations`;
CREATE TABLE `investigations` (
  `survey_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `survey_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `survey_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `survey_title` varchar(255) DEFAULT NULL COMMENT '案由',
  `survey_orig_filename` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `survey_filename` varchar(255) DEFAULT NULL COMMENT '封面圖片檔名',
  `survey_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `survey_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `survey_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `survey_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `survey_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  `survey_sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`survey_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `investigations_note`
-- ----------------------------
DROP TABLE IF EXISTS `investigations_note`;
CREATE TABLE `investigations_note` (
  `survey_note_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `survey_id` int(11) DEFAULT NULL COMMENT '對應 survey.survey_id 資料表，資料庫流水號',
  `survey_note_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `survey_note_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `survey_note_hyperlinks` varchar(255) DEFAULT NULL COMMENT '連結',
  `survey_note_date` date DEFAULT NULL COMMENT '新增時間',
  `survey_note_content` text COMMENT '內文',
  `survey_note_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `survey_note_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `survey_note_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `survey_note_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`survey_note_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1286 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `journals`
-- ----------------------------
DROP TABLE IF EXISTS `journals`;
CREATE TABLE `journals` (
  `journal_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `journal_type_id` int(11) NOT NULL DEFAULT '0' COMMENT '對應 journal_type 資料表，資料庫流水號',
  `journal_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `journal_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `journal_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `journal_content` longtext COMMENT '內文',
  `journal_orig_filename` varchar(255) DEFAULT NULL COMMENT '圖片原檔名',
  `journal_filename` varchar(255) DEFAULT NULL COMMENT '圖片真實檔名',
  `journal_show_date` date DEFAULT NULL COMMENT '發佈日期',
  `journal_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `journal_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `journal_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `journal_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `journal_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  PRIMARY KEY (`journal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `journals_file`
-- ----------------------------
DROP TABLE IF EXISTS `journals_file`;
CREATE TABLE `journals_file` (
  `journal_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `journal_id` int(11) DEFAULT NULL COMMENT '對應 org_rules 資料表，資料庫流水號',
  `journal_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `journal_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `journal_file_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `journal_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `journal_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `journal_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `journal_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `journal_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `journal_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`journal_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `journals_type`
-- ----------------------------
DROP TABLE IF EXISTS `journals_type`;
CREATE TABLE `journals_type` (
  `journal_type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `journal_type_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `journal_type_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `journal_type_name` varchar(255) DEFAULT NULL COMMENT '名稱',
  `journal_type_content` longtext,
  `journal_type_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `journal_type_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `journal_type_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `journal_type_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`journal_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `keywords`
-- ----------------------------
DROP TABLE IF EXISTS `keywords`;
CREATE TABLE `keywords` (
  `hot_keyword_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `hot_keyword_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `hot_keyword_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `hot_keyword_title` varchar(255) DEFAULT NULL COMMENT '關鍵字',
  `hot_keyword_sort` tinyint(4) NOT NULL DEFAULT '1' COMMENT '排序',
  `hot_keyword_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `hot_keyword_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `hot_keyword_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `hot_keyword_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`hot_keyword_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `links`
-- ----------------------------
DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `hist_link_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `hist_link_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `hist_link_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `hist_link_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `hist_link_url` varchar(255) DEFAULT NULL COMMENT '外部連結',
  `hist_link_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `hist_link_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `hist_link_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `hist_link_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`hist_link_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `litigations`
-- ----------------------------
DROP TABLE IF EXISTS `litigations`;
CREATE TABLE `litigations` (
  `litigation_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `litigation_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `litigation_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `litigation_title` varchar(255) DEFAULT NULL COMMENT '案由',
  `litigation_orig_filename` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `litigation_filename` varchar(255) DEFAULT NULL COMMENT '封面圖片檔名',
  `litigation_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `litigation_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `litigation_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `litigation_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `litigation_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  PRIMARY KEY (`litigation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `litigations_file`
-- ----------------------------
DROP TABLE IF EXISTS `litigations_file`;
CREATE TABLE `litigations_file` (
  `litigation_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `litigation_id` int(11) DEFAULT NULL COMMENT '對應 litigation 資料表，資料庫流水號',
  `litigation_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `litigation_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `litigation_file_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `litigation_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `litigation_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `litigation_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `litigation_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `litigation_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `litigation_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`litigation_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `litigations_note`
-- ----------------------------
DROP TABLE IF EXISTS `litigations_note`;
CREATE TABLE `litigations_note` (
  `litigation_note_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `litigation_id` int(11) DEFAULT NULL COMMENT '對應 litigation.litigation_id 資料表，資料庫流水號',
  `litigation_note_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `litigation_note_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `litigation_note_hyperlinks` varchar(255) DEFAULT NULL COMMENT '連結',
  `litigation_note_date` date DEFAULT NULL COMMENT '新增時間',
  `litigation_note_content` text COMMENT '內文',
  `litigation_note_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `litigation_note_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `litigation_note_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `litigation_note_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`litigation_note_id`)
) ENGINE=InnoDB AUTO_INCREMENT=592 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `members`
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `commissioner_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `commissioner_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `commissioner_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `commissioner_name` varchar(255) DEFAULT NULL COMMENT '委員姓名',
  `commissioner_orig_filename` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `commissioner_filename` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `commissioner_education` text COMMENT '學歷，json 格式',
  `commissioner_experience` text COMMENT '經歷，json 格式',
  `commissioner_is_leader` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否為主任委員 0:否 1:是 預設0',
  `commissioner_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `commissioner_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `commissioner_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `commissioner_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `commissioner_sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`commissioner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `notes_publish`
-- ----------------------------
DROP TABLE IF EXISTS `notes_publish`;
CREATE TABLE `notes_publish` (
  `notes_publish_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `notes_publish_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `notes_publish_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `notes_publish_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `notes_publish_content` longtext COMMENT '內文',
  `notes_publish_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `notes_publish_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `notes_publish_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `notes_publish_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`notes_publish_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `notes_publish_file`
-- ----------------------------
DROP TABLE IF EXISTS `notes_publish_file`;
CREATE TABLE `notes_publish_file` (
  `notes_publish_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `notes_publish_id` int(11) DEFAULT NULL COMMENT '對應 notes_publish 資料表，資料庫流水號',
  `notes_publish_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `notes_publish_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `notes_publish_file_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `notes_publish_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `notes_publish_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `notes_publish_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `notes_publish_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `notes_publish_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `notes_publish_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`notes_publish_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `organic_rules`
-- ----------------------------
DROP TABLE IF EXISTS `organic_rules`;
CREATE TABLE `organic_rules` (
  `org_rules_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `org_rules_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `org_rules_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `org_rules_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `org_rules_content` longtext COMMENT '內文',
  `org_rules_orig_filename` varchar(255) DEFAULT NULL COMMENT '圖片原檔名',
  `org_rules_filename` varchar(255) DEFAULT NULL COMMENT '圖片真實檔名',
  `org_rules_show_date` date DEFAULT NULL COMMENT '發佈日期',
  `org_rules_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `org_rules_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `org_rules_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `org_rules_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `org_rules_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  PRIMARY KEY (`org_rules_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `organic_rules_file`
-- ----------------------------
DROP TABLE IF EXISTS `organic_rules_file`;
CREATE TABLE `organic_rules_file` (
  `org_rules_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `org_rules_id` int(11) DEFAULT NULL COMMENT '對應 org_rules 資料表，資料庫流水號',
  `org_rules_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `org_rules_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `org_rules_file_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `org_rules_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `org_rules_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `org_rules_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `org_rules_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `org_rules_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `org_rules_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`org_rules_file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `permissions`
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `backend_menu_permission_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `backend_menu_permission_name` varchar(255) NOT NULL DEFAULT '' COMMENT '權限名稱',
  `backend_menu_permission_lists` text NOT NULL COMMENT '權限資訊',
  `backend_menu_permission_is_del` tinyint(11) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `backend_menu_permission_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `backend_menu_permission_created_user` int(11) DEFAULT NULL COMMENT '新增人員',
  `backend_menu_permission_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `backend_menu_permission_edited_user` int(11) DEFAULT NULL COMMENT '修改人員',
  PRIMARY KEY (`backend_menu_permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `permissions`
-- ----------------------------
BEGIN;
INSERT INTO `permissions` VALUES ('1', '最高管理員', ',34A,34B,34C,34D,2A,2B,2C,2D,46A,46B,46C,46D,45A,45B,45C,45D,3A,3B,3C,3D,7A,7B,7C,7D,6A,6B,6C,6D,20A,20B,20C,20D,19A,19B,19C,19D,21A,21B,21C,21D,9A,9B,9C,9D,43A,43B,43C,43D,10A,10B,10C,10D,16A,16B,16C,16D,17A,17B,17C,17D,13A,13B,13C,13D,14A,14B,14C,14D,18A,18B,18C,18D,4A,4B,4C,4D,27A,27B,27C,27D,23A,23B,23C,23D,24A,24B,24C,24D,25A,25B,25C,25D,28A,28B,28C,28D,29A,29B,29C,29D,11A,11B,11C,11D,32A,32B,32C,32D,26A,26B,26C,26D,22A,22B,22C,22D,33A,33B,33C,33D,30A,30B,30C,30D,44A,44B,44C,44D,5A,5B,5C,5D,35A,35B,35C,35D,31A,31B,31C,31D,', '0', '2017-05-31 07:50:55', '2', '2017-08-29 10:56:01', '2'), ('2', '檢視', ',3A,7A,6A,20A,19A,21A,43A,9A,10A,16A,17A,13A,14A,18A,4A,27A,23A,24A,25A,28A,29A,11A,32A,26A,22A,33A,30A,35A,31A,5A,', '0', '2017-06-21 02:28:26', '2', '2017-06-30 03:29:11', '2'), ('3', '修改', ',34C,2C,3C,7C,6C,20C,19C,21C,43C,9C,10C,16C,17C,13C,14C,18C,4C,27C,23C,24C,25C,28C,29C,11C,32C,26C,22C,33C,30C,35C,31C,5C,', '1', '2017-06-21 05:53:07', '2', '2017-06-21 05:53:21', '2'), ('4', 'test', ',34A,34B,34C,34D,', '1', '2017-06-27 07:25:26', '2', '2017-06-27 07:25:32', '2');
COMMIT;

-- ----------------------------
--  Table structure for `policies`
-- ----------------------------
DROP TABLE IF EXISTS `policies`;
CREATE TABLE `policies` (
  `policy_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `policy_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `policy_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `policy_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `policy_orig_filename` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `policy_filename` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `policy_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `policy_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `policy_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `policy_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `policy_content` longtext COMMENT '內文',
  `policy_show_date` date DEFAULT NULL COMMENT '發佈日期',
  `policy_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  PRIMARY KEY (`policy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `policies_file`
-- ----------------------------
DROP TABLE IF EXISTS `policies_file`;
CREATE TABLE `policies_file` (
  `policy_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `policy_id` int(11) DEFAULT NULL COMMENT '對應 org_purchasess 資料表，資料庫流水號',
  `policy_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `policy_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `policy_file_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `policy_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `policy_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `policy_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `policy_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `policy_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `policy_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`policy_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `purchases`
-- ----------------------------
DROP TABLE IF EXISTS `purchases`;
CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `purchase_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `purchase_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `purchase_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `purchase_orig_filename` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `purchase_filename` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `purchase_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `purchase_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `purchase_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `purchase_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `purchase_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  `purchase_content` longtext COMMENT '內文',
  `purchase_show_date` date DEFAULT NULL COMMENT '發佈日期',
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `purchases_file`
-- ----------------------------
DROP TABLE IF EXISTS `purchases_file`;
CREATE TABLE `purchases_file` (
  `purchase_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `purchase_id` int(11) DEFAULT NULL COMMENT '對應 org_purchasess 資料表，資料庫流水號',
  `purchase_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `purchase_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `purchase_file_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `purchase_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `purchase_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `purchase_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `purchase_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `purchase_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `purchase_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`purchase_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `questions`
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `qa_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `qa_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `qa_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `qa_question` varchar(255) DEFAULT NULL COMMENT '問題',
  `qa_answer` text COMMENT '答案',
  `qa_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `qa_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `qa_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `qa_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `qa_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  `qa_sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`qa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `recoveries`
-- ----------------------------
DROP TABLE IF EXISTS `recoveries`;
CREATE TABLE `recoveries` (
  `repo_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `repo_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `repo_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `repo_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `repo_content` longtext COMMENT '內文',
  `repo_show_date` date DEFAULT NULL COMMENT '申報日期',
  `repo_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `repo_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `repo_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `repo_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `repo_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  PRIMARY KEY (`repo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `recoveries_file`
-- ----------------------------
DROP TABLE IF EXISTS `recoveries_file`;
CREATE TABLE `recoveries_file` (
  `repo_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `repo_id` int(11) DEFAULT NULL COMMENT '對應 org_rules 資料表，資料庫流水號',
  `repo_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `repo_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `repo_file_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `repo_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `repo_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `repo_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `repo_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `repo_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `repo_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`repo_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `regulations`
-- ----------------------------
DROP TABLE IF EXISTS `regulations`;
CREATE TABLE `regulations` (
  `law_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `law_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `law_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `law_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `law_content` longtext COMMENT '內文',
  `law_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `law_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `law_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `law_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `law_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  `law_sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`law_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `regulations_chapter`
-- ----------------------------
DROP TABLE IF EXISTS `regulations_chapter`;
CREATE TABLE `regulations_chapter` (
  `law_chapter_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `law_id` int(11) DEFAULT NULL COMMENT '對應 law 資料表，資料庫流水號',
  `law_chapter_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `law_chapter_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `law_chapter_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `law_chapter_sort` tinyint(4) NOT NULL DEFAULT '1' COMMENT '排序',
  `law_chapter_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `law_chapter_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `law_chapter_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `law_chapter_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`law_chapter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `regulations_file`
-- ----------------------------
DROP TABLE IF EXISTS `regulations_file`;
CREATE TABLE `regulations_file` (
  `law_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `law_id` int(11) DEFAULT NULL COMMENT '對應 law 資料表，資料庫流水號',
  `law_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `law_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `law_file_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `law_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `law_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `law_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `law_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `law_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `law_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`law_file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `regulations_terms`
-- ----------------------------
DROP TABLE IF EXISTS `regulations_terms`;
CREATE TABLE `regulations_terms` (
  `law_terms_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `law_chapter_id` int(11) DEFAULT NULL COMMENT '對應 law 資料表，資料庫流水號',
  `law_terms_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `law_terms_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `law_terms_content` longtext COMMENT '內文',
  `law_terms_sort` tinyint(4) NOT NULL DEFAULT '1' COMMENT '排序',
  `law_terms_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `law_terms_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `law_terms_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `law_terms_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `law_terms_numbering` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '條文編號',
  PRIMARY KEY (`law_terms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `related_links`
-- ----------------------------
DROP TABLE IF EXISTS `related_links`;
CREATE TABLE `related_links` (
  `related_links_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `related_links_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `related_links_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `related_links_title` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '標題',
  `related_links_url` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '外部連結',
  `related_links_sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `related_links_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `related_links_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `related_links_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `related_links_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`related_links_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
--  Table structure for `repossess_list`
-- ----------------------------
DROP TABLE IF EXISTS `repossess_list`;
CREATE TABLE `repossess_list` (
  `repo_list_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `repo_list_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `repo_list_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `repo_list_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `repo_list_content` longtext COMMENT '內文',
  `repo_list_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `repo_list_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `repo_list_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `repo_list_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`repo_list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `repossess_list_chapter`
-- ----------------------------
DROP TABLE IF EXISTS `repossess_list_chapter`;
CREATE TABLE `repossess_list_chapter` (
  `repo_list_chapter_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `repo_list_id` int(11) DEFAULT NULL COMMENT '對應 repossess_list 資料表，資料庫流水號',
  `repo_list_chapter_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `repo_list_chapter_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `repo_list_chapter_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `repo_list_chapter_sort` tinyint(4) NOT NULL DEFAULT '1' COMMENT '排序',
  `repo_list_chapter_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `repo_list_chapter_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `repo_list_chapter_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `repo_list_chapter_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`repo_list_chapter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `repossess_list_terms`
-- ----------------------------
DROP TABLE IF EXISTS `repossess_list_terms`;
CREATE TABLE `repossess_list_terms` (
  `repo_list_terms_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `repo_list_chapter_id` int(11) DEFAULT NULL COMMENT '對應 repossess_list 資料表，資料庫流水號',
  `repo_list_terms_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `repo_list_terms_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `repo_list_terms_content` longtext COMMENT '內文',
  `repo_list_terms_sort` tinyint(4) NOT NULL DEFAULT '1' COMMENT '排序',
  `repo_list_terms_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `repo_list_terms_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `repo_list_terms_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `repo_list_terms_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`repo_list_terms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `reward_list`
-- ----------------------------
DROP TABLE IF EXISTS `reward_list`;
CREATE TABLE `reward_list` (
  `reward_list_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `reward_list_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `reward_list_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `reward_list_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `reward_list_content` longtext COMMENT '內文',
  `reward_list_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `reward_list_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `reward_list_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `reward_list_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`reward_list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `reward_list_chapter`
-- ----------------------------
DROP TABLE IF EXISTS `reward_list_chapter`;
CREATE TABLE `reward_list_chapter` (
  `reward_list_chapter_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `reward_list_id` int(11) DEFAULT NULL COMMENT '對應 reward_list 資料表，資料庫流水號',
  `reward_list_chapter_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `reward_list_chapter_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `reward_list_chapter_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `reward_list_chapter_sort` tinyint(4) NOT NULL DEFAULT '1' COMMENT '排序',
  `reward_list_chapter_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `reward_list_chapter_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `reward_list_chapter_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `reward_list_chapter_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`reward_list_chapter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `reward_list_terms`
-- ----------------------------
DROP TABLE IF EXISTS `reward_list_terms`;
CREATE TABLE `reward_list_terms` (
  `reward_list_terms_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `reward_list_chapter_id` int(11) DEFAULT NULL COMMENT '對應 reward_list 資料表，資料庫流水號',
  `reward_list_terms_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `reward_list_terms_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `reward_list_terms_content` longtext COMMENT '內文',
  `reward_list_terms_sort` tinyint(4) NOT NULL DEFAULT '1' COMMENT '排序',
  `reward_list_terms_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `reward_list_terms_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `reward_list_terms_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `reward_list_terms_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`reward_list_terms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rewards`
-- ----------------------------
DROP TABLE IF EXISTS `rewards`;
CREATE TABLE `rewards` (
  `reward_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `reward_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `reward_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `reward_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `reward_content` longtext COMMENT '內文',
  `reward_show_date` date DEFAULT NULL COMMENT '申報日期',
  `reward_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `reward_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `reward_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `reward_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `reward_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  PRIMARY KEY (`reward_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rewards_file`
-- ----------------------------
DROP TABLE IF EXISTS `rewards_file`;
CREATE TABLE `rewards_file` (
  `reward_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `reward_id` int(11) DEFAULT NULL COMMENT '對應 org_rules 資料表，資料庫流水號',
  `reward_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `reward_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `reward_file_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `reward_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `reward_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `reward_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `reward_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `reward_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `reward_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`reward_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `statistics`
-- ----------------------------
DROP TABLE IF EXISTS `statistics`;
CREATE TABLE `statistics` (
  `sales_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `sales_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `sales_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `sales_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `sales_orig_filename` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `sales_filename` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `sales_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `sales_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `sales_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `sales_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `sales_content` longtext COMMENT '內文',
  `sales_show_date` date DEFAULT NULL COMMENT '發佈日期',
  `sales_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  PRIMARY KEY (`sales_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `statistics_file`
-- ----------------------------
DROP TABLE IF EXISTS `statistics_file`;
CREATE TABLE `statistics_file` (
  `sales_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `sales_id` int(11) DEFAULT NULL COMMENT '對應 org_purchasess 資料表，資料庫流水號',
  `sales_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `sales_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `sales_file_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `sales_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `sales_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `sales_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `sales_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `sales_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `sales_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`sales_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `stories`
-- ----------------------------
DROP TABLE IF EXISTS `stories`;
CREATE TABLE `stories` (
  `history_story_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `history_story_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `history_story_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `history_story_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `history_story_content` longtext COMMENT '內文',
  `history_story_orig_filename` varchar(255) DEFAULT NULL COMMENT '圖片原檔名',
  `history_story_filename` varchar(255) DEFAULT NULL COMMENT '圖片真實檔名',
  `history_story_show_date` date DEFAULT NULL COMMENT '發佈日期',
  `history_story_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `history_story_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `history_story_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `history_story_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `history_story_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  PRIMARY KEY (`history_story_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `stories_file`
-- ----------------------------
DROP TABLE IF EXISTS `stories_file`;
CREATE TABLE `stories_file` (
  `history_story_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `history_story_id` int(11) DEFAULT NULL COMMENT '對應 history_story 資料表，資料庫流水號',
  `history_story_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `history_story_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `history_story_file_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `history_story_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `history_story_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `history_story_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `history_story_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `history_story_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `history_story_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`history_story_file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `users_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `users_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `users_phone` varchar(32) DEFAULT NULL COMMENT '用戶電話',
  `users_account` varchar(64) DEFAULT NULL COMMENT '用戶帳號',
  `users_password` text COMMENT '用戶密碼',
  `users_name` varchar(64) DEFAULT NULL COMMENT '用戶姓名',
  `users_email` varchar(255) DEFAULT NULL COMMENT '用戶信箱',
  `backend_menu_permission_id` int(11) DEFAULT NULL COMMENT '用戶權限',
  `users_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `users_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `users_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `users_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('2', '0', '1', '0912345678', 'tester@unidyna.com', 'LnZQ1HBmFqY4XfoIGmliNXqq38vB4wYjI8YP0I0FEmIElv4QmMlbTCtyGuF4g4W5', 'test', 'tester@unidyna.com', '1', '2017-04-07 17:36:00', '1', '2017-06-29 12:59:18', '2');
COMMIT;

-- ----------------------------
--  Table structure for `users_log`
-- ----------------------------
DROP TABLE IF EXISTS `users_log`;
CREATE TABLE `users_log` (
  `users_log_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `users_log_type` tinyint(4) DEFAULT NULL COMMENT 'LOG類別 0:新增 1:修改 2:刪除 3:登入 4:登出',
  `users_id` int(11) DEFAULT NULL COMMENT '用戶ID',
  `users_is_del_before` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `users_is_del_after` tinyint(4) NOT NULL DEFAULT '0',
  `users_status_before` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `users_status_after` tinyint(4) NOT NULL DEFAULT '1',
  `users_phone_before` varchar(32) DEFAULT NULL COMMENT '用戶電話',
  `users_phone_after` varchar(32) DEFAULT NULL,
  `users_account_before` varchar(64) DEFAULT NULL COMMENT '用戶帳號',
  `users_account_after` varchar(64) DEFAULT NULL,
  `users_password_before` varchar(64) DEFAULT NULL COMMENT '用戶密碼',
  `users_password_after` varchar(64) DEFAULT NULL,
  `users_name_before` varchar(64) DEFAULT NULL COMMENT '用戶姓名',
  `users_name_after` varchar(64) DEFAULT NULL COMMENT '用戶姓名',
  `users_email_before` varchar(255) DEFAULT NULL COMMENT '用戶信箱',
  `users_email_after` varchar(255) DEFAULT NULL,
  `backend_menu_permission_id_before` int(11) DEFAULT NULL COMMENT '用戶權限',
  `backend_menu_permission_id_after` int(11) DEFAULT NULL,
  `users_created_date_before` datetime DEFAULT NULL COMMENT '新增時間',
  `users_created_date_after` datetime DEFAULT NULL,
  `users_created_user_before` int(11) DEFAULT NULL COMMENT '新增人員',
  `users_created_user_after` int(11) DEFAULT NULL,
  `users_edited_date_before` datetime DEFAULT NULL COMMENT '修改時間',
  `users_edited_date_after` datetime DEFAULT NULL,
  `users_edited_user_before` int(11) DEFAULT NULL COMMENT '修改人員',
  `users_edited_user_after` int(11) DEFAULT NULL,
  PRIMARY KEY (`users_log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=424 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users_log`
-- ----------------------------
BEGIN;
INSERT INTO `users_log` VALUES ('419', '3', '2', '0', '0', '1', '1', null, null, 'unidynaoffice@unidyna.com', null, null, null, 'unidynaoffice', null, null, null, null, null, null, null, null, null, null, null, null, null), ('420', '4', '2', '0', '0', '1', '1', null, null, null, 'unidynaoffice@unidyna.com', null, null, null, 'unidynaoffice', null, null, null, null, null, null, null, null, null, null, null, null), ('421', '3', '2', '0', '0', '1', '1', null, null, 'unidynaoffice@unidyna.com', null, null, null, 'unidynaoffice', null, null, null, null, null, null, null, null, null, null, null, null, null), ('422', '4', '2', '0', '0', '1', '1', null, null, null, 'unidynaoffice@unidyna.com', null, null, null, 'unidynaoffice', null, null, null, null, null, null, null, null, null, null, null, null), ('423', '3', '2', '0', '0', '1', '1', null, null, 'tester@unidyna.com', null, null, null, 'test', null, null, null, null, null, null, null, null, null, null, null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `videos`
-- ----------------------------
DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `video_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `video_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `video_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `video_content` longtext COMMENT '內文',
  `video_show_date` date DEFAULT NULL COMMENT '發佈日期',
  `video_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `video_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `video_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `video_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  `video_meta_description` varchar(255) DEFAULT NULL COMMENT '分享說明',
  `video_sort` int(11) NOT NULL DEFAULT '0',
  `video_url` varchar(255) DEFAULT NULL COMMENT '連結',
  `video_directions` varchar(255) DEFAULT NULL COMMENT '說明',
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `videos_file`
-- ----------------------------
DROP TABLE IF EXISTS `videos_file`;
CREATE TABLE `videos_file` (
  `video_file_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '資料庫流水號',
  `video_id` int(11) DEFAULT NULL COMMENT '對應 org_rules 資料表，資料庫流水號',
  `video_file_is_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否刪除 0:存活 1:刪除 預設0',
  `video_file_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0:下架 1:上架 預設1',
  `video_file_title` varchar(255) DEFAULT NULL COMMENT '標題',
  `video_file_orig_name` varchar(255) DEFAULT NULL COMMENT '原檔名',
  `video_file_name` varchar(255) DEFAULT NULL COMMENT '真實檔名',
  `video_file_created_date` datetime DEFAULT NULL COMMENT '新增時間',
  `video_file_created_user` int(11) NOT NULL DEFAULT '0' COMMENT '新增人員',
  `video_file_edited_date` datetime DEFAULT NULL COMMENT '修改時間',
  `video_file_edited_user` int(11) NOT NULL DEFAULT '0' COMMENT '修改人員',
  PRIMARY KEY (`video_file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
