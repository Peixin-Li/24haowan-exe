/*
Navicat MySQL Data Transfer

Source Server         : tmp1
Source Server Version : 50518
Source Host           : rds5c1st1pd6vl158518o.mysql.rds.aliyuncs.com:3306
Source Database       : haowan24_tmp1

Target Server Type    : MYSQL
Target Server Version : 50518
File Encoding         : 65001

Date: 2015-12-03 13:00:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for attention_user
-- ----------------------------
DROP TABLE IF EXISTS `attention_user`;
CREATE TABLE `attention_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luck_item` int(11) DEFAULT NULL COMMENT '获奖的项目',
  `is_first` enum('no','yes') COLLATE utf8mb4_unicode_ci DEFAULT 'yes' COMMENT '是否已经参加过抽奖',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='微信关注-抽奖列表';

-- ----------------------------
-- Records of attention_user
-- ----------------------------

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `user_id` int(11) NOT NULL COMMENT '玩家ID',
  `game_id` int(11) NOT NULL COMMENT '游戏ID',
  `comment` varchar(500) DEFAULT NULL COMMENT '评论内容',
  `star` varchar(20) DEFAULT NULL COMMENT '评论星级',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`,`user_id`,`game_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='玩家评论';

-- ----------------------------
-- Records of comment
-- ----------------------------

-- ----------------------------
-- Table structure for credential
-- ----------------------------
DROP TABLE IF EXISTS `credential`;
CREATE TABLE `credential` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `value` varchar(1000) NOT NULL COMMENT '凭据值',
  `type` enum('access_token','jsapi_ticket') NOT NULL COMMENT '凭据类型',
  `update_time` int(11) NOT NULL COMMENT '最近一次更新时间',
  `expires_time` int(11) NOT NULL COMMENT '凭据过期时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='微信全局凭据';

-- ----------------------------
-- Records of credential
-- ----------------------------

-- ----------------------------
-- Table structure for game
-- ----------------------------
DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
  `game_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_name` varchar(50) NOT NULL,
  `star` varchar(20) NOT NULL DEFAULT '★★★★' COMMENT '游戏星数',
  `quantity` int(11) NOT NULL DEFAULT '0' COMMENT '人气，根据人数来统计',
  `gametype` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL COMMENT '游戏简介',
  `comment_times` int(11) NOT NULL DEFAULT '0' COMMENT '评论的次数',
  `subject_id` int(11) DEFAULT NULL COMMENT '游戏主题ID',
  `img` varchar(200) NOT NULL COMMENT '游戏图片',
  `share_img` varchar(200) DEFAULT NULL COMMENT '游戏分享的链接图片',
  `game_url` varchar(200) NOT NULL COMMENT '游戏的链接地址',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `start_time` datetime DEFAULT NULL COMMENT '游戏上线时间',
  PRIMARY KEY (`game_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='游戏列表';

-- ----------------------------
-- Records of game
-- ----------------------------
INSERT INTO `game` VALUES ('1', '寻找单身狗', '★★★★★', '1', '休闲', '为抵御恩爱狗的袭击，单身狗向各位玩家请求保护，商量反击大计。', '0', '1', 'https://mmbiz.qlogo.cn/mmbiz/9wVOpRibEu9UrwSlXp8PTho5iblDw9nBg3yIoA0OI38TjzDegWz8nnZc0iaic3WMPRBA2CSPKibXrwxfIE86eibkTFXA/0?wx_fmt=jpeg', 'http://24haowan-cdn.shanyougame.com/FindSingle/game_small_logo.png', 'http://h5-1.shanyougame.com/main/game/game_id/1', '2015-11-10 16:23:25', '2015-11-10 18:40:00');
-- ----------------------------
-- Table structure for game_share
-- ----------------------------
DROP TABLE IF EXISTS `game_share`;
CREATE TABLE `game_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '玩家id',
  `game_id` int(11) NOT NULL DEFAULT '1' COMMENT '游戏ID',
  `share_type` enum('cfriend','friend') NOT NULL COMMENT '分享的类型：''cfriend''朋友圈  ， ‘friend’朋友',
  `share_times` int(11) DEFAULT '0' COMMENT '分享的次数',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '最后一次更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='玩家分享记录';

-- ----------------------------
-- Records of game_share
-- ----------------------------

-- ----------------------------
-- Table structure for relationship
-- ----------------------------
DROP TABLE IF EXISTS `relationship`;
CREATE TABLE `relationship` (
  `from_user_id` int(11) NOT NULL COMMENT '来源用户ID',
  `to_user_id` int(11) NOT NULL COMMENT '目标用户ID',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`from_user_id`,`to_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='玩家好友关系记录';

-- ----------------------------
-- Records of relationship
-- ----------------------------

-- ----------------------------
-- Table structure for subject
-- ----------------------------
DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主题ID',
  `subject_name` varchar(50) DEFAULT NULL,
  `subject_description` varchar(500) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL COMMENT '本期专题图片url',
  `total_game` int(11) NOT NULL DEFAULT '0' COMMENT '本期游戏总数',
  `quantity` int(11) NOT NULL DEFAULT '0' COMMENT '人气',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `start_time` datetime DEFAULT NULL COMMENT '开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '结束时间',
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='游戏主题';

-- ----------------------------
-- Records of subject
-- ----------------------------
INSERT INTO `subject` VALUES ('1', '过往游戏', '单身狗的绝地反击', 'http://24haowan-cdn.shanyougame.com/FindSingle/subject_logo.png', '0', '1670', '2015-11-05 16:18:02', '2015-11-10 18:18:05', '2015-11-17 16:18:07');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `openid` varchar(300) NOT NULL COMMENT '用户的唯一标识',
  `name` varchar(300) CHARACTER SET utf8mb4 NOT NULL COMMENT '用户昵称',
  `sex` enum('2','1','0') NOT NULL COMMENT '用户的性别，值为1时是男性，值为2时是女性，值为0时是未知',
  `province` varchar(50) DEFAULT NULL COMMENT '用户个人资料填写的省份',
  `city` varchar(50) DEFAULT NULL COMMENT '普通用户个人资料填写的城市',
  `country` varchar(50) DEFAULT NULL COMMENT '国家，如中国为CN',
  `headimgurl` varchar(500) DEFAULT NULL COMMENT '用户头像',
  `unionid` varchar(100) DEFAULT NULL,
  `from` varchar(20) DEFAULT 'weixin',
  `create_time` datetime NOT NULL COMMENT '账号创建时间',
  `last_update_time` datetime DEFAULT NULL COMMENT '最近一次更新个人信息的时间',
  `last_login_time` datetime DEFAULT NULL COMMENT '最近一次登录时间',
  `last_login_ip` varchar(20) DEFAULT NULL COMMENT '最近一次登录IP',
  `enable` enum('no','yes') NOT NULL DEFAULT 'yes' COMMENT '是否禁用',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='用户信息表';

-- ----------------------------
-- Records of user
-- ----------------------------

-- ----------------------------
-- Table structure for user_score
-- ----------------------------
DROP TABLE IF EXISTS `user_score`;
CREATE TABLE `user_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '玩家id',
  `game_id` int(11) NOT NULL COMMENT '游戏id',
  `last_score` int(11) NOT NULL DEFAULT '0' COMMENT '上一次游戏成绩',
  `score` int(11) DEFAULT '0' COMMENT '游戏最高分数',
  `badge` int(11) DEFAULT NULL COMMENT '徽章',
  `from` varchar(20) DEFAULT 'weixin' COMMENT '该玩家来源',
  `device_type` varchar(200) DEFAULT NULL COMMENT '设备型号',
  `game_time` int(11) DEFAULT NULL COMMENT '玩游戏的次数',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '最近一次更新时间',
  `stage` int(11) DEFAULT '0' COMMENT '游戏关卡',
  `role_id` int(11) DEFAULT '0' COMMENT '人物ID',
  PRIMARY KEY (`id`,`user_id`,`game_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='玩家游戏结果记录';

-- ----------------------------
-- Records of user_score
-- ----------------------------
