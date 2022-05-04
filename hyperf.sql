/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 80013
 Source Host           : 127.0.0.1:3306
 Source Schema         : hyperf

 Target Server Type    : MySQL
 Target Server Version : 80013
 File Encoding         : 65001

 Date: 04/05/2022 14:38:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for about
-- ----------------------------
DROP TABLE IF EXISTS `about`;
CREATE TABLE `about` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `github` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `constellation` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icp` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `about_user_id_unique` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='简介表';

-- ----------------------------
-- Records of about
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章标题',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章内容',
  `images` json DEFAULT NULL COMMENT '文章封面图片',
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '标签',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态 0待审核 1通过 -1失败',
  `is_display` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否显示 1显示 -1隐藏',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_id_unique` (`id`),
  KEY `article_title_index` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='文章表';

-- ----------------------------
-- Records of article
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for article_tag
-- ----------------------------
DROP TABLE IF EXISTS `article_tag`;
CREATE TABLE `article_tag` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL COMMENT '文章ID',
  `tag_id` int(11) NOT NULL COMMENT '标签ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_tag_article_id_tag_id_unique` (`article_id`,`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='文章标签表';

-- ----------------------------
-- Records of article_tag
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for attachment
-- ----------------------------
DROP TABLE IF EXISTS `attachment`;
CREATE TABLE `attachment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL COMMENT '附件类型0图片1语音2视频3其他',
  `link` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '附件链接',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='附件表';

-- ----------------------------
-- Records of attachment
-- ----------------------------
BEGIN;
INSERT INTO `attachment` (`id`, `type`, `link`, `created_at`, `updated_at`) VALUES (1, 1, 'r8vccl3st.bkt.clouddn.com/bdc2b3fbf5dcc3000e9d053a0028c088.jpeg', '2022-03-17 06:03:07', '2022-03-17 06:03:07');
INSERT INTO `attachment` (`id`, `type`, `link`, `created_at`, `updated_at`) VALUES (2, 1, 'r8vccl3st.bkt.clouddn.com/bdc2b3fbf5dcc3000e9d053a0028c088.jpeg', '2022-03-18 06:32:41', '2022-03-18 06:32:41');
INSERT INTO `attachment` (`id`, `type`, `link`, `created_at`, `updated_at`) VALUES (3, 3, 'http://ra9eblmyb.bkt.clouddn.com/32d58132ec0a44739975936ea06f9e38.jpg', '2022-04-13 05:31:52', '2022-04-13 05:31:52');
INSERT INTO `attachment` (`id`, `type`, `link`, `created_at`, `updated_at`) VALUES (4, 3, 'http://ra9eblmyb.bkt.clouddn.com/32d58132ec0a44739975936ea06f9e38.jpg', '2022-04-13 05:35:13', '2022-04-13 05:35:13');
INSERT INTO `attachment` (`id`, `type`, `link`, `created_at`, `updated_at`) VALUES (5, 3, 'http://ra9eblmyb.bkt.clouddn.com/32d58132ec0a44739975936ea06f9e38.jpg', '2022-04-13 05:38:45', '2022-04-13 05:38:45');
INSERT INTO `attachment` (`id`, `type`, `link`, `created_at`, `updated_at`) VALUES (6, 3, 'http://ra9eblmyb.bkt.clouddn.com/32d58132ec0a44739975936ea06f9e38.jpg', '2022-04-13 05:41:44', '2022-04-13 05:41:44');
INSERT INTO `attachment` (`id`, `type`, `link`, `created_at`, `updated_at`) VALUES (7, 3, 'http://ra9eblmyb.bkt.clouddn.com/32d58132ec0a44739975936ea06f9e38.jpg', '2022-04-13 05:44:35', '2022-04-13 05:44:35');
INSERT INTO `attachment` (`id`, `type`, `link`, `created_at`, `updated_at`) VALUES (8, 3, 'http://ra9eblmyb.bkt.clouddn.com/32d58132ec0a44739975936ea06f9e38.jpg', '2022-04-13 05:45:28', '2022-04-13 05:45:28');
INSERT INTO `attachment` (`id`, `type`, `link`, `created_at`, `updated_at`) VALUES (9, 3, 'http://ra9eblmyb.bkt.clouddn.com/32d58132ec0a44739975936ea06f9e38.jpg', '2022-04-13 05:48:13', '2022-04-13 05:48:13');
INSERT INTO `attachment` (`id`, `type`, `link`, `created_at`, `updated_at`) VALUES (10, 3, 'http://ra9eblmyb.bkt.clouddn.com/32d58132ec0a44739975936ea06f9e38.jpg', '2022-04-13 05:50:00', '2022-04-13 05:50:00');
INSERT INTO `attachment` (`id`, `type`, `link`, `created_at`, `updated_at`) VALUES (11, 3, 'http://ra9eblmyb.bkt.clouddn.com/32d58132ec0a44739975936ea06f9e38.jpg', '2022-04-13 05:53:56', '2022-04-13 05:53:56');
COMMIT;

-- ----------------------------
-- Table structure for casbin_rule
-- ----------------------------
DROP TABLE IF EXISTS `casbin_rule`;
CREATE TABLE `casbin_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ptype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v0` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `v5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of casbin_rule
-- ----------------------------
BEGIN;
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (29, 'p', '管理员', '/', 'GET', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (41, 'p', '管理员', 'Sys', 'GET', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (42, 'p', '管理员', 'SysUser', 'GET', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (43, 'p', '管理员', 'SysUserAdd', 'POST', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (44, 'p', '管理员', 'SysUserEdit', 'PUT', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (45, 'p', '管理员', 'SysRole', 'GET', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (46, 'p', '管理员', 'SysRoleAdd', 'POST', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (47, 'p', '管理员', 'SysRoleEdit', 'PUT', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (48, 'p', '管理员', 'SysRoleAllotPermissions', 'PUT', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (49, 'p', '管理员', 'SysMenu', 'GET', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (50, 'p', '管理员', 'SysMenuAdd', 'POST', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (51, 'p', '管理员', 'SysMenuEdit', 'PUT', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (52, 'p', '管理员', 'SysMenuDelete', 'DELETE', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (57, 'g', 'test', 'test', NULL, NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (102, 'g', 'demo', 'test', NULL, NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (105, 'g', 'admin', '管理员', NULL, NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (106, 'g', 'dasda', 'test', NULL, NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (107, 'p', 'test', 'SysRoleAdd', 'POST', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (108, 'p', 'test', 'SysRole', 'GET', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (109, 'p', 'test', 'SysRoleEdit', 'PUT', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (110, 'p', 'test', 'SysRoleAllotPermissions', 'PUT', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (111, 'p', 'test', 'SysRoleDelete', 'DELETE', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (112, 'p', 'test', 'SysMenuEdit', 'PUT', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (113, 'p', 'test', 'SysMenu', 'GET', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (114, 'p', 'test', 'SysMenuAdd', 'POST', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (115, 'p', 'test', 'SysMenuDelete', 'DELETE', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (116, 'p', 'test', 'SysUser', 'GET', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (117, 'p', 'test', 'SysUserAdd', 'POST', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (118, 'p', 'test', 'SysUserEdit', 'PUT', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (119, 'p', 'test', 'SysUserQuery', 'GET', NULL, NULL, NULL);
INSERT INTO `casbin_rule` (`id`, `ptype`, `v0`, `v1`, `v2`, `v3`, `v4`, `v5`) VALUES (120, 'p', 'test', 'Sys', 'GET', NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '头像',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='分类表';

-- ----------------------------
-- Records of category
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '评论内容',
  `parent_comment_id` bigint(20) DEFAULT NULL COMMENT '父评论ID',
  `article_id` int(11) NOT NULL COMMENT '文章ID',
  `user_id` int(11) NOT NULL COMMENT '作者ID',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态 0待审核 1通过 -1失败',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_created_at_index` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='文章评论表';

-- ----------------------------
-- Records of comment
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户标识',
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '访问地址',
  `info` json DEFAULT NULL COMMENT '日志',
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '访问ip',
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '访问者user_agnet',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=394 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='日志表';

-- ----------------------------
-- Records of log
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '类型 1消息 2通知 3代办',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `message_id_unique` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='消息表';

-- ----------------------------
-- Records of message
-- ----------------------------
BEGIN;
INSERT INTO `message` (`id`, `title`, `content`, `type`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, '测试', '测试内容', 1, 1, '2022-05-02 03:01:23', '2022-05-02 03:01:25', NULL);
COMMIT;

-- ----------------------------
-- Table structure for message_user
-- ----------------------------
DROP TABLE IF EXISTS `message_user`;
CREATE TABLE `message_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` int(11) NOT NULL COMMENT '消息ID',
  `user_id` int(11) NOT NULL COMMENT '发送用户ID',
  `isRead` tinyint(4) NOT NULL COMMENT '类型 0未读 1已读 -1已删除',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `message_user_id_unique` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='消息用户表';

-- ----------------------------
-- Records of message_user
-- ----------------------------
BEGIN;
INSERT INTO `message_user` (`id`, `message_id`, `user_id`, `isRead`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 1, 1, 0, '2022-05-02 13:15:24', '2022-05-02 13:15:26', NULL);
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '2022_03_11_100834_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '2022_03_11_205352_create_log_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '2022_03_14_060127_create_comment_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4, '2022_03_14_060142_create_tag_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5, '2022_03_14_060158_create_category_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6, '2022_03_14_060213_create_attachment_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7, '2022_03_14_060244_create_article_tag_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8, '2022_03_14_060314_create_about_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9, '2022_03_14_092839_create_article_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10, '2022_03_15_024812_create_serverlog_log_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11, '2022_04_29_060341_create_message_table', 3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12, '2022_05_02_042023_create_message_user_table', 4);
COMMIT;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL COMMENT '上级权限',
  `is_display` tinyint(1) NOT NULL COMMENT '是否显示在菜单',
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '路由',
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '权限辨别',
  `method` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sort` mediumint(9) NOT NULL COMMENT '排序',
  `menuType` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型 1菜单 2按钮',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图标',
  PRIMARY KEY (`id`),
  UNIQUE KEY `path` (`path`,`method`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
BEGIN;
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (1, 0, 0, 'system', '', 'Sys', 'GET', '系统管理', 0, 1, 'setting');
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (2, 1, 0, 'user', '/system/user', 'SysUser', 'GET', '用户管理', 0, 1, '');
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (3, 2, 0, '', '/staff/user/add', 'SysUserAdd', 'POST', '添加用户', 0, 2, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (4, 2, 0, '', '/staff/user/add/update', 'SysUserEdit', 'PUT', '编辑用户', 0, 2, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (6, 1, 0, 'role', '/system/role', 'SysRole', 'GET', '角色管理', 0, 1, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (7, 6, 0, '', '/staff/role/add', 'SysRoleAdd', 'POST', '添加角色', 0, 2, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (8, 6, 0, '', '/staff/role/update', 'SysRoleEdit', 'PUT', '编辑角色', 0, 2, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (9, 6, 0, '', '/staff/role/setRolePermissions', 'SysRoleAllotPermissions', 'PUT', '分配权限', 0, 2, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (29, 1, 0, 'menu', '/system/menu', 'SysMenu', 'GET', '节点管理', 0, 1, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (30, 29, 0, '', '/staff/menu/add', 'SysMenuAdd', 'POST', '添加节点', 0, 2, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (31, 29, 0, '', '/staff/menu/edit', 'SysMenuEdit', 'PUT', '编辑节点', 0, 2, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (32, 29, 0, '', '/staff/menu/delete', 'SysMenuDelete', 'DELETE', '删除节点', 0, 2, NULL);
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (34, 6, 0, '', '/staff/role/delete', 'SysRoleDelete', 'DELETE', '删除角色', 1, 2, '');
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (35, 2, 0, '', '/staff/user/list', 'SysUserQuery', 'GET', '查询用户', 1, 2, '');
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (36, 1, 0, 'log', '/system/log', 'SysLog', 'GET', '日志管理', 0, 1, '');
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (37, 36, 0, '', '/staff/log/list', 'SysLogQuery', 'GET', '查询日志', 1, 2, '');
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (38, 6, 0, '', '/staff/role/list	', 'SysRoleQuery', 'get', '查询角色', 1, 2, '');
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (39, 29, 0, '', '/staff/menu/list', 'SysMenuQuery', 'GET', '查询菜单', 1, 2, '');
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (40, 1, 0, 'message', '/system/message', 'SysMessage', 'GET', '消息通知', 1, 1, '');
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (41, 40, 0, '', '/staff/message/list', 'SysMessageQuery', 'GET', '查询消息', 1, 2, '');
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (42, 40, 0, '', '/staff/message/add', 'SysMessageAdd', 'POST', '新增消息', 1, 2, '');
INSERT INTO `permissions` (`id`, `parent_id`, `is_display`, `route`, `path`, `description`, `method`, `name`, `sort`, `menuType`, `icon`) VALUES (43, 40, 0, '', '/staff/message/delete', 'SysMessageDelete', 'DELETE', '删除消息', 1, 2, '');
COMMIT;

-- ----------------------------
-- Table structure for role_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_permissions`;
CREATE TABLE `role_permissions` (
  `roleId` int(10) NOT NULL,
  `menuId` int(10) NOT NULL,
  `pseudoChecked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_permissions
-- ----------------------------
BEGIN;
INSERT INTO `role_permissions` (`roleId`, `menuId`, `pseudoChecked`) VALUES (6, 7, 2);
INSERT INTO `role_permissions` (`roleId`, `menuId`, `pseudoChecked`) VALUES (6, 6, 2);
INSERT INTO `role_permissions` (`roleId`, `menuId`, `pseudoChecked`) VALUES (6, 8, 2);
INSERT INTO `role_permissions` (`roleId`, `menuId`, `pseudoChecked`) VALUES (6, 9, 2);
INSERT INTO `role_permissions` (`roleId`, `menuId`, `pseudoChecked`) VALUES (6, 34, 2);
INSERT INTO `role_permissions` (`roleId`, `menuId`, `pseudoChecked`) VALUES (6, 31, 2);
INSERT INTO `role_permissions` (`roleId`, `menuId`, `pseudoChecked`) VALUES (6, 29, 2);
INSERT INTO `role_permissions` (`roleId`, `menuId`, `pseudoChecked`) VALUES (6, 30, 2);
INSERT INTO `role_permissions` (`roleId`, `menuId`, `pseudoChecked`) VALUES (6, 32, 2);
INSERT INTO `role_permissions` (`roleId`, `menuId`, `pseudoChecked`) VALUES (6, 2, 2);
INSERT INTO `role_permissions` (`roleId`, `menuId`, `pseudoChecked`) VALUES (6, 3, 2);
INSERT INTO `role_permissions` (`roleId`, `menuId`, `pseudoChecked`) VALUES (6, 4, 2);
INSERT INTO `role_permissions` (`roleId`, `menuId`, `pseudoChecked`) VALUES (6, 35, 2);
INSERT INTO `role_permissions` (`roleId`, `menuId`, `pseudoChecked`) VALUES (6, 1, 2);
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `auth_roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` (`id`, `name`, `description`) VALUES (5, '管理员', '管理员');
INSERT INTO `roles` (`id`, `name`, `description`) VALUES (6, 'test', 'test');
COMMIT;

-- ----------------------------
-- Table structure for serverlog_log
-- ----------------------------
DROP TABLE IF EXISTS `serverlog_log`;
CREATE TABLE `serverlog_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户标识',
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户名称',
  `content` json NOT NULL COMMENT '操作',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '访问地址',
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '访问ip',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `serverlog_log_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1014 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='日志表';

-- ----------------------------
-- Records of serverlog_log
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tag
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标签名',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='标签表';

-- ----------------------------
-- Records of tag
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '姓名',
  `mobile` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '联系电话',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户昵称',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '账号',
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '邮箱',
  `avatar` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '头像',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态 0待审核 1通过 -1失败',
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ip',
  `last_at` timestamp NULL DEFAULT NULL COMMENT '最近登录时间',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_id_index` (`id`),
  KEY `users_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户表';

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `name`, `mobile`, `password`, `nickname`, `username`, `email`, `avatar`, `status`, `position`, `ip`, `last_at`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'admin', '13867124407', '$2y$10$Ooup65psQ4pajFZZgC7g8uKAkagT19Thwm1gn3SMdB1/M.cZMkbie', '张三', '13867124407', '873853298@qq.com', 'https://wx2.sinaimg.cn/mw2000/002VTQLVly8gm7ifpqregj60e80e874y02.jpg', 1, '前端工程师 | 计算服务事业群-VUE平台', '172.18.0.12', '2022-05-03 04:46:53', '2022-03-14 14:38:56', '2022-05-03 04:46:53', NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
