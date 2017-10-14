/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : laravel55.dev

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-10-01 00:11:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for la_admins
-- ----------------------------
DROP TABLE IF EXISTS `la_admins`;
CREATE TABLE `la_admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名称',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '角色状态:1可用 0不可用',
  `headimg` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户头像',
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户邮箱',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户密码',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of la_admins
-- ----------------------------
INSERT INTO `la_admins` VALUES ('1', 'Janis Kutch', '1', 'asset_admin/assets/img/user-1.jpg', 'mabelle66@example.net', '$2y$10$.qteVoFBLtIfXsIxTuJ6tetx8WyySaMqGZ0tyAr/QRcuZrF67sDUu', 'tLRdgAtP9A', '2017-09-18 14:57:26', '2017-09-18 14:57:26');
INSERT INTO `la_admins` VALUES ('2', 'Prof. Kamille Kirlin', '1', 'asset_admin/assets/img/user-1.jpg', 'dianna18@example.org', '$2y$10$.qteVoFBLtIfXsIxTuJ6tetx8WyySaMqGZ0tyAr/QRcuZrF67sDUu', 'GpY7UxmwEz', '2017-09-18 14:57:26', '2017-09-18 14:57:26');
INSERT INTO `la_admins` VALUES ('3', 'Kelley Kshlerin', '1', 'asset_admin/assets/img/user-1.jpg', 'lempi43@example.net', '$2y$10$.qteVoFBLtIfXsIxTuJ6tetx8WyySaMqGZ0tyAr/QRcuZrF67sDUu', 'ZIRL9UTsB3', '2017-09-18 14:57:26', '2017-09-18 14:57:26');
INSERT INTO `la_admins` VALUES ('4', 'Herta Wiza', '1', 'asset_admin/assets/img/user-1.jpg', 'twila20@example.com', '$2y$10$.qteVoFBLtIfXsIxTuJ6tetx8WyySaMqGZ0tyAr/QRcuZrF67sDUu', 'OPQyvC2PnR', '2017-09-18 14:57:26', '2017-09-18 14:57:26');
INSERT INTO `la_admins` VALUES ('5', 'Prof. Aurore Rippin', '1', 'asset_admin/assets/img/user-1.jpg', 'vprice@example.net', '$2y$10$.qteVoFBLtIfXsIxTuJ6tetx8WyySaMqGZ0tyAr/QRcuZrF67sDUu', 'IGaeRkhSTG', '2017-09-18 14:57:26', '2017-09-18 14:57:26');
INSERT INTO `la_admins` VALUES ('6', 'Holden Bartell', '1', 'asset_admin/assets/img/user-1.jpg', 'halvorson.ali@example.org', '$2y$10$F7J8zSN9pxezHd2Dtxg/6Ozm4WNZW9e07ROY391GwSa2LAQuHfTOC', 'Buyn7jZfeA', '2017-09-18 15:26:24', '2017-09-18 15:26:24');
INSERT INTO `la_admins` VALUES ('7', 'Shayne Mosciski', '1', 'asset_admin/assets/img/user-1.jpg', 'greg.schaden@example.net', '$2y$10$F7J8zSN9pxezHd2Dtxg/6Ozm4WNZW9e07ROY391GwSa2LAQuHfTOC', 'agbMz8ulFh', '2017-09-18 15:26:24', '2017-09-18 15:26:24');
INSERT INTO `la_admins` VALUES ('8', 'Christine Bruen II', '1', 'asset_admin/assets/img/user-1.jpg', 'trevor81@example.com', '$2y$10$F7J8zSN9pxezHd2Dtxg/6Ozm4WNZW9e07ROY391GwSa2LAQuHfTOC', 'DHDPRxu1ee', '2017-09-18 15:26:24', '2017-09-18 15:26:24');
INSERT INTO `la_admins` VALUES ('9', 'Skye Ritchie Jr.', '1', 'asset_admin/assets/img/user-1.jpg', 'phettinger@example.net', '$2y$10$F7J8zSN9pxezHd2Dtxg/6Ozm4WNZW9e07ROY391GwSa2LAQuHfTOC', 'lGRIINAxVV', '2017-09-18 15:26:24', '2017-09-18 15:26:24');
INSERT INTO `la_admins` VALUES ('10', 'Dr. Deon Hilll MD', '1', 'asset_admin/assets/img/user-1.jpg', 'lgusikowski@example.org', '$2y$10$F7J8zSN9pxezHd2Dtxg/6Ozm4WNZW9e07ROY391GwSa2LAQuHfTOC', 'd5xVQpoC9A', '2017-09-18 15:26:24', '2017-09-18 15:26:24');

-- ----------------------------
-- Table structure for la_admins_roles
-- ----------------------------
DROP TABLE IF EXISTS `la_admins_roles`;
CREATE TABLE `la_admins_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_roles_admin_id_role_id_unique` (`admin_id`,`role_id`),
  KEY `admins_roles_admin_id_index` (`admin_id`),
  KEY `admins_roles_role_id_index` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of la_admins_roles
-- ----------------------------

-- ----------------------------
-- Table structure for la_articles
-- ----------------------------
DROP TABLE IF EXISTS `la_articles`;
CREATE TABLE `la_articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类id',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文章标题',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章内容',
  `desc` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文章描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_top` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶，1置顶，0不置顶',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态：1正，-1删除，0待发布',
  `published_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_title_unique` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of la_articles
-- ----------------------------
INSERT INTO `la_articles` VALUES ('1', '1', 'abc', 'vabcabcabcabcabcabcabcabcabcabcabcabcabcabc', 'abc', '2017-09-19 11:49:06', '2017-09-23 23:12:24', '1', '-1', '2017-09-24 14:11:25');
INSERT INTO `la_articles` VALUES ('2', '1', 'aaa', 'sss', 'ccc', '2017-09-19 19:08:33', '2017-09-19 19:08:33', '1', '0', '2017-09-24 14:11:25');
INSERT INTO `la_articles` VALUES ('3', '1', 'document', '```javascript\r\n$(document).ready(function () {\r\n	alert(\'hello world\');\r\n});\r\n```', 'aaaa', '2017-09-19 21:03:12', '2017-09-19 21:03:12', '1', '0', '2017-09-24 14:11:25');
INSERT INTO `la_articles` VALUES ('4', '1', '啊啊啊啊', '啊啊啊啊', '啊啊啊啊', '2017-09-19 21:09:25', '2017-09-19 21:09:25', '1', '0', '2017-09-24 14:11:25');
INSERT INTO `la_articles` VALUES ('5', '3', '啊啊啊啊s', 'aaa', '啊啊啊啊', '2017-09-19 21:10:54', '2017-09-19 21:10:54', '0', '0', '2017-09-24 14:11:25');
INSERT INTO `la_articles` VALUES ('6', '1', '噩噩噩噩', '噩噩噩噩', '噩噩噩噩', '2017-09-19 21:22:56', '2017-09-19 21:22:56', '0', '0', '2017-09-24 14:11:25');
INSERT INTO `la_articles` VALUES ('7', '1', '噩噩噩噩s', 'sss', '噩噩噩噩', '2017-09-19 21:24:17', '2017-09-19 21:24:17', '0', '0', '2017-09-24 14:11:25');
INSERT INTO `la_articles` VALUES ('8', '3', '噩噩噩噩ss', '```javascript\r\n$(document).ready(function () {\r\n    alert(\'hello world\');\r\n});\r\n```', '噩噩噩噩', '2017-09-23 17:40:55', '2017-09-23 17:40:55', '0', '0', '2017-09-24 14:11:25');
INSERT INTO `la_articles` VALUES ('9', '1', 'abcs', '```javascript\r\n$(document).ready(function () {\r\n    alert(\'hello world\');\r\n});\r\n```', 'aaa', '2017-09-23 23:07:48', '2017-09-24 14:54:06', '1', '0', '2017-09-24 14:54:06');

-- ----------------------------
-- Table structure for la_articles_tags
-- ----------------------------
DROP TABLE IF EXISTS `la_articles_tags`;
CREATE TABLE `la_articles_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(10) unsigned NOT NULL COMMENT '文章id',
  `tag_id` int(10) unsigned NOT NULL COMMENT '标签id',
  PRIMARY KEY (`id`),
  KEY `articles_tags_article_id_index` (`article_id`),
  KEY `articles_tags_tag_id_index` (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of la_articles_tags
-- ----------------------------
INSERT INTO `la_articles_tags` VALUES ('1', '1', '1');
INSERT INTO `la_articles_tags` VALUES ('2', '8', '3');
INSERT INTO `la_articles_tags` VALUES ('3', '9', '1');

-- ----------------------------
-- Table structure for la_categorys
-- ----------------------------
DROP TABLE IF EXISTS `la_categorys`;
CREATE TABLE `la_categorys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父分类id',
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分类名称',
  `flag` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分类标识',
  `desc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分类描述',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态:1可用 0不可用',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categorys_flag_unique` (`flag`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of la_categorys
-- ----------------------------
INSERT INTO `la_categorys` VALUES ('1', '0', 'php', 'php', 'php', '1', '2017-09-18 21:42:37', '2017-09-18 21:42:37');
INSERT INTO `la_categorys` VALUES ('2', '0', 'linux', 'linux', 'linux', '1', '2017-09-18 21:42:47', '2017-09-18 21:42:47');
INSERT INTO `la_categorys` VALUES ('3', '1', 'laravel', 'laravel', 'laravel', '1', '2017-09-18 21:42:57', '2017-09-18 21:43:13');

-- ----------------------------
-- Table structure for la_migrations
-- ----------------------------
DROP TABLE IF EXISTS `la_migrations`;
CREATE TABLE `la_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of la_migrations
-- ----------------------------
INSERT INTO `la_migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `la_migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `la_migrations` VALUES ('3', '2017_09_14_024150_creaet_admins_table', '1');
INSERT INTO `la_migrations` VALUES ('4', '2017_09_14_113611_creaet_sidebars_table', '1');
INSERT INTO `la_migrations` VALUES ('5', '2017_09_14_164933_create_admins_roles_table', '1');
INSERT INTO `la_migrations` VALUES ('6', '2017_09_14_165121_creaet_roles_table', '1');
INSERT INTO `la_migrations` VALUES ('7', '2017_09_14_165157_creaet_privileges_table', '1');
INSERT INTO `la_migrations` VALUES ('8', '2017_09_14_165225_creaet_articles_table', '1');
INSERT INTO `la_migrations` VALUES ('9', '2017_09_14_165302_creaet_categorys_table', '1');
INSERT INTO `la_migrations` VALUES ('10', '2017_09_18_144029_create_tags_table', '1');
INSERT INTO `la_migrations` VALUES ('11', '2017_09_18_144548_create_articles_tags_table', '1');

-- ----------------------------
-- Table structure for la_password_resets
-- ----------------------------
DROP TABLE IF EXISTS `la_password_resets`;
CREATE TABLE `la_password_resets` (
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of la_password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for la_privileges
-- ----------------------------
DROP TABLE IF EXISTS `la_privileges`;
CREATE TABLE `la_privileges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父类id',
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '权限名称',
  `flag` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '权限标识',
  `desc` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '权限描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `privileges_flag_unique` (`flag`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of la_privileges
-- ----------------------------
INSERT INTO `la_privileges` VALUES ('1', '0', '角色列表', 'rbac_role_index', '角色列表', '2017-09-23 14:38:54', '2017-09-23 14:38:54');
INSERT INTO `la_privileges` VALUES ('2', '0', '权限列表', 'rbac_privilege_index', '权限列表', '2017-09-23 14:39:34', '2017-09-23 14:39:34');
INSERT INTO `la_privileges` VALUES ('3', '0', '菜单列表', 'rbac_sidebar_index', '菜单列表', '2017-09-23 14:39:52', '2017-09-23 14:39:52');
INSERT INTO `la_privileges` VALUES ('4', '0', '管理员列表', 'rabc_admin_index', '管理员列表', '2017-09-23 14:40:14', '2017-09-23 14:40:14');
INSERT INTO `la_privileges` VALUES ('5', '0', '文章分类', 'category_index', '文章分类', '2017-09-23 14:40:37', '2017-09-23 14:40:37');
INSERT INTO `la_privileges` VALUES ('6', '0', '文章列表', 'article_index', '文章列表', '2017-09-23 14:40:51', '2017-09-23 14:40:51');
INSERT INTO `la_privileges` VALUES ('7', '0', '标签列表', 'tag_index', '标签列表', '2017-09-23 14:41:11', '2017-09-23 14:41:11');

-- ----------------------------
-- Table structure for la_roles
-- ----------------------------
DROP TABLE IF EXISTS `la_roles`;
CREATE TABLE `la_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `desc` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色描述',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '角色状态:1可用0不可用',
  `rules` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '角色规则,保存的是权限的id,多个逗号分割',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of la_roles
-- ----------------------------
INSERT INTO `la_roles` VALUES ('1', '超级管理员', '超级管理员', '1', '', '2017-09-23 14:37:51', '2017-09-23 14:37:51');
INSERT INTO `la_roles` VALUES ('2', '技术开发', '技术开发', '1', '', '2017-09-23 14:38:06', '2017-09-23 14:38:06');

-- ----------------------------
-- Table structure for la_sidebars
-- ----------------------------
DROP TABLE IF EXISTS `la_sidebars`;
CREATE TABLE `la_sidebars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `class` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单icon',
  `purview_flag` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单权限',
  `is_active` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否激活高亮',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父类id',
  `url` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单地址',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of la_sidebars
-- ----------------------------
INSERT INTO `la_sidebars` VALUES ('1', '系统设置', '', '', '0', '0', '', '2017-09-14 17:08:21', '2017-09-14 17:08:21');
INSERT INTO `la_sidebars` VALUES ('2', '角色列表', '', 'rbac_role_index', '0', '1', 'admin/role', '2017-09-14 17:08:21', '2017-09-14 17:08:21');
INSERT INTO `la_sidebars` VALUES ('3', '权限列表', '', 'rbac_privilege_index', '0', '1', 'admin/privilege', '2017-09-14 17:08:21', '2017-09-14 17:08:21');
INSERT INTO `la_sidebars` VALUES ('4', '菜单列表', '', 'rbac_sidebar_index', '0', '1', 'admin/sidebar', '2017-09-14 17:08:21', '2017-09-14 17:08:21');
INSERT INTO `la_sidebars` VALUES ('5', '管理员列表', '', 'rabc_admin_index', '0', '1', 'admin/admin', '2017-09-14 17:08:21', '2017-09-14 17:08:21');
INSERT INTO `la_sidebars` VALUES ('6', '文章管理', '', '', '0', '0', '', '2017-09-14 17:08:21', '2017-09-14 17:08:21');
INSERT INTO `la_sidebars` VALUES ('7', '文章分类', '', 'category_index', '0', '6', 'admin/category', '2017-09-14 17:08:21', '2017-09-14 17:08:21');
INSERT INTO `la_sidebars` VALUES ('8', '文章列表', '', 'article_index', '0', '6', 'admin/article', '2017-09-14 17:08:21', '2017-09-14 17:08:21');
INSERT INTO `la_sidebars` VALUES ('9', '标签列表', '', 'tag_index', '0', '6', 'admin/tag', '2017-09-14 17:08:21', '2017-09-14 17:08:21');

-- ----------------------------
-- Table structure for la_tags
-- ----------------------------
DROP TABLE IF EXISTS `la_tags`;
CREATE TABLE `la_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标签名称',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of la_tags
-- ----------------------------
INSERT INTO `la_tags` VALUES ('1', 'jquery', null, '2017-09-23 11:00:20');
INSERT INTO `la_tags` VALUES ('3', 'linux', '2017-09-23 10:53:27', '2017-09-23 10:53:27');

-- ----------------------------
-- Table structure for la_users
-- ----------------------------
DROP TABLE IF EXISTS `la_users`;
CREATE TABLE `la_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of la_users
-- ----------------------------
INSERT INTO `la_users` VALUES ('1', 'Prof. Kenya Ondricka DVM', 'jett.windler@example.net', '$2y$10$4PMsmbT8EjgJcgY/CXm0je5ZtmEtEUcmYFW6Tt4MEOoSgyaoxeAUy', 'qvT6nXBs3i', '2017-09-18 15:07:20', '2017-09-18 15:07:20');
INSERT INTO `la_users` VALUES ('2', 'Vito Sporer', 'maggie77@example.com', '$2y$10$4PMsmbT8EjgJcgY/CXm0je5ZtmEtEUcmYFW6Tt4MEOoSgyaoxeAUy', '0UHh1zupQD', '2017-09-18 15:08:23', '2017-09-18 15:08:23');
INSERT INTO `la_users` VALUES ('3', 'Camden Osinski II', 'mac34@example.com', '$2y$10$4PMsmbT8EjgJcgY/CXm0je5ZtmEtEUcmYFW6Tt4MEOoSgyaoxeAUy', 'j8ohvKnadZ', '2017-09-18 15:08:24', '2017-09-18 15:08:24');
INSERT INTO `la_users` VALUES ('4', 'Miss Elnora Dibbert', 'rossie.johnston@example.net', '$2y$10$4PMsmbT8EjgJcgY/CXm0je5ZtmEtEUcmYFW6Tt4MEOoSgyaoxeAUy', '916QwjtK4d', '2017-09-18 15:08:24', '2017-09-18 15:08:24');
INSERT INTO `la_users` VALUES ('5', 'Hazel Mueller Jr.', 'otis97@example.com', '$2y$10$4PMsmbT8EjgJcgY/CXm0je5ZtmEtEUcmYFW6Tt4MEOoSgyaoxeAUy', 'XnCl0ffJqh', '2017-09-18 15:08:24', '2017-09-18 15:08:24');
INSERT INTO `la_users` VALUES ('6', 'Linda Rippin', 'keeley35@example.net', '$2y$10$4PMsmbT8EjgJcgY/CXm0je5ZtmEtEUcmYFW6Tt4MEOoSgyaoxeAUy', 'H2hesA5F4i', '2017-09-18 15:08:24', '2017-09-18 15:08:24');
