-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2019 �?08 �?17 �?03:04
-- 服务器版本: 5.5.53
-- PHP 版本: 5.6.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `suibianlu2`
--

-- --------------------------------------------------------

--
-- 表的结构 `tmf_account_log`
--

CREATE TABLE IF NOT EXISTS `tmf_account_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '变动金额（负数表示扣除）',
  `type` varchar(32) NOT NULL DEFAULT '0' COMMENT '类型（public-发布扣款，tranfer_out-转账，transfer_in-转出，cash-提现扣款，cash_fail-提现失败退款，team_profit-团队收益）',
  `to_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '对方会员id',
  `note` varchar(255) DEFAULT NULL COMMENT '备注',
  `order_no` varchar(255) DEFAULT NULL COMMENT '订单号',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `income_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '收益类型（0-无效，1-收入，2-支出）',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='资金记录表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tmf_action_log`
--

CREATE TABLE IF NOT EXISTS `tmf_action_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行会员id',
  `username` char(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `ip` char(30) NOT NULL DEFAULT '' COMMENT '执行行为者ip',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '行为名称',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '执行的URL',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='行为日志表' AUTO_INCREMENT=190 ;

--
-- 转存表中的数据 `tmf_action_log`
--

INSERT INTO `tmf_action_log` (`id`, `member_id`, `username`, `ip`, `name`, `describe`, `url`, `status`, `update_time`, `create_time`) VALUES
(1, 1, 'admin', '182.137.56.161', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', -1, 1564495259, 1564493379),
(2, 1, 'admin', '182.137.56.161', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', -1, 1564495259, 1564494685),
(3, 1, 'admin', '182.137.56.161', '删除', '数据库备份文件删除，path：/www/wwwroot/yq.myxs.ltd/data/20190726-002651-*.sql*', '/admin.php/database/backupdel/time/1564072011.html', -1, 1564495259, 1564495238),
(4, 1, 'admin', '182.137.56.161', '删除', '数据库备份文件删除，path：/www/wwwroot/yq.myxs.ltd/data/20190728-151902-*.sql*', '/admin.php/database/backupdel/time/1564298342.html', -1, 1564495259, 1564495241),
(5, 1, 'admin', '182.137.56.161', '清理', '文件清理', '/admin.php/fileclean/cleanlist.html', -1, 1564495259, 1564495247),
(6, 1, 'admin', '182.137.56.161', '清理', '文件清理', '/admin.php/fileclean/cleanlist.html', -1, 1564495259, 1564495250),
(7, 1, 'admin', '182.137.56.161', '删除', '删除会员，where：id=25', '/admin.php/member/memberdel/id/25.html', 1, 1564495296, 1564495296),
(8, 1, 'admin', '182.137.56.161', '删除', '删除会员，where：id=24', '/admin.php/member/memberdel/id/24.html', 1, 1564495298, 1564495298),
(9, 1, 'admin', '36.49.147.44', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564495354, 1564495354),
(10, 1, 'admin', '182.137.56.161', '编辑', '会员编辑id:2', '/admin.php/user/useredit.html', 1, 1564513348, 1564513348),
(11, 1, 'admin', '182.137.56.161', '编辑', '会员编辑id:3', '/admin.php/user/useredit.html', 1, 1564513476, 1564513476),
(12, 1, 'admin', '110.188.227.227', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564542710, 1564542710),
(13, 1, 'admin', '110.188.227.227', '编辑', '编辑菜单，name：会员管理', '/admin.php/menu/menuedit.html', 1, 1564543442, 1564543442),
(14, 1, 'admin', '110.188.227.227', '新增', '会员资料新增id:0', '/admin.php/user_profile/userprofileedit.html', 1, 1564543820, 1564543820),
(15, 1, 'admin', '110.188.227.227', '新增', '新增菜单，name：升级管理', '/admin.php/menu/menuadd.html', 1, 1564543925, 1564543925),
(16, 1, 'admin', '110.188.227.227', '数据状态', '数据状态调整，model：Menu，ids：223，status：-1', '/admin.php/menu/setstatus/ids/223/status/-1.html', 1, 1564544966, 1564544966),
(17, 1, 'admin', '110.188.227.227', '数据状态', '数据状态调整，model：Menu，ids：213，status：0', '/admin.php/menu/setstatus/ids/213/status/0.html', 1, 1564544971, 1564544971),
(18, 1, 'admin', '110.188.227.227', '数据状态', '数据状态调整，model：Menu，ids：213，status：1', '/admin.php/menu/setstatus/ids/213/status/1.html', 1, 1564544997, 1564544997),
(19, 1, 'admin', '110.188.227.227', '数据状态', '数据状态调整，model：Menu，ids：213，status：0', '/admin.php/menu/setstatus/ids/213/status/0.html', 1, 1564545005, 1564545005),
(20, 1, 'admin', '110.188.227.227', '数据状态', '数据状态调整，model：Menu，ids：213，status：-1', '/admin.php/menu/setstatus/ids/213/status/-1.html', 1, 1564545029, 1564545029),
(21, 1, 'admin', '110.188.227.227', '新增', '新增菜单，name：实名认证', '/admin.php/menu/menuadd.html', 1, 1564545186, 1564545186),
(22, 1, 'admin', '110.188.227.227', '新增', '新增菜单，name：债务管理', '/admin.php/menu/menuadd.html', 1, 1564545520, 1564545520),
(23, 1, 'admin', '110.188.227.227', '数据排序', '数据排序调整，model：Menu，id：211，value：2', '/admin.php/menu/setsort.html', 1, 1564545606, 1564545606),
(24, 1, 'admin', '110.188.227.227', '数据排序', '数据排序调整，model：Menu，id：214，value：100', '/admin.php/menu/setsort.html', 1, 1564545619, 1564545619),
(25, 1, 'admin', '110.188.227.227', '数据排序', '数据排序调整，model：Menu，id：220，value：100', '/admin.php/menu/setsort.html', 1, 1564545630, 1564545630),
(26, 1, 'admin', '110.188.227.227', '数据排序', '数据排序调整，model：Menu，id：68，value：100', '/admin.php/menu/setsort.html', 1, 1564545645, 1564545645),
(27, 1, 'admin', '110.188.227.227', '数据排序', '数据排序调整，model：Menu，id：216，value：3', '/admin.php/menu/setsort.html', 1, 1564545653, 1564545653),
(28, 1, 'admin', '110.188.227.227', '数据排序', '数据排序调整，model：Menu，id：16，value：100', '/admin.php/menu/setsort.html', 1, 1564545661, 1564545661),
(29, 1, 'admin', '110.188.227.227', '数据排序', '数据排序调整，model：Menu，id：218，value：4', '/admin.php/menu/setsort.html', 1, 1564545666, 1564545666),
(30, 1, 'admin', '110.188.227.227', '数据排序', '数据排序调整，model：Menu，id：233，value：5', '/admin.php/menu/setsort.html', 1, 1564545682, 1564545682),
(31, 1, 'admin', '110.188.227.227', '数据排序', '数据排序调整，model：Menu，id：144，value：100', '/admin.php/menu/setsort.html', 1, 1564545690, 1564545690),
(32, 1, 'admin', '110.188.227.227', '数据排序', '数据排序调整，model：Menu，id：157，value：100', '/admin.php/menu/setsort.html', 1, 1564545698, 1564545698),
(33, 1, 'admin', '110.188.227.227', '数据排序', '数据排序调整，model：Menu，id：166，value：7', '/admin.php/menu/setsort.html', 1, 1564545721, 1564545721),
(34, 1, 'admin', '110.188.227.227', '数据排序', '数据排序调整，model：Menu，id：16，value：6', '/admin.php/menu/setsort.html', 1, 1564545728, 1564545728),
(35, 1, 'admin', '110.188.227.227', '编辑', '编辑菜单，name：债务管理', '/admin.php/menu/menuedit.html', 1, 1564547283, 1564547283),
(36, 1, 'admin', '110.188.227.227', '新增', '新增菜单，name：债务列表', '/admin.php/menu/menuadd.html', 1, 1564547421, 1564547421),
(37, 1, 'admin', '110.188.227.227', '编辑', '编辑菜单，name：债务列表', '/admin.php/menu/menuedit.html', 1, 1564547946, 1564547946),
(38, 1, 'admin', '110.188.227.227', '编辑', '编辑菜单，name：债务列表', '/admin.php/menu/menuedit.html', 1, 1564548184, 1564548184),
(39, 1, 'admin', '139.205.155.40', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564553803, 1564553803),
(40, 1, 'admin', '110.188.227.227', '编辑', '编辑菜单，name：升级列表', '/admin.php/menu/menuedit.html', 1, 1564554993, 1564554993),
(41, 1, 'admin', '110.188.227.227', '编辑', '会员资料编辑id:1', '/admin.php/user_profile/userprofileedit.html', 1, 1564555348, 1564555348),
(42, 1, 'admin', '110.188.227.227', '数据状态', '数据状态调整，model：Config，ids：65，status：0', '/admin.php/config/setstatus/ids/65/status/0.html', 1, 1564561254, 1564561254),
(43, 1, 'admin', '110.188.227.227', '数据状态', '数据状态调整，model：Config，ids：65，status：1', '/admin.php/config/setstatus/ids/65/status/1.html', 1, 1564561257, 1564561257),
(44, 1, 'admin', '110.188.227.227', '数据状态', '数据状态调整，model：Menu，ids：231，status：-1', '/admin.php/menu/setstatus/ids/231/status/-1.html', 1, 1564562415, 1564562415),
(45, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:3', '/admin.php/level/leveledit.html', 1, 1564563619, 1564563619),
(46, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:4', '/admin.php/level/leveledit.html', 1, 1564563629, 1564563629),
(47, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:5', '/admin.php/level/leveledit.html', 1, 1564563712, 1564563712),
(48, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:6', '/admin.php/level/leveledit.html', 1, 1564563725, 1564563725),
(49, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:7', '/admin.php/level/leveledit.html', 1, 1564563744, 1564563744),
(50, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:8', '/admin.php/level/leveledit.html', 1, 1564563759, 1564563759),
(51, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:9', '/admin.php/level/leveledit.html', 1, 1564563786, 1564563786),
(52, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:14', '/admin.php/level/leveledit.html', 1, 1564563821, 1564563821),
(53, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:16', '/admin.php/level/leveledit.html', 1, 1564564003, 1564564003),
(54, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:3', '/admin.php/level/leveledit.html', 1, 1564564830, 1564564830),
(55, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:14', '/admin.php/level/leveledit.html', 1, 1564564997, 1564564997),
(56, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:14', '/admin.php/level/leveledit.html', 1, 1564565008, 1564565008),
(57, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:14', '/admin.php/level/leveledit.html', 1, 1564565021, 1564565021),
(58, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:16', '/admin.php/level/leveledit.html', 1, 1564565031, 1564565031),
(59, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:16', '/admin.php/level/leveledit.html', 1, 1564565077, 1564565077),
(60, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:16', '/admin.php/level/leveledit.html', 1, 1564565145, 1564565145),
(61, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:16', '/admin.php/level/leveledit.html', 1, 1564565156, 1564565156),
(62, 1, 'admin', '61.151.180.39', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564582961, 1564582961),
(63, 1, 'admin', '113.118.86.114', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564585569, 1564585569),
(64, 1, 'admin', '112.97.54.234', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564588145, 1564588145),
(65, 1, 'admin', '112.97.54.234', '编辑', '会员编辑id:4', '/admin.php/user/useredit.html', 1, 1564593416, 1564593416),
(66, 1, 'admin', '110.188.227.227', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564627113, 1564627113),
(67, 1, 'admin', '112.97.54.234', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564632325, 1564632325),
(68, 1, 'admin', '183.15.177.161', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564633322, 1564633322),
(69, 1, 'admin', '183.15.177.161', '编辑', '会员编辑id:2', '/admin.php/user/useredit.html', 1, 1564633492, 1564633492),
(70, 1, 'admin', '110.188.227.227', '编辑', '编辑菜单，name：阶段列表', '/admin.php/menu/menuedit.html', 1, 1564644137, 1564644137),
(71, 1, 'admin', '110.188.227.227', '编辑', '编辑菜单，name：阶段管理', '/admin.php/menu/menuedit.html', 1, 1564644153, 1564644153),
(72, 1, 'admin', '110.188.227.227', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564647544, 1564647544),
(73, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:1', '/admin.php/user/useredit.html', 1, 1564647576, 1564647576),
(74, 1, 'admin', '112.97.51.142', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564650446, 1564650446),
(75, 1, 'admin', '1.192.61.202', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564650904, 1564650904),
(76, 1, 'admin', '0.0.0.0', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564651535, 1564651535),
(77, 1, 'admin', '110.188.227.227', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564656178, 1564656178),
(78, 1, 'admin', '112.97.51.142', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564662668, 1564662668),
(79, 1, 'admin', '182.137.56.161', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564673368, 1564673368),
(80, 1, 'admin', '182.137.56.161', '编辑', '会员编辑id:1', '/admin.php/level/leveledit.html', 1, 1564674733, 1564674733),
(81, 1, 'admin', '112.97.51.142', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564681464, 1564681464),
(82, 1, 'admin', '36.49.148.156', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564681540, 1564681540),
(83, 1, 'admin', '36.49.148.156', '备份', '数据库备份', '/admin.php/database/databackup.html', -1, 1564682110, 1564682045),
(84, 1, 'admin', '36.49.148.156', '删除', '数据库备份文件删除，path：/www/wwwroot/yq.myxs.ltd/data/20190802-015404-*.sql*', '/admin.php/database/backupdel/time/1564682044.html', -1, 1564682107, 1564682068),
(85, 1, 'admin', '36.49.148.156', '备份', '数据库备份', '/admin.php/database/databackup.html', -1, 1564683438, 1564683427),
(86, 1, 'admin', '0.0.0.0', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564709440, 1564709440),
(87, 1, 'admin', '110.188.227.227', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564713100, 1564713100),
(88, 1, 'admin', '110.188.227.227', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564717585, 1564717585),
(89, 1, 'admin', '110.188.227.227', '编辑', '会员密码修改，id：1', '/admin.php/member/editpassword.html', 1, 1564717613, 1564717613),
(90, 1, 'admin', '110.188.227.227', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564717648, 1564717648),
(91, 1, 'admin', '110.188.227.227', '删除', '数据库备份文件删除，path：/www/wwwroot/yq.myxs.ltd/data/20190726-002651-*.sql*', '/admin.php/database/backupdel/time/1564072011.html', 1, 1564718366, 1564718366),
(92, 1, 'admin', '110.188.227.227', '删除', '数据库备份文件删除，path：/www/wwwroot/yq.myxs.ltd/data/20190728-151902-*.sql*', '/admin.php/database/backupdel/time/1564298342.html', 1, 1564718369, 1564718369),
(93, 1, 'admin', '110.188.227.227', '删除', '数据库备份文件删除，path：/www/wwwroot/yq.myxs.ltd/data/20190726-002241-*.sql*', '/admin.php/database/backupdel/time/1564071761.html', 1, 1564718379, 1564718379),
(94, 1, 'admin', '110.188.227.227', '新增', '新增菜单，name：打款管理', '/admin.php/menu/menuadd.html', 1, 1564724856, 1564724856),
(95, 1, 'admin', '110.188.227.227', '数据排序', '数据排序调整，model：Menu，id：16，value：7', '/admin.php/menu/setsort.html', 1, 1564724887, 1564724887),
(96, 1, 'admin', '110.188.227.227', '数据排序', '数据排序调整，model：Menu，id：166，value：8', '/admin.php/menu/setsort.html', 1, 1564724891, 1564724891),
(97, 1, 'admin', '110.188.227.227', '新增', '新增菜单，name：打款列表', '/admin.php/menu/menuadd.html', 1, 1564725010, 1564725010),
(98, 1, 'admin', '110.188.227.227', '编辑', '编辑菜单，name：打款管理', '/admin.php/menu/menuedit.html', 1, 1564725734, 1564725734),
(99, 1, 'admin', '110.188.227.227', '编辑', '编辑会员，id：1', '/admin.php/member/memberedit.html', 1, 1564726544, 1564726544),
(100, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:1', '/admin.php/user/useredit.html', 1, 1564729532, 1564729532),
(101, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:2', '/admin.php/user/useredit.html', 1, 1564729546, 1564729546),
(102, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:3', '/admin.php/user/useredit.html', 1, 1564729558, 1564729558),
(103, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:4', '/admin.php/user/useredit.html', 1, 1564729571, 1564729571),
(104, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:5', '/admin.php/user/useredit.html', 1, 1564729585, 1564729585),
(105, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:6', '/admin.php/user/useredit.html', 1, 1564729597, 1564729597),
(106, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:7', '/admin.php/user/useredit.html', 1, 1564729623, 1564729623),
(107, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:8', '/admin.php/user/useredit.html', 1, 1564729636, 1564729636),
(108, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:9', '/admin.php/user/useredit.html', 1, 1564729932, 1564729932),
(109, 1, 'admin', '110.188.227.227', '编辑', '会员编辑id:9', '/admin.php/user/useredit.html', 1, 1564729958, 1564729958),
(110, 1, 'admin', '117.177.110.49', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564735541, 1564735541),
(111, 1, 'admin', '117.177.110.49', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564746310, 1564746310),
(112, 1, 'admin', '117.177.110.49', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564764664, 1564764664),
(113, 1, 'admin', '110.188.229.207', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564792641, 1564792641),
(114, 1, 'admin', '117.173.132.208', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564799888, 1564799888),
(115, 1, 'admin', '117.177.110.49', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1564815992, 1564815992),
(116, 1, 'admin', '60.183.170.180', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565259005, 1565259005),
(117, 1, 'admin', '60.183.170.180', '设置', '系统设置保存', '/admin.php/config/setting.html', 1, 1565263466, 1565263466),
(118, 1, 'admin', '119.39.70.15', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565263614, 1565263614),
(119, 1, 'admin', '119.39.70.15', '新增', '新增会员，username：ceshi', '/admin.php/member/memberadd.html', 1, 1565264175, 1565264175),
(120, 1, 'admin', '119.39.70.15', '删除', '删除会员，where：id=27', '/admin.php/member/memberdel/id/27.html', 1, 1565264213, 1565264213),
(121, 1, 'admin', '119.39.70.15', '优化', '数据库优化', '/admin.php/database/optimize.html', 1, 1565264376, 1565264376),
(122, 1, 'admin', '120.227.45.173', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565268863, 1565268863),
(123, 1, 'admin', '59.175.15.22', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565269013, 1565269013),
(124, 1, 'admin', '1.25.220.192', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565270138, 1565270138),
(125, 1, 'admin', '171.107.59.41', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565270355, 1565270355),
(126, 1, 'admin', '171.107.59.41', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565272261, 1565272261),
(127, 1, 'admin', '1.25.220.192', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565274321, 1565274321),
(128, 1, 'admin', '114.100.85.74', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', -1, 1565283612, 1565274460),
(129, 1, 'admin', '114.100.85.74', '编辑', '会员编辑id:28', '/admin.php/user/useredit.html', -1, 1565283608, 1565277079),
(130, 1, 'admin', '114.100.85.74', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', -1, 1565283599, 1565281957),
(131, 1, 'admin', '114.100.85.74', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', -1, 1565283596, 1565283141),
(132, 1, 'admin', '114.100.85.74', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', -1, 1565283593, 1565283251),
(133, 1, 'admin', '114.100.85.74', '设置', '系统设置保存', '/admin.php/config/setting.html', -1, 1565283591, 1565283337),
(134, 1, 'admin', '223.104.178.82', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565283750, 1565283750),
(135, 1, 'admin', '59.173.171.156', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565284925, 1565284925),
(136, 1, 'admin', '140.243.25.137', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565284988, 1565284988),
(137, 1, 'admin', '1.25.221.191', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565313139, 1565313139),
(138, 1, 'admin', '1.25.221.191', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565313682, 1565313682),
(139, 1, 'admin', '116.235.79.40', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565319812, 1565319812),
(140, 1, 'admin', '124.128.133.56', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565320014, 1565320014),
(141, 1, 'admin', '171.107.59.41', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565322543, 1565322543),
(142, 1, 'admin', '223.104.178.95', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565323105, 1565323105),
(143, 1, 'admin', '119.163.188.245', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565324848, 1565324848),
(144, 1, 'admin', '119.103.210.183', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565325130, 1565325130),
(145, 1, 'admin', '140.243.130.135', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565325538, 1565325538),
(146, 1, 'admin', '118.212.190.53', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565325538, 1565325538),
(147, 1, 'admin', '113.240.164.215', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565325864, 1565325864),
(148, 1, 'admin', '113.240.164.215', '编辑', '会员编辑id:27', '/admin.php/user/useredit.html', 1, 1565328825, 1565328825),
(149, 1, 'admin', '113.240.164.215', '编辑', '会员编辑id:26', '/admin.php/user/useredit.html', 1, 1565328834, 1565328834),
(150, 1, 'admin', '113.240.164.215', '编辑', '会员编辑id:21', '/admin.php/user/useredit.html', 1, 1565331210, 1565331210),
(151, 1, 'admin', '113.240.164.215', '编辑', '会员编辑id:32', '/admin.php/user/useredit.html', 1, 1565332519, 1565332519),
(152, 1, 'admin', '59.175.15.22', '编辑', '会员编辑id:35', '/admin.php/user/useredit.html', 1, 1565337142, 1565337142),
(153, 1, 'admin', '124.128.133.56', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565339294, 1565339294),
(154, 1, 'admin', '59.175.15.22', '编辑', '会员编辑id:26', '/admin.php/user/useredit.html', 1, 1565340358, 1565340358),
(155, 1, 'admin', '59.175.15.22', '编辑', '会员编辑id:37', '/admin.php/user/useredit.html', 1, 1565343134, 1565343134),
(156, 1, 'admin', '1.25.221.1', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565344368, 1565344368),
(157, 1, 'admin', '171.107.59.41', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565344533, 1565344533),
(158, 1, 'admin', '112.32.71.245', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565344622, 1565344622),
(159, 1, 'admin', '1.25.221.1', '数据状态', '数据状态调整，model：Menu，ids：236，status：0', '/admin.php/menu/setstatus/ids/236/status/0.html', 1, 1565345829, 1565345829),
(160, 1, 'admin', '1.25.221.1', '数据状态', '数据状态调整，model：Menu，ids：236，status：1', '/admin.php/menu/setstatus/ids/236/status/1.html', 1, 1565345833, 1565345833),
(161, 1, 'admin', '117.136.94.3', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565355727, 1565355727),
(162, 1, 'admin', '123.112.255.12', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565362279, 1565362279),
(163, 1, 'admin', '59.175.15.22', '编辑', '会员编辑id:26', '/admin.php/user/useredit.html', 1, 1565362395, 1565362395),
(164, 1, 'admin', '59.175.15.22', '编辑', '会员编辑id:3', '/admin.php/level/leveledit.html', 1, 1565362505, 1565362505),
(165, 1, 'admin', '59.175.15.22', '编辑', '会员编辑id:18', '/admin.php/user/useredit.html', 1, 1565366301, 1565366301),
(166, 1, 'admin', '59.175.15.22', '编辑', '会员编辑id:35', '/admin.php/user/useredit.html', 1, 1565395313, 1565395313),
(167, 1, 'admin', '59.175.15.22', '编辑', '会员编辑id:17', '/admin.php/user/useredit.html', 1, 1565396067, 1565396067),
(168, 1, 'admin', '59.175.15.22', '编辑', '会员编辑id:38', '/admin.php/user/useredit.html', 1, 1565396294, 1565396294),
(169, 1, 'admin', '59.175.15.22', '编辑', '会员编辑id:44', '/admin.php/user/useredit.html', 1, 1565396468, 1565396468),
(170, 1, 'admin', '59.175.15.22', '编辑', '会员编辑id:35', '/admin.php/user/useredit.html', 1, 1565396527, 1565396527),
(171, 1, 'admin', '59.175.15.22', '编辑', '会员编辑id:35', '/admin.php/user/useredit.html', 1, 1565396763, 1565396763),
(172, 1, 'admin', '59.175.15.22', '编辑', '会员编辑id:35', '/admin.php/user/useredit.html', 1, 1565399459, 1565399459),
(173, 1, 'admin', '59.175.15.22', '编辑', '会员编辑id:35', '/admin.php/user/useredit.html', 1, 1565399659, 1565399659),
(174, 1, 'admin', '59.175.15.22', '编辑', '会员编辑id:35', '/admin.php/user/useredit.html', 1, 1565399754, 1565399754),
(175, 1, 'admin', '59.175.15.22', '编辑', '会员编辑id:27', '/admin.php/user/useredit.html', 1, 1565399902, 1565399902),
(176, 1, 'admin', '59.175.15.22', '编辑', '会员编辑id:20', '/admin.php/user/useredit.html', 1, 1565400657, 1565400657),
(177, 1, 'admin', '124.128.133.56', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565402769, 1565402769),
(178, 1, 'admin', '113.240.165.155', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565407185, 1565407185),
(179, 1, 'admin', '127.0.0.1', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565834257, 1565834257),
(180, 1, 'admin', '127.0.0.1', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1565837786, 1565837786),
(181, 1, 'admin', '127.0.0.1', '设置', '系统设置保存', '/admin.php/config/setting.html', 1, 1565838034, 1565838034),
(182, 1, 'admin', '127.0.0.1', '设置', '系统设置保存', '/admin.php/config/setting.html', 1, 1565838062, 1565838062),
(183, 1, 'admin', '127.0.0.1', '新增', '友情链接新增，name：娜迦源码', '/admin.php/blogroll/blogrolladd.html', 1, 1565838099, 1565838099),
(184, 1, 'admin', '127.0.0.1', '登录', '登录操作，username：admin', '/admin.php/login/loginhandle.html', 1, 1566010050, 1566010050),
(185, 1, 'admin', '127.0.0.1', '设置', '系统设置保存', '/admin.php/config/setting.html', 1, 1566010274, 1566010274),
(186, 1, 'admin', '127.0.0.1', '编辑', '会员编辑id:44', '/admin.php/user/useredit.html', 1, 1566010430, 1566010430),
(187, 1, 'admin', '127.0.0.1', '编辑', '会员密码修改，id：1', '/admin.php/member/editpassword.html', 1, 1566010509, 1566010509),
(188, 1, 'admin', '127.0.0.1', '编辑', '会员编辑id:44', '/admin.php/user/useredit.html', 1, 1566010580, 1566010580),
(189, 1, 'admin', '127.0.0.1', '编辑', '会员编辑id:44', '/admin.php/user/useredit.html', 1, 1566010618, 1566010618);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_addon`
--

CREATE TABLE IF NOT EXISTS `tmf_addon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名称',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '插件描述',
  `config` text NOT NULL COMMENT '配置',
  `author` varchar(40) NOT NULL DEFAULT '' COMMENT '作者',
  `version` varchar(20) NOT NULL DEFAULT '' COMMENT '版本号',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='插件表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tmf_addon`
--

INSERT INTO `tmf_addon` (`id`, `name`, `title`, `describe`, `config`, `author`, `version`, `status`, `create_time`, `update_time`) VALUES
(3, 'File', '文件上传', '文件上传插件', '', 'Jack', '1.0', 1, 0, 0),
(4, 'Icon', '图标选择', '图标选择插件', '', '5gyun', '1.0', 1, 0, 0),
(5, 'Editor', '文本编辑器', '富文本编辑器', '', '5gyun', '1.0', 1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_api`
--

CREATE TABLE IF NOT EXISTS `tmf_api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(150) NOT NULL DEFAULT '' COMMENT '接口名称',
  `group_id` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '接口分组',
  `request_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '请求类型 0:POST  1:GET',
  `api_url` char(50) NOT NULL DEFAULT '' COMMENT '请求路径',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '接口描述',
  `describe_text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '接口富文本描述',
  `is_request_data` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否需要请求数据',
  `request_data` text NOT NULL COMMENT '请求数据',
  `response_data` text NOT NULL COMMENT '响应数据',
  `is_response_data` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否需要响应数据',
  `is_user_token` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否需要用户token',
  `is_response_sign` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否返回数据签名',
  `is_request_sign` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否验证请求数据签名',
  `response_examples` text NOT NULL COMMENT '响应栗子',
  `developer` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '研发者',
  `api_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '接口状态（0:待研发，1:研发中，2:测试中，3:已完成）',
  `is_page` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为分页接口 0：否  1：是',
  `sort` tinyint(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '数据状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='API表' AUTO_INCREMENT=192 ;

--
-- 转存表中的数据 `tmf_api`
--

INSERT INTO `tmf_api` (`id`, `name`, `group_id`, `request_type`, `api_url`, `describe`, `describe_text`, `is_request_data`, `request_data`, `response_data`, `is_response_data`, `is_user_token`, `is_response_sign`, `is_request_sign`, `response_examples`, `developer`, `api_status`, `is_page`, `sort`, `status`, `create_time`, `update_time`) VALUES
(186, '登录或注册', 34, 0, 'common/login', '系统登录注册接口，若用户名存在则验证密码正确性，若用户名不存在则注册新用户，返回 user_token 用于操作需验证身份的接口', '', 1, '[{"field_name":"username","data_type":"0","is_require":"1","field_describe":"\\u7528\\u6237\\u540d"},{"field_name":"password","data_type":"0","is_require":"1","field_describe":"\\u5bc6\\u7801"}]', '[{"field_name":"data","data_type":"2","field_describe":"\\u4f1a\\u5458\\u6570\\u636e\\u53causer_token"}]', 1, 0, 1, 0, '{\r\n    &quot;code&quot;: 0,\r\n    &quot;msg&quot;: &quot;操作成功&quot;,\r\n    &quot;data&quot;: {\r\n        &quot;member_id&quot;: 51,\r\n        &quot;nickname&quot;: &quot;sadasdas&quot;,\r\n        &quot;username&quot;: &quot;sadasdas&quot;,\r\n        &quot;create_time&quot;: &quot;2017-09-09 13:40:17&quot;,\r\n        &quot;user_token&quot;: &quot;eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJPbmVCYXNlIEpXVCIsImlhdCI6MTUwNDkzNTYxNywiZXhwIjoxNTA0OTM2NjE3LCJhdWQiOiJPbmVCYXNlIiwic3ViIjoiT25lQmFzZSIsImRhdGEiOnsibWVtYmVyX2lkIjo1MSwibmlja25hbWUiOiJzYWRhc2RhcyIsInVzZXJuYW1lIjoic2FkYXNkYXMiLCJjcmVhdGVfdGltZSI6IjIwMTctMDktMDkgMTM6NDA6MTcifX0.6PEShODuifNsa-x1TumLoEaR2TCXpUEYgjpD3Mz3GRM&quot;\r\n    }\r\n}', 0, 1, 0, 0, 0, 1504501410, 1564060269),
(187, '文章分类列表', 44, 0, 'article/categorylist', '文章分类列表接口', '', 0, '', '[{"field_name":"id","data_type":"0","field_describe":"\\u6587\\u7ae0\\u5206\\u7c7bID"},{"field_name":"name","data_type":"0","field_describe":"\\u6587\\u7ae0\\u5206\\u7c7b\\u540d\\u79f0"}]', 1, 0, 0, 0, '{\r\n    &quot;code&quot;: 0,\r\n    &quot;msg&quot;: &quot;操作成功&quot;,\r\n    &quot;data&quot;: [\r\n        {\r\n            &quot;id&quot;: 2,\r\n            &quot;name&quot;: &quot;测试文章分类2&quot;\r\n        },\r\n        {\r\n            &quot;id&quot;: 1,\r\n            &quot;name&quot;: &quot;测试文章分类1&quot;\r\n        }\r\n    ]\r\n}', 0, 0, 0, 2, 1, 1504765581, 1520504982),
(188, '文章列表', 44, 0, 'article/articlelist', '文章列表接口', '', 1, '[{"field_name":"category_id","data_type":"0","is_require":"0","field_describe":"\\u82e5\\u4e0d\\u4f20\\u9012\\u6b64\\u53c2\\u6570\\u5219\\u4e3a\\u6240\\u6709\\u5206\\u7c7b"}]', '', 0, 0, 0, 0, '{\r\n    &quot;code&quot;: 0,\r\n    &quot;msg&quot;: &quot;操作成功&quot;,\r\n    &quot;data&quot;: {\r\n        &quot;total&quot;: 9,\r\n        &quot;per_page&quot;: &quot;10&quot;,\r\n        &quot;current_page&quot;: 1,\r\n        &quot;last_page&quot;: 1,\r\n        &quot;data&quot;: [\r\n            {\r\n                &quot;id&quot;: 16,\r\n                &quot;name&quot;: &quot;11111111&quot;,\r\n                &quot;category_id&quot;: 2,\r\n                &quot;describe&quot;: &quot;22222222&quot;,\r\n                &quot;create_time&quot;: &quot;2017-08-07 13:58:37&quot;\r\n            },\r\n            {\r\n                &quot;id&quot;: 15,\r\n                &quot;name&quot;: &quot;tttttt&quot;,\r\n                &quot;category_id&quot;: 1,\r\n                &quot;describe&quot;: &quot;sddd&quot;,\r\n                &quot;create_time&quot;: &quot;2017-08-07 13:24:46&quot;\r\n            }\r\n        ]\r\n    }\r\n}', 0, 0, 1, 1, 1, 1504779780, 1520504982),
(189, '首页接口', 45, 0, 'combination/index', '首页聚合接口', '', 1, '[{"field_name":"category_id","data_type":"0","is_require":"0","field_describe":"\\u6587\\u7ae0\\u5206\\u7c7bID"}]', '[{"field_name":"article_category_list","data_type":"2","field_describe":"\\u6587\\u7ae0\\u5206\\u7c7b\\u6570\\u636e"},{"field_name":"article_list","data_type":"2","field_describe":"\\u6587\\u7ae0\\u6570\\u636e"}]', 1, 0, 1, 0, '{\r\n    &quot;code&quot;: 0,\r\n    &quot;msg&quot;: &quot;操作成功&quot;,\r\n    &quot;data&quot;: {\r\n        &quot;article_category_list&quot;: [\r\n            {\r\n                &quot;id&quot;: 2,\r\n                &quot;name&quot;: &quot;测试文章分类2&quot;\r\n            },\r\n            {\r\n                &quot;id&quot;: 1,\r\n                &quot;name&quot;: &quot;测试文章分类1&quot;\r\n            }\r\n        ],\r\n        &quot;article_list&quot;: {\r\n            &quot;total&quot;: 8,\r\n            &quot;per_page&quot;: &quot;2&quot;,\r\n            &quot;current_page&quot;: &quot;1&quot;,\r\n            &quot;last_page&quot;: 4,\r\n            &quot;data&quot;: [\r\n                {\r\n                    &quot;id&quot;: 15,\r\n                    &quot;name&quot;: &quot;tttttt&quot;,\r\n                    &quot;category_id&quot;: 1,\r\n                    &quot;describe&quot;: &quot;sddd&quot;,\r\n                    &quot;create_time&quot;: &quot;2017-08-07 13:24:46&quot;\r\n                },\r\n                {\r\n                    &quot;id&quot;: 14,\r\n                    &quot;name&quot;: &quot;1111111111111111111&quot;,\r\n                    &quot;category_id&quot;: 1,\r\n                    &quot;describe&quot;: &quot;123123&quot;,\r\n                    &quot;create_time&quot;: &quot;2017-08-04 15:37:20&quot;\r\n                }\r\n            ]\r\n        }\r\n    }\r\n}', 0, 0, 1, 0, 0, 1504785072, 1564059629),
(190, '详情页接口', 45, 0, 'combination/details', '详情页接口', '', 1, '[{"field_name":"article_id","data_type":"0","is_require":"1","field_describe":"\\u6587\\u7ae0ID"}]', '[{"field_name":"article_category_list","data_type":"2","field_describe":"\\u6587\\u7ae0\\u5206\\u7c7b\\u6570\\u636e"},{"field_name":"article_details","data_type":"2","field_describe":"\\u6587\\u7ae0\\u8be6\\u60c5\\u6570\\u636e"}]', 1, 0, 0, 0, '{\r\n    &quot;code&quot;: 0,\r\n    &quot;msg&quot;: &quot;操作成功&quot;,\r\n    &quot;data&quot;: {\r\n        &quot;article_category_list&quot;: [\r\n            {\r\n                &quot;id&quot;: 2,\r\n                &quot;name&quot;: &quot;测试文章分类2&quot;\r\n            },\r\n            {\r\n                &quot;id&quot;: 1,\r\n                &quot;name&quot;: &quot;测试文章分类1&quot;\r\n            }\r\n        ],\r\n        &quot;article_details&quot;: {\r\n            &quot;id&quot;: 1,\r\n            &quot;name&quot;: &quot;213&quot;,\r\n            &quot;category_id&quot;: 1,\r\n            &quot;describe&quot;: &quot;test001&quot;,\r\n            &quot;content&quot;: &quot;第三方发送到&quot;&quot;&quot;,\r\n            &quot;create_time&quot;: &quot;2014-07-22 11:56:53&quot;\r\n        }\r\n    }\r\n}', 0, 0, 0, 0, 1, 1504922092, 1520504982),
(191, '修改密码', 34, 0, 'common/changepassword', '修改密码接口', '', 1, '[{"field_name":"old_password","data_type":"0","is_require":"1","field_describe":"\\u65e7\\u5bc6\\u7801"},{"field_name":"new_password","data_type":"0","is_require":"1","field_describe":"\\u65b0\\u5bc6\\u7801"}]', '', 0, 1, 0, 0, '{\r\n    &quot;code&quot;: 0,\r\n    &quot;msg&quot;: &quot;操作成功&quot;,\r\n    &quot;exe_time&quot;: &quot;0.037002&quot;\r\n}', 0, 0, 0, 0, 1, 1504941496, 1520504982);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_api_group`
--

CREATE TABLE IF NOT EXISTS `tmf_api_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(120) NOT NULL DEFAULT '' COMMENT 'aip分组名称',
  `sort` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='api分组表' AUTO_INCREMENT=72 ;

--
-- 转存表中的数据 `tmf_api_group`
--

INSERT INTO `tmf_api_group` (`id`, `name`, `sort`, `update_time`, `create_time`, `status`) VALUES
(34, '基础接口', 0, 1504501195, 0, 1),
(44, '文章接口', 1, 1504765319, 1504765319, 1),
(45, '聚合接口', 0, 1504784149, 1504784149, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_apply_record`
--

CREATE TABLE IF NOT EXISTS `tmf_apply_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` varchar(32) NOT NULL COMMENT '记录编号',
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '会员id',
  `level_before` int(10) NOT NULL DEFAULT '0' COMMENT '升级之前等级',
  `level_after` int(10) NOT NULL DEFAULT '0' COMMENT '升级之后等级',
  `up_user_id` int(10) NOT NULL DEFAULT '0' COMMENT '申请人id',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态，0发起申请，1同意，2撤销',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status_complain` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0未投诉，1已投诉，2已撤诉',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '升级缴纳金额',
  `verify_note` varchar(255) DEFAULT '' COMMENT '审核备注',
  `agent_pid` int(10) DEFAULT '0' COMMENT '代理',
  `up_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '升级验证级别 （0-普通验证，1及其以上特殊验证）',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='升级申请记录' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tmf_article`
--

CREATE TABLE IF NOT EXISTS `tmf_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `name` char(40) NOT NULL DEFAULT '' COMMENT '文章名称',
  `category_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章分类',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `content` text NOT NULL COMMENT '文章内容',
  `cover_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '封面图片id',
  `file_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件id',
  `img_ids` varchar(200) NOT NULL DEFAULT '',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '数据状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='文章表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tmf_article`
--

INSERT INTO `tmf_article` (`id`, `member_id`, `name`, `category_id`, `describe`, `content`, `cover_id`, `file_id`, `img_ids`, `create_time`, `update_time`, `status`) VALUES
(1, 24, '公告公告公告公告公告', 9, 'dasfdsdgfhrrhtrhnfggbvxb', '(2)&lt;span&gt; &lt;/span&gt;公告(2)&lt;span&gt; &lt;/span&gt;公告(2)&lt;span&gt; &lt;/span&gt;公告(2)&lt;span&gt; &lt;/span&gt;公告(2)&lt;span&gt; &lt;/span&gt;公告(2)&lt;span&gt; &lt;/span&gt;公告(2)&lt;span&gt; &lt;/span&gt;公告(2)&lt;span&gt; &lt;/span&gt;公告(2)&lt;span&gt; &lt;/span&gt;公告(2)&lt;span&gt; &lt;/span&gt;公告(2)&lt;span&gt; &lt;/span&gt;公告(2)&lt;span&gt; &lt;/span&gt;公告(2)&lt;span&gt; &lt;/span&gt;公告(2)&lt;span&gt; &lt;/span&gt;公告(2)&lt;span&gt; &lt;/span&gt;公告', 0, 0, '', 1548835950, 1564119670, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_article_category`
--

CREATE TABLE IF NOT EXISTS `tmf_article_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '分类名称',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '数据状态',
  `icon` char(20) NOT NULL DEFAULT '' COMMENT '分类图标',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_name` (`name`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='分类表' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `tmf_article_category`
--

INSERT INTO `tmf_article_category` (`id`, `name`, `describe`, `create_time`, `update_time`, `status`, `icon`) VALUES
(7, '基础', '基础内容', 1509620712, 1509620712, -1, 'fa-street-view'),
(8, '后台介绍', '后台功能介绍', 1509792822, 1509792822, -1, 'fa-user'),
(9, '系统公告', '系统公告', 1546511262, 1547044535, 1, 'fa-th-list'),
(10, '最新资讯', '最新资讯', 1547044566, 1547603805, -1, 'fa-star');

-- --------------------------------------------------------

--
-- 表的结构 `tmf_auth_group`
--

CREATE TABLE IF NOT EXISTS `tmf_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id,自增主键',
  `module` varchar(20) NOT NULL DEFAULT '' COMMENT '用户组所属模块',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '用户组名称',
  `describe` varchar(80) NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户组状态：为1正常，为0禁用,-1为删除',
  `rules` varchar(1000) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='权限组表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tmf_auth_group`
--

INSERT INTO `tmf_auth_group` (`id`, `module`, `name`, `describe`, `status`, `rules`, `member_id`, `update_time`, `create_time`) VALUES
(1, '', '代理', '代理', 1, '211,212,213,223,225,226,227,228,214,215,229,230,216,217,218,219,220,221,222,1,210,144,145,150,153,149', 1, 1547730324, 1546584993);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_auth_group_access`
--

CREATE TABLE IF NOT EXISTS `tmf_auth_group_access` (
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户组id',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户组授权表';

--
-- 转存表中的数据 `tmf_auth_group_access`
--

INSERT INTO `tmf_auth_group_access` (`member_id`, `group_id`, `update_time`, `create_time`, `status`) VALUES
(2, 1, 1546585344, 1546585344, 1),
(3, 1, 1547019440, 1547019440, 1),
(4, 1, 1547044289, 1547044289, 1),
(5, 1, 1547110229, 1547110229, 1),
(6, 1, 1547110976, 1547110976, 1),
(7, 1, 1547536238, 1547536238, 1),
(8, 1, 1547622374, 1547622374, 1),
(9, 1, 1548468666, 1548468666, 1),
(10, 1, 1548471511, 1548471511, 1),
(11, 1, 1548481143, 1548481143, 1),
(12, 1, 1548481807, 1548481807, 1),
(13, 1, 1548482778, 1548482778, 1),
(14, 1, 1548483250, 1548483250, 1),
(15, 1, 1548485916, 1548485916, 1),
(17, 1, 1548511153, 1548511153, 1),
(18, 1, 1548514266, 1548514266, 1),
(19, 1, 1548514491, 1548514491, 1),
(20, 1, 1548557836, 1548557836, 1),
(21, 1, 1548641370, 1548641370, 1),
(16, 1, 1548649376, 1548649376, 1),
(22, 1, 1548649382, 1548649382, 1),
(23, 1, 1548835092, 1548835092, 1),
(24, 1, 1548835392, 1548835392, 1),
(25, 1, 1548838575, 1548838575, 1),
(26, 1, 1564320611, 1564320611, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_bank`
--

CREATE TABLE IF NOT EXISTS `tmf_bank` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_code` varchar(20) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_simple_code` varchar(10) DEFAULT NULL,
  `is_select` tinyint(4) DEFAULT '0' COMMENT '是否选中',
  `logo_url` varchar(255) DEFAULT NULL COMMENT 'logo 地址',
  `color` varchar(10) DEFAULT NULL COMMENT '银行卡颜色',
  `e_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`bank_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=207 ;

--
-- 转存表中的数据 `tmf_bank`
--

INSERT INTO `tmf_bank` (`bank_id`, `bank_code`, `bank_name`, `bank_simple_code`, `is_select`, `logo_url`, `color`, `e_code`) VALUES
(2, '102100099996', '中国工商银行', '102', 1, '/Public/bank_logo/102100099996.png', '#3388ff', 'ICBC'),
(3, '103100000026', '中国农业银行', '103', 1, '/Public/bank_logo/103100000026.png', '#3388ff', 'ABC'),
(4, '104100000004', '中国银行', '104', 1, '/Public/bank_logo/china2x.png', '#3388ff', 'BOC'),
(5, '313305066661', '苏州银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'BOSZ'),
(6, '313591001001', '广东南粤银行股份有限公司', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'GDNYBANK'),
(7, '402241000015', '吉林农村信用社', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(8, '402451000010', '山东省农联社', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(9, '593100000020', '友利银行', '593', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'WOORIBANKC'),
(10, '313791030003', '长安银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(11, '313585000990', '珠海华润银行清算中心', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(12, '313335081005', '嘉兴银行清算中心', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'JXBANK'),
(13, '313655091983', '自贡市商业银行清算中心', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'ZGCCB'),
(14, '402331000007', '浙江省农村信用社', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'ZJNX'),
(15, '313146000019', '廊坊银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'LANGFB'),
(16, '313617000018', '桂林银行股份有限公司', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'GLBANK'),
(17, '320345790018', '浙江三门银座村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'SMYZB'),
(18, '313451000019', '齐鲁银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'QLBANK'),
(19, '313586000006', '广东华兴银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(20, '320100010011', '北京顺义银座村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'SYYZB'),
(21, '320428090311', '江西赣州银座村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'GZYZB'),
(22, '320584002002', '深圳福田银座村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(23, '320653000104', '重庆渝北银座村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'YBYZB'),
(24, '320687000016', '重庆黔江银座村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'QJYZB'),
(25, '320343800019', '浙江景宁银座村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'JNYZB'),
(26, '313397075189', '泉州银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(27, '313312300018', '江苏长江商行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(28, '314305106644', '太仓农商行', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(29, '313791000015', '西安银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'XABANK'),
(30, '313454000016', '枣庄银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(31, '314641000014', '海口联合农村商业银行', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'UNITEDBANK'),
(32, '313424076706', '九江银行股份有限公司', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'JJBANK'),
(33, '313673093259', '南充市商业银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'CGNB'),
(34, '313651099999', '成都银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'CDFB'),
(35, '502290000006', '东亚银行（中国）有限公司', '502', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'HKBEA'),
(36, '314302200018', '江阴农商银行', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(37, '105100000017', '中国建设银行', '105', 1, '/Public/bank_logo/105100000017.png', '#3388ff', 'CCB'),
(38, '301290000007', '交通银行', '301', 1, '/Public/bank_logo/301290000007.png', '#3388ff', 'COMM'),
(39, '302100011000', '中信银行', '302', 1, '/Public/bank_logo/302100011000.png', '#3388ff', 'CITIC'),
(40, '303100000006', '中国光大银行', '303', 1, '/Public/bank_logo/1.jpg', '#3388ff', 'CEB'),
(41, '304100040000', '华夏银行', '304', 1, '/Public/bank_logo/304100040000.png', '#3388ff', 'HXBANK'),
(42, '305100000013', '中国民生银行', '305', 1, '/Public/bank_logo/306581000003.png', '#3388ff', 'CMBC'),
(43, '306581000003', '广发银行股份有限公司', '306', 1, '/Public/bank_logo/306581000003.png', '#3388ff', 'GDB'),
(44, '307584007998', '平安银行', '307', 1, '/Public/bank_logo/1.jpg', '#3388ff', 'SPABANK'),
(45, '308584000013', '招商银行', '308', 1, '/Public/bank_logo/308584000013.png', '#3388ff', 'CMB'),
(46, '309391000011', '兴业银行', '309', 1, '/Public/bank_logo/309391000011.png', '#3388ff', 'CIB'),
(47, '313100000013', '北京银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'BJBANK'),
(48, '313110000017', '天津银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'TCCB'),
(49, '313581003284', '广州银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'GCB'),
(50, '313521006000', '湖北银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'HBC'),
(51, '313602088017', '东莞银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'BOD'),
(52, '314581000011', '广州农村商业银行', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'GRCBANK'),
(53, '314588000016', '顺德农村商业银行', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'SDEBANK'),
(54, '317110010019', '天津农商银行', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'TRCB'),
(55, '318110000014', '渤海银行', '318', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'BOHAIB'),
(56, '402100000018', '北京农村商业银行', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'BJRCB'),
(57, '402584009991', '深圳农商行', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(58, '402602000018', '东莞农村商业银行', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'DRCBCL'),
(59, '403100000004', '中国邮政储蓄银行', '403', 1, '/Public/bank_logo/403100000004.png', '#3388ff', 'PSBC'),
(60, '402651020006', '四川省联社', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(61, '595100000007', '新韩银行中国', '595', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'SHINHAN'),
(62, '597100000014', '韩亚银行', '597', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'KEBHANA'),
(66, '313227000012', '锦州银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'BOJZ'),
(67, '313222080002', '大连银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'DLB'),
(68, '313223007007', '鞍山市商业银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(69, '313227600018', '葫芦岛银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(70, '313452060150', '青岛银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'BQD'),
(71, '313453001017', '齐商银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'ZBCB'),
(72, '313456000108', '烟台银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'YANTAIBANK'),
(73, '313461000012', '济宁银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(74, '313463000993', '泰安银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'TACCB'),
(75, '313473070018', '临商银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'LSBC'),
(76, '313455000018', '东营银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(77, '313465000010', '威海市商业银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'WHCCB'),
(78, '313473200011', '日照银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'RZB'),
(79, '313463400019', '莱商银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'LSBANK'),
(80, '402361018886', '安徽省农村信用社联合社', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'ARCU'),
(81, '313551088886', '长沙银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'CSCB'),
(82, '313421087506', '南昌银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'NCB'),
(83, '313433076801', '上饶银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'SRBANK'),
(84, '313611001018', '广西北部湾银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'BGB'),
(85, '313491099996', '中原银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(86, '325290000012', '上海银行', '325', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'SHBANK'),
(87, '310290000013', '上海浦东发展银行', '310', 1, '/Public/bank_logo/310290000013.png', '#3388ff', 'SPDB'),
(88, '313495081900', '平顶山银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'BOP'),
(89, '314305670002', '张家港农村商业银行', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'ZRCBANK'),
(90, '314305206650', '昆山农村商业银行', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'KSRB'),
(91, '313331000014', '杭州银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'HZCB'),
(92, '316331000018', '浙商银行', '316', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'ZSB'),
(93, '313338707013', '浙江稠州商业银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'CZCB'),
(94, '313345010019', '浙江泰隆商业银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'ZJTLCB'),
(95, '313333007331', '温州银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'WZCB'),
(96, '402332010004', '鄞州银行', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'NBYZ'),
(97, '313332082914', '宁波银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'NBBANK'),
(98, '313336071575', '湖州银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'HZCCB'),
(99, '313393080005', '厦门银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'XMCCB'),
(100, '402871099996', '黄河农村商业银行', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'NXRCU'),
(101, '402641000014', '海南省农村信用社', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(102, '402521000032', '湖北农信', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(103, '313882000012', '昆仑银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'KLB'),
(104, '313168000003', '晋城银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'JINCHB'),
(105, '313881000002', '乌鲁木齐市商业银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'WLB'),
(106, '313228000276', '营口银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'BOYK'),
(107, '313131000016', '邢台银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'XTB'),
(108, '323584000888', '深圳前海微众银行', '323', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'BANKOFTIAN'),
(109, '313229000008', '阜新银行结算中心', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'FXCB'),
(110, '314651000000', '成都农村商业银行股份有限公司', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(111, '313656000019', '攀枝花市商业银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(112, '313653000013', '重庆银行股份有限公司', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'CQBANK'),
(113, '314653000011', '重庆农村商业银行', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'CRCBANK'),
(114, '313121006888', '河北银行股份有限公司', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'HEBBANK'),
(115, '313127000013', '邯郸市商业银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(116, '313141052422', '承德银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'BOCD'),
(117, '313138000019', '张家口市商业银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(118, '313143005157', '沧州银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'CZBANK'),
(119, '313658000014', '德阳银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(120, '313659000016', '绵阳市商业银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(121, '313521000011', '汉口银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'HKB'),
(122, '313731010015', '富滇银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'FDB'),
(123, '402731057238', '云南省农村信用社', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'YNRCC'),
(124, '313821001016', '兰州银行股份有限公司', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'LZYH'),
(125, '313871000007', '宁夏银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'NXBANK'),
(126, '313851000018', '青海银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'BOQH'),
(127, '313261099913', '龙江银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'DAQINGB'),
(128, '313261000018', '哈尔滨银行结算中心', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'HRBCB'),
(129, '313491000232', '郑州银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'ZZBANK'),
(130, '313148053964', '衡水银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'HSBK'),
(131, '313493080539', '洛阳银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'LYCCB'),
(132, '313332090019', '宁波通商银行股份有限公司', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'NCBANK'),
(133, '313701098010', '贵阳银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(134, '313161000017', '晋商银行网上银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'JSBANK'),
(135, '313191000011', '内蒙古银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'H3CB'),
(136, '313192000013', '包商银行股份有限公司', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'BSB'),
(137, '313205057830', '鄂尔多斯银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'ORBANK'),
(138, '313241066661', '吉林银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'JLBANK'),
(139, '402611099974', '广西农村信用社（合作银行）', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(140, '313614000012', '柳州银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(141, '596110000013', '企业银行', '596', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'IBK'),
(142, '313345001665', '台州银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'TZCB'),
(143, '313345400010', '浙江民泰商业银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'ZJMTFB'),
(144, '313337009004', '绍兴银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'SXCB'),
(145, '315456000105', '恒丰银行', '315', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'HFBANK'),
(146, '313468000015', '德州银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'DZBANK'),
(147, '313458000013', '潍坊银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'BANKWF'),
(148, '402301099998', '江苏省农村信用社联合社', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(149, '314305506621', '常熟农村商业银行', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'CSRCB'),
(150, '313301099999', '江苏银行股份有限公司', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'JSBCHINA '),
(151, '313301008887', '南京银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'NJCB'),
(152, '314305400015', '吴江农村商业银行', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(153, '313428076517', '赣州银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(154, '319361000013', '徽商银行', '319', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'HSBANK'),
(155, '402391000068', '福建省农村信用社', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(156, '313391080007', '福建海峡银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'FJHXBC'),
(157, '322290000011', '上海农商银行', '322', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'SRCB'),
(158, '313501080608', '焦作中旅银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'JZCTB'),
(159, '402521090019', '武汉农村商业银行', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'WHRCB'),
(160, '320455000019', '东营莱商村镇银行股份有限公司', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(161, '402421099990', '农村信用社', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'HURCB'),
(162, '313338009688', '金华银行股份有限公司', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'JHBANK'),
(163, '787290000019', '富邦华一银行', '787', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'FSONLINE'),
(164, '402581090008', '广东省农信', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(165, '781393010011', '厦门国际银行', '781', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'XIB'),
(166, '313175000011', '晋中银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(167, '313551070008', '华融湘江银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'HRXJB'),
(168, '313736000019', '曲靖市商业银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(169, '402791000010', '陕西信合', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'SXRCCU'),
(170, '313193057846', '乌海银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(171, '314302066666', '无锡农村商业银行', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'WRCB'),
(172, '402701002999', '贵州省农村信用社联合社', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'GZRCU'),
(173, '313741095715', '玉溪市商业银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(174, '313221030008', '盛京银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'SJBANK'),
(175, '321667090019', '重庆三峡银行', '321', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'CCQTGB'),
(176, '314110000011', '天津滨海农村商业银行股份有限公司', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(177, '323331000001', '浙江网商银行', '323', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'MYBANK'),
(178, '320902800016', '石河子国民村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(179, '717110000010', '中德银行', '717', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(180, '320884000025', '哈密红星国民村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(181, '314304099999', '江南农村商业银行', '314', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'JNBANK'),
(182, '320881000011', '新疆绿洲国民村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(183, '320898000010', '伊犁国民村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(184, '320898100019', '奎屯国民村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(185, '531290088881', '花旗银行', '531', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'CITIBANK'),
(186, '313701099012', '贵州银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(187, '320631100016', '广西钦州钦南国民村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(188, '320633100011', '东兴国民村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(189, '320611000067', '广西上林国民村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(190, '320633000027', '防城港防城国民村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'FCCZB'),
(191, '313872097457', '石嘴山银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(192, '323290000016', '华瑞银行', '323', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'SHR'),
(193, '313641099995', '海南银行股份有限公司', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(194, '320631500019', '广西浦北国民村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(195, '313662000015', '遂宁商行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(196, '320623000015', '广西银行国民村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(197, '320882000013', '克拉玛依金龙国民村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(198, '320885099990', '昌吉国民村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(199, '313671000017', '宜宾市商业银行', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'YBCCB'),
(200, '320884400011', '北屯国民村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(201, '320885800018', '五家渠国民村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(202, '320887000014', '博乐国民村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(203, '313231000013', '辽阳银行股份有限公司', '313', 0, '/Public/bank_logo/1.jpg', '#3388ff', 'BANKOFLIAO'),
(204, '320623100016', '合浦国民村镇银行', '320', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(205, '402221010013', '辽宁省农村信用社联合社运营管理部', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL),
(206, '402491000026', '河南省农信联社', '402', 0, '/Public/bank_logo/1.jpg', '#3388ff', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_blogroll`
--

CREATE TABLE IF NOT EXISTS `tmf_blogroll` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL DEFAULT '' COMMENT '链接名称',
  `img_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '链接图片封面',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '数据状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='友情链接表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `tmf_blogroll`
--

INSERT INTO `tmf_blogroll` (`id`, `name`, `img_id`, `url`, `describe`, `sort`, `status`, `create_time`, `update_time`) VALUES
(3, '娜迦源码', 0, 'https://wsx6.cn', '', 1, 1, 1565838099, 1565838099);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_code_log`
--

CREATE TABLE IF NOT EXISTS `tmf_code_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account` varchar(15) DEFAULT '' COMMENT '发送账号（手机号）',
  `code_type` varchar(32) DEFAULT '' COMMENT '发送类型',
  `code` varchar(32) DEFAULT '' COMMENT '验证码',
  `send_status` tinyint(1) unsigned DEFAULT '0' COMMENT '发送状态（0-未发送，1-发送成功 2-已验证）',
  `ip` varchar(20) DEFAULT NULL COMMENT 'ip',
  `create_time` int(10) unsigned DEFAULT '0' COMMENT '添加时间',
  `expire_time` int(10) unsigned DEFAULT '0' COMMENT '失效时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `account` (`account`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=123 ;

--
-- 转存表中的数据 `tmf_code_log`
--

INSERT INTO `tmf_code_log` (`id`, `account`, `code_type`, `code`, `send_status`, `ip`, `create_time`, `expire_time`) VALUES
(1, '18182652215', 'find_pwd', '123456', 0, '113.96.218.50', 1548981395, 1548981575),
(2, '18687137412', 'registe', '123456', 0, '14.204.155.207', 1564022445, 1564022625),
(3, '18687137419', 'registe', '123456', 0, '14.204.155.207', 1564022507, 1564022687),
(4, '18866885581', 'registe', '123456', 0, '39.82.235.26', 1564044641, 1564044821),
(5, '17623847989', 'registe', '123456', 0, '223.104.63.46', 1564050089, 1564050269),
(6, '17623847989', 'registe', '123456', 0, '123.147.246.33', 1564076955, 1564077135),
(7, '18687137455', 'registe', '123456', 0, '14.204.155.8', 1564088700, 1564088880),
(8, '18687137419', 'registe', '123456', 0, '58.144.156.43', 1564110182, 1564110362),
(9, '13843554869', 'registe', '410501', 0, '36.49.148.222', 1564119195, 1564119375),
(10, '13989272019', 'registe', '447250', 0, '223.87.39.236', 1564121814, 1564121994),
(11, '13989272029', 'registe', '212747', 0, '223.87.39.236', 1564121878, 1564122058),
(12, '13989272029', 'registe', '137545', 0, '223.87.39.236', 1564122612, 1564122792),
(13, '13989272029', 'registe', '972973', 0, '223.87.39.236', 1564135139, 1564135319),
(14, '17623847989', 'registe', '604519', 0, '58.144.156.39', 1564136580, 1564136760),
(15, '13989272029', 'registe', '544534', 0, '223.87.39.236', 1564136611, 1564136791),
(16, '13989272029', 'registe', '330465', 0, '223.87.39.236', 1564137369, 1564137549),
(17, '13989272029', 'registe', '885549', 0, '223.87.39.236', 1564140012, 1564140192),
(18, '18676149413', 'registe', '120324', 0, '14.116.137.170', 1564141256, 1564141436),
(19, '13989272029', 'registe', '662582', 0, '223.87.39.236', 1564143512, 1564143692),
(20, '10000000123', 'registe', '647091', 0, '36.49.148.165', 1564149843, 1564150023),
(21, '10000000124', 'registe', '865692', 0, '36.49.148.165', 1564150451, 1564150631),
(22, '10000000125', 'registe', '264685', 0, '36.49.148.165', 1564150638, 1564150818),
(23, '18687137419', 'registe', '415170', 0, '58.144.156.43', 1564153451, 1564153631),
(24, '13780894666', 'registe', '293084', 0, '112.244.242.127', 1564191945, 1564192125),
(25, '19982715926', 'registe', '366418', 0, '14.116.137.170', 1564192863, 1564193043),
(26, '13989272029', 'registe', '800488', 0, '223.87.39.236', 1564208165, 1564208345),
(27, '13843554869', 'registe', '193493', 0, '36.49.148.143', 1564218162, 1564218342),
(28, '13989272029', 'registe', '409896', 0, '113.96.231.120', 1564223220, 1564223400),
(29, '15388981149', 'registe', '395092', 0, '125.83.177.3', 1564235233, 1564235413),
(30, '15388981149', 'registe', '658160', 0, '14.116.141.248', 1564237293, 1564237473),
(31, '13989272029', 'registe', '705978', 0, '223.87.39.236', 1564248923, 1564249103),
(32, '13989272029', 'registe', '850448', 0, '113.96.231.120', 1564248977, 1564249157),
(33, '17623847989', 'registe', '339529', 0, '123.147.246.111', 1564252266, 1564252446),
(34, '13322221111', 'registe', '106372', 0, '175.31.82.174', 1564288521, 1564288701),
(35, '18958953380', 'registe', '130514', 0, '101.226.225.86', 1564289725, 1564289905),
(36, '17779039175', 'registe', '632891', 0, '183.11.69.141', 1564298810, 1564298990),
(37, '18682134884', 'registe', '301159', 0, '183.3.255.28', 1564311445, 1564311625),
(38, '18603034969', 'registe', '560052', 0, '14.116.133.171', 1564326352, 1564326532),
(39, '13213211027', 'registe', '980224', 0, '182.114.146.5', 1564327911, 1564328091),
(40, '17794260222', 'registe', '820703', 0, '27.224.68.225', 1564334114, 1564334294),
(41, '13989272029', 'registe', '563870', 0, '221.182.125.244', 1564337392, 1564337572),
(42, '13640979137', 'registe', '264520', 0, '221.182.125.244', 1564341077, 1564341257),
(43, '18644096399', 'registe', '986404', 0, '36.155.93.224', 1564358452, 1564358632),
(44, '13026593993', 'registe', '693014', 0, '101.226.225.85', 1564364868, 1564365048),
(45, '15879760615', 'registe', '774917', 0, '117.136.124.6', 1564367175, 1564367355),
(46, '13640979137', 'registe', '847509', 0, '221.182.125.244', 1564369594, 1564369774),
(47, '13640979137', 'registe', '558404', 0, '221.182.125.244', 1564369699, 1564369879),
(48, '13110200735', 'registe', '449804', 0, '113.205.50.63', 1564373198, 1564373378),
(49, '13110200734', 'registe', '529510', 0, '113.205.50.63', 1564373226, 1564373406),
(50, '18676348678', 'registe', '579141', 0, '183.3.227.100', 1564373253, 1564373433),
(51, '18676348678', 'registe', '817214', 0, '183.3.227.100', 1564373661, 1564373841),
(52, '19982715926', 'registe', '821801', 0, '110.188.229.0', 1564374281, 1564374461),
(53, '18682134884', 'registe', '898925', 0, '116.24.66.175', 1564379473, 1564379653),
(54, '13640979137', 'registe', '160122', 0, '221.182.125.244', 1564382438, 1564382618),
(55, '13640979137', 'registe', '231259', 0, '113.96.231.120', 1564382548, 1564382728),
(56, '15661394551', 'registe', '397344', 0, '218.68.91.101', 1564391296, 1564391476),
(57, '19912545632', 'registe', '908676', 0, '171.15.126.185', 1564393713, 1564393893),
(58, '18687137419', 'registe', '345819', 0, '119.84.153.153', 1564394852, 1564395032),
(59, '18679933536', 'registe', '929000', 0, '104.192.83.17', 1564396887, 1564397067),
(60, '13153630040', 'registe', '820675', 0, '112.224.65.141', 1564413800, 1564413980),
(61, '13153630040', 'registe', '376965', 0, '123.151.148.57', 1564414034, 1564414214),
(62, '13153630040', 'registe', '644235', 0, '123.151.148.55', 1564415116, 1564415296),
(63, '17623847989', 'registe', '368533', 0, '119.84.153.253', 1564421809, 1564421989),
(64, '17625508118', 'registe', '850723', 0, '183.251.90.175', 1564424548, 1564424728),
(65, '18615573824', 'registe', '237878', 0, '112.229.127.76', 1564449212, 1564449392),
(66, '15555555512', 'registe', '555191', 0, '111.199.54.214', 1564455951, 1564456131),
(67, '15228412430', 'registe', '673458', 0, '110.188.227.227', 1564456553, 1564456733),
(68, '15228412430', 'registe', '462384', 0, '110.188.227.227', 1564458568, 1564458748),
(69, '18582968672', 'registe', '292947', 0, '110.188.227.227', 1564458754, 1564458934),
(70, '19982715926', 'registe', '874316', 0, '110.188.227.227', 1564458819, 1564458999),
(71, '18296748091', 'registe', '834188', 0, '106.6.72.67', 1564459539, 1564459719),
(72, '18643720591', 'registe', '249276', 0, '175.31.80.177', 1564464413, 1564464593),
(73, '13640979137', 'registe', '676232', 0, '221.182.125.244', 1564466004, 1564466184),
(74, '13989272029', 'registe', '981707', 0, '221.182.125.244', 1564466214, 1564466394),
(75, '15228412430', 'registe', '240365', 0, '182.137.56.161', 1564496102, 1564496282),
(76, '15228412430', 'registe', '711368', 0, '182.137.56.161', 1564513351, 1564513531),
(77, '15228412430', 'registe', '297477', 0, '182.137.56.161', 1564513485, 1564513665),
(78, '15228412430', 'find_pwd', '681596', 0, '182.137.56.161', 1564514881, 1564515061),
(79, '15228412430', 'find_pwd', '469204', 0, '182.137.56.161', 1564514987, 1564515167),
(80, '15228412430', 'find_pwd', '212666', 0, '182.137.56.161', 1564515147, 1564515327),
(90, '15228412431', 'collection', '321320', 0, '110.188.227.227', 1564635144, 1564635324),
(89, '18682134884', 'registe', '858258', 0, '183.15.177.161', 1564633520, 1564633700),
(88, '15228412430', 'collection', '971131', 0, '112.97.54.234', 1564593501, 1564593681),
(87, '15228412430', 'collection', '268738', 0, '110.188.227.227', 1564559133, 1564559313),
(86, '15228412430', 'collection', '301423', 0, '110.188.227.227', 1564558523, 1564558703),
(91, '15228412430', 'collection', '814093', 0, '110.188.227.227', 1564637260, 1564637440),
(92, '15228412430', 'collection', '341118', 0, '110.188.227.227', 1564637338, 1564637518),
(93, '18582968671', 'collection', '237988', 0, '110.188.227.227', 1564644760, 1564644940),
(94, '18582968672', 'registe', '961773', 0, '110.188.227.227', 1564644805, 1564644985),
(95, '18582968672', 'collection', '361048', 0, '110.188.227.227', 1564717893, 1564718073),
(96, '13111111111', 'registe', '253498', 0, '36.49.148.156', 1564718363, 1564718543),
(97, '13122112211', 'registe', '620902', 0, '36.49.148.156', 1564718435, 1564718615),
(98, '19982968671', 'registe', '417066', 0, '110.188.227.227', 1564729673, 1564729853),
(99, '19982715926', 'registe', '288748', 0, '110.188.227.227', 1564729871, 1564730051),
(100, '19982968672', 'registe', '310266', 0, '110.188.227.227', 1564730706, 1564730886),
(101, '15228412430', 'registe', '984214', 0, '110.188.227.227', 1564731141, 1564731321),
(102, '15228412430', 'collection', '303079', 0, '110.188.227.227', 1564731557, 1564731737),
(103, '18582968689', 'collection', '446110', 0, '110.188.227.227', 1564733668, 1564733848),
(104, '13989272029', 'registe', '644777', 0, '117.177.110.49', 1564735593, 1564735773),
(105, '13989272029', 'collection', '879322', 0, '117.177.110.49', 1564736518, 1564736698),
(106, '13640979137', 'registe', '116463', 0, '117.177.110.49', 1564736693, 1564736873),
(107, '15002139413', 'registe', '922057', 0, '119.39.70.15', 1565266468, 1565266648),
(108, '15002139413', 'registe', '610718', 0, '119.39.70.15', 1565266552, 1565266732),
(109, '17778889991', 'collection', '830280', 0, '223.104.178.82', 1565267098, 1565267278),
(110, '13033050222', 'registe', '674167', 0, '114.100.85.74', 1565276843, 1565277023),
(111, '18582968679', 'collection', '601022', 0, '171.107.59.41', 1565277737, 1565277917),
(112, '13033050222', 'collection', '102533', 0, '114.100.85.74', 1565279823, 1565280003),
(113, '18582968679', 'collection', '848812', 0, '171.107.59.41', 1565282139, 1565282319),
(114, '17778889991', 'collection', '518085', 0, '39.89.170.167', 1565313124, 1565313304),
(115, '15002139413', 'collection', '614924', 0, '113.240.164.215', 1565325915, 1565326095),
(116, '15002139430', 'collection', '236633', 0, '113.240.164.215', 1565329267, 1565329447),
(117, '18050200224', 'collection', '360606', 0, '59.175.15.22', 1565335406, 1565335586),
(118, '15727011417', 'collection', '747908', 0, '59.175.15.22', 1565336229, 1565336409),
(119, '15271750928', 'collection', '243258', 0, '59.175.15.22', 1565339749, 1565339929),
(120, '15271750928', 'collection', '339231', 0, '59.175.15.22', 1565340113, 1565340293),
(121, '13033050222', 'find_pwd', '236325', 0, '59.175.15.22', 1565361569, 1565361749),
(122, '13804888764', 'collection', '252284', 0, '59.175.15.22', 1565395423, 1565395603);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_complain`
--

CREATE TABLE IF NOT EXISTS `tmf_complain` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `apply_record_id` int(10) NOT NULL DEFAULT '0' COMMENT '记录id',
  `content` text COMMENT '内容',
  `img_ids` varchar(255) DEFAULT '' COMMENT '投诉图片ids,多张图片',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `status` tinyint(1) DEFAULT '1' COMMENT '暂时无用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='申请投诉表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `tmf_complain`
--

INSERT INTO `tmf_complain` (`id`, `apply_record_id`, `content`, `img_ids`, `create_time`, `title`, `status`) VALUES
(1, 100, '英模呵呵', '36', 1564291887, '424334', 1),
(2, 11, '没确认', '50', 1564379515, '没有却仍', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_config`
--

CREATE TABLE IF NOT EXISTS `tmf_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置标题',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置选项',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '配置说明',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `value` text NOT NULL COMMENT '配置值',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_name` (`name`) USING BTREE,
  KEY `type` (`type`) USING BTREE,
  KEY `group` (`group`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='配置表' AUTO_INCREMENT=68 ;

--
-- 转存表中的数据 `tmf_config`
--

INSERT INTO `tmf_config` (`id`, `name`, `type`, `title`, `group`, `extra`, `describe`, `create_time`, `update_time`, `status`, `value`, `sort`) VALUES
(1, 'seo_title', 1, '网站标题', 1, '', '网站标题前台显示标题，优先级低于SEO模块', 1378898976, 1566010274, 1, '娜迦源码', 3),
(2, 'seo_description', 2, '网站描述', 1, '', '网站搜索引擎描述，优先级低于SEO模块', 1378898976, 1566010274, 1, '人人还', 100),
(3, 'seo_keywords', 2, '网站关键字', 1, '', '网站搜索引擎关键字，优先级低于SEO模块', 1378898976, 1566010274, 1, 'OneBase|ThinkPHP5', 99),
(9, 'config_type_list', 3, '配置类型列表', 3, '', '主要用于数据解析和页面表单的生成', 1378898976, 1512982406, 1, '0:数字\r\n1:字符\r\n2:文本\r\n3:数组\r\n4:枚举\r\n5:图片\r\n6:文件\r\n7:富文本\r\n8:单选\r\n9:多选\r\n10:日期\r\n11:时间\r\n12:颜色', 100),
(20, 'config_group_list', 3, '配置分组', 3, '', '配置分组', 1379228036, 1512982406, 1, '1:基础\r\n2:数据\r\n3:系统\r\n4:API', 100),
(25, 'list_rows', 0, '每页数据记录数', 2, '', '数据每页显示记录数', 1379503896, 1565283337, 1, '10', 10),
(29, 'data_backup_part_size', 0, '数据库备份卷大小', 2, '', '该值用于限制压缩后的分卷最大长度。单位：B', 1381482488, 1565283337, 1, '52428800', 7),
(30, 'data_backup_compress', 4, '数据库备份文件是否启用压缩', 2, '0:不压缩\r\n1:启用压缩', '压缩备份文件需要PHP环境支持gzopen,gzwrite函数', 1381713345, 1565283337, 1, '1', 9),
(31, 'data_backup_compress_level', 4, '数据库备份文件压缩级别', 2, '1:普通\r\n4:一般\r\n9:最高', '数据库备份文件的压缩级别，该配置在开启压缩时生效', 1381713408, 1565283337, 1, '9', 10),
(33, 'allow_url', 3, '不受权限验证的url', 3, '', '', 1386644047, 1512982406, 1, '0:file/pictureupload\r\n1:addon/execute', 100),
(43, 'empty_list_describe', 1, '数据列表为空时的描述信息', 2, '', '', 1492278127, 1565283337, 1, 'aOh! 暂时还没有数据~', 0),
(44, 'trash_config', 3, '回收站配置', 3, '', 'key为模型名称，值为显示列。', 1492312698, 1512982406, 1, 'Config:name\r\nAuthGroup:name\r\nMember:nickname\r\nMenu:name\r\nArticle:name\r\nArticleCategory:name\r\nAddon:name\r\nPicture:name\r\nFile:name\r\nActionLog:describe\r\nApi:name\r\nApiGroup:name\r\nBlogroll:name', 0),
(49, 'static_domain', 1, '静态资源域名', 1, '', '若静态资源为本地资源则此项为空，若为外部资源则为存放静态资源的域名', 1502430387, 1566010274, 1, '', 0),
(52, 'team_developer', 3, '研发团队人员', 4, '', '', 1504236453, 1565838062, 1, '0:5G云网络\r\n1:娜迦源码', 0),
(53, 'api_status_option', 3, 'API接口状态', 4, '', '', 1504242433, 1565838062, 1, '0:待研发\r\n1:研发中\r\n2:测试中\r\n3:已完成', 0),
(54, 'api_data_type_option', 3, 'API数据类型', 4, '', '', 1504328208, 1565838062, 1, '0:字符\r\n1:文本\r\n2:数组\r\n3:文件', 0),
(55, 'frontend_theme', 1, '前端主题', 1, '', '', 1504762360, 1566010274, 1, 'default', 0),
(56, 'api_domain', 1, 'API部署域名', 4, '', '', 1504779094, 1565838062, 1, 'https://demo.onebase.org', 0),
(57, 'api_key', 1, 'API加密KEY', 4, '', '泄露后API将存在安全隐患', 1505302112, 1565838062, 1, 'l2V|gfZp{8`;jzR~6Y1_', 0),
(58, 'loading_icon', 4, '页面Loading图标设置', 1, '1:图标1\r\n2:图标2\r\n3:图标3\r\n4:图标4\r\n5:图标5\r\n6:图标6\r\n7:图标7', '页面Loading图标支持7种图标切换', 1505377202, 1566010274, 1, '7', 80),
(59, 'sys_file_field', 3, '文件字段配置', 3, '', 'key为模型名，值为文件列名。', 1505799386, 1512982406, 1, '0_article:file_id', 0),
(60, 'sys_picture_field', 3, '图片字段配置', 3, '', 'key为模型名，值为图片列名。', 1506315422, 1512982406, 1, '0_article:cover_id\r\n1_article:img_ids', 0),
(61, 'jwt_key', 1, 'JWT加密KEY', 4, '', '', 1506748805, 1565838062, 1, 'l2V|ddFAAAgfZp{8`;FjzR~6Y1_', 0),
(65, 'admin_allow_ip', 3, '超级管理员登录IP', 3, '', '后台超级管理员登录IP限制，其他角色不受限。', 1510995580, 1564561257, 1, '0:27.22.112.250', 0),
(66, 'pjax_mode', 8, 'PJAX模式', 3, '0:否\r\n1:是', '若为PJAX模式则浏览器不会刷新，若为常规模式则为AJAX+刷新', 1512370397, 1512982406, 1, '1', 120),
(67, 'no_allow_same_up', 1, '', 3, '0:允许\r\n1:不允许', '升级查找上级是否限制导师重复', 0, 0, 1, '1', 0);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_driver`
--

CREATE TABLE IF NOT EXISTS `tmf_driver` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `service_name` varchar(40) NOT NULL DEFAULT '' COMMENT '服务标识',
  `driver_name` varchar(20) NOT NULL DEFAULT '' COMMENT '驱动标识',
  `config` text NOT NULL COMMENT '配置',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='插件表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tmf_file`
--

CREATE TABLE IF NOT EXISTS `tmf_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件ID',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '原始文件名',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '保存名称',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '远程地址',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='文件表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tmf_hook`
--

CREATE TABLE IF NOT EXISTS `tmf_hook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `describe` varchar(255) NOT NULL COMMENT '描述',
  `addon_list` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件 ''，''分割',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='钩子表' AUTO_INCREMENT=39 ;

--
-- 转存表中的数据 `tmf_hook`
--

INSERT INTO `tmf_hook` (`id`, `name`, `describe`, `addon_list`, `status`, `update_time`, `create_time`) VALUES
(36, 'File', '文件上传钩子', 'File', 1, 0, 0),
(37, 'Icon', '图标选择钩子', 'Icon', 1, 0, 0),
(38, 'ArticleEditor', '富文本编辑器', 'Editor', 1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_income`
--

CREATE TABLE IF NOT EXISTS `tmf_income` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `user_id` int(11) DEFAULT NULL,
  `money` varchar(255) DEFAULT NULL,
  `agent_pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属代理id（0无所属代理）',
  `note` varchar(64) DEFAULT NULL COMMENT '备注',
  `from_order` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '订单来源类型（0-订单表，其他待定）',
  `order_no` varchar(64) DEFAULT NULL COMMENT '订单号',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='佣金收益表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tmf_level`
--

CREATE TABLE IF NOT EXISTS `tmf_level` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level` int(10) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `type` tinyint(4) DEFAULT '1' COMMENT '类型，1普通会员，2特殊',
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '缴纳金额',
  `need_num` int(10) NOT NULL DEFAULT '0' COMMENT '升级条件，下级达标人数',
  `team_level` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '团队人数需要的最低等级',
  `direct_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '直推人数',
  `direct_level` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '推荐最低等级要求',
  `up_num` int(10) DEFAULT '0' COMMENT '向上查找层数',
  `up_level` int(10) DEFAULT '0' COMMENT '向上查找等级',
  `note` varchar(32) DEFAULT NULL COMMENT '备注',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT '0' COMMENT '更新时间',
  `is_end` tinyint(4) DEFAULT '0' COMMENT '是否等级上限',
  `can_reg` tinyint(4) DEFAULT '1' COMMENT '是否能注册下级，1能，0不能',
  `status` tinyint(4) unsigned DEFAULT '0' COMMENT '无用',
  `score` int(10) DEFAULT '0' COMMENT '赠送积分额度',
  `query_method` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '查找方式 （0仅查找上级，1仅查找客服，2查找上级和客服）',
  `need_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '额外方式 （-1不要，0-都完成，1-完成其中1项）',
  `up_level_limit` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '找层数以上几层 （0无限层）',
  `other_up` text COMMENT '其他升级 配置要求',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `tmf_level`
--

INSERT INTO `tmf_level` (`id`, `level`, `name`, `type`, `money`, `need_num`, `team_level`, `direct_num`, `direct_level`, `up_num`, `up_level`, `note`, `create_time`, `update_time`, `is_end`, `can_reg`, `status`, `score`, `query_method`, `need_type`, `up_level_limit`, `other_up`) VALUES
(1, 1, '会员', 1, '0.00', 0, 0, 0, 0, 0, 0, '注册就是这个', 1547043879, 1564674733, 0, 1, 1, 50, 0, 0, 0, ''),
(3, 2, '第一阶段', 1, '600.00', 0, 2, 0, 0, 1, 1, '给直推打款，第九阶段众筹者打款', 1547046173, 1565362505, 0, 1, 1, 50, 0, 0, 0, '{"list":[{"money":-1,"query_method":-1,"up_num":10,"up_level_limit":0,"up_level":10}]}'),
(4, 3, '第二阶段', 1, '1800.00', 0, 0, 3, 2, 2, 3, '注册', 1547046182, 1564563628, 0, 1, 1, 50, 0, -1, 0, NULL),
(5, 4, '第三阶段', 1, '5400.00', 0, 2, 0, 0, 3, 4, '', 1547046198, 1564563712, 0, 1, 1, 50, 0, -1, 0, NULL),
(6, 5, '第四阶段', 1, '16200.00', 0, 2, 0, 0, 4, 5, '', 1547046233, 1564563725, 0, 1, 1, 50, 0, -1, 0, NULL),
(7, 6, '第五阶段', 1, '48600.00', 0, 2, 0, 0, 5, 6, '', 1547046247, 1564563744, 0, 1, 1, 50, 0, 0, 0, ''),
(8, 7, '第六阶段', 1, '145800.00', 0, 2, 0, 0, 6, 7, '', 1547046255, 1564563759, 0, 1, 1, 50, 0, -1, 0, NULL),
(9, 8, '第七阶段', 1, '437400.00', 0, 2, 0, 0, 7, 8, '', 1547046264, 1564563786, 0, 1, 1, 50, 0, -1, 0, NULL),
(14, 9, '第八阶段', 1, '1312200.00', 0, 2, 0, 0, 8, 9, '', 1547046270, 1564565021, 0, 1, 1, 50, 0, -1, 0, NULL),
(16, 10, '第九阶段', 1, '3032000.00', 81, 2, 0, 0, 9, 9, '需要81个第二阶段众筹者', 1547046270, 1564565156, 1, 1, 1, 50, 0, -1, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_member`
--

CREATE TABLE IF NOT EXISTS `tmf_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `nickname` char(50) NOT NULL DEFAULT '' COMMENT '昵称',
  `username` char(16) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `email` char(32) NOT NULL DEFAULT '' COMMENT '用户邮箱',
  `mobile` char(15) NOT NULL DEFAULT '' COMMENT '用户手机',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态',
  `leader_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '上级会员ID',
  `is_share_member` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否共享会员',
  `is_inside` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为后台使用者',
  `code` varchar(32) DEFAULT NULL COMMENT '代理编号',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='会员表' AUTO_INCREMENT=28 ;

--
-- 转存表中的数据 `tmf_member`
--

INSERT INTO `tmf_member` (`id`, `nickname`, `username`, `password`, `email`, `mobile`, `update_time`, `create_time`, `status`, `leader_id`, `is_share_member`, `is_inside`, `code`) VALUES
(1, 'admin', 'admin', 'ddf980e3507223e80b6762d3bf832361', '158382468@qq.com', '18555555555', 1566010509, 1545725050, 1, 0, 0, 1, NULL),
(27, 'ceshi', 'ceshi', 'b7dc5a79f29871c3f05bbcb59d87521d', '1719725384@qq.com', '', 1565264213, 1565264175, -1, 1, 0, 1, '44545a5d7d6bde72');

-- --------------------------------------------------------

--
-- 表的结构 `tmf_menu`
--

CREATE TABLE IF NOT EXISTS `tmf_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `module` char(20) NOT NULL DEFAULT '' COMMENT '模块',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `is_hide` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `is_shortcut` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否快捷操作',
  `icon` char(30) NOT NULL DEFAULT '' COMMENT '图标',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='菜单表' AUTO_INCREMENT=237 ;

--
-- 转存表中的数据 `tmf_menu`
--

INSERT INTO `tmf_menu` (`id`, `name`, `pid`, `sort`, `module`, `url`, `is_hide`, `is_shortcut`, `icon`, `status`, `update_time`, `create_time`) VALUES
(1, '系统首页', 0, 1, 'admin', 'index/index', 0, 0, 'fa-home', 1, 1564031629, 0),
(16, '代理管理', 0, 7, 'admin', 'member/index', 0, 0, 'fa-users', 1, 1564724887, 0),
(17, '代理列表', 16, 1, 'admin', 'member/memberlist', 0, 1, 'fa-list', 1, 1547003739, 0),
(18, '代理添加', 16, 2, 'admin', 'member/memberadd', 0, 0, 'fa-user-plus', 1, 1547003746, 0),
(27, '权限管理', 16, 3, 'admin', 'auth/grouplist', 0, 0, 'fa-key', 1, 1520505512, 0),
(32, '权限组编辑', 27, 0, 'admin', 'auth/groupedit', 1, 0, '', 1, 1492002620, 0),
(34, '授权', 27, 0, 'admin', 'auth_manager/group', 1, 0, '', 1, 0, 0),
(35, '菜单授权', 27, 0, 'admin', 'auth/menuauth', 1, 0, '', 1, 1492095653, 0),
(36, '会员授权', 27, 0, 'admin', 'auth_manager/memberaccess', 1, 0, '', 1, 0, 0),
(68, '系统管理', 0, 100, 'admin', 'config/group', 0, 0, 'fa-wrench', 1, 1564545645, 0),
(69, '系统设置', 68, 3, 'admin', 'config/setting', 0, 0, 'fa-cogs', 1, 1520505460, 0),
(70, '配置管理', 68, 2, 'admin', 'config/index', 0, 0, 'fa-cog', 1, 1520505457, 0),
(71, '配置编辑', 70, 0, 'admin', 'config/configedit', 1, 0, '', 1, 1491674180, 0),
(72, '配置删除', 70, 0, 'admin', 'config/configDel', 1, 0, '', 1, 1491674201, 0),
(73, '配置添加', 70, 0, 'admin', 'config/configadd', 0, 0, 'fa-plus', 1, 1491666947, 0),
(75, '菜单管理', 68, 1, 'admin', 'menu/index', 0, 0, 'fa-th-large', 1, 1520505453, 0),
(98, '菜单编辑', 75, 0, 'admin', 'menu/menuedit', 1, 0, '', 1, 1512459021, 0),
(124, '菜单列表', 75, 0, 'admin', 'menu/menulist', 0, 1, 'fa-list', 1, 1491318271, 0),
(125, '菜单添加', 75, 0, 'admin', 'menu/menuadd', 0, 0, 'fa-plus', 1, 1491318307, 0),
(126, '配置列表', 70, 0, 'admin', 'config/configlist', 0, 1, 'fa-list', 1, 1491666890, 1491666890),
(127, '菜单状态', 75, 0, 'admin', 'menu/setstatus', 1, 0, '', 1, 1520506673, 1491674128),
(128, '权限组添加', 27, 0, 'admin', 'auth/groupadd', 1, 0, '', 1, 1492002635, 1492002635),
(134, '授权', 17, 0, 'admin', 'member/memberauth', 1, 0, '', 1, 1492238568, 1492101426),
(135, '回收站', 68, 4, 'admin', 'trash/trashlist', 0, 0, ' fa-recycle', 1, 1520505468, 1492311462),
(136, '回收站数据', 135, 0, 'admin', 'trash/trashdatalist', 1, 0, 'fa-database', 1, 1492319477, 1492319392),
(140, '服务管理', 68, 5, 'admin', 'service/servicelist', 0, 0, 'fa-server', 1, 1520505473, 1492352972),
(141, '插件管理', 68, 6, 'admin', 'addon/index', 0, 0, 'fa-puzzle-piece', 1, 1520505475, 1492427605),
(142, '钩子列表', 141, 0, 'admin', 'addon/hooklist', 0, 0, 'fa-anchor', 1, 1492427665, 1492427665),
(143, '插件列表', 141, 0, 'admin', 'addon/addonlist', 0, 0, 'fa-list', 1, 1492428116, 1492427838),
(144, '文章管理', 0, 100, 'admin', 'article/index', 0, 0, 'fa-edit', 1, 1564545690, 1492480187),
(145, '文章列表', 144, 0, 'admin', 'article/articlelist', 0, 1, 'fa-list', 1, 1492480245, 1492480245),
(146, '文章分类', 144, 0, 'admin', 'article/articlecategorylist', 0, 0, 'fa-list', 1, 1492480359, 1492480342),
(147, '文章分类编辑', 146, 0, 'admin', 'article/articlecategoryedit', 1, 0, '', 1, 1492485294, 1492485294),
(148, '分类添加', 144, 0, 'admin', 'article/articlecategoryadd', 0, 0, 'fa-plus', 1, 1492486590, 1492486576),
(149, '文章添加', 144, 0, 'admin', 'article/articleadd', 0, 0, 'fa-plus', 1, 1492518453, 1492518453),
(150, '文章编辑', 145, 0, 'admin', 'article/articleedit', 1, 0, '', 1, 1492879589, 1492879589),
(151, '插件安装', 143, 0, 'admin', 'addon/addoninstall', 1, 0, '', 1, 1492879763, 1492879763),
(152, '插件卸载', 143, 0, 'admin', 'addon/addonuninstall', 1, 0, '', 1, 1492879789, 1492879789),
(153, '文章删除', 145, 0, 'admin', 'article/articledel', 1, 0, '', 1, 1492879960, 1492879960),
(154, '文章分类删除', 146, 0, 'admin', 'article/articlecategorydel', 1, 0, '', 1, 1492879995, 1492879995),
(156, '驱动安装', 140, 0, 'admin', 'service/driverinstall', 1, 0, '', 1, 1502267009, 1502267009),
(157, '接口管理', 0, 100, 'admin', 'api/index', 0, 0, 'fa fa-book', 1, 1564545698, 1504000434),
(158, '分组管理', 157, 0, 'admin', 'api/apigrouplist', 0, 0, 'fa fa-fw fa-th-list', 1, 1504000977, 1504000723),
(159, '分组添加', 157, 0, 'admin', 'api/apigroupadd', 0, 0, 'fa fa-fw fa-plus', 1, 1504004646, 1504004646),
(160, '分组编辑', 157, 0, 'admin', 'api/apigroupedit', 1, 0, '', 1, 1504004710, 1504004710),
(161, '分组删除', 157, 0, 'admin', 'api/apigroupdel', 1, 0, '', 1, 1504004732, 1504004732),
(162, '接口列表', 157, 0, 'admin', 'api/apilist', 0, 0, 'fa fa-fw fa-th-list', 1, 1504172326, 1504172326),
(163, '接口添加', 157, 0, 'admin', 'api/apiadd', 0, 0, 'fa fa-fw fa-plus', 1, 1504172352, 1504172352),
(164, '接口编辑', 157, 0, 'admin', 'api/apiedit', 1, 0, '', 1, 1504172414, 1504172414),
(165, '接口删除', 157, 0, 'admin', 'api/apidel', 1, 0, '', 1, 1504172435, 1504172435),
(166, '优化维护', 0, 8, 'admin', 'maintain/index', 0, 0, 'fa-legal', 1, 1564724891, 1505387256),
(168, '数据库', 166, 0, 'admin', 'maintain/database', 0, 0, 'fa-database', 1, 1505539670, 1505539394),
(169, '数据备份', 168, 0, 'admin', 'database/databackup', 0, 0, 'fa-download', 1, 1506309900, 1505539428),
(170, '数据还原', 168, 0, 'admin', 'database/datarestore', 0, 0, 'fa-exchange', 1, 1506309911, 1505539492),
(171, '文件清理', 166, 0, 'admin', 'fileclean/cleanlist', 0, 0, 'fa-file', 1, 1506310152, 1505788517),
(174, '行为日志', 166, 0, 'admin', 'log/loglist', 0, 1, 'fa-street-view', 1, 1507201516, 1507200836),
(203, '友情链接', 68, 7, 'admin', 'blogroll/index', 0, 0, 'fa-link', 1, 1520505723, 1520505717),
(204, '链接列表', 203, 0, 'admin', 'blogroll/blogrolllist', 0, 0, 'fa-th', 1, 1520505777, 1520505777),
(205, '链接添加', 203, 0, 'admin', 'blogroll/blogrolladd', 0, 0, 'fa-plus', 1, 1520505826, 1520505826),
(206, '链接编辑', 203, 0, 'admin', 'blogroll/blogrolledit', 1, 0, 'fa-edit', 1, 1520505863, 1520505863),
(207, '链接删除', 203, 0, 'admin', 'blogroll/blogrolldel', 1, 0, 'fa-minus', 1, 1520505889, 1520505889),
(208, '菜单排序', 75, 0, 'admin', 'menu/setsort', 1, 0, '', 1, 1520506696, 1520506696),
(209, '代理编辑', 16, 2, 'admin', 'member/memberedit', 1, 0, 'fa-edit', 1, 1547003751, 0),
(210, '修改密码', 1, 2, 'admin', 'member/editpassword', 1, 0, 'fa-edit', 1, 1520505510, 0),
(211, '会员管理', 0, 2, 'admin', '#1', 0, 0, 'fa-street-view', 1, 1564545606, 1545897104),
(212, '会员列表', 211, 0, 'admin', 'user/userList', 0, 0, 'fa-circle-o-notch', 1, 1545897226, 1545897226),
(213, '会员设置', 211, 0, 'admin', 'user/userEdit', 1, 0, 'fa-spinner', -1, 1564545029, 1545897367),
(214, '会员资料管理', 0, 100, 'admin', '#2', 0, 0, 'fa-linkedin', 1, 1564545619, 1545897571),
(215, '会员资料列表', 214, 0, 'admin', 'userProfile/profileList', 0, 0, 'fa-meanpath', 1, 1545897595, 1545897595),
(216, '升级管理', 0, 3, 'admin', '#3', 0, 0, 'fa-google-plus', 1, 1564545652, 1545898099),
(217, '升级列表', 216, 0, 'admin', 'ApplyRecord/applyRecordList', 0, 0, 'fa-money', 1, 1564554993, 1545898193),
(218, '阶段管理', 0, 4, 'admin', '#4', 0, 0, 'fa-pinterest-p', 1, 1564644153, 1545902557),
(219, '阶段列表', 218, 0, 'admin', 'Level/levelList', 0, 0, 'fa-cc', 1, 1564644136, 1545902593),
(220, '意见反馈管理', 0, 100, 'admin', '#5', 0, 0, 'fa-asterisk', 1, 1564545630, 1545962951),
(221, '意见反馈列表', 220, 0, 'admin', 'suggestion/suggestionList', 0, 0, 'fa-gift', 1, 1545963010, 1545963010),
(222, '意见反馈编辑', 220, 0, 'admin', 'suggestion/suggestionEdit', 1, 0, 'fa-plus-circle', 1, 1545968804, 1545968804),
(223, '特殊会员', 211, 0, 'admin', '#', 1, 0, 'fa-fire', -1, 1564544965, 1546410667),
(224, '签到开关', 218, 0, 'admin', 'Level/sign_setting', 0, 0, '', 1, 1547015087, 1547015087),
(225, '特殊会员添加', 223, 0, 'admin', 'userSpecial/userspecialadd', 0, 0, 'fa-photo', 1, 1547111170, 1547019606),
(226, '状态设置', 223, 0, 'admin', 'user_special/setstatus', 1, 0, '', 1, 1547019748, 1547019748),
(227, '列表', 223, 0, 'admin', 'UserSpecial/userspecialList', 0, 0, 'fa-barcode', 1, 1547111223, 1547111223),
(228, '添加会员', 211, 0, 'admin', 'user/register', 0, 0, 'fa-cloud-upload', 1, 1547707272, 1547707272),
(229, '会员资料设置', 214, 0, 'admin', 'user_profile/userprofileedit', 1, 0, 'fa-video-camera', 1, 1547730220, 1547730220),
(230, '会员资料设置', 214, 0, 'admin', 'userProfile/userprofileedit', 1, 0, 'fa-video-camera', 1, 1547730309, 1547730309),
(231, '升级管理', 211, 0, 'admin', 'fa-google-plus', 0, 0, 'fa-arrow-up', -1, 1564562415, 1564543925),
(232, '实名认证', 211, 0, 'admin', 'user/authentication', 0, 0, 'fa-graduation-cap', 1, 1564545186, 1564545186),
(233, '债务管理', 0, 5, 'admin', '#10', 0, 0, 'fa-list-ul', 1, 1564547283, 1564545520),
(234, '债务列表', 233, 0, 'admin', 'debt/debtList', 0, 0, 'fa-sliders', 1, 1564548184, 1564547421),
(235, '打款管理', 0, 6, 'admin', '#11', 0, 0, 'fa-binoculars', 1, 1564725734, 1564724856),
(236, '打款列表', 235, 0, 'admin', 'make/moneyList', 0, 0, 'fa-indent', 1, 1565345832, 1564725010);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_message`
--

CREATE TABLE IF NOT EXISTS `tmf_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_time` int(10) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1升级，2新增会员',
  `content` varchar(64) NOT NULL COMMENT '内容',
  `agent_pid` int(10) DEFAULT '0' COMMENT '代理id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='消息记录' AUTO_INCREMENT=34 ;

--
-- 转存表中的数据 `tmf_message`
--

INSERT INTO `tmf_message` (`id`, `create_time`, `type`, `content`, `agent_pid`) VALUES
(1, 1548931468, 1, '恭喜会员【130****0000】升级到【1星商户】', 1),
(2, 1564076796, 1, '恭喜会员【133****0000】升级到【4星商户】', 1),
(3, 1564124690, 1, '恭喜会员【176****6669】升级到【1星商户】', 1),
(4, 1564126620, 1, '恭喜会员【176****6668】升级到【2星商户】', 1),
(5, 1564126979, 1, '恭喜会员【176****6668】升级到【3星商户】', 1),
(6, 1564127038, 1, '恭喜会员【176****6668】升级到【4星商户】', 1),
(7, 1564130668, 1, '恭喜会员【176****6668】升级到【5星商户】', 1),
(8, 1564131085, 1, '恭喜会员【176****6668】升级到【6星商户】', 1),
(9, 1564131266, 1, '恭喜会员【176****6668】升级到【7星商户】', 1),
(10, 1564145452, 1, '恭喜会员【189****0002】升级到【1星商户】', 25),
(11, 1564205296, 1, '恭喜会员【189****0018】升级到【1星商户】', 25),
(12, 1564207275, 1, '恭喜会员【189****0019】升级到【1星商户】', 25),
(13, 1564207600, 1, '恭喜会员【189****0023】升级到【1星商户】', 25),
(14, 1564207608, 1, '恭喜会员【189****0022】升级到【1星商户】', 25),
(15, 1564207617, 1, '恭喜会员【189****0021】升级到【1星商户】', 25),
(16, 1564207677, 1, '恭喜会员【189****0019】升级到【2星商户】', 25),
(17, 1564207732, 1, '恭喜会员【189****0019】升级到【3星商户】', 25),
(18, 1564207954, 1, '恭喜会员【189****0019】升级到【4星商户】', 25),
(19, 1564208148, 1, '恭喜会员【189****0019】升级到【5星商户】', 25),
(20, 1564208193, 1, '恭喜会员【189****0019】升级到【6星商户】', 25),
(21, 1564208229, 1, '恭喜会员【189****0019】升级到【7星商户】', 25),
(22, 1564208272, 1, '恭喜会员【189****0019】升级到【8星商户】', 25),
(23, 1564208481, 1, '恭喜会员【189****0001】升级到【4星商户】', 25),
(24, 1564367466, 1, '恭喜会员【133****3331】升级到【1星商户】', 1),
(25, 1564367470, 1, '恭喜会员【188****8880】升级到【1星商户】', 1),
(26, 1564371630, 1, '恭喜会员【133****2222】升级到【1星商户】', 1),
(27, 1564381271, 1, '恭喜会员【134****9011】升级到【2星商户】', 1),
(28, 1564401091, 1, '恭喜会员【189****0001】升级到【5星商户】', 25),
(29, 1564401529, 1, '恭喜会员【189****0001】升级到【6星商户】', 25),
(30, 1564451081, 1, '恭喜会员【133****4444】升级到【1星商户】', 1),
(31, 1564451086, 1, '恭喜会员【133****3333】升级到【1星商户】', 1),
(32, 1564458430, 1, '恭喜会员【152****2430】升级到【1星商户】', 1),
(33, 1564458889, 1, '恭喜会员【152****2430】升级到【1星商户】', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_picture`
--

CREATE TABLE IF NOT EXISTS `tmf_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id自增',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '图片名称',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='图片表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tmf_score_log`
--

CREATE TABLE IF NOT EXISTS `tmf_score_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL COMMENT '会员id',
  `score` int(10) NOT NULL DEFAULT '0' COMMENT '可用积分变动',
  `score_amount` int(10) NOT NULL DEFAULT '0' COMMENT '冻结积分(剩余积分额度)',
  `type` varchar(32) DEFAULT NULL,
  `note` varchar(64) DEFAULT NULL COMMENT '备注',
  `order_no` varchar(255) DEFAULT NULL COMMENT '订单号',
  `to_user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '对方id（0表示无）',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='积分变动表' AUTO_INCREMENT=39 ;

--
-- 转存表中的数据 `tmf_score_log`
--

INSERT INTO `tmf_score_log` (`id`, `user_id`, `score`, `score_amount`, `type`, `note`, `order_no`, `to_user_id`, `create_time`) VALUES
(1, 13, 0, 100, 'upgrade', '升级等级【1星商户】赠送糖果哦', '', 0, 1548931468),
(2, 10, 0, 80, 'upgrade', '升级等级【4星商户】赠送糖果哦', '', 0, 1564076796),
(3, 38, 0, 100, 'upgrade', '升级等级【1星商户】赠送糖果哦', '', 0, 1564124690),
(4, 37, 0, 20, 'upgrade', '升级等级【2星商户】赠送糖果哦', '', 0, 1564126620),
(5, 37, 0, 40, 'upgrade', '升级等级【3星商户】赠送糖果哦', '', 0, 1564126979),
(6, 37, 0, 80, 'upgrade', '升级等级【4星商户】赠送糖果哦', '', 0, 1564127038),
(7, 37, 0, 160, 'upgrade', '升级等级【5星商户】赠送糖果哦', '', 0, 1564130668),
(8, 37, 0, 320, 'upgrade', '升级等级【6星商户】赠送糖果哦', '', 0, 1564131085),
(9, 37, 0, 640, 'upgrade', '升级等级【7星商户】赠送糖果哦', '', 0, 1564131266),
(10, 57, 0, 100, 'upgrade', '升级等级【1星商户】赠送糖果哦', '', 0, 1564145452),
(11, 91, 0, 100, 'upgrade', '升级等级【1星商户】赠送糖果哦', '', 0, 1564205296),
(12, 92, 0, 100, 'upgrade', '升级等级【1星商户】赠送糖果哦', '', 0, 1564207275),
(13, 97, 0, 100, 'upgrade', '升级等级【1星商户】赠送糖果哦', '', 0, 1564207600),
(14, 96, 0, 100, 'upgrade', '升级等级【1星商户】赠送糖果哦', '', 0, 1564207608),
(15, 95, 0, 100, 'upgrade', '升级等级【1星商户】赠送糖果哦', '', 0, 1564207617),
(16, 92, 0, 20, 'upgrade', '升级等级【2星商户】赠送糖果哦', '', 0, 1564207677),
(17, 92, 0, 40, 'upgrade', '升级等级【3星商户】赠送糖果哦', '', 0, 1564207732),
(18, 92, 0, 80, 'upgrade', '升级等级【4星商户】赠送糖果哦', '', 0, 1564207954),
(19, 92, 0, 160, 'upgrade', '升级等级【5星商户】赠送糖果哦', '', 0, 1564208148),
(20, 92, 0, 320, 'upgrade', '升级等级【6星商户】赠送糖果哦', '', 0, 1564208193),
(21, 92, 0, 640, 'upgrade', '升级等级【7星商户】赠送糖果哦', '', 0, 1564208229),
(22, 92, 0, 1280, 'upgrade', '升级等级【8星商户】赠送糖果哦', '', 0, 1564208272),
(23, 56, 0, 80, 'upgrade', '升级等级【4星商户】赠送糖果哦', '', 0, 1564208481),
(24, 141, 0, 100, 'upgrade', '升级等级【1星商户】赠送糖果哦', '', 0, 1564367466),
(25, 140, 0, 100, 'upgrade', '升级等级【1星商户】赠送糖果哦', '', 0, 1564367470),
(26, 147, 0, 100, 'upgrade', '升级等级【1星商户】赠送糖果哦', '', 0, 1564371630),
(27, 14, 0, 20, 'upgrade', '升级等级【2星商户】赠送糖果哦', '', 0, 1564381271),
(28, 56, 0, 160, 'upgrade', '升级等级【5星商户】赠送糖果哦', '', 0, 1564401091),
(29, 56, 0, 320, 'upgrade', '升级等级【6星商户】赠送糖果哦', '', 0, 1564401529),
(30, 8, 0, 50, 'reg', '注册赠送糖果哦', '', 0, 1564718605),
(31, 9, 0, 50, 'reg', '注册赠送糖果哦', '', 0, 1564729912),
(32, 20, 0, 50, 'reg', '注册赠送糖果哦', '', 0, 1564730819),
(33, 21, 0, 50, 'reg', '注册赠送糖果哦', '', 0, 1564731156),
(34, 22, 0, 50, 'reg', '注册赠送糖果哦', '', 0, 1564735614),
(35, 23, 0, 50, 'reg', '注册赠送糖果哦', '', 0, 1564736713),
(36, 24, 0, 50, 'reg', '注册赠送糖果哦', '', 0, 1564800281),
(37, 26, 0, 50, 'reg', '注册赠送糖果哦', '', 0, 1565266567),
(38, 28, 0, 50, 'reg', '注册赠送糖果哦', '', 0, 1565276908);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_sign_log`
--

CREATE TABLE IF NOT EXISTS `tmf_sign_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `score` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '赠送积分',
  `sign_day` varchar(14) DEFAULT NULL COMMENT '签到日期',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `continuous_times` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '连续签到次数',
  `history_times` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '历史签到次数',
  `note` varchar(255) DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='签到记录表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tmf_sign_setting`
--

CREATE TABLE IF NOT EXISTS `tmf_sign_setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL COMMENT '名称',
  `value` text NOT NULL COMMENT '值',
  `type` varchar(255) NOT NULL DEFAULT 'text' COMMENT '类型(''json'':json）',
  `agent_pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '代理id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `tmf_sign_setting`
--

INSERT INTO `tmf_sign_setting` (`id`, `name`, `value`, `type`, `agent_pid`) VALUES
(1, 'is_send', '0', 'text', 0),
(2, 'score_each_day', '1', 'text', 0),
(3, 'is_add', '0', 'text', 0),
(4, 'add_type', '1', 'text', 0),
(5, 'add_setting_history', '[{"min_days":2,"score":100},{"min_days":4,"score":200},{"min_days":6,"score":300},{"min_days":10,"score":400}]', 'json', 0),
(6, 'add_setting_continue', '[{"min_days":2,"score":15},{"min_days":3,"score":25},{"min_days":4,"score":34},{"min_days":5,"score":65}]', 'json', 0),
(7, 'add_setting_month', '[{"min_days":1,"score":15},{"min_days":6,"score":90},{"min_days":3,"score":34},{"min_days":2,"score":26}]', 'json', 0);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_sign_user`
--

CREATE TABLE IF NOT EXISTS `tmf_sign_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员id',
  `continuous_times` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '连续签到次数',
  `history_times` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '累计签到次数',
  `longest_times` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '最长连续签到次数',
  `last_sign_day` varchar(18) DEFAULT '' COMMENT '上次签到日期',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `history_for_month_times` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '累计签到次数（月）',
  `history_for_month` varchar(14) NOT NULL COMMENT '累计签到月份（月）',
  `update_time` int(10) unsigned DEFAULT '0' COMMENT '最后更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `idx_user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='签到会员表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tmf_sms_log`
--

CREATE TABLE IF NOT EXISTS `tmf_sms_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone` varchar(11) NOT NULL COMMENT '发送手机号',
  `content` varchar(255) DEFAULT '' COMMENT '发送短信内容',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态（0-未发送，1发送成功，2-发送失败）',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='短信发送记录' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tmf_sms_set`
--

CREATE TABLE IF NOT EXISTS `tmf_sms_set` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '短信设置自增id',
  `type` varchar(24) DEFAULT NULL COMMENT '类型',
  `data` text COMMENT 'json数据',
  `status` tinyint(1) DEFAULT '1' COMMENT '开启状态，1开启0关闭',
  `note` varchar(20) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='短信配置表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tmf_sms_set`
--

INSERT INTO `tmf_sms_set` (`id`, `type`, `data`, `status`, `note`) VALUES
(1, 'sms_tt', '{"src":"aa111111","pwd":"2we34rt5","msg":"【知学科技】验证码#code#，请确保是本人操作且为本人手机，否则请忽略此短信。"}', 1, '天天短信');

-- --------------------------------------------------------

--
-- 表的结构 `tmf_suggestion`
--

CREATE TABLE IF NOT EXISTS `tmf_suggestion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT '0' COMMENT '会员id',
  `img_ids` varchar(255) DEFAULT NULL COMMENT '图片ids',
  `content` text COMMENT '内容',
  `create_time` int(10) DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0待审核，1已处理，2处理失败',
  `note` varchar(128) DEFAULT NULL COMMENT '备注',
  `title` varchar(128) DEFAULT NULL COMMENT '标题',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1建议，2投诉',
  `agent_pid` int(10) DEFAULT '0' COMMENT '代理id（0表示非代理推荐）',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='意见反馈表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tmf_suggestion`
--

INSERT INTO `tmf_suggestion` (`id`, `user_id`, `img_ids`, `content`, `create_time`, `update_time`, `status`, `note`, `title`, `type`, `agent_pid`) VALUES
(1, 7, '23', '你好嘛，匿名 cut your grass today to，不对。', 1564022606, 1564191991, 0, '', '是的', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_user`
--

CREATE TABLE IF NOT EXISTS `tmf_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员id（自增）',
  `username` varchar(32) NOT NULL COMMENT '会员名称(手机号)',
  `money` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态（1-正常，0-无效，2-封号）',
  `pwd` varchar(64) DEFAULT NULL COMMENT '登陆密码',
  `invite_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '推荐id',
  `agent_pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '代理id（0表示非代理推荐）',
  `login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登陆时间',
  `login_ip` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '最后登陆ip',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `code` varchar(16) NOT NULL COMMENT '推广号',
  `token` varchar(64) DEFAULT NULL COMMENT 'token',
  `level` int(10) DEFAULT '1' COMMENT '等级',
  `node` varchar(255) DEFAULT '' COMMENT '标志',
  `score` int(10) DEFAULT '0' COMMENT '积分（糖果）',
  `score_amount` int(10) DEFAULT '0' COMMENT '剩余于签到分',
  `activate` tinyint(1) DEFAULT '0' COMMENT '是否激活 0未激活  1已激活',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `code` (`code`) USING BTREE,
  KEY `node` (`node`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='会员表' AUTO_INCREMENT=45 ;

--
-- 转存表中的数据 `tmf_user`
--

INSERT INTO `tmf_user` (`id`, `username`, `money`, `status`, `pwd`, `invite_id`, `agent_pid`, `login_time`, `login_ip`, `create_time`, `update_time`, `code`, `token`, `level`, `node`, `score`, `score_amount`, `activate`) VALUES
(1, '18582968679', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, 1, 1565341508, 1001328406, 1564493459, 1564729532, 'RMGLLEZL', 'd7cc63001ba072f9ad608de56ea9849e', 10, '1', 0, 0, 1),
(2, '18582968678', '0.00', 1, '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1, 1, 1564714681, 1857872867, 1564496135, 1564729546, 'AGC449249', '177127e7d834a322810e8936d84867dc', 9, '1-2', 0, 0, 1),
(3, '18582968677', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, 1, 1565341572, 1001328406, 1564513380, 1564729558, 'PCU990495', '4ed03e21e4080a482bb7f1a946e5227e', 8, '1-2-3', 0, 0, 1),
(4, '18582968676', '0.00', 1, '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 2, 1, 1564718975, 1857872867, 1564513510, 1564729571, 'AMZ374246', '444d1d6dbe1ea60f8b0ea956de607e60', 7, '1-2-4', 0, 0, 1),
(5, '18582968675', '0.00', 1, '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 2, 1, 1564593998, 1885419242, 1564593986, 1564729585, 'I9QWFS8Y', 'dc4f84f14566d7677e4c092c49c5e0e1', 6, '1-2-5', 0, 0, 1),
(6, '18582968674', '0.00', 1, '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 5, 1, 1564633693, 3071259041, 1564633548, 1564729597, 'RRF731310', '55c4a521bfd3963879128ef2e6f4147a', 5, '1-2-5-6', 0, 0, 1),
(7, '18582968673', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 4, 1, 1565341596, 1001328406, 1564644835, 1564729623, 'HXF115441', '1965bab87de72a480a937ccaa96194aa', 4, '1-2-4-7', 0, 0, 1),
(8, '18582968672', '0.00', 1, '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 7, 1, 1564718623, 607229084, 1564718605, 1564729636, 'NNJ446692', '9c7f50934617aa2f666dfe4df7a3cf0c', 3, '1-2-4-7-8', 0, 50, 1),
(9, '18582968671', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 8, 1, 1565338327, 1001328406, 1564729912, 1564729958, 'PBM170127', '3792d62f4ba68fdb5b67ba74393b5c82', 2, '1-2-4-7-8-9', 0, 50, 1),
(10, '18582968689', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 9, 1, 1565364410, 1001328406, 1564730230, 1564730230, '9LYAY85R', '66fe67e575abca71ef3c0f10f66faedf', 10, '1-2-4-7-8-9-10', 0, 0, 1),
(11, '18582968688', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 10, 1, 1565364020, 1001328406, 1564730282, 1564730282, '7RPR29VR', 'ac6a0eede25d2caf19b6cc714ff0be8d', 9, '1-2-4-7-8-9-10-11', 0, 0, 1),
(12, '18582968687', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 11, 1, 1565363571, 1001328406, 1564730328, 1564730328, 'YHSIM5UU', '91b2f0c4c7862644192bc02fed02dd12', 8, '1-2-4-7-8-9-10-11-12', 0, 0, 1),
(13, '18582968686', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 12, 1, 1565363560, 1001328406, 1564730351, 1564730351, 'H847ZTDM', '7e1c432868ceedc6588e06bb3f30220f', 7, '1-2-4-7-8-9-10-11-12-13', 0, 0, 1),
(14, '18582968685', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 13, 1, 1565363552, 1001328406, 1564730372, 1564730372, '0QSGLL4S', 'fe42f36e20df522a88e6e3e83f960bf1', 6, '1-2-4-7-8-9-10-11-12-13-14', 0, 0, 1),
(15, '18582968684', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 14, 1, 1565363537, 1001328406, 1564730392, 1564730392, 'THQO2NXE', 'b5bcc930c5d6d7d3c4c61f5b3ef5ef02', 5, '1-2-4-7-8-9-10-11-12-13-14-15', 0, 0, 1),
(16, '18582968683', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 15, 1, 1565363517, 1001328406, 1564730409, 1564730409, 'BU1DSK7U', '9b35a8eaa18179a869222e7e6deaac69', 4, '1-2-4-7-8-9-10-11-12-13-14-15-16', 0, 0, 1),
(17, '18582968682', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 16, 1, 1565400592, 1001328406, 1564730435, 1565396067, 'I8I4GGCX', '2af90eb996e2127e14570267c46ae0a8', 4, '1-2-4-7-8-9-10-11-12-13-14-15-16-17', 0, 0, 1),
(18, '18582968681', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 17, 1, 1565400421, 1001328406, 1564730458, 1565366301, 'E9F0TSB0', '99bd86e823a91830fb3c01ad38043dda', 3, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18', 0, 0, 1),
(19, '18582968680', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 18, 1, 1565400376, 1001328406, 1564730477, 1564730477, 'WJ2BM490', '497a0ab56f99d66f0f1165239e03331b', 2, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19', 0, 0, 1),
(20, '19982968672', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 19, 1, 1565400641, 1001328406, 1564730819, 1565400657, 'HFK501439', 'e466bf7951c683afde0b7e4b25c901d1', 1, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20', 0, 50, 1),
(21, '15228412430', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 20, 1, 1565400038, 1001328406, 1564731156, 1565331210, 'FNH654154', '24fd761b7d25d749fbd0749be2925a44', 2, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21', 0, 50, 1),
(22, '13989272029', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 21, 1, 1565407311, 1911596443, 1564735614, 1564735614, 'LZQ504918', '4161e9590bf6a1aca34bc532bfece8de', 2, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22', 0, 50, 1),
(23, '13640979137', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 22, 1, 1565365633, 1001328406, 1564736713, 1564736713, 'KAZ632923', '10af09d9cadd0daa4bbd9b1ae5d1afac', 1, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-23', 0, 50, 0),
(24, '17111175366', '0.00', 1, '327650d9ebb00cd55e38b2cbb551c032d45a9033', 19, 1, 1565313385, 18472383, 1564800281, 1564800281, 'NMG762810', 'aa79b2b2af283555f9f6a2cb1dd9a6a9', 1, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-24', 0, 50, 0),
(25, '17778889991', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, 1, 1565404831, 1001328406, 1565259073, 1565259073, 'L4PPG08T', 'b4c840b1cbddbeb6f000f3c1411a32a1', 1, '25', 0, 0, 0),
(26, '15002139413', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 22, 1, 1565401773, 2071002892, 1565266567, 1565362395, 'FPM149179', 'd281af7bfa241d054c9ba4f0e8932657', 2, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26', 0, 50, 1),
(27, '15002139430', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 26, 1, 1565399929, 1001328406, 1565270054, 1565399902, '5U9P3KTP', '4d2e59bada0f8e44838b2222f554b849', 1, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26-27', 0, 0, 1),
(28, '13033050222', '0.00', 1, '1f82c942befda29b6ed487a51da199f78fce7f05', 9, 1, 1565346439, 1881163765, 1565276908, 1565277079, 'TAU346031', '6e29dba625feb37555ec783163b2c0fe', 1, '1-2-4-7-8-9-28', 0, 50, 0),
(29, '15002139414', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 26, 1, 1565341380, 1001328406, 1565332272, 1565332272, '3XGYTRYU', '8020f65e28455e297fa4bf58311f99a4', 10, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26-29', 0, 0, 0),
(30, '15002139415', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 29, 1, 1565337368, 1001328406, 1565332299, 1565332299, '6NKF4IGK', 'b059cc9c5edf253459b2dec893f00f72', 9, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26-29-30', 0, 0, 0),
(31, '15002139416', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 30, 1, 1565337379, 1001328406, 1565332319, 1565332319, '26B5GH76', 'a2571446f4b68f292bacaa5f191c9c25', 8, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26-29-30-31', 0, 0, 0),
(32, '15002139417', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 30, 1, 1565337391, 1001328406, 1565332346, 1565332519, '464U8CP5', 'b672975b0a2bf80030a1c4449fa69b54', 1, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26-29-30-32', 0, 0, 0),
(33, '15002139418', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 32, 1, 1565363029, 1001328406, 1565332373, 1565332373, 'UXX45T42', '57b0aad2eff7378b070d1aa851f8ef07', 6, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26-29-30-32-33', 0, 0, 0),
(34, '15002139420', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 33, 1, 1565361793, 1001328406, 1565333583, 1565333583, '4H0SZR7L', 'ff548b37684de30bf37dc6e5d8475aab', 1, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26-29-30-32-33-34', 0, 0, 0),
(35, '18050200224', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 26, 1, 1565399800, 1001328406, 1565335269, 1565399754, 'PXEM9HV4', 'a86f0c63784a9b9634a525a736e298a6', 3, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26-35', 0, 0, 1),
(36, '15727011417', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 35, 1, 1565399860, 1001328406, 1565336201, 1565336201, '87FBW12M', 'ba270565b2b054ac86cea72dfc4304e2', 2, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26-35-36', 0, 0, 1),
(37, '15271750928', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 36, 1, 1565396307, 1001328406, 1565339682, 1565343134, 'HR8KIA6N', 'e56bf4db81a559c92b18154ab9f2474e', 2, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26-35-36-37', 0, 0, 1),
(38, '15145939460', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 37, 1, 1565362866, 1001328406, 1565362866, 1565396294, '78J2ZZ93', NULL, 2, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26-35-36-37-38', 0, 0, 0),
(39, '15145939461', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 37, 1, 1565362888, 1001328406, 1565362888, 1565362888, '13D1UEM2', NULL, 2, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26-35-36-37-39', 0, 0, 0),
(40, '15145939462', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 37, 1, 1565395997, 1001328406, 1565362906, 1565362906, 'SBUB8M1Q', '12a675776fcbbafc3de836e06701ffbb', 3, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26-35-36-37-40', 0, 0, 0),
(41, '13804888764', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 35, 1, 1565395773, 1001328406, 1565395353, 1565395353, 'U6NTDHUN', 'd55d09f246b6495dcdf5dd044e874d7d', 2, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26-35-41', 0, 0, 1),
(42, '15145939469', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 27, 1, 1565396411, 1001328406, 1565396411, 1565396411, 'GU58R7GA', NULL, 2, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26-27-42', 0, 0, 0),
(43, '15145939468', '0.00', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 27, 1, 1565396441, 1001328406, 1565396441, 1565396441, 'REIIOPFH', NULL, 2, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26-27-43', 0, 0, 0),
(44, '15145939467', '0.00', 1, '419082ba8458964c3e03377705c958b5f9b09f81', 27, 1, 1565396458, 1001328406, 1565396458, 1566010618, '90D73LOB', NULL, 2, '1-2-4-7-8-9-10-11-12-13-14-15-16-17-18-19-20-21-22-26-27-44', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_user_card`
--

CREATE TABLE IF NOT EXISTS `tmf_user_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `user_name` varchar(255) DEFAULT NULL COMMENT '用户姓名',
  `user_card` varchar(255) DEFAULT NULL COMMENT '用户身份证',
  `user_positive` varchar(255) DEFAULT NULL COMMENT '身份证正面',
  `user_reverse` varchar(255) DEFAULT NULL COMMENT '身份证反面',
  `status` tinyint(1) DEFAULT '0' COMMENT '是否审核 0待审，1审核通过，2驳回',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `shenhe_time` int(11) DEFAULT NULL COMMENT '审核时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=28 ;

--
-- 转存表中的数据 `tmf_user_card`
--

INSERT INTO `tmf_user_card` (`id`, `uid`, `user_name`, `user_card`, `user_positive`, `user_reverse`, `status`, `add_time`, `shenhe_time`) VALUES
(3, 4, 'lx666', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190801/14014609480.png', 'http://yq.myxs.ltd/upload/picture/20190801/14015279612.jpeg', 1, 1564639313, 1564641966),
(4, 1, 'sunyuan', '51082319730405704X', 'http://yq.myxs.ltd/upload/picture/20190801/15204594332.jpeg', 'http://yq.myxs.ltd/upload/picture/20190801/15204905649.jpeg', 1, 1564644050, 1564644060),
(5, 5, '44', '320325196902201692', 'http://yq.myxs.ltd/upload/picture/20190801/01284705290.jpeg', 'http://yq.myxs.ltd/upload/picture/20190801/01285059340.jpeg', 2, 1564594132, 1564638767),
(7, 6, '全志君', '430422199704202112', 'http://yq.myxs.ltd/upload/picture/20190801/12285164870.png', 'http://yq.myxs.ltd/upload/picture/20190801/12285360514.png', 1, 1564633734, 1564638764),
(8, 2, '新都多', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190801/17183985887.jpeg', 'http://yq.myxs.ltd/upload/picture/20190801/17184267409.jpeg', 1, 1564651141, 1564674766),
(9, 7, '半仙', '510823199110207037', 'http://yq.myxs.ltd/upload/picture/20190802/11484490159.jpeg', 'http://yq.myxs.ltd/upload/picture/20190802/11484979360.jpeg', 1, 1564717752, 1564717859),
(10, 20, '测试1号', '510823199110207037', 'http://yq.myxs.ltd/upload/picture/20190802/15284411845.jpeg', 'http://yq.myxs.ltd/upload/picture/20190802/15284863642.jpeg', 1, 1564730929, 1564731319),
(11, 21, '龙鑫', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/15362099633.jpeg', 'http://yq.myxs.ltd/upload/picture/20190802/15362426518.png', 1, 1564731387, 1564736161),
(12, 10, '测试9级', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/16135205159.jpeg', 'http://yq.myxs.ltd/upload/picture/20190802/16135405866.jpeg', 1, 1564733636, 1564736158),
(13, 19, '测试上上级', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/16181003422.jpeg', 'http://yq.myxs.ltd/upload/picture/20190802/16181356307.jpeg', 1, 1564733894, 1564736154),
(14, 22, '何大爷', '511321198509199039', 'http://yq.myxs.ltd/upload/picture/20190802/16475766145.jpeg', 'http://yq.myxs.ltd/upload/picture/20190802/16480263622.jpeg', 2, 1564735703, 1565345779),
(15, 23, '大爷何', '511321198509199039', 'http://yq.myxs.ltd/upload/picture/20190802/17061086517.jpeg', 'http://yq.myxs.ltd/upload/picture/20190802/17061458348.jpeg', 2, 1564736775, 1565345769),
(16, 18, '测试2号', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190803/11285760937.jpeg', 'http://yq.myxs.ltd/upload/picture/20190803/11290251788.png', 1, 1564802945, 1564802966),
(17, 17, '测试啊', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190803/11370624108.jpeg', 'http://yq.myxs.ltd/upload/picture/20190803/11370975721.png', 1, 1564803432, 1564803468),
(18, 26, '林鑫', '510321199804230776', 'http://43.249.83.77:3892/upload/picture/20190809/12413062154.jpeg', 'http://43.249.83.77:3892/upload/picture/20190809/12413440414.jpeg', 1, 1565325722, 1565325880),
(19, 27, '盼盼', '430181199001264353', 'http://43.249.83.77:3892/upload/picture/20190809/13392270343.jpeg', 'http://43.249.83.77:3892/upload/picture/20190809/13393151643.jpeg', 1, 1565329224, 1565329241),
(20, 25, '林秀珠', '440781198003093121', 'http://43.249.83.77:3892/upload/picture/20190809/13384143093.jpeg', 'http://43.249.83.77:3892/upload/picture/20190809/13384732676.jpeg', 0, 1565329369, NULL),
(21, 33, '王朗', '510724199506016158', 'http://43.249.83.77:3892/upload/picture/20190809/15135996498.jpeg', 'http://43.249.83.77:3892/upload/picture/20190809/15140163948.jpeg', 0, 1565334842, NULL),
(22, 29, '娜娜', '510321199804230776', 'http://43.249.83.77:3892/upload/picture/20190809/15240851136.jpeg', 'http://43.249.83.77:3892/upload/picture/20190809/15241114040.jpeg', 1, 1565335489, 1565335526),
(23, 35, '王双', '510724199506016158', 'http://43.249.83.77:3892/upload/picture/20190809/15244808990.jpeg', 'http://43.249.83.77:3892/upload/picture/20190809/15245036153.jpeg', 1, 1565335498, 1565335517),
(24, 36, '一盒', '510724199506016158', 'http://43.249.83.77:3892/upload/picture/20190809/15383203963.jpeg', 'http://43.249.83.77:3892/upload/picture/20190809/15383421185.jpeg', 1, 1565336315, 1565336353),
(25, 37, '吕阿', '510724199506016158', 'http://43.249.83.77:3892/upload/picture/20190809/16353110227.jpeg', 'http://43.249.83.77:3892/upload/picture/20190809/16353243747.jpeg', 1, 1565339733, 1565340415),
(26, NULL, '张飞', '340123198906204873', 'http://43.249.83.77:3892/upload/picture/20190809/18114330453.jpeg', 'http://43.249.83.77:3892/upload/picture/20190809/18111648501.jpeg', 0, 1565345528, NULL),
(27, 41, 'wadadasd', '510724199506016158', 'http://43.249.83.77:3892/upload/picture/20190810/08054426789.jpeg', 'http://43.249.83.77:3892/upload/picture/20190810/08054626056.jpeg', 0, 1565395547, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_user_collection`
--

CREATE TABLE IF NOT EXISTS `tmf_user_collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `user_account` varchar(255) DEFAULT NULL COMMENT '账号',
  `user_erwei` varchar(255) DEFAULT NULL COMMENT '二维码',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `update_time` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `tmf_user_collection`
--

INSERT INTO `tmf_user_collection` (`id`, `uid`, `user_account`, `user_erwei`, `add_time`, `update_time`) VALUES
(5, 21, 'lx1234536789', 'http://yq.myxs.ltd/upload/picture/20190802/15391122500.png', 1564731570, NULL),
(6, 10, 'ceshi9999999', 'http://yq.myxs.ltd/upload/picture/20190802/15391122500.png', 1564731570, NULL),
(7, 19, 'ceshi1111111', 'http://yq.myxs.ltd/upload/picture/20190802/15391122500.png', 1564731570, NULL),
(8, 22, '13640979137', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', 1564736553, NULL),
(9, 20, 'ceshi111111111111', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', 1564736553, NULL),
(10, 18, 'ceshi2222222222', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', 1564736553, NULL),
(11, 17, 'ceshi3333333333', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', 1564736553, NULL),
(12, 26, '1234', 'http://43.249.83.77:3892/upload/picture/20190809/12450642935.jpeg', 1565325970, NULL),
(13, 27, '123456789', 'http://43.249.83.77:3892/upload/picture/20190809/13405294419.jpeg', 1565329317, NULL),
(14, 35, '123456', 'http://43.249.83.77:3892/upload/picture/20190809/15232355873.jpeg', 1565335435, NULL),
(15, 36, '123456', 'http://43.249.83.77:3892/upload/picture/20190809/15370749618.jpeg', 1565336287, NULL),
(16, 37, 'weaa', 'http://43.249.83.77:3892/upload/picture/20190809/16354766407.jpeg', 1565340130, NULL),
(17, 41, 'asd', 'http://43.249.83.77:3892/upload/picture/20190810/08034026275.jpeg', 1565395520, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_user_profile`
--

CREATE TABLE IF NOT EXISTS `tmf_user_profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL COMMENT '会员id',
  `wx_picture_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '微信二维码图片id（0表示无）',
  `wx_account` varchar(64) DEFAULT NULL COMMENT '微信号',
  `shoukuan_pic` varchar(255) DEFAULT NULL,
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别（0-未知，1-男，2-女）',
  `account_no` varchar(32) DEFAULT NULL COMMENT '银行卡号',
  `account_name` varchar(64) DEFAULT NULL COMMENT '账户姓名',
  `bank_name` varchar(128) DEFAULT NULL COMMENT '银行名称',
  `branch_name` varchar(128) DEFAULT NULL COMMENT '支行名称',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `agent_pid` int(10) unsigned DEFAULT '0' COMMENT '归属代理id（0表示无）',
  `head_icon` varchar(255) DEFAULT NULL COMMENT '头像',
  `nickname` varchar(64) DEFAULT NULL COMMENT '昵称',
  `agent_nid` int(10) DEFAULT '0' COMMENT '代理id（0表示非代理推荐）',
  `age` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '年龄',
  `profession` varchar(255) DEFAULT '' COMMENT '职业',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='会员资料表' AUTO_INCREMENT=46 ;

--
-- 转存表中的数据 `tmf_user_profile`
--

INSERT INTO `tmf_user_profile` (`id`, `user_id`, `wx_picture_id`, `wx_account`, `shoukuan_pic`, `sex`, `account_no`, `account_name`, `bank_name`, `branch_name`, `create_time`, `update_time`, `agent_pid`, `head_icon`, `nickname`, `agent_nid`, `age`, `profession`) VALUES
(1, 1, 0, 'yuanmu_1', NULL, 0, NULL, NULL, NULL, NULL, 0, 1564555348, 1, NULL, NULL, 0, 0, ''),
(2, 2, 0, '', NULL, 0, NULL, '', NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(3, 3, 0, '', NULL, 0, NULL, '', NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(4, 4, 0, '', NULL, 0, NULL, '', NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(5, 0, 0, 'yuanmu', NULL, 0, NULL, NULL, NULL, NULL, 1564543820, 1564543820, 0, NULL, NULL, 0, 0, ''),
(6, 5, 0, 'mmm', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(7, 6, 0, '', NULL, 0, NULL, '', NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(8, 7, 0, '', NULL, 0, NULL, '', NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(9, 8, 0, '', NULL, 0, NULL, '', NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(10, 9, 0, '', NULL, 0, NULL, '', NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(11, 10, 0, '18582968689', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(12, 11, 0, '18582968688', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(13, 12, 0, '18582968687', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(14, 13, 0, '18582968686', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(15, 14, 0, '18582968685', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(16, 15, 0, '18582968684', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(17, 16, 0, '18582968683', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(18, 17, 0, '18582968682', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(19, 18, 0, '18582968681', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(20, 19, 0, '18582968680', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(21, 20, 0, '', NULL, 0, NULL, '', NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(22, 21, 0, '', NULL, 0, NULL, '', NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(23, 22, 0, '', NULL, 0, NULL, '', NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(24, 23, 0, '', NULL, 0, NULL, '', NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(25, 24, 0, '', NULL, 0, NULL, '', NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(26, 25, 0, 'wertfv', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(27, 26, 0, '', NULL, 0, NULL, '', NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(28, 27, 0, '17395042900', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(29, 28, 0, '', NULL, 0, NULL, '', NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(30, 29, 0, '15002139414', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(31, 30, 0, '15002139415', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(32, 31, 0, '15002139416', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(33, 32, 0, '15002139417', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(34, 33, 0, '15002139418', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(35, 34, 0, '1234567899', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(36, 35, 0, '123456', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(37, 36, 0, 'asdaaa', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(38, 37, 0, '654321', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(39, 38, 0, 'wqer', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(40, 39, 0, '789', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(41, 40, 0, '123', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(42, 41, 0, 'sds', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(43, 42, 0, '456', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(44, 43, 0, '456a', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, ''),
(45, 44, 0, '79789789', NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, NULL, 0, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `tmf_user_special`
--

CREATE TABLE IF NOT EXISTS `tmf_user_special` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `create_time` int(10) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '1启用，0关闭',
  `update_time` int(10) DEFAULT NULL,
  `agent_pid` int(10) DEFAULT '0' COMMENT '代理id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='特殊会员表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tmf_zcplan`
--

CREATE TABLE IF NOT EXISTS `tmf_zcplan` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `imgurl` varchar(255) DEFAULT NULL COMMENT '债务凭证',
  `status` tinyint(1) DEFAULT '0' COMMENT '审核状态 0未审核 1审核通过',
  `create_time` int(11) DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`Id`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=42 ;

--
-- 转存表中的数据 `tmf_zcplan`
--

INSERT INTO `tmf_zcplan` (`Id`, `uid`, `type`, `name`, `account`, `imgurl`, `status`, `create_time`, `update_time`) VALUES
(28, '10', '1', '信用卡', '5000000', 'http://yq.myxs.ltd/upload/picture/20190803/08582561185.jpeg', 1, 0, 0),
(29, '18', '4', '其他', '3500000', 'http://yq.myxs.ltd/upload/picture/20190803/11341330555.png', 1, 0, 0),
(32, '17', '2', '房贷', '1250000', 'http://yq.myxs.ltd/upload/picture/20190803/12321814933.jpeg', 1, 0, 0),
(33, '22', '2', '房贷', '2000000', 'http://yq.myxs.ltd/upload/picture/20190803/15055244326.jpeg', 1, 0, 0),
(27, '20', '1', '信用卡', '500000', 'http://yq.myxs.ltd/upload/picture/20190803/08404363793.jpeg', 1, 0, 0),
(26, '21', '1', '信用卡', '500000', 'http://yq.myxs.ltd/upload/picture/20190803/08345179222.jpeg', 1, 0, 0),
(34, '26', '1', '信用卡', '3000000', 'http://43.249.83.77:3892/upload/picture/20190809/12462995918.jpeg', 1, 0, 0),
(35, '27', '2', '房贷', '5000000', 'http://43.249.83.77:3892/upload/picture/20190809/13423556067.jpeg', 1, 0, 0),
(36, '25', '1', '信用卡', '500', 'http://43.249.83.77:3892/upload/picture/20190809/13431178670.jpeg', 0, 0, 0),
(37, '35', '2', '房贷', '8000000', 'http://43.249.83.77:3892/upload/picture/20190809/15254785049.jpeg', 1, 0, 0),
(38, '36', '2', '房贷', '3000000', 'http://43.249.83.77:3892/upload/picture/20190809/15385112808.jpeg', 1, 0, 0),
(39, '19', '2', '房贷', '11111111', 'http://43.249.83.77:3892/upload/picture/20190809/16090000639.jpeg', 1, 0, 0),
(40, '37', '2', '房贷', '2000000', 'http://43.249.83.77:3892/upload/picture/20190809/16421957975.jpeg', 1, 0, 0),
(41, '41', '1', '信用卡', '8000000', 'http://43.249.83.77:3892/upload/picture/20190810/08060630421.jpeg', 1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_zcplan_list`
--

CREATE TABLE IF NOT EXISTS `tmf_zcplan_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `zcplan_id` int(11) NOT NULL COMMENT '债务id',
  `type` tinyint(1) DEFAULT NULL COMMENT '类型',
  `phase` varchar(50) DEFAULT NULL COMMENT '阶段 1-9',
  `demand` int(11) DEFAULT '0' COMMENT '需求金额',
  `set_demand` int(11) DEFAULT NULL COMMENT '设置金额',
  `all_count` int(11) DEFAULT NULL COMMENT '总金额',
  `add_time` int(11) DEFAULT NULL COMMENT '生成时间',
  `standard_money` int(11) unsigned DEFAULT '0' COMMENT '对应阶段标准金额，用来判断当前阶段是否满足标准',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态  0未激活  1已激活  2已完成',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=291 ;

--
-- 转存表中的数据 `tmf_zcplan_list`
--

INSERT INTO `tmf_zcplan_list` (`id`, `uid`, `zcplan_id`, `type`, `phase`, `demand`, `set_demand`, `all_count`, `add_time`, `standard_money`, `status`) VALUES
(88, 21, 26, 1, '一', 0, 600, 500000, 1564792660, 600, 1),
(89, 21, 26, 1, '二', 400, 1800, 500000, 1564792660, 1800, 1),
(90, 21, 26, 1, '三', 0, 5400, 500000, 1564792660, 5400, 0),
(91, 21, 26, 1, '四', 0, 16200, 500000, 1564792660, 16200, 0),
(92, 21, 26, 1, '五', 0, 48600, 500000, 1564792660, 48600, 0),
(93, 21, 26, 1, '六', 0, 145800, 500000, 1564792660, 145800, 0),
(94, 21, 26, 1, '七', 0, 281600, 500000, 1564792660, 437400, 0),
(95, 20, 27, 1, '一', 200, 600, 500000, 1564792853, 600, 1),
(96, 20, 27, 1, '二', 0, 1800, 500000, 1564792853, 1800, 1),
(97, 20, 27, 1, '三', 0, 5400, 500000, 1564792853, 5400, 0),
(98, 20, 27, 1, '四', 0, 16200, 500000, 1564792853, 16200, 0),
(99, 20, 27, 1, '五', 0, 48600, 500000, 1564792853, 48600, 0),
(100, 20, 27, 1, '六', 0, 145800, 500000, 1564792853, 145800, 0),
(101, 20, 27, 1, '七', 0, 281600, 500000, 1564792853, 437400, 0),
(102, 10, 28, 1, '一', 1200, 600, 5000000, 1564793920, 600, 2),
(103, 10, 28, 1, '二', 0, 1800, 5000000, 1564793920, 1800, 0),
(104, 10, 28, 1, '三', 0, 5400, 5000000, 1564793920, 5400, 0),
(105, 10, 28, 1, '四', 0, 16200, 5000000, 1564793920, 16200, 0),
(106, 10, 28, 1, '五', 0, 48600, 5000000, 1564793920, 48600, 0),
(107, 10, 28, 1, '六', 0, 145800, 5000000, 1564793920, 145800, 0),
(108, 10, 28, 1, '七', 0, 437400, 5000000, 1564793920, 437400, 0),
(109, 10, 28, 1, '八', 0, 1312200, 5000000, 1564793920, 1312200, 0),
(110, 10, 28, 1, '九', 0, 3032000, 5000000, 1564793920, 3032000, 0),
(117, 18, 29, 1, '一', 600, 600, 3500000, 1564803270, 600, 1),
(118, 18, 29, 1, '二', 0, 1800, 3500000, 1564803270, 1800, 0),
(119, 18, 29, 1, '三', 0, 5400, 3500000, 1564803270, 5400, 0),
(120, 18, 29, 1, '四', 0, 16200, 3500000, 1564803270, 16200, 0),
(121, 18, 29, 1, '五', 0, 48600, 3500000, 1564803270, 48600, 0),
(122, 18, 29, 1, '六', 0, 145800, 3500000, 1564803270, 145800, 0),
(123, 18, 29, 1, '七', 0, 437400, 3500000, 1564803270, 437400, 0),
(124, 18, 29, 1, '八', 0, 1312200, 3500000, 1564803270, 1312200, 0),
(125, 18, 29, 1, '九', 0, 1532000, 3500000, 1564803270, 3032000, 0),
(162, 17, 32, 1, '一', 1000, 600, 1250000, 1564806745, 600, 2),
(163, 17, 32, 1, '二', 0, 1800, 1250000, 1564806745, 1800, 0),
(164, 17, 32, 1, '三', 0, 5400, 1250000, 1564806745, 5400, 0),
(165, 17, 32, 1, '四', 0, 16200, 1250000, 1564806745, 16200, 0),
(166, 17, 32, 1, '五', 0, 48600, 1250000, 1564806745, 48600, 0),
(167, 17, 32, 1, '六', 0, 145800, 1250000, 1564806745, 145800, 0),
(168, 17, 32, 1, '七', 0, 437400, 1250000, 1564806745, 437400, 0),
(169, 17, 32, 1, '八', 0, 594200, 1250000, 1564806745, 1312200, 0),
(177, 22, 33, 1, '一', 1000, 600, 2000000, 1564816007, 600, 2),
(178, 22, 33, 1, '二', 0, 1800, 2000000, 1564816007, 1800, 1),
(179, 22, 33, 1, '三', 0, 5400, 2000000, 1564816007, 5400, 0),
(180, 22, 33, 1, '四', 0, 16200, 2000000, 1564816007, 16200, 0),
(181, 22, 33, 1, '五', 0, 48600, 2000000, 1564816007, 48600, 0),
(182, 22, 33, 1, '六', 0, 145800, 2000000, 1564816007, 145800, 0),
(183, 22, 33, 1, '七', 0, 437400, 2000000, 1564816007, 437400, 0),
(184, 22, 33, 1, '八', 0, 1312200, 2000000, 1564816007, 1312200, 0),
(185, 22, 33, 1, '九', 0, 32000, 2000000, 1564816007, 3032000, 0),
(192, 26, 34, 1, '一', 600, 600, 3000000, 1565326057, 600, 1),
(193, 26, 34, 1, '二', 0, 1800, 3000000, 1565326057, 1800, 1),
(194, 26, 34, 1, '三', 0, 5400, 3000000, 1565326057, 5400, 0),
(195, 26, 34, 1, '四', 0, 16200, 3000000, 1565326057, 16200, 0),
(196, 26, 34, 1, '五', 0, 48600, 3000000, 1565326057, 48600, 0),
(197, 26, 34, 1, '六', 0, 145800, 3000000, 1565326057, 145800, 0),
(198, 26, 34, 1, '七', 0, 437400, 3000000, 1565326057, 437400, 0),
(199, 26, 34, 1, '八', 0, 1312200, 3000000, 1565326057, 1312200, 0),
(200, 26, 34, 1, '九', 0, 1032000, 3000000, 1565326057, 3032000, 0),
(207, 27, 35, 1, '一', 0, 600, 5000000, 1565329382, 600, 1),
(208, 27, 35, 1, '二', 0, 1800, 5000000, 1565329382, 1800, 0),
(209, 27, 35, 1, '三', 0, 5400, 5000000, 1565329382, 5400, 0),
(210, 27, 35, 1, '四', 0, 16200, 5000000, 1565329382, 16200, 0),
(211, 27, 35, 1, '五', 0, 48600, 5000000, 1565329382, 48600, 0),
(212, 27, 35, 1, '六', 0, 145800, 5000000, 1565329382, 145800, 0),
(213, 27, 35, 1, '七', 0, 437400, 5000000, 1565329382, 437400, 0),
(214, 27, 35, 1, '八', 0, 1312200, 5000000, 1565329382, 1312200, 0),
(215, 27, 35, 1, '九', 0, 3032000, 5000000, 1565329382, 3032000, 0),
(222, 35, 37, 1, '一', 600, 600, 8000000, 1565335558, 600, 1),
(223, 35, 37, 1, '二', 0, 1800, 8000000, 1565335558, 1800, 1),
(224, 35, 37, 1, '三', 0, 5400, 8000000, 1565335558, 5400, 1),
(225, 35, 37, 1, '四', 0, 16200, 8000000, 1565335558, 16200, 1),
(226, 35, 37, 1, '五', 0, 48600, 8000000, 1565335558, 48600, 0),
(227, 35, 37, 1, '六', 0, 145800, 8000000, 1565335558, 145800, 0),
(228, 35, 37, 1, '七', 0, 437400, 8000000, 1565335558, 437400, 0),
(229, 35, 37, 1, '八', 0, 1312200, 8000000, 1565335558, 1312200, 0),
(230, 35, 37, 1, '九', 0, 3032000, 8000000, 1565335558, 3032000, 0),
(237, 36, 38, 1, '一', 0, 600, 3000000, 1565336345, 600, 1),
(238, 36, 38, 1, '二', 0, 1800, 3000000, 1565336345, 1800, 1),
(239, 36, 38, 1, '三', 0, 5400, 3000000, 1565336345, 5400, 0),
(240, 36, 38, 1, '四', 0, 16200, 3000000, 1565336345, 16200, 0),
(241, 36, 38, 1, '五', 0, 48600, 3000000, 1565336345, 48600, 0),
(242, 36, 38, 1, '六', 0, 145800, 3000000, 1565336345, 145800, 0),
(243, 36, 38, 1, '七', 0, 437400, 3000000, 1565336345, 437400, 0),
(244, 36, 38, 1, '八', 0, 1312200, 3000000, 1565336345, 1312200, 0),
(245, 36, 38, 1, '九', 0, 1032000, 3000000, 1565336345, 3032000, 0),
(252, 19, 39, 1, '一', 200, 600, 11111111, 1565338188, 600, 1),
(253, 19, 39, 1, '二', 0, 1800, 11111111, 1565338188, 1800, 0),
(254, 19, 39, 1, '三', 0, 5400, 11111111, 1565338188, 5400, 0),
(255, 19, 39, 1, '四', 0, 16200, 11111111, 1565338188, 16200, 0),
(256, 19, 39, 1, '五', 0, 48600, 11111111, 1565338188, 48600, 0),
(257, 19, 39, 1, '六', 0, 145800, 11111111, 1565338188, 145800, 0),
(258, 19, 39, 1, '七', 0, 437400, 11111111, 1565338188, 437400, 0),
(259, 19, 39, 1, '八', 0, 1312200, 11111111, 1565338188, 1312200, 0),
(260, 19, 39, 1, '九', 0, 3032000, 11111111, 1565338188, 3032000, 0),
(267, 37, 40, 1, '一', 0, 600, 2000000, 1565340169, 600, 1),
(268, 37, 40, 1, '二', 0, 1800, 2000000, 1565340169, 1800, 0),
(269, 37, 40, 1, '三', 0, 5400, 2000000, 1565340169, 5400, 0),
(270, 37, 40, 1, '四', 0, 16200, 2000000, 1565340169, 16200, 0),
(271, 37, 40, 1, '五', 0, 48600, 2000000, 1565340169, 48600, 0),
(272, 37, 40, 1, '六', 0, 145800, 2000000, 1565340169, 145800, 0),
(273, 37, 40, 1, '七', 0, 437400, 2000000, 1565340169, 437400, 0),
(274, 37, 40, 1, '八', 0, 1312200, 2000000, 1565340169, 1312200, 0),
(275, 37, 40, 1, '九', 0, 32000, 2000000, 1565340169, 3032000, 0),
(282, 41, 41, 1, '一', 0, 600, 8000000, 1565395578, 600, 1),
(283, 41, 41, 1, '二', 0, 1800, 8000000, 1565395578, 1800, 0),
(284, 41, 41, 1, '三', 0, 5400, 8000000, 1565395578, 5400, 0),
(285, 41, 41, 1, '四', 0, 16200, 8000000, 1565395578, 16200, 0),
(286, 41, 41, 1, '五', 0, 48600, 8000000, 1565395578, 48600, 0),
(287, 41, 41, 1, '六', 0, 145800, 8000000, 1565395578, 145800, 0),
(288, 41, 41, 1, '七', 0, 437400, 8000000, 1565395578, 437400, 0),
(289, 41, 41, 1, '八', 0, 1312200, 8000000, 1565395578, 1312200, 0),
(290, 41, 41, 1, '九', 0, 3032000, 8000000, 1565395578, 3032000, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tmf_zcplan_plan`
--

CREATE TABLE IF NOT EXISTS `tmf_zcplan_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0' COMMENT '打款人id',
  `pay_img` varchar(255) DEFAULT NULL COMMENT '付款凭证',
  `get_uid` int(11) DEFAULT '0' COMMENT '收款人id',
  `get_avater` varchar(255) DEFAULT NULL COMMENT '收款人头像',
  `get_user_name` varchar(255) DEFAULT NULL COMMENT '收款人姓名',
  `get_user_card` varchar(255) DEFAULT NULL COMMENT '收款人身份证',
  `get_erwei` varchar(255) DEFAULT NULL COMMENT '收款人二维吗',
  `get_account` varchar(255) DEFAULT NULL COMMENT '收款人账号',
  `money` decimal(10,1) DEFAULT NULL COMMENT '收款金额',
  `type` tinyint(1) DEFAULT '0' COMMENT '类型 1激活打款  2升级打款',
  `add_time` int(11) DEFAULT '0' COMMENT '生成时间',
  `get_time` int(11) DEFAULT '0' COMMENT '打款时间',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态 0收款人未确认  1收款人已确认',
  `pay_status` tinyint(1) DEFAULT '0' COMMENT '付款装态  0未进行付款  1已付款（等审核）',
  `phase` int(11) DEFAULT '0' COMMENT '阶段1-9',
  `level` tinyint(1) DEFAULT NULL COMMENT '升级等级',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=75 ;

--
-- 转存表中的数据 `tmf_zcplan_plan`
--

INSERT INTO `tmf_zcplan_plan` (`id`, `uid`, `pay_img`, `get_uid`, `get_avater`, `get_user_name`, `get_user_card`, `get_erwei`, `get_account`, `money`, `type`, `add_time`, `get_time`, `status`, `pay_status`, `phase`, `level`) VALUES
(33, 21, 'http://yq.myxs.ltd/upload/picture/20190803/09002666269.jpeg', 20, '', '测试1号', '510823199110207037', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', 'ceshi111111111111', '200.0', 1, 1564794003, 1564794027, 1, 1, 95, 2),
(34, 21, 'http://yq.myxs.ltd/upload/picture/20190803/09003590542.png', 10, '', '测试9级', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/15391122500.png', 'ceshi9999999', '200.0', 1, 1564794003, 1564794037, 1, 1, 102, 2),
(39, 21, 'http://yq.myxs.ltd/upload/picture/20190803/13375264721.jpeg', 17, '', '测试啊', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', 'ceshi3333333333', '200.0', 2, 1564810663, 1564810673, 1, 1, 162, 3),
(40, 22, 'http://yq.myxs.ltd/upload/picture/20190803/15070618421.jpeg', 21, '', '龙鑫', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/15391122500.png', 'lx1234536789', '200.0', 1, 1564816015, 1564816027, 1, 1, 89, 2),
(41, 22, 'http://yq.myxs.ltd/upload/picture/20190803/15071764779.jpeg', 10, '', '测试9级', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/15391122500.png', 'ceshi9999999', '200.0', 1, 1564816015, 1564816038, 1, 1, 102, NULL),
(42, 26, 'http://43.249.83.77:3892/upload/picture/20190809/12525278466.jpeg', 22, '', '何大爷', '511321198509199039', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', '13640979137', '200.0', 1, 1565326273, 1565326375, 1, 1, 177, 2),
(43, 26, 'http://43.249.83.77:3892/upload/picture/20190809/12523929624.jpeg', 10, '', '测试9级', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/15391122500.png', 'ceshi9999999', '200.0', 1, 1565326273, 1565326361, 1, 1, 102, NULL),
(44, 27, 'http://43.249.83.77:3892/upload/picture/20190809/23050028370.jpeg', 22, '', '何大爷', '511321198509199039', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', '13640979137', '200.0', 1, 1565329398, 1565363102, 1, 1, 177, NULL),
(45, 27, 'http://43.249.83.77:3892/upload/picture/20190809/23050865392.jpeg', 26, '', '林鑫', '510321199804230776', 'http://43.249.83.77:3892/upload/picture/20190809/12450642935.jpeg', '1234', '200.0', 1, 1565329399, 1565363109, 1, 1, 192, 3),
(46, 18, 'http://43.249.83.77:3892/upload/picture/20190809/16241365665.jpeg', 17, '', '测试啊', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', 'ceshi3333333333', '200.0', 1, 1565334633, 1565339055, 1, 1, 162, 3),
(47, 18, 'http://43.249.83.77:3892/upload/picture/20190809/16235956960.jpeg', 10, '', '测试9级', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/15391122500.png', 'ceshi9999999', '200.0', 1, 1565334634, 1565339040, 1, 1, 102, NULL),
(48, 35, 'http://43.249.83.77:3892/upload/picture/20190809/16453117405.jpeg', 22, '', '何大爷', '511321198509199039', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', '13640979137', '200.0', 1, 1565335569, 1565340333, 1, 1, 177, NULL),
(49, 35, 'http://43.249.83.77:3892/upload/picture/20190809/16453839481.jpeg', 26, '', '林鑫', '510321199804230776', 'http://43.249.83.77:3892/upload/picture/20190809/12450642935.jpeg', '1234', '200.0', 1, 1565335569, 1565340340, 1, 1, 192, 2),
(50, 36, 'http://43.249.83.77:3892/upload/picture/20190809/15530105561.jpeg', 22, '', '何大爷', '511321198509199039', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', '13640979137', '200.0', 1, 1565336393, 1565337183, 1, 1, 177, NULL),
(51, 36, 'http://43.249.83.77:3892/upload/picture/20190809/15525313448.jpeg', 26, '', '林鑫', '510321199804230776', 'http://43.249.83.77:3892/upload/picture/20190809/12450642935.jpeg', '1234', '200.0', 1, 1565336393, 1565337174, 1, 1, 192, NULL),
(52, 10, 'http://43.249.83.77:3892/upload/picture/20190809/23205202939.jpeg', 9, '', NULL, NULL, NULL, NULL, '200.0', 1, 1565337710, 1565364052, 0, 1, 0, 10),
(53, 10, 'http://43.249.83.77:3892/upload/picture/20190809/23205922013.jpeg', 1, '', 'sunyuan', '51082319730405704X', NULL, NULL, '200.0', 1, 1565337710, 1565364060, 0, 1, 0, NULL),
(54, 19, 'http://43.249.83.77:3892/upload/picture/20190809/16131870725.jpeg', 18, '', '测试2号', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', 'ceshi2222222222', '200.0', 1, 1565338261, 1565338399, 1, 1, 117, 2),
(55, 19, 'http://43.249.83.77:3892/upload/picture/20190809/16132874558.jpeg', 10, '', '测试9级', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/15391122500.png', 'ceshi9999999', '200.0', 1, 1565338261, 1565338411, 1, 1, 102, NULL),
(56, 17, 'http://43.249.83.77:3892/upload/picture/20190809/16323752072.jpeg', 16, '', NULL, NULL, NULL, NULL, '200.0', 1, 1565338551, 1565339558, 0, 1, 0, 4),
(57, 17, 'http://43.249.83.77:3892/upload/picture/20190809/16324487174.jpeg', 10, '', '测试9级', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/15391122500.png', 'ceshi9999999', '200.0', 1, 1565338551, 1565339565, 1, 1, 102, NULL),
(58, 19, NULL, 17, '', NULL, NULL, NULL, NULL, '200.0', 2, 1565339359, 0, 0, 0, 0, 3),
(59, 18, NULL, 8, '', NULL, NULL, NULL, NULL, '200.0', 2, 1565339514, 0, 0, 0, 0, 3),
(60, 37, 'http://43.249.83.77:3892/upload/picture/20190809/22290667852.jpeg', 22, '', '何大爷', '511321198509199039', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', '13640979137', '200.0', 1, 1565340424, 1565360947, 1, 1, 177, NULL),
(61, 37, 'http://43.249.83.77:3892/upload/picture/20190809/22291955166.jpeg', 35, '', '王双', '510724199506016158', 'http://43.249.83.77:3892/upload/picture/20190809/15232355873.jpeg', '123456', '200.0', 1, 1565340426, 1565360960, 1, 1, 222, NULL),
(62, 26, 'http://43.249.83.77:3892/upload/picture/20190809/23063870804.jpeg', 17, '', '测试啊', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', 'ceshi3333333333', '200.0', 2, 1565363192, 1565363201, 1, 1, 162, 3),
(63, 22, 'http://43.249.83.77:3892/upload/picture/20190809/23081072158.jpeg', 17, '', '测试啊', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', 'ceshi3333333333', '200.0', 2, 1565363284, 1565363292, 1, 1, 162, 3),
(64, 20, 'http://43.249.83.77:3892/upload/picture/20190809/23215185854.jpeg', 19, '', '测试上上级', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/15391122500.png', 'ceshi1111111', '200.0', 1, 1565364104, 1565364112, 1, 1, 252, 2),
(65, 20, 'http://43.249.83.77:3892/upload/picture/20190809/23215809350.jpeg', 10, '', '测试9级', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/15391122500.png', 'ceshi9999999', '200.0', 1, 1565364104, 1565364119, 1, 1, 0, NULL),
(66, 20, 'http://43.249.83.77:3892/upload/picture/20190809/23280281303.jpeg', 17, '', '测试啊', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', 'ceshi3333333333', '200.0', 2, 1565364471, 1565364484, 1, 1, 162, 3),
(67, 41, 'http://43.249.83.77:3892/upload/picture/20190810/08063715612.jpeg', 35, '', '王双', '510724199506016158', 'http://43.249.83.77:3892/upload/picture/20190809/15232355873.jpeg', '123456', '200.0', 1, 1565395587, 1565395598, 1, 1, 222, 2),
(68, 41, 'http://43.249.83.77:3892/upload/picture/20190810/08064548541.jpeg', 35, '', '王双', '510724199506016158', 'http://43.249.83.77:3892/upload/picture/20190809/15232355873.jpeg', '123456', '200.0', 1, 1565395587, 1565395606, 1, 1, 222, 2),
(69, 36, 'http://43.249.83.77:3892/upload/picture/20190810/08115350543.jpeg', 18, '', '测试2号', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', 'ceshi2222222222', '200.0', 2, 1565395893, 1565395915, 1, 1, 117, 3),
(70, 35, 'http://43.249.83.77:3892/upload/picture/20190810/08252334820.jpeg', 22, '', '龙鑫', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/15391122500.png', 'lx1234536789', '200.0', 2, 1565396582, 1565396724, 1, 1, 89, 2),
(71, 35, 'http://43.249.83.77:3892/upload/picture/20190810/08263102329.jpeg', 18, '', '测试2号', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', 'ceshi2222222222', '200.0', 2, 1565396784, 1565396792, 1, 1, 117, 3),
(72, 18, NULL, 16, '', NULL, NULL, NULL, NULL, '200.0', 2, 1565396874, 0, 0, 0, 0, 4),
(73, 35, 'http://43.249.83.77:3892/upload/picture/20190810/09132989484.jpeg', 17, '', '测试啊', '510724199506016158', 'http://yq.myxs.ltd/upload/picture/20190802/17014808750.jpeg', 'ceshi3333333333', '200.0', 2, 1565399466, 1565399611, 1, 1, 0, 4),
(74, 20, NULL, 9, '', NULL, NULL, NULL, NULL, '200.0', 2, 1565400667, 0, 0, 0, 0, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
