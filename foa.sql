-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 05 月 09 日 08:50
-- 服务器版本: 5.5.53
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `foa`
--

-- --------------------------------------------------------

--
-- 表的结构 `oa_admin_role`
--

CREATE TABLE IF NOT EXISTS `oa_admin_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `role_name` varchar(30) DEFAULT NULL COMMENT '角色名称',
  `act_list` text COMMENT '权限列表',
  `role_desc` varchar(255) DEFAULT NULL COMMENT '角色描述',
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `oa_admin_role`
--

INSERT INTO `oa_admin_role` (`role_id`, `role_name`, `act_list`, `role_desc`) VALUES
(2, '管理员', '39,62,63,64,65,66', '管理全站'),
(6, '用户', '39,62,63,64,65', '编写代码');

-- --------------------------------------------------------

--
-- 表的结构 `oa_file`
--

CREATE TABLE IF NOT EXISTS `oa_file` (
  `file_url` text NOT NULL,
  `file_name` text NOT NULL,
  `file_size` text NOT NULL,
  `file_id` int(5) NOT NULL AUTO_INCREMENT,
  `file_pdf` text NOT NULL,
  PRIMARY KEY (`file_id`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=171 ;

-- --------------------------------------------------------

--
-- 表的结构 `oa_img`
--

CREATE TABLE IF NOT EXISTS `oa_img` (
  `img_url` text NOT NULL,
  `img_name` text NOT NULL,
  `img_size` text NOT NULL,
  `img_id` int(5) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`img_id`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=132 ;

-- --------------------------------------------------------

--
-- 表的结构 `oa_info`
--

CREATE TABLE IF NOT EXISTS `oa_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `is_read` tinyint(3) DEFAULT '0' COMMENT '是否需要签收',
  `tos` int(10) NOT NULL DEFAULT '0' COMMENT '登陆人ID',
  `from` int(10) NOT NULL COMMENT '登陆人名称',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '删除标记',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `oa_mail`
--

CREATE TABLE IF NOT EXISTS `oa_mail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `content` text NOT NULL COMMENT '内容',
  `from` varchar(255) DEFAULT NULL COMMENT '发件人',
  `to` varchar(255) DEFAULT NULL COMMENT '收件人',
  `read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '已读',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `user_name` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名称',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `is_del` tinyint(3) NOT NULL DEFAULT '0' COMMENT '删除标记',
  `type` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `create_time` (`create_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `oa_mail_account`
--

CREATE TABLE IF NOT EXISTS `oa_mail_account` (
  `smtp_server` varchar(50) NOT NULL,
  `id` mediumint(6) NOT NULL,
  `smtp_port` int(6) DEFAULT NULL COMMENT '邮件地址',
  `smtp_user` varchar(50) NOT NULL DEFAULT '' COMMENT '邮件显示名称',
  `smtp_pwd` varchar(50) NOT NULL DEFAULT '' COMMENT 'pop服务器',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '邮件密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='think_user_info';

-- --------------------------------------------------------

--
-- 表的结构 `oa_onework`
--

CREATE TABLE IF NOT EXISTS `oa_onework` (
  `user` varchar(10) NOT NULL COMMENT '用户名',
  `content` text NOT NULL COMMENT '留言内容',
  `time` datetime NOT NULL COMMENT '留言时间',
  `img_id` int(11) DEFAULT NULL COMMENT '图片id',
  `file_id` int(11) DEFAULT NULL COMMENT '文件id',
  `workorder_id` int(11) NOT NULL COMMENT '工单id',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

-- --------------------------------------------------------

--
-- 表的结构 `oa_system_config`
--

CREATE TABLE IF NOT EXISTS `oa_system_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `val` varchar(255) DEFAULT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `sort` varchar(20) DEFAULT NULL,
  `pid` int(11) DEFAULT '0',
  `data_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `oa_system_config`
--

INSERT INTO `oa_system_config` (`id`, `code`, `name`, `val`, `is_del`, `sort`, `pid`, `data_type`) VALUES
(1, 'login_verify_code', '', '0', 0, NULL, 0, 'system');

-- --------------------------------------------------------

--
-- 表的结构 `oa_system_menu`
--

CREATE TABLE IF NOT EXISTS `oa_system_menu` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '权限名字',
  `group` varchar(20) DEFAULT NULL COMMENT '所属分组',
  `right` text COMMENT '权限码(控制器+动作)',
  `is_del` tinyint(1) DEFAULT '0' COMMENT '删除状态 1删除,0正常',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- 转存表中的数据 `oa_system_menu`
--

INSERT INTO `oa_system_menu` (`id`, `name`, `group`, `right`, `is_del`) VALUES
(3, '工作日志', 'work', 'WorkController@worklog', 0),
(4, '工作列表', 'work', 'WorkController@worklist', 0),
(5, '任务列表', 'work', 'WorkController@task', 0),
(6, '任务状态', 'work', 'WorkController@status', 0),
(7, '已发送', 'mail', 'MailController@maillist', 0),
(8, '写信', 'mail', 'MailController@sendemail', 0),
(9, '草稿箱', 'mail', 'MailController@draftmail', 0),
(10, '垃圾箱', 'mail', 'MailController@trashmail', 0),
(11, '草稿箱', 'mail', 'MailController@draftmail', 0),
(12, '邮件设置', 'mail', 'MailController@config', 0),
(13, '我的信息', 'info', 'InfoController@index', 0),
(27, '工作统计', 'form', 'FormController@index', 0),
(39, '用户管理', 'manager', 'ManagerController@user', 0),
(40, '角色管理', 'manager', 'ManagerController@role', 0),
(62, '发布工单', 'workorder', 'WorkorderController@newwork', 0),
(63, '所有工单', 'workorder', 'WorkorderController@allwork', 0),
(64, '等待回复工单', 'workorder', 'MyworkController@waittingreply', 0),
(65, '我发布的工单', 'workorder', 'MyworkController@myworkorder', 0),
(66, '我处理的工单', 'workorder', 'MyworkController@handleworkorder', 0);

-- --------------------------------------------------------

--
-- 表的结构 `oa_task`
--

CREATE TABLE IF NOT EXISTS `oa_task` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL DEFAULT '' COMMENT '标题',
  `content` varchar(255) DEFAULT NULL COMMENT '内容',
  `expected_time` int(11) DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_name` varchar(20) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `dept_name` varchar(20) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `status` tinyint(3) DEFAULT '0',
  `is_del` tinyint(3) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `oa_user`
--

CREATE TABLE IF NOT EXISTS `oa_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `emp_no` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL,
  `letter` varchar(10) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `birthday` date DEFAULT NULL,
  `last_login_ip` varchar(40) DEFAULT NULL,
  `login_count` int(8) DEFAULT NULL,
  `pic` varchar(200) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `duty` varchar(2000) NOT NULL,
  `office_tel` varchar(20) NOT NULL,
  `mobile_tel` varchar(20) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  `openid` varchar(50) DEFAULT NULL,
  `westatus` tinyint(3) DEFAULT '0',
  `init_pwd` tinyint(3) DEFAULT NULL,
  `pay_pwd` varchar(32) DEFAULT NULL,
  `role_id` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`emp_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `oa_user`
--

INSERT INTO `oa_user` (`id`, `emp_no`, `name`, `letter`, `password`, `dept_id`, `position_id`, `sex`, `birthday`, `last_login_ip`, `login_count`, `pic`, `email`, `duty`, `office_tel`, `mobile_tel`, `create_time`, `update_time`, `is_del`, `openid`, `westatus`, `init_pwd`, `pay_pwd`, `role_id`) VALUES
(11, 'admin1', 'admin1', '', 'e00cf25ad42683b3df678c61f42c6bda', 0, 0, '', NULL, '127.0.0.1', NULL, NULL, '', '', '', '', 1525660624, 0, 0, NULL, 0, NULL, NULL, 2),
(12, 'admin2', 'admin2', '', 'c84258e9c39059a89ab77d846ddab909', 0, 0, '', NULL, '127.0.0.1', NULL, NULL, '', '', '', '', 1525660644, 0, 0, NULL, 0, NULL, NULL, 2),
(13, 'admin3', 'admin3', '', '32cacb2f994f6b42183a1300d9a3e8d6', 0, 0, '', NULL, NULL, NULL, NULL, '', '', '', '', 1525660663, 0, 0, NULL, 0, NULL, NULL, 2),
(14, 'admin4', 'admin4', '', 'fc1ebc848e31e0a68e868432225e3c82', 0, 0, '', NULL, NULL, NULL, NULL, '', '', '', '', 1525660677, 0, 0, NULL, 0, NULL, NULL, 2),
(15, 'user1', 'user1', '', '24c9e15e52afc47c225b757e7bee1f9d', 0, 0, '', NULL, '127.0.0.1', NULL, NULL, '', '', '', '', 1525660727, 0, 0, NULL, 0, NULL, NULL, 6),
(16, 'user2', 'user2', '', '7e58d63b60197ceb55a1c487989a3720', 0, 0, '', NULL, NULL, NULL, NULL, '', '', '', '', 1525660759, 0, 0, NULL, 0, NULL, NULL, 6);

-- --------------------------------------------------------

--
-- 表的结构 `oa_worklog`
--

CREATE TABLE IF NOT EXISTS `oa_worklog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_name` varchar(20) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  `content` varchar(600) DEFAULT NULL,
  `plan` varchar(600) DEFAULT NULL,
  `is_del` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `oa_workorder`
--

CREATE TABLE IF NOT EXISTS `oa_workorder` (
  `del` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1为正常2为已删除',
  `title` varchar(10) NOT NULL COMMENT '标题',
  `rank` enum('1','2','3','4') NOT NULL COMMENT '工单级别',
  `content` text NOT NULL COMMENT '内容',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `file_id` int(5) NOT NULL COMMENT '文件ID',
  `img_id` int(5) NOT NULL COMMENT '图片ID',
  `status` enum('1','2','3','4') NOT NULL DEFAULT '1' COMMENT '工单状态',
  `user_id` int(5) NOT NULL COMMENT '发布人ID',
  `solve_uid` int(5) NOT NULL DEFAULT '0' COMMENT '接单人ID',
  `leibie` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1查询，2需求，3管理',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=195 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
