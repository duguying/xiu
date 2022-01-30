-- phpMyAdmin SQL Dump
-- version 4.0.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 07 月 30 日 04:36
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `aixuanxiu`
--
CREATE DATABASE IF NOT EXISTS `aixuanxiu` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `aixuanxiu`;

-- --------------------------------------------------------

--
-- 表的结构 `xiu_admin`
--

CREATE TABLE IF NOT EXISTS `xiu_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) DEFAULT NULL COMMENT '密码MD5',
  `nickname` varchar(255) DEFAULT '新建管理员' COMMENT '昵称',
  `grade` enum('1','2') DEFAULT NULL COMMENT '等级【1级：课程管理用户管理。2级：评论管理】',
  `regtime` timestamp NULL DEFAULT NULL COMMENT '注册时间',
  `lasttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后离开时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `xiu_admin`
--

INSERT INTO `xiu_admin` (`id`, `username`, `password`, `nickname`, `grade`, `regtime`, `lasttime`) VALUES
(1, 'admin', 'ajdfg', 'admin', '2', '2013-07-29 08:41:00', '2013-07-29 08:40:50'),
(2, 'lijun', 'dfgsdfg', 'lijun', '1', '2013-07-29 08:49:07', '2013-07-29 08:49:09'),
(3, 'test', 'adsf', '', '1', '2013-07-29 10:07:31', '2013-07-29 10:06:53');

-- --------------------------------------------------------

--
-- 表的结构 `xiu_admin_filter`
--

CREATE TABLE IF NOT EXISTS `xiu_admin_filter` (
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键词'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='过滤关键词表';

--
-- 转存表中的数据 `xiu_admin_filter`
--

INSERT INTO `xiu_admin_filter` (`keyword`) VALUES
('MLGB'),
('我草'),
('我操'),
('我擦');

-- --------------------------------------------------------

--
-- 表的结构 `xiu_admin_iplimit`
--

CREATE TABLE IF NOT EXISTS `xiu_admin_iplimit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ips` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ip域',
  `comment` varchar(5120) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='管理员ip限制表' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `xiu_admin_iplimit`
--

INSERT INTO `xiu_admin_iplimit` (`id`, `ips`, `comment`) VALUES
(1, '10.10', '10IP'),
(2, '127.0.0.1', '本地'),
(3, '192.168.0.1', 'user1'),
(4, '20.1.1', 'yyy'),
(5, '5.9', 'ji'),
(6, '255.255.255.255', 'long'),
(7, '10.10.0.1', '这儿有十五个汉字这儿有十五个汉');

-- --------------------------------------------------------

--
-- 表的结构 `xiu_admin_log`
--

CREATE TABLE IF NOT EXISTS `xiu_admin_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'super',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '时间',
  `log` text COLLATE utf8_unicode_ci NOT NULL COMMENT '操作内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='管理员操作日志' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `xiu_at`
--

CREATE TABLE IF NOT EXISTS `xiu_at` (
  `at_id` int(11) NOT NULL AUTO_INCREMENT,
  `at_user_id` int(11) DEFAULT NULL COMMENT '@用户',
  `at_from_user_id` int(11) DEFAULT NULL COMMENT '来自用户',
  `at_time` int(11) DEFAULT NULL COMMENT '@时间',
  `at_type` int(1) DEFAULT NULL COMMENT '来自类别：1,cmt;2,tpc;3,tk',
  `tk_location_id` int(11) DEFAULT NULL COMMENT '具体信息的id',
  PRIMARY KEY (`at_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='@用户表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `xiu_change_psw`
--

CREATE TABLE IF NOT EXISTS `xiu_change_psw` (
  `cp_id` int(11) NOT NULL AUTO_INCREMENT,
  `cp_key` varchar(255) NOT NULL DEFAULT '' COMMENT '密匙',
  `cp_time` int(11) DEFAULT NULL COMMENT '生成时间',
  PRIMARY KEY (`cp_id`),
  UNIQUE KEY `cp_key` (`cp_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='修改密码请求表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `xiu_class`
--

CREATE TABLE IF NOT EXISTS `xiu_class` (
  `cls_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cls_name` varchar(255) DEFAULT NULL COMMENT '课程名称',
  `cls_teacher_id` int(11) unsigned DEFAULT NULL COMMENT '上课老师ID',
  `cls_time` varchar(255) DEFAULT '' COMMENT '上课时间',
  `cls_addr` varchar(255) DEFAULT NULL COMMENT '上课地址',
  `cls_score` varchar(255) DEFAULT NULL COMMENT '课程评价分数',
  `cls_college` varchar(255) DEFAULT NULL COMMENT '开课学院',
  `cls_class_time` int(2) unsigned DEFAULT NULL COMMENT '课程学时',
  `cls_clsscore` float(3,1) DEFAULT NULL COMMENT '课程学分',
  `cls_target` varchar(255) DEFAULT NULL COMMENT '课程对象',
  `cls_roll_call` varchar(255) DEFAULT NULL COMMENT '点名频率',
  `cls_homework_type` varchar(255) DEFAULT NULL COMMENT '作业类型',
  `cls_exam_method` varchar(255) DEFAULT NULL COMMENT '考核方式',
  `cls_introduction` varchar(255) DEFAULT NULL COMMENT '课程介绍',
  `cls_pass_rate` varchar(255) DEFAULT NULL COMMENT '通过率',
  `cls_stu_sex` int(3) DEFAULT NULL COMMENT '性别率【男生比】',
  `cls_category` int(2) NOT NULL DEFAULT '0' COMMENT '课程所属类别',
  PRIMARY KEY (`cls_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='课程表【主表】' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `xiu_class`
--

INSERT INTO `xiu_class` (`cls_id`, `cls_name`, `cls_teacher_id`, `cls_time`, `cls_addr`, `cls_score`, `cls_college`, `cls_class_time`, `cls_clsscore`, `cls_target`, `cls_roll_call`, `cls_homework_type`, `cls_exam_method`, `cls_introduction`, `cls_pass_rate`, `cls_stu_sex`, `cls_category`) VALUES
(1, 'MATLAB程序设计', 84, '日1', '13#102', '4', '计算机科学院', 17, 1.5, '所有学生', NULL, NULL, NULL, 'MATLAB编程是一门计算机语言课程，主要用于科学计算，在各学科中应用较多。', NULL, NULL, 1),
(2, '环境科学概论', 2, '一1', '东13-C-217c', '2', '化学与环境工程学院', 17, 1.5, '所有学生', NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `xiu_class_category`
--

CREATE TABLE IF NOT EXISTS `xiu_class_category` (
  `ct_id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ct_name` varchar(255) DEFAULT NULL COMMENT '类别名',
  PRIMARY KEY (`ct_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='课程分类' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `xiu_class_category`
--

INSERT INTO `xiu_class_category` (`ct_id`, `ct_name`) VALUES
(1, '自然科学类'),
(2, '文化与哲学类'),
(3, '艺术及其他类'),
(4, '语言文学类'),
(5, '历史类');

-- --------------------------------------------------------

--
-- 表的结构 `xiu_comment`
--

CREATE TABLE IF NOT EXISTS `xiu_comment` (
  `cmt_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `cmt_content` varchar(255) DEFAULT NULL COMMENT '评论内容',
  `cmt_class_id` int(11) DEFAULT NULL COMMENT '评论课程ID',
  `cmt_score` int(11) NOT NULL DEFAULT '0' COMMENT '评论的总分',
  `cmt_score_time` int(11) NOT NULL DEFAULT '1' COMMENT '评论被打分次数',
  `cmt_user_id` int(11) DEFAULT NULL COMMENT '评论者ID',
  `cmt_time` int(11) DEFAULT NULL COMMENT '评论时间',
  PRIMARY KEY (`cmt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='评论表' AUTO_INCREMENT=37 ;

--
-- 转存表中的数据 `xiu_comment`
--

INSERT INTO `xiu_comment` (`cmt_id`, `cmt_content`, `cmt_class_id`, `cmt_score`, `cmt_score_time`, `cmt_user_id`, `cmt_time`) VALUES
(1, 'sdfgdsfhsdh', 1, 53, 14, 1, 23),
(2, 'fdgsdg', 1, 17, 9, 1, 34),
(3, '山语庭苑5十一二', 1, 11, 3, 2, 23132),
(4, '虽然它是人体', 1, 12, 3, 1, 324123),
(5, '三大特色人的方式', 1, 8, 3, 1, 3423),
(6, '三天小方法', 1, 5, 2, 1, 3256),
(7, '虽然通过发挥', 1, 10, 3, 2, 54321),
(8, '热通过湖南电视台', 2, 12, 4, 1, 2457),
(9, '人体艺术各地纷纷', 1, 10, 3, 1, 65742),
(10, '人听音乐呢豆腐干', 3, 10, 3, 1, 653),
(11, '人太阳能我不是对人体部分', 1, 5, 2, 1, 24657),
(12, 'asdmf,smdnhev,', 2, 9, 3, 3, 2313),
(13, 'afg234ds', 3, 10, 3, 3, 23),
(14, 'dfsgdfggkjfgk', 2, 10, 3, 3, 2341),
(15, ' dfng,dsmv f', 3, 8, 3, 2, 45),
(16, ' ads v,dsvba.v a', 2, 8, 3, 3, 354),
(17, 'fgbdfb gf d gb gb', 2, 15, 4, 2, 23),
(18, 'dfkg,hdfkgmnvb,kgugvnbd,sfiysdfkl.sdmnsd,fmn.dfkgireegrn', 1, 5, 2, 1, 1360670466),
(19, 'dfkg,hdfkgmnvb,kgugvnbd,sfiysdfkl.sdmnsd,fmn.dfkgireegrn', 1, 10, 3, 1, 1360670505),
(20, 'dfkg,hdfkgmnvb,kgugvnbd,sfiysdfkl.sdmnsd,fmn.dfkgireegrn', 1, 15, 4, 1, 1360670602),
(21, '这是一项点评测试', 1, 15, 4, 1, 1360670637),
(22, '再来测试一下', 2, 10, 3, 1, 1360672437),
(23, '东方卡阿萨德房价阿萨德，返回的阿萨德据法国', 2, 10, 3, 1, 1360672469),
(24, '豆腐干豆腐干', 1, 10, 3, 1, 1360683446),
(25, '测试评论', 1, 10, 3, 4, 1360764449),
(26, 'df,ghskghslkfghdsfg', 1, 10, 3, 4, 1360768026),
(27, '这是一项评论', 2, 15, 4, 4, 1360775180),
(28, '', 2, 10, 3, 1, 1360996911),
(29, 'fasfgdsfgadsg', 2, 5, 2, 1, 1361089119),
(30, '', 2, 4, 2, 1, 1361089975),
(31, '', 2, 5, 2, 1, 1361090179),
(32, '', 2, 5, 2, 1, 1361090213),
(33, 'adfgasgasg', 2, 5, 2, 1, 1361090392),
(34, '', 2, 5, 2, 1, 1361090406),
(35, '', 2, 5, 2, 1, 1361090496),
(36, 'dfgsdgdg', 2, 5, 2, 1, 1361113430);

-- --------------------------------------------------------

--
-- 表的结构 `xiu_figure`
--

CREATE TABLE IF NOT EXISTS `xiu_figure` (
  `fg_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `fg_url` varchar(255) DEFAULT NULL COMMENT '图像原地址',
  `fg_user_id` varchar(255) DEFAULT NULL COMMENT '用户id',
  `fg_rs` blob COMMENT '图像资源数据',
  `fg_type` int(1) NOT NULL DEFAULT '0' COMMENT '默认图片来源,0使用默认,1使用外链,2使用本地',
  PRIMARY KEY (`fg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='图像表100*100png' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `xiu_figure`
--

INSERT INTO `xiu_figure` (`fg_id`, `fg_url`, `fg_user_id`, `fg_rs`, `fg_type`) VALUES
(1, '', '1', NULL, 1),
(2, 'http://localhost/xiu/Public/img/221249_100.jpg', '2', NULL, 1),
(3, NULL, '3', NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `xiu_oc`
--

CREATE TABLE IF NOT EXISTS `xiu_oc` (
  `oc_id` int(11) NOT NULL AUTO_INCREMENT,
  `oc_qq_oid` varchar(255) DEFAULT NULL COMMENT 'QQ用户open_id',
  `oc_renren_oid` varchar(255) DEFAULT NULL COMMENT '人人用户openID',
  `oc_sina_oid` varchar(255) DEFAULT NULL COMMENT '新浪用户openID',
  `oc_msn_oid` varchar(255) DEFAULT NULL COMMENT 'msn用户openID',
  `oc_douban_oid` varchar(255) DEFAULT NULL COMMENT '豆瓣用户openID',
  `oc_diandian_oid` varchar(255) DEFAULT NULL COMMENT '点点用户openID',
  `oc_user_id` int(11) DEFAULT NULL COMMENT '对应的本地数据库user_id',
  PRIMARY KEY (`oc_id`),
  KEY `oc_user_id` (`oc_user_id`),
  KEY `oc_qc_open_id` (`oc_qq_oid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Open Connect信息表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `xiu_point_record`
--

CREATE TABLE IF NOT EXISTS `xiu_point_record` (
  `pr_id` int(11) NOT NULL AUTO_INCREMENT,
  `pr_point` int(2) DEFAULT NULL COMMENT '分数',
  `pr_type` int(2) DEFAULT NULL COMMENT '打分类型，1cmt，2cls, 3rat',
  `pr_user_id` int(11) DEFAULT NULL COMMENT '打分者id',
  `pr_item_id` int(11) DEFAULT NULL COMMENT '所打分项目id',
  PRIMARY KEY (`pr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='打分记录表' AUTO_INCREMENT=105 ;

--
-- 转存表中的数据 `xiu_point_record`
--

INSERT INTO `xiu_point_record` (`pr_id`, `pr_point`, `pr_type`, `pr_user_id`, `pr_item_id`) VALUES
(22, 3, 1, 1, 1),
(23, 4, 1, 1, 2),
(24, 4, 1, 1, 3),
(25, 5, 1, 1, 4),
(26, 4, 1, 1, 6),
(27, 3, 1, 1, 5),
(28, 4, 1, 1, 8),
(29, 5, 1, 1, 7),
(30, 3, 1, 9, 1),
(31, 3, 1, 9, 2),
(32, 5, 1, 9, 3),
(33, 2, 1, 9, 4),
(34, 1, 1, 9, 6),
(35, 5, 1, 1, 9),
(36, 5, 1, 2, 1),
(37, 3, 1, 2, 8),
(38, 5, 1, 2, 9),
(39, 4, 1, 2, 2),
(40, 5, 1, 3, 7),
(41, 2, 1, 2, 3),
(42, 3, 1, 4, 16),
(43, 3, 1, 4, 15),
(44, 5, 1, 4, 17),
(45, 4, 1, 4, 2),
(46, 4, 1, 4, 12),
(47, 5, 1, 4, 14),
(48, 3, 1, 4, 1),
(49, 5, 1, 4, 8),
(50, 5, 1, 2, 17),
(51, 5, 1, 2, 16),
(52, 5, 1, 1, 17),
(53, 5, 1, 1, 14),
(54, 5, 1, 1, 12),
(55, 5, 1, 1, 21),
(56, 5, 1, 1, 11),
(57, 5, 1, 1, 18),
(58, 5, 1, 1, 10),
(59, 5, 1, 1, 15),
(60, 5, 1, 1, 24),
(61, 5, 1, 1, 23),
(62, 5, 1, 1, 22),
(63, 5, 1, 1, 13),
(64, 5, 1, 1, 19),
(65, 5, 1, 1, 20),
(66, 5, 1, 4, 24),
(67, 5, 1, 4, 23),
(68, 5, 1, 4, 22),
(69, 5, 1, 4, 21),
(70, 5, 1, 4, 20),
(71, 5, 1, 4, 4),
(72, 5, 1, 4, 25),
(73, 5, 1, 4, 13),
(74, 5, 1, 4, 10),
(75, 5, 1, 4, 26),
(76, 5, 1, 4, 19),
(77, 5, 1, 4, 27),
(78, 5, 1, 2, 27),
(79, 5, 1, 2, 20),
(80, 5, 1, 1, 27),
(81, 5, 1, 1, 26),
(82, 5, 1, 1, 25),
(83, 5, 1, 4, 5),
(86, 5, 2, 2, 2),
(87, 3, 3, 2, 2),
(88, 1, 3, 3, 2),
(89, 1, 2, 3, 2),
(90, 1, 2, 1, 2),
(91, 5, 1, 1, 28),
(92, 5, 2, 1, 1),
(93, 5, 3, 1, 1),
(94, 5, 1, 2, 28),
(95, 5, 1, 2, 21),
(96, 5, 3, 1, 2),
(97, 5, 1, 1, 29),
(98, 5, 1, 1, 35),
(99, 5, 1, 1, 34),
(100, 5, 1, 1, 33),
(101, 5, 1, 1, 36),
(102, 4, 1, 1, 30),
(103, 5, 1, 2, 32),
(104, 5, 1, 2, 31);

-- --------------------------------------------------------

--
-- 表的结构 `xiu_recycle`
--

CREATE TABLE IF NOT EXISTS `xiu_recycle` (
  `rc_id` int(11) NOT NULL AUTO_INCREMENT,
  `rc_table` varchar(255) DEFAULT NULL COMMENT '所来自的表格',
  `rc_time` int(11) DEFAULT NULL COMMENT '操作时间',
  `rc_content` text COMMENT '内容，json类型',
  PRIMARY KEY (`rc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='删除信息表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `xiu_reply_cmt`
--

CREATE TABLE IF NOT EXISTS `xiu_reply_cmt` (
  `rplcmt_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '回复ID',
  `rplcmt_content` varchar(255) DEFAULT NULL COMMENT '回复内容',
  `rplcmt_user_id` int(11) DEFAULT NULL COMMENT '回复者ID',
  `rplcmt_time` int(11) DEFAULT NULL COMMENT '回帖时间',
  `rplcmt_cmt_id` int(11) DEFAULT NULL COMMENT '原帖ID',
  PRIMARY KEY (`rplcmt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='评论回复表' AUTO_INCREMENT=68 ;

--
-- 转存表中的数据 `xiu_reply_cmt`
--

INSERT INTO `xiu_reply_cmt` (`rplcmt_id`, `rplcmt_content`, `rplcmt_user_id`, `rplcmt_time`, `rplcmt_cmt_id`) VALUES
(1, '大番薯', 1, NULL, 2),
(2, '梵蒂冈', 1, NULL, 23),
(3, 'fghdfghfgh', 2, NULL, 23),
(16, NULL, 4, 1360769507, 1),
(17, 'hsdghdsgh', 4, 1360770910, 1),
(18, 'hsdghdsgh', 4, 1360770988, 26),
(19, 'hsdghdsgh', 4, 1360771174, 26),
(20, 'hsdghdsgh', 4, 1360771244, 26),
(21, '.ljk.lv,dmf', 4, 1360771365, 26),
(22, '.lkjlgb', 4, 1360771414, 26),
(23, '.dkfjg.dfbnth gb', 4, 1360771434, 26),
(24, 'gfjbf f kfjv', 4, 1360771488, 26),
(25, 'df,jdfkd.gdsfgd', 4, 1360771790, 25),
(26, 'smdfgbjgf', 4, 1360771820, 25),
(27, 'bhdmbn fm fv', 4, 1360771862, 24),
(28, 'dfbdfbdfb', 4, 1360771907, 24),
(29, ' dfg h hdv', 4, 1360771939, 22),
(30, '这是回复评论的一项测试，如果成功，将会自动添加', 4, 1360772494, 26),
(31, '这是回复评论的一项测试，如果成功，将会自动添加', 4, 1360772578, 26),
(32, '成功了', 4, 1360772597, 26),
(33, '成功，将会自动这是回复评论的一项测试，', 4, 1360772879, 26),
(34, '一项测试，如果成成功，将会', 4, 1360773028, 26),
(35, 'fjbf f kfjv，如果成成功，将会', 4, 1360773196, 26),
(36, '试，如果成成kfjv，如果成成功，', 4, 1360773242, 26),
(37, '     \n\n    测试用户 回应： 这是回复评论的一项测试，如果成功，将会自动添加\n    回应时间：13分钟前回复\n\n    测试用户 回应： 这是回复评论的一项测试，如果成', 4, 1360773297, 26),
(38, '用户 回应： 这是回复评论的一项测试，如果成功，将会自动添加 回应时间：13', 4, 1360773311, 26),
(39, '回复评论的一项测试，如果', 4, 1360773317, 26),
(40, '终于，这一模块彻底成功了', 4, 1360773390, 22),
(41, '看见对方卡萨帝景房', 4, 1360773529, 26),
(42, 'xcmbjxz,vz.,', 4, 1360773695, 26),
(43, 'sdfgsdhdbxcbvcbfghb', 4, 1360773737, 26),
(44, '这一模块彻底成功', 4, 1360773768, 24),
(45, 'fdsgj.sgf', 4, 1360774342, 22),
(46, '东方大厦股份的时光飞逝德国大使馆', 4, 1360774370, 22),
(47, 'gsdbsdgbfsb发动更多是法国', 1, 1360774787, 19),
(48, 'dfsdfdfgdgds', 4, 1360774906, 19),
(49, 'dmfngdfjg,dgjdfg', 4, 1360774994, 21),
(50, 'dfjkghdsfjkgdgkdfgporjm;bm;rb;rbm', 4, 1360775072, 25),
(51, '才vcxvb', 4, 1360775192, 27),
(52, 'sdfgdfgdsgdg', 2, 1360775381, 27),
(53, '来自ie9', 2, 1360775436, 27),
(54, 'kdufgalskdghsdk', 4, 1360810037, 17),
(55, 'sdfaerfbabfbfrbfbfb', 4, 1360810060, 17),
(56, 'basfbfbfdbfdb', 4, 1360810063, 17),
(57, 'fgrbsafgbsfgbrgfb', 4, 1360810067, 17),
(58, 'sgrfbsgrfbfbrdgfbgfrb', 4, 1360810071, 17),
(59, 'nghndtgntdtn', 4, 1360810074, 17),
(60, 'dtndthnedthndtn', 4, 1360810078, 17),
(61, 'edndethntghngngn', 4, 1360810081, 17),
(62, 'dehndethndthn', 4, 1360810085, 17),
(63, '斯蒂芬森科技大会上', 4, 1360899738, 27),
(64, '恢复健康高科技', 4, 1360923188, 8),
(65, '变得更反感', 4, 1360929950, 20),
(66, '选修课导航\n\n英语词汇学 冷琦\n英语思辨技巧训练（一） 周文慧\n中华诗词写作 占骁勇\n建筑史概论 万谦\n政治的逻辑 梁木生\n昆曲欣赏 唐荣\n舞蹈艺术与舞蹈文化', 4, 1360931788, 27),
(67, 'http://localhost/aixuanxiu/home/user/4.do', 4, 1360931800, 27);

-- --------------------------------------------------------

--
-- 表的结构 `xiu_reply_tpc`
--

CREATE TABLE IF NOT EXISTS `xiu_reply_tpc` (
  `rpltpc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '回复贴ID',
  `rpltpc_topic_id` int(11) DEFAULT NULL COMMENT '回复的主题贴的ID',
  `rpltpc_content` varchar(255) DEFAULT NULL COMMENT '主题回复内容',
  `rpltpc_user_id` int(11) DEFAULT NULL COMMENT '回复主题者ID',
  `rpltpc_time` varchar(255) DEFAULT NULL COMMENT '回帖时间',
  PRIMARY KEY (`rpltpc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='主题回复表' AUTO_INCREMENT=61 ;

--
-- 转存表中的数据 `xiu_reply_tpc`
--

INSERT INTO `xiu_reply_tpc` (`rpltpc_id`, `rpltpc_topic_id`, `rpltpc_content`, `rpltpc_user_id`, `rpltpc_time`) VALUES
(5, 4, 'dfgdsgghw', 2, '1349420629'),
(23, 7, 'content', 1, '1360948296'),
(24, 7, 'content', 1, '1360948707'),
(25, 7, 'content', 1, '1360948712'),
(26, 7, 'content', 1, '1360948767'),
(27, 7, '光的反射', 1, '1360948800'),
(28, 7, '光的反射', 1, '1360948882'),
(29, 7, '光的反射', 1, '1360948889'),
(30, 7, '再发一条', 1, '1360948905'),
(31, 7, '对方是否', 1, '1360949117'),
(32, 7, 'dfhgs', 1, '1360950938'),
(33, 19, '测试一下', 1, '1360953078'),
(34, 19, '没机会', 1, '1361000648'),
(35, 24, 'asdfsdfs', 1, '1361090577'),
(36, 22, '1', 1, '1361181405'),
(37, 22, '2', 1, '1361181409'),
(38, 22, '3', 1, '1361181411'),
(39, 22, '4', 1, '1361181416'),
(40, 22, '5', 1, '1361181420'),
(41, 22, '6', 1, '1361181424'),
(42, 22, '7', 1, '1361181428'),
(43, 22, '8', 1, '1361181435'),
(44, 22, '9', 1, '1361181439'),
(45, 22, '0', 1, '1361181442'),
(46, 22, '10', 1, '1361181456'),
(47, 22, '11', 1, '1361181460'),
(48, 22, '12', 1, '1361181463'),
(49, 22, '13', 1, '1361181467'),
(50, 22, '14', 1, '1361181470'),
(51, 22, '15', 1, '1361181475'),
(52, 22, '16', 1, '1361181480'),
(53, 22, '17', 1, '1361181484'),
(54, 22, '18', 1, '1361181488'),
(55, 22, '19', 1, '1361181491'),
(56, 22, '20', 1, '1361181495'),
(57, 22, '21', 1, '1361181499'),
(58, 22, '22', 1, '1361181517'),
(59, 22, '23', 1, '1361181523'),
(60, 22, '24', 1, '1361181527');

-- --------------------------------------------------------

--
-- 表的结构 `xiu_talk`
--

CREATE TABLE IF NOT EXISTS `xiu_talk` (
  `tk_id` int(11) NOT NULL AUTO_INCREMENT,
  `tk_time` int(11) DEFAULT NULL COMMENT '发表时间',
  `tk_content` varchar(255) DEFAULT NULL COMMENT '内容',
  `tk_user_id` int(11) DEFAULT NULL COMMENT '发表用户',
  PRIMARY KEY (`tk_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='说一句表' AUTO_INCREMENT=126 ;

--
-- 转存表中的数据 `xiu_talk`
--

INSERT INTO `xiu_talk` (`tk_id`, `tk_time`, `tk_content`, `tk_user_id`) VALUES
(1, 12321413, '，麻烦vdsv阿萨德减肥', 1),
(2, 3452452, 'fdgdsfgdfgfgghj', 2),
(3, 1360854807, '第一次测试', 1),
(4, 1360855210, '第二次测试', 1),
(5, 1360855255, '第3次测试', 1),
(6, 1360855287, '第4次测试', 1),
(7, 1360855399, '第5次测试', 1),
(8, 1360855492, '第6次测试', 1),
(9, 1360856018, '第8次测试', 1),
(10, 1360856229, '第10次测试', 1),
(11, 1360856263, '第11次测试', 1),
(12, 1360856516, 'talk', 1),
(13, 1360856585, '你感兴趣的', 1),
(14, 1360856593, '和你共同选修一', 1),
(18, 1360856618, '找到你感兴趣', 1),
(20, 1360856633, '找到你感兴趣', 1),
(22, 1360856657, '找到你感兴趣', 1),
(23, 1360856679, '，给学弟学妹们', 1),
(25, 1360856755, '吐槽你不', 1),
(27, 1360856809, '，给学弟学妹们留', 1),
(28, 1360856817, '你不喜', 1),
(29, 1360857155, 'df,jgdkg.sdkg', 1),
(32, 1360857220, 'dfgsdgdfg', 1),
(33, 1360857389, 'fbgsgbsfgb', 1),
(34, 1360857638, 'afsadfdg', 1),
(35, 1360859020, 'fdsgfsdjf', 1),
(36, 1360859034, 'sdafsdffasf', 1),
(37, 1360859193, 'dssdgffdg', 1),
(38, 1360859253, 'asdfj,adsfj', 1),
(39, 1360859686, 'sadfsdf', 1),
(40, 1360859856, 'sdfsdfsd', 1),
(41, 1360859936, 'dfvasdvadsvsdav', 1),
(42, 1360860009, 'dascasc', 1),
(43, 1360862862, 'dfasfag', 1),
(44, 1360862933, 'sdfvdfgvdfggv', 1),
(45, 1360862974, 'sdfgsdgdg', 1),
(46, 1360862995, 'adsfasgfsdgfsd', 1),
(47, 1360863020, 'dsgjdfgkj.hds', 1),
(48, 1360863053, 'sadfdsagsdg', 1),
(49, 1360863074, 'agsd\nd\nf\ng', 1),
(50, 1360863076, 'sdfg', 1),
(51, 1360863078, 'adfgasdgas', 1),
(52, 1360863201, 'afasdfasdf', 1),
(53, 1360863876, 'dsfmj,skg', 1),
(54, 1360863951, 'dsfgsdg', 1),
(55, 1360863990, 'sfgdsgd', 1),
(56, 1360864114, 'dfsdhsdfjbfg;;', 1),
(57, 1360864140, 'test', 1),
(58, 1360864161, '再来一条', 1),
(59, 1360864345, '询到到所有公共选修课信息\n找到和你共同选修一门课的人\n找到你感', 1),
(60, 1360864435, '岁的法国的', 1),
(61, 1360864503, '啊gas个', 1),
(62, 1360864727, '阿斯蒂芬斯柯达减肥', 1),
(63, 1360864746, '正常了，说一句', 1),
(64, 1360864773, '本板块正常了', 1),
(65, 1360865194, '阿的根深蒂固', 1),
(66, 1360865230, '测试', 4),
(67, 1360865252, '再来', 1),
(68, 1360865315, '不正常？', 1),
(69, 1360865336, '漏了一个……', 1),
(70, 1360865366, '伤不起', 4),
(71, 1360865375, '顺酐', 1),
(72, 1360865398, '基本上能够实现聊天效果', 4),
(73, 1360865405, '是的啊', 1),
(74, 1360865417, '辛苦一大晚上', 4),
(75, 1360865432, '呵呵，终于有了结果哈', 1),
(76, 1360865457, '我就说嘛，没有什么能够难到我的', 4),
(77, 1360865489, '接下来该做的就是捕捉漏网之鱼了', 1),
(78, 1360865508, '将第二个定时器做好', 4),
(79, 1360865551, '他的时间就是为了捕捉漏网之鱼和', 1),
(80, 1360865564, '和刷新“刚刚”', 4),
(81, 1360865586, '使其达到更新时间的效果', 1),
(82, 1360866240, '来一句', 1),
(83, 1360867211, '偶自己的动弹一下', 4),
(84, 1360867276, 'zheershiyixia', 2),
(85, 1360867283, 'bucuo', 2),
(86, 1360899699, '使得地方很少看到', 4),
(87, 1360899720, '所见到，hksjdfhks.d', 4),
(88, 1360909193, 'ceshi', 1),
(89, 1360909266, 'ceshi -ie', 2),
(90, 1360910277, 'ceshiyixia', 1),
(91, 1360910296, '????', 1),
(92, 1360910311, 'losta msg', 1),
(93, 1360911208, 'sdajf,sdjk', 1),
(94, 1360911257, 'smdfb,samfb', 1),
(95, 1360911405, 'xcvxzcv', 1),
(96, 1360911651, 'mnvjmh', 1),
(97, 1360912958, 'ahskdhfsd', 1),
(98, 1360912972, 'd,sjfskajgh', 1),
(99, 1360913781, 'sdsdfsaf', 1),
(100, 1360914057, 'djkfaskjdf', 1),
(101, 1360914094, 'dfvdfv', 1),
(102, 1360915263, 'fdgdfgsdg', 1),
(103, 1360915708, 'dsfgdsgeg', 1),
(104, 1360917397, 'fsdfsdfsdf', 1),
(105, 1360921175, '开会客家话就', 4),
(106, 1360922991, '犯嘀咕嘀咕', 4),
(107, 1360928776, '在这里你可以同华中科技大学的同学们起...查询到到所有公共选修课信息找到和你共同选修一门课的人找到你感兴趣的课吐槽你不喜欢的课', 1),
(108, 1360928821, '楼下的', 4),
(109, 1360930185, '干嘛', 1),
(110, 1360930873, '阿斯蒂芬', 1),
(111, 1360931078, '电风扇地方', 1),
(112, 1360931356, '你会过得更好', 1),
(113, 1360984392, '轮七八糟', 4),
(114, 1361017740, 'n gcmjh', 1),
(115, 1361017790, 'adfadgadsg', 1),
(116, 1361017927, 'dfgsd', 1),
(117, 1361017972, 'dfggehw', 1),
(118, 1361018184, 'dfv', 1),
(119, 1361031786, 'gb f fb fdvd', 2),
(120, 1361085304, '斯蒂芬森的', 2),
(121, 1361085512, '的发射点发', 2),
(122, 1361089045, 'dgfsdgf', 1),
(123, 1361112848, 'afdasdfasdf', 1),
(124, 1369485714, 'ceshiosdflsd', 2),
(125, 1369485877, 'sdfsdfssdf', 2);

-- --------------------------------------------------------

--
-- 表的结构 `xiu_teacher`
--

CREATE TABLE IF NOT EXISTS `xiu_teacher` (
  `tch_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '老师ID',
  `tch_name` varchar(255) DEFAULT NULL COMMENT '老师姓名',
  `tch_college` varchar(255) DEFAULT NULL COMMENT '所属学院',
  `tch_score` int(3) DEFAULT NULL COMMENT '老师评分',
  `tch_phone` varchar(20) DEFAULT NULL COMMENT '老师电话',
  `tch_qq` int(11) DEFAULT NULL COMMENT '老师QQ',
  `tch_email` varchar(255) DEFAULT NULL COMMENT '老师邮箱',
  `tch_introduction` varchar(255) DEFAULT NULL COMMENT '老师介绍',
  PRIMARY KEY (`tch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='教师信息表' AUTO_INCREMENT=115 ;

--
-- 转存表中的数据 `xiu_teacher`
--

INSERT INTO `xiu_teacher` (`tch_id`, `tch_name`, `tch_college`, `tch_score`, `tch_phone`, `tch_qq`, `tch_email`, `tch_introduction`) VALUES
(1, '白凯', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(2, '曹小玲', '信息与数学学院', NULL, NULL, NULL, NULL, NULL),
(3, '曹志华', '动物科学学院', NULL, NULL, NULL, NULL, NULL),
(4, '曾尉', '艺术学院', NULL, NULL, NULL, NULL, NULL),
(5, '柴毅', '动物科学学院', NULL, NULL, NULL, NULL, NULL),
(6, '陈列利', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(7, '陈青', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(8, '陈勇', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(9, '陈志静', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(10, '程彩虹', '农学院', NULL, NULL, NULL, NULL, NULL),
(11, '崔青山', '文学院', NULL, NULL, NULL, NULL, NULL),
(12, '高林', '化学与环境工程学院', NULL, NULL, NULL, NULL, NULL),
(13, '龚频', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(14, '顾觉醒', '医学院', NULL, NULL, NULL, NULL, NULL),
(15, '郭蕾', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(16, '郭素贞', '经济学院（东）', NULL, NULL, NULL, NULL, NULL),
(17, '侯明华', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(18, '宦成林', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(19, '黄芬肖', '园艺园林学院', NULL, NULL, NULL, NULL, NULL),
(20, '黄河', '化学与环境工程学院', NULL, NULL, NULL, NULL, NULL),
(21, '纪海芹', '管理学院', NULL, NULL, NULL, NULL, NULL),
(22, '贾陈忠', '化学与环境工程学院', NULL, NULL, NULL, NULL, NULL),
(23, '金芳', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(24, '雷元卫', '医学院', NULL, NULL, NULL, NULL, NULL),
(25, '李从玉', '园艺园林学院', NULL, NULL, NULL, NULL, NULL),
(26, '李晶', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(27, '李喜成', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(28, '李祥华', '医学院', NULL, NULL, NULL, NULL, NULL),
(29, '李玉和', '医学院', NULL, NULL, NULL, NULL, NULL),
(30, '李正耀', '信息与数学学院', NULL, NULL, NULL, NULL, NULL),
(31, '刘会宁', '园艺园林学院', NULL, NULL, NULL, NULL, NULL),
(32, '刘建军', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(33, '刘俊丽', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(34, '刘勉', '文学院', NULL, NULL, NULL, NULL, NULL),
(35, '刘鹏Y', '艺术学院', NULL, NULL, NULL, NULL, NULL),
(36, '刘远军', '文学院', NULL, NULL, NULL, NULL, NULL),
(37, '楼有根', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(38, '卢小琴', '园艺园林学院', NULL, NULL, NULL, NULL, NULL),
(39, '陆峰', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(40, '罗春蕾', '艺术学院', NULL, NULL, NULL, NULL, NULL),
(41, '潘大勇', '信息与数学学院', NULL, NULL, NULL, NULL, NULL),
(42, '潘劲松', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(43, '潘友刚', '教育科学系', NULL, NULL, NULL, NULL, NULL),
(44, '彭文秀', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(45, '漆良蜜', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(46, '秦良斌', '学生事务处', NULL, NULL, NULL, NULL, NULL),
(47, '饶贵珍', '园艺园林学院', NULL, NULL, NULL, NULL, NULL),
(48, '邵书慧', '经济学院（东）', NULL, NULL, NULL, NULL, NULL),
(49, '宋文广', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(50, '孙代红', '化学与环境工程学院', NULL, NULL, NULL, NULL, NULL),
(51, '谭凤霞', '动物科学学院', NULL, NULL, NULL, NULL, NULL),
(52, '汤慧', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(53, '汤天伟', '城市建设学院', NULL, NULL, NULL, NULL, NULL),
(54, '佟桂玲', '法学系', NULL, NULL, NULL, NULL, NULL),
(55, '童菁', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(56, '汪海全', '医学院', NULL, NULL, NULL, NULL, NULL),
(57, '王光霞', '马列学院', NULL, NULL, NULL, NULL, NULL),
(58, '王贵林', '医学院', NULL, NULL, NULL, NULL, NULL),
(59, '王贵元', '园艺园林学院', NULL, NULL, NULL, NULL, NULL),
(60, '王华强', '管理学院', NULL, NULL, NULL, NULL, NULL),
(61, '王家奇', '教育科学系', NULL, NULL, NULL, NULL, NULL),
(62, '王剑J', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(63, '王桃群', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(64, '望丽', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(65, '卫晓旭', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(66, '魏登峰', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(67, '魏平方', '化学与环境工程学院', NULL, NULL, NULL, NULL, NULL),
(68, '吴楚', '园艺园林学院', NULL, NULL, NULL, NULL, NULL),
(69, '吴强盛', '园艺园林学院', NULL, NULL, NULL, NULL, NULL),
(70, '吴锡改', '教育科学系', NULL, NULL, NULL, NULL, NULL),
(71, '吴焱森', '医学院', NULL, NULL, NULL, NULL, NULL),
(72, '伍廉松', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(73, '夏新中', '医学院', NULL, NULL, NULL, NULL, NULL),
(74, '向德富', '文学院', NULL, NULL, NULL, NULL, NULL),
(75, '向华', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(76, '肖慧', '管理学院', NULL, NULL, NULL, NULL, NULL),
(77, '肖文静', '园艺园林学院', NULL, NULL, NULL, NULL, NULL),
(78, '谢斐', '医学院', NULL, NULL, NULL, NULL, NULL),
(79, '谢田芳', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(80, '徐红', '教育科学系', NULL, NULL, NULL, NULL, NULL),
(81, '徐小利', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(82, '许芳', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(83, '薛睿韬', '艺术学院', NULL, NULL, NULL, NULL, NULL),
(84, '严圣华', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(85, '杨娟', '管理学院', NULL, NULL, NULL, NULL, NULL),
(86, '杨强', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(87, '杨舒', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(88, '杨秀华', '文学院', NULL, NULL, NULL, NULL, NULL),
(89, '杨长铭', '物理科学与技术学院', NULL, NULL, NULL, NULL, NULL),
(90, '姚昌炳', '文学院', NULL, NULL, NULL, NULL, NULL),
(91, '殷裕斌', '动物科学学院', NULL, NULL, NULL, NULL, NULL),
(92, '喻秋山', '物理科学与技术学院', NULL, NULL, NULL, NULL, NULL),
(93, '袁园', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(94, '张健', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(95, '张立平', '文学院', NULL, NULL, NULL, NULL, NULL),
(96, '张明如', '经济学院（东）', NULL, NULL, NULL, NULL, NULL),
(97, '张文渊', '教育科学系', NULL, NULL, NULL, NULL, NULL),
(98, '张文元', '马列学院', NULL, NULL, NULL, NULL, NULL),
(99, '张晓方', '医学院', NULL, NULL, NULL, NULL, NULL),
(100, '张欣', '生命科学学院', NULL, NULL, NULL, NULL, NULL),
(101, '张燕', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(102, '张铀', '管理学院', NULL, NULL, NULL, NULL, NULL),
(103, '张长青', '农学院', NULL, NULL, NULL, NULL, NULL),
(104, '赵红梅', '动物科学学院', NULL, NULL, NULL, NULL, NULL),
(105, '赵延亮', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(106, '郑健S', '医学院', NULL, NULL, NULL, NULL, NULL),
(107, '周汝瑞', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(108, '周新', '外国语学院', NULL, NULL, NULL, NULL, NULL),
(109, '周中林', '管理学院', NULL, NULL, NULL, NULL, NULL),
(110, '朱朝霞', '计算机科学学院', NULL, NULL, NULL, NULL, NULL),
(111, '朱道卫', '文学院', NULL, NULL, NULL, NULL, NULL),
(112, '朱瑞海', '经济学院（东）', NULL, NULL, NULL, NULL, NULL),
(113, '邹小芳', '经济学院（东）', NULL, NULL, NULL, NULL, NULL),
(114, '邹小燕', '艺术学院', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `xiu_topic`
--

CREATE TABLE IF NOT EXISTS `xiu_topic` (
  `tpc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主题ID',
  `tpc_title` varchar(255) DEFAULT NULL COMMENT '主题标题',
  `tpc_content` varchar(255) DEFAULT NULL COMMENT '主题内容',
  `tpc_user_id` int(11) DEFAULT NULL COMMENT '主题创建者ID',
  `tpc_time` int(11) DEFAULT NULL COMMENT '创帖时间',
  `tpc_class_id` int(11) DEFAULT NULL COMMENT '来自的课程的ID',
  PRIMARY KEY (`tpc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='主题表' AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `xiu_topic`
--

INSERT INTO `xiu_topic` (`tpc_id`, `tpc_title`, `tpc_content`, `tpc_user_id`, `tpc_time`, `tpc_class_id`) VALUES
(7, 'fhsdfhsgh', 'ceshiceshi', 3, 1349083459, 2),
(9, '黄飞鸿', '纪录提高利用刘', 2, 1349322200, 1),
(10, 'dfgdgsdfg', 'dgsdgsdfgsd', 4, 1349327155, 1),
(14, '都很符合法规', '跌幅更是大幅回升的好', 1, 1349330755, 2),
(15, 'lihdj', 'hfkhfjh', 2, 1349363103, 1),
(16, 'fdgdfgsdg', 'dfgsdfgsdfgdsfgdfg24534523452345', 3, 1349363397, 1),
(17, '测试标题', '测试内容', 1, 1360671817, 2),
(18, '第二次测试标题', '第二次测试内容', 1, 1360671860, 2),
(19, 'ceshi', 'ceshicct', 4, 1360918441, 2),
(20, '', '', 1, 1360998456, 2),
(21, '', '', 1, 1360998686, 2),
(22, 'xcvxcv', 'xcvzxbzxb', 1, 1361089892, 2),
(23, '', '', 1, 1361090083, 2),
(24, 'afsdf', 'asdddddddddddd', 1, 1361090566, 2),
(25, 'sdf', 'sdfs', 1, 1361113484, 2);

-- --------------------------------------------------------

--
-- 表的结构 `xiu_user`
--

CREATE TABLE IF NOT EXISTS `xiu_user` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `usr_name` varchar(255) DEFAULT NULL COMMENT '用户名',
  `usr_nickname` varchar(255) DEFAULT NULL COMMENT '昵称',
  `usr_mail` varchar(100) DEFAULT NULL COMMENT '用户邮箱',
  `usr_active_score` int(11) NOT NULL DEFAULT '0' COMMENT '用户活跃分数',
  `usr_reg_time` int(11) DEFAULT NULL COMMENT '注册时间',
  `usr_last_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后活跃时间',
  `usr_reg_ip` varchar(255) DEFAULT NULL COMMENT '用户注册ip',
  `usr_last_ip` varchar(255) DEFAULT NULL COMMENT '最后登录IP',
  `usr_psw` varchar(255) DEFAULT NULL COMMENT '密码',
  `usr_sid` varchar(255) DEFAULT NULL COMMENT 'session_id',
  `usr_sex` enum('女','男') DEFAULT '女' COMMENT '性别',
  PRIMARY KEY (`usr_id`),
  UNIQUE KEY `用户名` (`usr_name`) COMMENT '用户名',
  UNIQUE KEY `usr_mail` (`usr_mail`) COMMENT '邮箱唯一'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `xiu_user`
--

INSERT INTO `xiu_user` (`usr_id`, `usr_name`, `usr_nickname`, `usr_mail`, `usr_active_score`, `usr_reg_time`, `usr_last_time`, `usr_reg_ip`, `usr_last_ip`, `usr_psw`, `usr_sid`, `usr_sex`) VALUES
(1, 'ceshi2013', 'ceshiuser', 'ceshi@gmail.com', 0, 1364392955, '0000-00-00 00:00:00', '127.0.0.1', NULL, 'fca874d95fc67e0362d9152696e59af7', NULL, '女'),
(2, 'lijunl', 'lijunl', 'lijun@gmail.com', 0, 1375071515, '0000-00-00 00:00:00', '127.0.0.1', '127.0.0.1', 'fca874d95fc67e0362d9152696e59af7', NULL, '女');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
