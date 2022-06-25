#listen_test_v2_0 数据字典
### 1.  `admin` 后台管理员表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| creator_id | int(11) | int | 11 | NO | 1 | 创建者ID | 
| name | char(50) | char | 50 | NO |  | 管理员名称 | 
| username | char(50) | char | 50 | NO |  | 登录账户名 | 
| password_hash | varchar(255) | varchar | 255 | NO |  | 密码 | 
| status | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 管理员状态，0禁用，1启用 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `creator_id` int(11) NOT NULL DEFAULT '1' COMMENT '创建者ID',
  `name` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员名称',
  `username` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登录账户名',
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '密码',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '管理员状态，0禁用，1启用',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_username` (`username`) USING BTREE COMMENT '登录账户名索引',
  KEY `idx_creator_id` (`creator_id`) USING BTREE COMMENT '创建者索引'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【后台管理】后台管理员表'
```
### 2.  `admin_right` 【后台管理】管理员权限表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| parent_id | int(11) | int | 11 | NO | 0 | 父级id | 
| api_route | char(50) | char | 50 | NO |  | 接口路由 | 
| module | char(50) | char | 50 | NO |  | 模块名称 | 
| name | char(60) | char | 60 | NO |  | 权限名称 | 
| status | tinyint(1) | tinyint | 1 | NO | 1 | 启用状态，0禁用，1启用 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `admin_right` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父级id',
  `api_route` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '接口路由',
  `module` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '模块名称',
  `name` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '权限名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '启用状态，0禁用，1启用',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_api_route` (`api_route`) USING BTREE,
  KEY `idx_parent_id` (`parent_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【后台管理】管理员权限表'
```
### 3.  `admin_robot` 【管理后台】机器人表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) | int | 11 | NO | NULL |  | 
| user_id | char(24) | char | 24 | NO |  | 机器人的用户id | 
| work_time | varchar(100) | varchar | 100 | NO |  | 活动时间：小时，逗号分隔 | 
| rate_visit | tinyint(1) | tinyint | 1 | NO | 1 | 浏览速度：每小时浏览内容次数   1/h - 127/h | 
| rate_like | tinyint(1) | tinyint | 1 | NO | 1 | 点赞概率：浏览文章后点赞的概率(1%-100%) | 
| status | tinyint(1) | tinyint | 1 | NO | 1 | 机器人状态：0关机，1开机 | 
| created_at | int(22) | int | 22 | NO | 0 | 创建时间 | 
| updated_at | int(22) | int | 22 | NO | 0 | 更新时间 | 
| last_visit_at | int(22) | int | 22 | NO | 0 | 最后浏览时间 | 
建表语句：
```sql
CREATE TABLE `admin_robot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '机器人的用户id',
  `work_time` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '活动时间：小时，逗号分隔',
  `rate_visit` tinyint(1) NOT NULL DEFAULT '1' COMMENT '浏览速度：每小时浏览内容次数   1/h - 127/h',
  `rate_like` tinyint(1) NOT NULL DEFAULT '1' COMMENT '点赞概率：浏览文章后点赞的概率(1%-100%)',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '机器人状态：0关机，1开机',
  `created_at` int(22) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(22) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `last_visit_at` int(22) NOT NULL DEFAULT '0' COMMENT '最后浏览时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【后台管理】机器人表'
```
### 4.  `admin_role` 管理员角色表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| name | char(100) | char | 100 | NO |  | 角色名称 | 
| description | varchar(600) | varchar | 600 | NO |  | 角色描述 | 
| status | tinyint(1) | tinyint | 1 | NO | 1 | 启用状态，0禁用，1启用 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `admin_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `description` varchar(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '启用状态，0禁用，1启用',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【后台管理】管理员角色表'
```
### 5.  `admin_role_relevance` 【后台管理】管理员角色关联表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| admin_id | int(11) | int | 11 | NO | 0 | 管理员ID | 
| role_id | int(11) | int | 11 | NO | 0 | 角色ID | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
建表语句：
```sql
CREATE TABLE `admin_role_relevance` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色ID',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_admin_id` (`admin_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【后台管理】管理员角色关联表'
```
### 6.  `auth_wechat` 微信授权表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| openid | char(35) | char | 35 | NO |  | 微信授权后的openid | 
| unionid | char(35) | char | 35 | NO |  | 用户统一标识。针对一个微信开放平台帐号下的应用，同一用户的 unionid 是唯一的。 | 
| nickname | varchar(255) | varchar | 255 | NO |  | 微信名称 | 
| gender | tinyint(1) | tinyint | 1 | NO | 1 | 用户性别，1 为男性，2 为女性 | 
| avatar | varchar(255) | varchar | 255 | NO |  | 用户头像，微信地址 | 
| local_avatar | varchar(255) | varchar | 255 | NO |  | 用户头像，oss静态资源地址 | 
| is_deleted | tinyint(1) | tinyint | 1 | NO | 0 | 用户是否取消绑定，0否1是 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `auth_wechat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `openid` char(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '微信授权后的openid',
  `unionid` char(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户统一标识。针对一个微信开放平台帐号下的应用，同一用户的 unionid 是唯一的。',
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '微信名称',
  `gender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户性别，1 为男性，2 为女性',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户头像，微信地址',
  `local_avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户头像，oss静态资源地址',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户是否取消绑定，0否1是',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_unionid` (`unionid`) USING BTREE,
  KEY `idx_openid` (`openid`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【第三方授权】微信授权表'
```
### 7.  `config` <配置>基础配置表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) | int | 11 | NO | NULL | 自增ID | 
| key | varchar(50) | varchar | 50 | NO |  | 键 | 
| value | text | text |  | NO | NULL | 值 | 
| is_server | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 服务端是否使用，0不使用，1使用 | 
| is_client | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 客户端是否使用，0不使用，1使用 | 
| status | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 启用状态，0禁用，1启用 | 
建表语句：
```sql
CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `key` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '键',
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '值',
  `is_server` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '服务端是否使用，0不使用，1使用',
  `is_client` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '客户端是否使用，0不使用，1使用',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '启用状态，0禁用，1启用',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_key` (`key`) USING BTREE,
  KEY `idx_is_server` (`is_server`) USING BTREE,
  KEY `idx_is_client` (`is_client`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<配置>基础配置表'
```
### 8.  `feed_dynamic` 【feed推送】动态feed推送记录表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) | int | 11 | NO | NULL |  | 
| dynamic_id | varchar(24) | varchar | 24 | NO | NULL | 动态id | 
| user_id | varchar(24) | varchar | 24 | NO |  | 用户id | 
| is_view | tinyint(1) | tinyint | 1 | NO | 1 | 是否可见，0否1是 | 
| is_deleted | tinyint(1) | tinyint | 1 | NO | 0 | 0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间 | 
| updated_at | int(11) | int | 11 | NO | 0 | 最后修改时间戳 | 
| apply_at | int(11) | int | 11 | NO | 0 | 动态创建时间 | 
建表语句：
```sql
CREATE TABLE `feed_dynamic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dynamic_id` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '动态id',
  `user_id` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户id',
  `is_view` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否可见，0否1是',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '最后修改时间戳',
  `apply_at` int(11) NOT NULL DEFAULT '0' COMMENT '动态创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `dynamic_id` (`dynamic_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【feed推送】动态feed推送记录表'
```
### 9.  `feed_message_announce` 系统公告消息feed表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| announce_id | int(11) | int | 11 | NO | 0 | 对应[sys_announce]表ID：系统公告ID | 
| is_issue | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否分发，0未分发，1已分发 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
建表语句：
```sql
CREATE TABLE `feed_message_announce` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `announce_id` int(11) NOT NULL DEFAULT '0' COMMENT '对应[sys_announce]表ID：系统公告ID',
  `is_issue` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否分发，0未分发，1已分发',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_is_issue` (`is_issue`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<feed流>系统公告消息feed表'
```
### 10.  `feed_message_comment` 评论/回复消息feed表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| sender_id | char(24) | char | 24 | NO |  | 点赞动作发起者ID | 
| receive_id | char(24) | char | 24 | NO |  | 点赞动作接收者ID | 
| target_id | char(24) | char | 24 | NO |  | 目标对象ID | 
| target_type | tinyint(1) | tinyint | 1 | NO | 1 | 目标对象类型：1文章，2笔记，3评论，4回复 | 
| is_issue | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否分发，0未分发，1已分发 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
建表语句：
```sql
CREATE TABLE `feed_message_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `sender_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '点赞动作发起者ID',
  `receive_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '点赞动作接收者ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '目标对象ID',
  `target_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '目标对象类型：1文章，2笔记，3评论，4回复',
  `is_issue` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否分发，0未分发，1已分发',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_is_issue` (`is_issue`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<feed流>评论/回复消息feed表'
```
### 11.  `feed_message_like` 点赞消息feed表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| sender_id | char(24) | char | 24 | NO |  | 点赞动作发起者ID | 
| receive_id | char(24) | char | 24 | NO |  | 点赞动作接收者ID | 
| target_id | char(24) | char | 24 | NO |  | 目标对象ID | 
| target_type | tinyint(1) | tinyint | 1 | NO | 1 | 目标对象类型：1文章，2笔记，3评论，4回复 | 
| is_issue | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否分发，0未分发，1已分发 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 最后修改时间戳 | 
建表语句：
```sql
CREATE TABLE `feed_message_like` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `sender_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '点赞动作发起者ID',
  `receive_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '点赞动作接收者ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '目标对象ID',
  `target_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '目标对象类型：1文章，2笔记，3评论，4回复',
  `is_issue` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否分发，0未分发，1已分发',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '最后修改时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_is_issue` (`is_issue`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<feed流>点赞消息feed表'
```
### 12.  `feed_note` 
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) | int | 11 | NO | NULL |  | 
| note_id | varchar(24) | varchar | 24 | NO | NULL | 笔记id | 
| user_id | varchar(24) | varchar | 24 | NO |  | 笔记用户id | 
| is_shield | tinyint(1) | tinyint | 1 | NO | 0 | 是否屏蔽，0否1是 | 
| is_deleted | tinyint(1) | tinyint | 1 | NO | 0 | 0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间 | 
| updated_at | int(11) | int | 11 | NO | 0 | 最后修改时间戳 | 
| apply_at | int(11) | int | 11 | NO | 0 | 笔记创建时间 | 
建表语句：
```sql
CREATE TABLE `feed_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note_id` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '笔记id',
  `user_id` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '笔记用户id',
  `is_shield` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否屏蔽，0否1是',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '最后修改时间戳',
  `apply_at` int(11) NOT NULL DEFAULT '0' COMMENT '笔记创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `note_id` (`note_id`) USING BTREE,
  KEY `is_shield` (`is_shield`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `del` (`is_deleted`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2433 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【feed推送】笔记feed推送记录表'
```
### 13.  `index_article` <暂时-索引>文章表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| article_id | char(24) | char | 24 | NO |  | 文章ID | 
| author_id | char(24) | char | 24 | NO |  | 用户ID | 
| spider_original_id | tinyint(1) | tinyint | 1 | NO | 0 | 对应[spider_original]表ID | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 删除状态，0正常，1删除 | 
| is_shield | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 屏蔽状态，0正常，1屏蔽 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `index_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `article_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文章ID',
  `author_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `spider_original_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT '对应[spider_original]表ID',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '删除状态，0正常，1删除',
  `is_shield` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '屏蔽状态，0正常，1屏蔽',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_article_id` (`article_id`) USING BTREE,
  KEY `idx_is_deleted` (`is_deleted`) USING BTREE,
  KEY `idx_is_shield` (`is_shield`) USING BTREE,
  KEY `idx_author_id` (`author_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6303 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<暂时-索引>文章表'
```
### 14.  `index_collect_package` <暂时-索引>收藏夹表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| collect_package_id | char(24) | char | 24 | NO |  | 收藏夹ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| collect_package_name | char(90) | char | 90 | NO |  | 收藏夹名称 | 
| is_default | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否为官方默认收藏夹，0正常，1删除 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| is_public | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否公开，0私密，1公开 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `index_collect_package` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `collect_package_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '收藏夹ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `collect_package_name` char(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '收藏夹名称',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为官方默认收藏夹，0正常，1删除',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `is_public` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否公开，0私密，1公开',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=303 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<暂时-索引>收藏夹表'
```
### 15.  `index_comment` <暂时-索引>评论和回复表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| comment_id | char(24) | char | 24 | NO |  | 评论ID | 
| reply_id | char(24) | char | 24 | NO |  | 回复ID | 
| target_id | char(24) | char | 24 | NO |  | 评论的目标ID | 
| target_type | tinyint(1) | tinyint | 1 | NO | 1 | 评论目标类型：1文章，2笔记，5动态 | 
| user_id | char(24) | char | 24 | NO |  | 发起评论/回复用户ID | 
| to_user_id | char(24) | char | 24 | NO |  | 被回复用户ID | 
| type | tinyint(1) | tinyint | 1 | NO | 3 | 类型，3评论，4回复 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 删除状态，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
| is_shield | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否屏蔽，0正常，1屏蔽 | 
建表语句：
```sql
CREATE TABLE `index_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `comment_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '评论ID',
  `reply_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '回复ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '评论的目标ID',
  `target_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '评论目标类型：1文章，2笔记，5动态',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '发起评论/回复用户ID',
  `to_user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '被回复用户ID',
  `type` tinyint(1) NOT NULL DEFAULT '3' COMMENT '类型，3评论，4回复',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '删除状态，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  `is_shield` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否屏蔽，0正常，1屏蔽',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_is_deleted` (`is_deleted`) USING BTREE,
  KEY `idx_comment_id` (`comment_id`) USING BTREE,
  KEY `idx_reply_id` (`reply_id`) USING BTREE,
  KEY `idx_target_id` (`target_id`) USING BTREE,
  KEY `idx_target_type` (`target_type`) USING BTREE,
  KEY `idx_type` (`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<暂时-索引>评论和回复表'
```
### 16.  `index_note` <暂时-前台使用-索引>笔记表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| note_id | char(24) | char | 24 | NO |  | 笔记ID | 
| article_id | char(24) | char | 24 | NO |  | 文章ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| start_index | int(11) | int | 11 | NO | 0 | 选中部分在文章中的位置 | 
| end_index | int(11) | int | 11 | NO | NULL | 选中部分在文章中结束的位置 | 
| is_choice | tinyint(1) | tinyint | 1 | NO | 0 | 是否被精选，0否，1是 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 删除状态，0正常，1删除 | 
| is_public | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 是否公开，0私密，1公开 | 
| is_shield | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 屏蔽状态，0正常，1屏蔽 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
| type | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 笔记类型，1文章笔记，2文章划线笔记，3纯文字笔记，4带图的笔记 | 
建表语句：
```sql
CREATE TABLE `index_note` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `note_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '笔记ID',
  `article_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文章ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `start_index` int(11) NOT NULL DEFAULT '0' COMMENT '选中部分在文章中的位置',
  `end_index` int(11) NOT NULL COMMENT '选中部分在文章中结束的位置',
  `is_choice` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否被精选，0否，1是',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '删除状态，0正常，1删除',
  `is_public` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否公开，0私密，1公开',
  `is_shield` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '屏蔽状态，0正常，1屏蔽',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '笔记类型，1文章笔记，2文章划线笔记，3纯文字笔记，4带图的笔记',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7819 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<暂时-前台使用-索引>笔记表'
```
### 17.  `index_search_collect` <暂时-前台使用-索引>收藏搜索索引表-存文章标题、笔记内容
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| collect_id | char(24) | char | 24 | NO |  | 收藏记录id | 
| search_title | longtext | longtext |  | NO | NULL | 笔记或文章的标题 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
| user_id | varchar(24) | varchar | 24 | NO |  | 用户ID | 
| is_deleted | tinyint(1) | tinyint | 1 | NO | 0 | 0正常，1删除 | 
| package_id | int(11) | int | 11 | NO | 0 | 收藏夹ID | 
建表语句：
```sql
CREATE TABLE `index_search_collect` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `collect_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '收藏记录id',
  `search_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '笔记或文章的标题',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  `user_id` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0正常，1删除',
  `package_id` int(11) NOT NULL DEFAULT '0' COMMENT '收藏夹ID',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `uk_note_id` (`collect_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1248 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<暂时-前台使用-索引>收藏搜索索引表-存文章标题、笔记内容'
```
### 18.  `index_search_note` 【笔记-搜索索引表】笔记索引表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) | int | 11 | NO | NULL |  | 
| note_id | char(24) | char | 24 | NO |  | 笔记ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| article_id | char(24) | char | 24 | NO |  | 文章ID | 
| type | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 笔记类型，1文章笔记，2文章划线笔记，3纯文字笔记，4带图的笔记 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 删除状态，0正常，1删除 | 
| is_public | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 是否公开，0私密，1公开 | 
| is_shield | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 屏蔽状态，0正常，1屏蔽 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
| content | longtext | longtext |  | NO | NULL | 笔记内容 | 
建表语句：
```sql
CREATE TABLE `index_search_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '笔记ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `article_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文章ID',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '笔记类型，1文章笔记，2文章划线笔记，3纯文字笔记，4带图的笔记',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '删除状态，0正常，1删除',
  `is_public` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否公开，0私密，1公开',
  `is_shield` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '屏蔽状态，0正常，1屏蔽',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '笔记内容',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3502 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【笔记-搜索索引表】笔记索引表'
```
### 19.  `library_file` <资源>资源库
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| type | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 类型，1文章，2用户，3智囊团 | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| target_id | char(24) | char | 24 | NO |  | 目标ID | 
| file_hash | char(40) | char | 40 | NO |  | 文件Hash | 
| url | char(40) | char | 40 | NO |  | 链接 | 
| original | text | text |  | NO | NULL | 原文件名 | 
| size | int(11) unsigned | int | 11 | NO | 0 | 文件大小 | 
| postfix | char(10) | char | 10 | NO |  | 文件后缀 | 
| file_mime | char(10) | char | 10 | NO |  | mime类型 | 
| from | tinyint(1) | tinyint | 1 | NO | 0 | 来自，0前台，1后台 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `library_file` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型，1文章，2用户，3智囊团',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '目标ID',
  `file_hash` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件Hash',
  `url` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '链接',
  `original` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '原文件名',
  `size` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `postfix` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件后缀',
  `file_mime` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'mime类型',
  `from` tinyint(1) NOT NULL DEFAULT '0' COMMENT '来自，0前台，1后台',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_file_hash` (`file_hash`) USING BTREE,
  UNIQUE KEY `uk_oss_name` (`url`) USING BTREE,
  KEY `idx_type` (`type`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE,
  KEY `idx_target_id` (`target_id`) USING BTREE,
  KEY `idx_is_deleted` (`is_deleted`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<资源>资源库'
```
### 20.  `log_article_repair_url_upload` 【日志】文章静态资源替换上传log
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL |  | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| article_id | char(24) | char | 24 | NO |  | 文章ID | 
| resource_file_name | char(40) | char | 40 | NO |  | 静态资源文件名 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
| original_url | varchar(1000) | varchar | 1000 | NO |  | 原文件地址 | 
| type | tinyint(1) | tinyint | 1 | NO | 0 | 图片替换类型 0文章内容图片替换 1文章封面图替换 | 
| status | tinyint(40) | tinyint | 40 | NO | 1 | 上传状态 1上传成功 0上传失败 | 
建表语句：
```sql
CREATE TABLE `log_article_repair_url_upload` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `article_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文章ID',
  `resource_file_name` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '静态资源文件名',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  `original_url` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '原文件地址',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '图片替换类型 0文章内容图片替换 1文章封面图替换',
  `status` tinyint(40) NOT NULL DEFAULT '1' COMMENT '上传状态 1上传成功 0上传失败',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE,
  KEY `idx_target_id` (`article_id`) USING BTREE,
  KEY `uk_oss_name` (`resource_file_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【日志】文章静态资源替换上传log'
```
### 21.  `log_count_202001` <日志>统计日志表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| send_user_id | char(24) | char | 24 | NO |  | 动作发起用户ID | 
| receive_user_id | char(24) | char | 24 | NO |  | 动作接收用户ID | 
| target_id | char(24) | char | 24 | NO |  | 动作的主体ID，如用户评论后，此评论的主体 | 
| target_type | tinyint(1) | tinyint | 1 | NO | 1 | 动作的主体类型：1文章，2笔记，3评论，4回复，5动态，6收藏夹 | 
| action_id | char(24) | char | 24 | NO |  | 动作的ID，如用户评论后产生的ID | 
| action_type | tinyint(1) | tinyint | 1 | NO | 1 | 看文档【V2值域】 | 
| count_num | tinyint(1) | tinyint | 1 | NO | 1 | 计数值 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
建表语句：
```sql
CREATE TABLE `log_count_202001` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `send_user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动作发起用户ID',
  `receive_user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动作接收用户ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动作的主体ID，如用户评论后，此评论的主体',
  `target_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '动作的主体类型：1文章，2笔记，3评论，4回复，5动态，6收藏夹',
  `action_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动作的ID，如用户评论后产生的ID',
  `action_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '看文档【V2值域】',
  `count_num` tinyint(1) NOT NULL DEFAULT '1' COMMENT '计数值',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_send_user_id` (`send_user_id`) USING BTREE,
  KEY `idx_receive_user_id` (`receive_user_id`) USING BTREE,
  KEY `idx_target_id` (`target_id`) USING BTREE,
  KEY `idx_target_type` (`target_type`) USING BTREE,
  KEY `idx_action_type` (`action_type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<日志>统计日志表'
```
### 22.  `log_count_202002` <日志>统计日志表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| send_user_id | char(24) | char | 24 | NO |  | 动作发起用户ID | 
| receive_user_id | char(24) | char | 24 | NO |  | 动作接收用户ID | 
| target_id | char(24) | char | 24 | NO |  | 动作的主体ID，如用户评论后，此评论的主体 | 
| target_type | tinyint(1) | tinyint | 1 | NO | 1 | 动作的主体类型：1文章，2笔记，3评论，4回复，5动态，6收藏夹 | 
| action_id | char(24) | char | 24 | NO |  | 动作的ID，如用户评论后产生的ID | 
| action_type | tinyint(1) | tinyint | 1 | NO | 1 | 看文档【V2值域】 | 
| count_num | tinyint(1) | tinyint | 1 | NO | 1 | 计数值 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
建表语句：
```sql
CREATE TABLE `log_count_202002` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `send_user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动作发起用户ID',
  `receive_user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动作接收用户ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动作的主体ID，如用户评论后，此评论的主体',
  `target_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '动作的主体类型：1文章，2笔记，3评论，4回复，5动态，6收藏夹',
  `action_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动作的ID，如用户评论后产生的ID',
  `action_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '看文档【V2值域】',
  `count_num` tinyint(1) NOT NULL DEFAULT '1' COMMENT '计数值',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_send_user_id` (`send_user_id`) USING BTREE,
  KEY `idx_receive_user_id` (`receive_user_id`) USING BTREE,
  KEY `idx_target_id` (`target_id`) USING BTREE,
  KEY `idx_target_type` (`target_type`) USING BTREE,
  KEY `idx_action_type` (`action_type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<日志>统计日志表'
```
### 23.  `log_count_202003` <日志>统计日志表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| send_user_id | char(24) | char | 24 | NO |  | 动作发起用户ID | 
| receive_user_id | char(24) | char | 24 | NO |  | 动作接收用户ID | 
| target_id | char(24) | char | 24 | NO |  | 动作的主体ID，如用户评论后，此评论的主体 | 
| target_type | tinyint(1) | tinyint | 1 | NO | 1 | 动作的主体类型：1文章，2笔记，3评论，4回复，5动态，6收藏夹 | 
| action_id | char(24) | char | 24 | NO |  | 动作的ID，如用户评论后产生的ID | 
| action_type | tinyint(1) | tinyint | 1 | NO | 1 | 看文档【V2值域】 | 
| count_num | tinyint(1) | tinyint | 1 | NO | 1 | 计数值 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
建表语句：
```sql
CREATE TABLE `log_count_202003` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `send_user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动作发起用户ID',
  `receive_user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动作接收用户ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动作的主体ID，如用户评论后，此评论的主体',
  `target_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '动作的主体类型：1文章，2笔记，3评论，4回复，5动态，6收藏夹',
  `action_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动作的ID，如用户评论后产生的ID',
  `action_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '看文档【V2值域】',
  `count_num` tinyint(1) NOT NULL DEFAULT '1' COMMENT '计数值',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_send_user_id` (`send_user_id`) USING BTREE,
  KEY `idx_receive_user_id` (`receive_user_id`) USING BTREE,
  KEY `idx_target_id` (`target_id`) USING BTREE,
  KEY `idx_target_type` (`target_type`) USING BTREE,
  KEY `idx_action_type` (`action_type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7871 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<日志>统计日志表'
```
### 24.  `log_count_202004` <日志>统计日志表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| send_user_id | char(24) | char | 24 | NO |  | 动作发起用户ID | 
| receive_user_id | char(24) | char | 24 | NO |  | 动作接收用户ID | 
| target_id | char(24) | char | 24 | NO |  | 动作的主体ID，如用户评论后，此评论的主体 | 
| target_type | tinyint(1) | tinyint | 1 | NO | 1 | 动作的主体类型：1文章，2笔记，3评论，4回复，5动态，6收藏夹 | 
| action_id | char(24) | char | 24 | NO |  | 动作的ID，如用户评论后产生的ID | 
| action_type | tinyint(1) | tinyint | 1 | NO | 1 | 看文档【V2值域】 | 
| count_num | tinyint(1) | tinyint | 1 | NO | 1 | 计数值 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
建表语句：
```sql
CREATE TABLE `log_count_202004` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `send_user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动作发起用户ID',
  `receive_user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动作接收用户ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动作的主体ID，如用户评论后，此评论的主体',
  `target_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '动作的主体类型：1文章，2笔记，3评论，4回复，5动态，6收藏夹',
  `action_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动作的ID，如用户评论后产生的ID',
  `action_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '看文档【V2值域】',
  `count_num` tinyint(1) NOT NULL DEFAULT '1' COMMENT '计数值',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_send_user_id` (`send_user_id`) USING BTREE,
  KEY `idx_receive_user_id` (`receive_user_id`) USING BTREE,
  KEY `idx_target_id` (`target_id`) USING BTREE,
  KEY `idx_target_type` (`target_type`) USING BTREE,
  KEY `idx_action_type` (`action_type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1253 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<日志>统计日志表'
```
### 25.  `log_login_202003` <日志>登录日志表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| code | int(11) | int | 11 | NO | 200 | 登录结果code | 
| input_login_name | char(30) | char | 30 | NO |  | 登录账户，可能为手机号、微信的unionid | 
| ip | varchar(15) | varchar | 15 | NO |  | ip地址 | 
| login_type | tinyint(1) | tinyint | 1 | NO | 1 | 登录方式，1一键登录，2手机号验证码，3手机号密码，3微信 | 
| platform | tinyint(1) | tinyint | 1 | NO | 1 | 1PC，2安卓，3iOS | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
建表语句：
```sql
CREATE TABLE `log_login_202003` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `code` int(11) NOT NULL DEFAULT '200' COMMENT '登录结果code',
  `input_login_name` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登录账户，可能为手机号、微信的unionid',
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'ip地址',
  `login_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '登录方式，1一键登录，2手机号验证码，3手机号密码，3微信',
  `platform` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1PC，2安卓，3iOS',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<日志>登录日志表'
```
### 26.  `log_spider` <爬虫>爬虫日志表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| url | varchar(1000) | varchar | 1000 | NO |  | 公众号Url | 
| type | tinyint(1) | tinyint | 1 | NO | 0 | 类型，0预览，1保存 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
建表语句：
```sql
CREATE TABLE `log_spider` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `url` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '公众号Url',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型，0预览，1保存',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<爬虫>爬虫日志表'
```
### 27.  `login_mobile` 【登录令牌】手机端令牌表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| device_id | char(50) | char | 50 | NO |  | android设备id | 
| access_token | char(88) | char | 88 | NO |  | 接口调用令牌 | 
| refresh_token | char(88) | char | 88 | NO |  | 刷新令牌 | 
| expired_at | int(11) | int | 11 | NO | 0 | 令牌过期时间 | 
| refresh_expired_at | int(11) | int | 11 | NO | 0 | 刷新令牌过期时间 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `login_mobile` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `device_id` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'android设备id',
  `access_token` char(88) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '接口调用令牌',
  `refresh_token` char(88) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '刷新令牌',
  `expired_at` int(11) NOT NULL DEFAULT '0' COMMENT '令牌过期时间',
  `refresh_expired_at` int(11) NOT NULL DEFAULT '0' COMMENT '刷新令牌过期时间',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【登录令牌】手机端令牌表'
```
### 28.  `login_web` 【登录令牌】web端令牌表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| access_token | char(88) | char | 88 | NO |  | 接口调用令牌 | 
| refresh_token | char(88) | char | 88 | NO |  | 刷新令牌 | 
| expired_at | int(11) | int | 11 | NO | 0 | 令牌过期时间 | 
| refresh_expired_at | int(11) | int | 11 | NO | 0 | 刷新令牌过期时间 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `login_web` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `access_token` char(88) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '接口调用令牌',
  `refresh_token` char(88) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '刷新令牌',
  `expired_at` int(11) NOT NULL DEFAULT '0' COMMENT '令牌过期时间',
  `refresh_expired_at` int(11) NOT NULL DEFAULT '0' COMMENT '刷新令牌过期时间',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【登录令牌】web端令牌表'
```
### 29.  `pro` 【智囊团】智囊团表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| nickname | varchar(60) | varchar | 60 | NO |  | 昵称 | 
| phone | varchar(20) | varchar | 20 | NO |  | 智囊团手机号，初始值一直等于对应用户的phone | 
| avatar | varchar(255) | varchar | 255 | NO |  | 用户头像 | 
| description | varchar(1500) | varchar | 1500 | NO |  | 描述 | 
| status | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 启用状态，0禁用，1启用 | 
| weight | int(11) | int | 11 | NO | 0 | 排序权重 | 
| is_recommend | tinyint(1) | tinyint | 1 | NO | 1 | 是否推荐，0否，1是 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `pro` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `nickname` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '智囊团手机号，初始值一直等于对应用户的phone',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户头像',
  `description` varchar(1500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '描述',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '启用状态，0禁用，1启用',
  `weight` int(11) NOT NULL DEFAULT '0' COMMENT '排序权重',
  `is_recommend` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否推荐，0否，1是',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【智囊团】智囊团表'
```
### 30.  `pro_category` 【智囊团】智囊团分类
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| name | char(30) | char | 30 | NO |  | 名称 | 
| member_count | int(11) | int | 11 | NO | 0 | 成员数量 | 
| weight | int(11) | int | 11 | NO | 0 | 排序权重 | 
| status | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 启用状态，0禁用，1启用 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `pro_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `member_count` int(11) NOT NULL DEFAULT '0' COMMENT '成员数量',
  `weight` int(11) NOT NULL DEFAULT '0' COMMENT '排序权重',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '启用状态，0禁用，1启用',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【智囊团】智囊团分类'
```
### 31.  `pro_category_relevance` 【智囊团】智囊团_分类关联表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| pro_id | int(11) | int | 11 | NO | 0 | 智囊团ID | 
| category_id | int(11) | int | 11 | NO | 0 | 智囊团分类ID | 
| weight | int(11) | int | 11 | NO | 0 | 排序权重 | 
| status | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 启用状态，0禁用，1启用 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| is_recommend | tinyint(1) | tinyint | 1 | NO | 1 | 是否推荐，0否，1是 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `pro_category_relevance` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `pro_id` int(11) NOT NULL DEFAULT '0' COMMENT '智囊团ID',
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '智囊团分类ID',
  `weight` int(11) NOT NULL DEFAULT '0' COMMENT '排序权重',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '启用状态，0禁用，1启用',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `is_recommend` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否推荐，0否，1是',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【智囊团】智囊团_分类关联表'
```
### 32.  `spider_content` <爬虫>内容表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| url | varchar(1000) | varchar | 1000 | NO |  | 第三方平台url | 
| content | longtext | longtext |  | NO | NULL | 替换标签后的内容 | 
| original_content | longtext | longtext |  | NO | NULL | 原始文章内容 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `spider_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `url` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '第三方平台url',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '替换标签后的内容',
  `original_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '原始文章内容',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4949 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<爬虫>内容表'
```
### 33.  `spider_info` <爬虫>基础属性表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| spider_original_id | tinyint(1) | tinyint | 1 | NO | 1 | 对应[spider_original]表ID | 
| third_platform_id | varchar(50) | varchar | 50 | NO |  | 第三方平台ID | 
| url | varchar(1000) | varchar | 1000 | NO |  | url | 
| title | varchar(255) | varchar | 255 | NO |  | 标题 | 
| cover_url | varchar(2000) | varchar | 2000 | NO |  | 封面图 | 
| author_name | varchar(255) | varchar | 255 | NO |  | 作者昵称 | 
| is_have_media | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否包含音频/视频，0不包含，1包含 | 
| is_invalid | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| original_created_at | char(20) | char | 20 | NO |  | 原文发布时间 | 
| created_at | int(11) | int | 11 | NO | 0 | 抓取时间 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间 | 
建表语句：
```sql
CREATE TABLE `spider_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `spider_original_id` tinyint(1) NOT NULL DEFAULT '1' COMMENT '对应[spider_original]表ID',
  `third_platform_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '第三方平台ID',
  `url` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'url',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标题',
  `cover_url` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '封面图',
  `author_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '作者昵称',
  `is_have_media` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否包含音频/视频，0不包含，1包含',
  `is_invalid` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `original_created_at` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '原文发布时间',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '抓取时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4950 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<爬虫>基础属性表'
```
### 34.  `spider_original` <爬虫>公共基础表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| name | varchar(255) | varchar | 255 | NO |  | 名称 | 
| base_url | varchar(255) | varchar | 255 | NO |  | 基础链接 | 
| status | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否启用，0禁用，1启用 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `spider_original` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `base_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '基础链接',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否启用，0禁用，1启用',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<爬虫>公共基础表'
```
### 35.  `spider_wechat` <爬虫>微信公众号表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| url | varchar(1000) | varchar | 1000 | NO |  | 链接 | 
| description | varchar(500) | varchar | 500 | NO |  | 简介 | 
| account_name | varchar(255) | varchar | 255 | NO |  | 公众号名称 | 
| is_have_media | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否包含音频/视频，0不包含，1包含 | 
| is_invalid | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `spider_wechat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `url` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '链接',
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '简介',
  `account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '公众号名称',
  `is_have_media` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否包含音频/视频，0不包含，1包含',
  `is_invalid` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4947 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<爬虫>微信公众号表'
```
### 36.  `static_code` 静态错误码
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(20) unsigned | int | 20 | NO | NULL |  | 
| key | int(20) | int | 20 | NO | 0 | 错误码 | 
| content | varchar(255) | varchar | 255 | NO |  | 错误描述 | 
| status | tinyint(1) | tinyint | 1 | NO | 2 | 错误码状态1禁用，2正常 | 
建表语句：
```sql
CREATE TABLE `static_code` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` int(20) NOT NULL DEFAULT '0' COMMENT '错误码',
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '错误描述',
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '错误码状态1禁用，2正常',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='静态错误码'
```
### 37.  `sync_counter_target` <计数同步>用户计数同步表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| target_id | char(24) | char | 24 | NO |  | 可能是用户，文章，笔记，评论，回复，动态，收藏夹ID | 
| action_type | tinyint(1) | tinyint | 1 | NO | 1 | 参看文档 | 
| count | int(11) | int | 11 | NO | 0 | 计数 | 
| sync_at | int(11) | int | 11 | NO | 0 | 数据同步时间，精确到天 | 
建表语句：
```sql
CREATE TABLE `sync_counter_target` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '可能是用户，文章，笔记，评论，回复，动态，收藏夹ID',
  `action_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '参看文档',
  `count` int(11) NOT NULL DEFAULT '0' COMMENT '计数',
  `sync_at` int(11) NOT NULL DEFAULT '0' COMMENT '数据同步时间，精确到天',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_target_id` (`target_id`) USING BTREE,
  KEY `idx_action_type` (`action_type`) USING BTREE,
  KEY `idx_sync_at` (`sync_at`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=46781 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<计数同步>用户计数同步表'
```
### 38.  `sync_counter_user` <计数同步>用户计数同步表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| target_id | char(24) | char | 24 | NO |  | 可能是用户，文章，笔记，评论，回复，动态，收藏夹ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| action_type | tinyint(1) | tinyint | 1 | NO | 1 | 参看文档 | 
| count | int(11) | int | 11 | NO | 0 | 计数 | 
| sync_at | int(11) | int | 11 | NO | 0 | 数据同步时间，精确到天 | 
建表语句：
```sql
CREATE TABLE `sync_counter_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '可能是用户，文章，笔记，评论，回复，动态，收藏夹ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `action_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '参看文档',
  `count` int(11) NOT NULL DEFAULT '0' COMMENT '计数',
  `sync_at` int(11) NOT NULL DEFAULT '0' COMMENT '数据同步时间，精确到天',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_action_type` (`action_type`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE,
  KEY `idx_target_id` (`target_id`) USING BTREE,
  KEY `idx_sync_at` (`sync_at`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5096 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<计数同步>用户计数同步表'
```
### 39.  `sys_agreement` 协议表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| title | varchar(255) | varchar | 255 | NO |  | 协议标题 | 
| route | char(20) | char | 20 | NO |  | PC端路由 | 
| url | varchar(255) | varchar | 255 | NO |  | 链接地址 | 
| status | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 启用状态，0禁用，1启用 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_agreement` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '协议标题',
  `route` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'PC端路由',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '链接地址',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '启用状态，0禁用，1启用',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_route` (`route`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<系统支撑>协议表'
```
### 40.  `sys_android_version_config` android 版本控制表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) | int | 11 | NO | NULL |  | 
| version | char(50) | char | 50 | NO |  | 产品版本号 | 
| new_version | char(50) | char | 50 | NO |  | 目前最新的产品版本号 | 
| api_version | int(11) | int | 11 | NO | 0 | api版本号 | 
| build_version | char(50) | char | 50 | NO |  | 构建版本号 | 
| title | varchar(255) | varchar | 255 | NO | NULL | 更新标题 | 
| content | varchar(1000) | varchar | 1000 | NO |  | 更新内容 | 
| updated_url | varchar(255) | varchar | 255 | NO |  | 更新地址，即：点击更新弹窗的确定后跳转的地址 | 
| is_forced_updating | tinyint(1) | tinyint | 1 | NO | 0 | 是否需要强制更新  0 不更新 1更新 2 强制更新 | 
| is_bring | tinyint(1) | tinyint | 1 | NO | 0 | 是否切到提审环境 0否 1是 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_android_version_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '产品版本号',
  `new_version` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '目前最新的产品版本号',
  `api_version` int(11) NOT NULL DEFAULT '0' COMMENT 'api版本号',
  `build_version` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '构建版本号',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '更新标题',
  `content` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '更新内容',
  `updated_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '更新地址，即：点击更新弹窗的确定后跳转的地址',
  `is_forced_updating` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否需要强制更新  0 不更新 1更新 2 强制更新',
  `is_bring` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否切到提审环境 0否 1是',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<系统支撑>安卓版本控制表'
```
### 41.  `sys_announce` 系统公告消息feed表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| template_id | int(11) | int | 11 | NO | 0 | 对应[sys_message_template]表ID | 
| title | varchar(255) | varchar | 255 | NO |  | 标题 | 
| content | text | text |  | NO | NULL | 公告内容json串 | 
| platform | int(11) | int | 11 | NO | 111 | 二进制数，公告发送目的地，数字相加：PC端1，安卓2，iOS4 | 
| template_content_params | text | text |  | NO | NULL | 模板消息内容填充值，以逗号分隔 | 
| is_send | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否发送，0未发送，1已发送 | 
| is_use_template | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否使用模板，0未使用，1使用 | 
| is_revoke | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 撤回状态，0未撤回，1撤回 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 删除状态，0正常，1删除 | 
| send_admin_id | int(11) | int | 11 | NO | 0 | 发送公告的管理员ID | 
| send_at | int(11) | int | 11 | NO | 0 | 发送时间戳 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_announce` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `template_id` int(11) NOT NULL DEFAULT '0' COMMENT '对应[sys_message_template]表ID',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标题',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '公告内容json串',
  `platform` int(11) NOT NULL DEFAULT '111' COMMENT '二进制数，公告发送目的地，数字相加：PC端1，安卓2，iOS4',
  `template_content_params` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '模板消息内容填充值，以逗号分隔',
  `is_send` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否发送，0未发送，1已发送',
  `is_use_template` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否使用模板，0未使用，1使用',
  `is_revoke` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '撤回状态，0未撤回，1撤回',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '删除状态，0正常，1删除',
  `send_admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '发送公告的管理员ID',
  `send_at` int(11) NOT NULL DEFAULT '0' COMMENT '发送时间戳',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【公告】公告表'
```
### 42.  `sys_announce_send_group` 【公告】公告_发送群体表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| announce_id | int(11) | int | 11 | NO | 0 | 对应[sys_announce]表ID | 
| sender_id | char(24) | char | 24 | NO |  | 发布者ID，可能是后台管理员ID/前台用户ID | 
| sender_type | tinyint(1) | tinyint | 1 | NO | 1 | 发布者身份：1后台管理员，2前台用户 | 
| receive_id | longtext | longtext |  | NO | NULL | 接收者ID，以逗号分隔 | 
| receive_type | tinyint(1) | tinyint | 1 | NO | 0 | 0全部用户，1发给指定的用户，2普通用户，3作者 | 
建表语句：
```sql
CREATE TABLE `sys_announce_send_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `announce_id` int(11) NOT NULL DEFAULT '0' COMMENT '对应[sys_announce]表ID',
  `sender_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '发布者ID，可能是后台管理员ID/前台用户ID',
  `sender_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '发布者身份：1后台管理员，2前台用户',
  `receive_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '接收者ID，以逗号分隔',
  `receive_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0全部用户，1发给指定的用户，2普通用户，3作者',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_announce_id` (`announce_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【公告】公告_发送群体表'
```
### 43.  `sys_article_0` 文章表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| article_id | char(24) | char | 24 | NO |  | 文章ID | 
| author_id | char(24) | char | 24 | NO |  | 作者ID | 
| spider_original_id | tinyint(1) | tinyint | 1 | NO | 1 | 对应[spider_original]表ID | 
| original_url | varchar(1000) | varchar | 1000 | NO |  | 对应[spider_info]表url | 
| cover_url | varchar(255) | varchar | 255 | NO |  | 封面图地址 | 
| title | varchar(255) | varchar | 255 | NO |  | 标题 | 
| description | varchar(200) | varchar | 200 | NO |  | 摘要 | 
| status | tinyint(1) | tinyint | 1 | NO | 0 | 标签（如img、video等）替换是否完成，0未完成，1完成 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 删除状态，0正常，1删除 | 
| is_shield | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 屏蔽状态，0正常，1屏蔽 | 
| original_created_at | int(11) | int | 11 | NO | 0 | 第三方平台发布时间戳 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_article_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `article_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文章ID',
  `author_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '作者ID',
  `spider_original_id` tinyint(1) NOT NULL DEFAULT '1' COMMENT '对应[spider_original]表ID',
  `original_url` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '对应[spider_info]表url',
  `cover_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '封面图地址',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标题',
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '摘要',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '标签（如img、video等）替换是否完成，0未完成，1完成',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '删除状态，0正常，1删除',
  `is_shield` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '屏蔽状态，0正常，1屏蔽',
  `original_created_at` int(11) NOT NULL DEFAULT '0' COMMENT '第三方平台发布时间戳',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_article_id` (`article_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3237 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【文章】文章表'
```
### 44.  `sys_article_content_0` 【文章-垂直分表】文章_内容表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| article_id | char(24) | char | 24 | NO |  | 文章ID | 
| content | longtext | longtext |  | NO | NULL | 内容 | 
建表语句：
```sql
CREATE TABLE `sys_article_content_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `article_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文章ID',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_article_id` (`article_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3237 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【文章-垂直分表】文章_内容表'
```
### 45.  `sys_article_original_url_0` 【文章-垂直分表】文章_来源地址表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| article_id | char(24) | char | 24 | NO |  | 文章ID | 
| user_id | char(24) | char | 24 | NO |  | 首次用户ID | 
| original_url | text | text |  | NO | NULL | 来源地址Url，对应[spider_info]表的url | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_article_original_url_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `article_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文章ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '首次用户ID',
  `original_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '来源地址Url，对应[spider_info]表的url',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_article_id` (`article_id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2708 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【文章-垂直分表】文章_来源地址表'
```
### 46.  `sys_article_repair_url_0` 【文章】文章静态资源替换记录
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL |  | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| article_id | char(24) | char | 24 | NO |  | 文章ID | 
| resource_file_name | char(40) | char | 40 | NO |  | 静态资源文件名 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
| original_url | varchar(1000) | varchar | 1000 | NO |  | 原文件地址 | 
| type | tinyint(1) | tinyint | 1 | NO | 0 | 图片替换类型 0文章内容图片替换 1文章封面图替换 | 
建表语句：
```sql
CREATE TABLE `sys_article_repair_url_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `article_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文章ID',
  `resource_file_name` char(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '静态资源文件名',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  `original_url` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '原文件地址',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '图片替换类型 0文章内容图片替换 1文章封面图替换',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE,
  KEY `idx_target_id` (`article_id`) USING BTREE,
  KEY `uk_oss_name` (`resource_file_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=214 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【文章】文章静态资源替换记录'
```
### 47.  `sys_article_user_0` <暂时>文章_用户表（可以找到用户被多少用户收藏）
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| article_id | char(24) | char | 24 | NO |  | 文章ID | 
| user_id | char(24) | char | 24 | NO |  | 首次用户ID | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_article_user_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `article_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文章ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '首次用户ID',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE,
  KEY `idx_article_id` (`article_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3034 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<暂时>文章_用户表（可以找到用户被多少用户收藏）'
```
### 48.  `sys_code` <系统支撑>系统错误码对照表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) | int | 11 | NO | NULL | 自增ID | 
| client_code | int(5) | int | 5 | NO | 0 | 客户端错误码 | 
| description | text | text |  | NO | NULL | 错误码描述 | 
| status | tinyint(1) | tinyint | 1 | NO | 1 | 启用状态，0禁用，1启用 | 
建表语句：
```sql
CREATE TABLE `sys_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `client_code` int(5) NOT NULL DEFAULT '0' COMMENT '客户端错误码',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '错误码描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '启用状态，0禁用，1启用',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_client_code` (`client_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<系统支撑>系统错误码对照表'
```
### 49.  `sys_comment_0` 评论表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| comment_id | char(24) | char | 24 | NO |  | 评论ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| target_id | char(24) | char | 24 | NO |  | 评论的目标ID | 
| target_type | tinyint(1) | tinyint | 1 | NO | 1 | 评论目标类型：1笔记，2动态 | 
| content | varchar(1500) | varchar | 1500 | NO |  | 内容 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 删除状态，0正常，1删除 | 
| is_view | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 是否可见，0不可见，1可见。当评论被删除，但其下有回复时，此时评论是可见的 | 
| is_shield | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否屏蔽，0正常，1屏蔽 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
| hot | int(11) | int | 11 | NO | 0 | 热度，点赞+1 | 
| have_author_reply | tinyint(1) | tinyint | 1 | NO | 0 | 是否有作者回复，0否1是 | 
建表语句：
```sql
CREATE TABLE `sys_comment_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `comment_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '评论ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '评论的目标ID',
  `target_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '评论目标类型：1笔记，2动态',
  `content` varchar(1500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '内容',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '删除状态，0正常，1删除',
  `is_view` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否可见，0不可见，1可见。当评论被删除，但其下有回复时，此时评论是可见的',
  `is_shield` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否屏蔽，0正常，1屏蔽',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  `hot` int(11) NOT NULL DEFAULT '0' COMMENT '热度，点赞+1',
  `have_author_reply` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否有作者回复，0否1是',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_comment_id` (`comment_id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE,
  KEY `idx_target_id` (`target_id`) USING BTREE,
  KEY `idx_target_type` (`target_type`) USING BTREE,
  KEY `idx_is_deleted` (`is_deleted`) USING BTREE,
  KEY `idx_is_view` (`is_view`) USING BTREE,
  KEY `idx_is_shield` (`is_shield`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【评论】评论表'
```
### 50.  `sys_dynamic_0` 动态表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| dynamic_id | char(24) | char | 24 | NO |  | 动态ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| target_id | char(24) | char | 24 | NO |  | 目标ID | 
| target_type | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 目标type 1文章 2笔记 | 
| type | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 动态类型，1文章动态，2笔记动态，3文本（包括视频、音频）类动态 | 
| is_view | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否全部用户可见，0否1是 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_dynamic_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `dynamic_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动态ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '目标ID',
  `target_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '目标type 1文章 2笔记',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '动态类型，1文章动态，2笔记动态，3文本（包括视频、音频）类动态',
  `is_view` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否全部用户可见，0否1是',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【动态】动态表'
```
### 51.  `sys_dynamic_attachment_0` 【动态】动态附件表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| dynamic_id | char(24) | char | 24 | NO |  | 动态ID | 
| attachment_content | longtext | longtext |  | NO | NULL | 附件内容json串 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_dynamic_attachment_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `dynamic_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '动态ID',
  `attachment_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '附件内容json串',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_dynamic_ic` (`dynamic_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【动态】动态附件表'
```
### 52.  `sys_education` <系统支撑>学历表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| name | varchar(40) | varchar | 40 | NO |  | 职业名称 | 
| weight | int(11) | int | 11 | NO | 0 | 排序权重，影响前台顺序 | 
| status | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 启用状态，0禁用，1启用 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_education` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '职业名称',
  `weight` int(11) NOT NULL DEFAULT '0' COMMENT '排序权重，影响前台顺序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '启用状态，0禁用，1启用',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<系统支撑>学历表'
```
### 53.  `sys_feedback` 【意见反馈】意见反馈表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| user_id | char(24) | char | 24 | NO | 0 | 用户ID | 
| contact | varchar(255) | varchar | 255 | NO |  | 联系方式 | 
| content | text | text |  | NO | NULL | 内容 | 
| platform | tinyint(1) | tinyint | 1 | NO | 1 | 1Web端，2小程序，3iOS，4安卓 | 
| status | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 处理状态，0未处理，1已忽略，2已处理 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| deal_at | int(11) | int | 11 | NO | 0 | 处理时间 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_feedback` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '用户ID',
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '联系方式',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `platform` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1Web端，2小程序，3iOS，4安卓',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '处理状态，0未处理，1已忽略，2已处理',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `deal_at` int(11) NOT NULL DEFAULT '0' COMMENT '处理时间',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE,
  KEY `idx_platform` (`platform`) USING BTREE,
  KEY `idx_status` (`status`) USING BTREE,
  KEY `idx_is_deleted` (`is_deleted`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【意见反馈】意见反馈表'
```
### 54.  `sys_industry` 行业表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| parent_id | int(11) | int | 11 | NO | 0 | 父级类别 | 
| user_id | char(24) | char | 24 | NO |  | 用户ID，如果为空，则是后台创建 | 
| name | varchar(40) | varchar | 40 | NO |  | 行业名称 | 
| weight | int(11) | int | 11 | NO | 0 | 排序权重，影响前台顺序 | 
| create_type | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 创建来源，1官方2用户 | 
| status | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 启用状态，0禁用，1启用 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_industry` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父级类别',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID，如果为空，则是后台创建',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '行业名称',
  `weight` int(11) NOT NULL DEFAULT '0' COMMENT '排序权重，影响前台顺序',
  `create_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '创建来源，1官方2用户',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '启用状态，0禁用，1启用',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_parent_id` (`parent_id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<系统支撑>行业表'
```
### 55.  `sys_ios_version_config` ios 版本控制表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) | int | 11 | NO | NULL |  | 
| version | char(50) | char | 50 | NO |  | 产品版本号 | 
| new_version | char(50) | char | 50 | NO |  | 目前最新的产品版本号 | 
| api_version | int(11) | int | 11 | NO | 0 | api版本号 | 
| build_version | char(50) | char | 50 | NO |  | 构建版本号 | 
| title | varchar(255) | varchar | 255 | NO | NULL | 更新标题 | 
| content | varchar(1000) | varchar | 1000 | NO |  | 更新内容 | 
| updated_url | varchar(255) | varchar | 255 | NO |  | 更新地址，即：点击更新弹窗的确定后跳转的地址 | 
| is_forced_updating | tinyint(1) | tinyint | 1 | NO | 0 | 是否需要强制更新  0 不更新 1更新 2 强制更新 | 
| is_bring | tinyint(1) | tinyint | 1 | NO | 0 | 是否切到提审环境 0否 1是 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_ios_version_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '产品版本号',
  `new_version` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '目前最新的产品版本号',
  `api_version` int(11) NOT NULL DEFAULT '0' COMMENT 'api版本号',
  `build_version` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '构建版本号',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '更新标题',
  `content` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '更新内容',
  `updated_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '更新地址，即：点击更新弹窗的确定后跳转的地址',
  `is_forced_updating` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否需要强制更新  0 不更新 1更新 2 强制更新',
  `is_bring` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否切到提审环境 0否 1是',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<系统支撑>ios版本控制表'
```
### 56.  `sys_job` 职业表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| parent_id | int(11) | int | 11 | NO | 0 | 父级类别 | 
| user_id | char(24) | char | 24 | NO |  | 用户ID，如果为空，则是后台创建 | 
| name | varchar(40) | varchar | 40 | NO |  | 职业名称 | 
| weight | int(11) | int | 11 | NO | 0 | 排序权重，影响前台顺序 | 
| create_type | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 创建来源，1官方2用户 | 
| status | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 启用状态，0禁用，1启用 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_job` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父级类别',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID，如果为空，则是后台创建',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '职业名称',
  `weight` int(11) NOT NULL DEFAULT '0' COMMENT '排序权重，影响前台顺序',
  `create_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '创建来源，1官方2用户',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '启用状态，0禁用，1启用',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_parent_id` (`parent_id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<系统支撑>职业表'
```
### 57.  `sys_message_template` 消息模板表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| title | varchar(255) | varchar | 255 | NO |  | 标题 | 
| content | text | text |  | NO | NULL | 模板内容，如：您的作者申请因{result}被退回，请XXX | 
| operating | varchar(255) | varchar | 255 | NO |  | 所需操作字符串 | 
| sign | tinyint(1) | tinyint | 1 | NO | 1 | 标识，详见文档 | 
| status | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 启用状态，0禁用，1启用 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_message_template` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标题',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '模板内容，如：您的作者申请因{result}被退回，请XXX',
  `operating` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '所需操作字符串',
  `sign` tinyint(1) NOT NULL DEFAULT '1' COMMENT '标识，详见文档',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '启用状态，0禁用，1启用',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<系统支撑>消息模板表'
```
### 58.  `sys_note_0` 笔记表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| note_id | char(24) | char | 24 | NO |  | 笔记ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| article_id | char(24) | char | 24 | NO |  | 文章ID | 
| type | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 笔记类型，1文章笔记，2文章划线笔记，3纯文字笔记，4带图的笔记 | 
| is_choice | tinyint(1) | tinyint | 1 | NO | 0 | 是否被精选，0否，1是 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 删除状态，0正常，1删除 | 
| is_public | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 是否公开，0私密，1公开 | 
| is_shield | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 屏蔽状态，0正常，1屏蔽 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_note_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `note_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '笔记ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `article_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文章ID',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '笔记类型，1文章笔记，2文章划线笔记，3纯文字笔记，4带图的笔记',
  `is_choice` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否被精选，0否，1是',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '删除状态，0正常，1删除',
  `is_public` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否公开，0私密，1公开',
  `is_shield` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '屏蔽状态，0正常，1屏蔽',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_article_id` (`article_id`) USING BTREE,
  KEY `idx_note_id` (`note_id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE,
  KEY `idx_is_choice` (`is_choice`) USING BTREE,
  KEY `idx_is_deleted` (`is_deleted`) USING BTREE,
  KEY `idx_is_public` (`is_public`) USING BTREE,
  KEY `idx_is_shield` (`is_shield`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2041 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【笔记】文章笔记表'
```
### 59.  `sys_note_choice` 【笔记-垂直分表】精选笔记表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| note_id | char(24) | char | 24 | NO |  | 笔记ID | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_note_choice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `note_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '笔记ID',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【笔记-垂直分表】精选笔记表'
```
### 60.  `sys_note_content_0` 【笔记-垂直分表】文章笔记_内容表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| note_id | char(24) | char | 24 | NO |  | 笔记ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| content | longtext | longtext |  | NO | NULL | 笔记内容 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_note_content_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `note_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '笔记ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '笔记内容',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_note_id` (`note_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2036 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【笔记-垂直分表】文章笔记_内容表'
```
### 61.  `sys_note_line_0` 【笔记】划线笔记表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| note_id | char(24) | char | 24 | NO |  | 笔记ID | 
| start_index | int(11) | int | 11 | NO | 0 | 选中部分在文章中的位置 | 
| end_index | int(11) | int | 11 | NO | 0 | 选中部分在文章中结束的位置 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_note_line_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `note_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '笔记ID',
  `start_index` int(11) NOT NULL DEFAULT '0' COMMENT '选中部分在文章中的位置',
  `end_index` int(11) NOT NULL DEFAULT '0' COMMENT '选中部分在文章中结束的位置',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_note_id` (`note_id`) USING BTREE,
  KEY `idx_start_index` (`start_index`) USING BTREE,
  KEY `idx_end_index` (`end_index`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1211 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【笔记】划线笔记表'
```
### 62.  `sys_note_selected_0` 【笔记-垂直分表】文章划线笔记笔记_文章节选表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| note_id | char(24) | char | 24 | NO |  | 笔记ID | 
| selected | longtext | longtext |  | NO | NULL | 文章节选内容 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_note_selected_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `note_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '笔记ID',
  `selected` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章节选内容',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_note_id` (`note_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1210 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【笔记-垂直分表】文章划线笔记笔记_文章节选表'
```
### 63.  `sys_official` <系统支撑>官方用户表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 删除状态，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_official` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '删除状态，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<系统支撑>官方用户表'
```
### 64.  `sys_reply_0` 回复表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增长ID | 
| reply_id | char(24) | char | 24 | NO |  | 回复ID | 
| comment_id | char(24) | char | 24 | NO |  | 评论ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| to_user_id | char(24) | char | 24 | NO |  | 被回复的用户ID | 
| target_id | char(24) | char | 24 | NO |  | 回复的目标ID | 
| target_type | tinyint(1) | tinyint | 1 | NO | 1 | 回复目标类型：1文章，2笔记，5动态，6收藏夹 | 
| content | varchar(1500) | varchar | 1500 | NO |  | 内容 | 
| type | tinyint(1) | tinyint | 1 | NO | 1 | 回复的类型，0本身是评论，1回复的评论，2回复的回复 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 删除状态，0正常，1删除 | 
| is_shield | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否屏蔽，0正常，1屏蔽 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_reply_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `reply_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '回复ID',
  `comment_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '评论ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `to_user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '被回复的用户ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '回复的目标ID',
  `target_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '回复目标类型：1文章，2笔记，5动态，6收藏夹',
  `content` varchar(1500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '内容',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '回复的类型，0本身是评论，1回复的评论，2回复的回复',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '删除状态，0正常，1删除',
  `is_shield` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否屏蔽，0正常，1屏蔽',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_reply_id` (`reply_id`) USING BTREE,
  KEY `idx_comment_id` (`comment_id`) USING BTREE,
  KEY `idx_is_deleted` (`is_deleted`) USING BTREE,
  KEY `idx_is_shield` (`is_shield`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【回复】回复表'
```
### 65.  `sys_report` 举报目标表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| category_id | tinyint(1) | tinyint | 1 | NO | 1 | 对应[sys_report_category]表ID | 
| deal_admin_id | int(11) | int | 11 | NO | 1 | 处理的管理员ID | 
| target_id | char(24) | char | 24 | NO |  | 被举报目标ID | 
| target_type | tinyint(1) | tinyint | 1 | NO | 1 | 被举报目标类型：1文章，2笔记，3评论，4回复，5收藏夹 | 
| content | text | text |  | NO | NULL | 内容 | 
| status | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 处理状态，0未处理，1已忽略，2已处理 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| deal_at | int(11) | int | 11 | NO | 0 | 处理时间 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_report` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `category_id` tinyint(1) NOT NULL DEFAULT '1' COMMENT '对应[sys_report_category]表ID',
  `deal_admin_id` int(11) NOT NULL DEFAULT '1' COMMENT '处理的管理员ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '被举报目标ID',
  `target_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '被举报目标类型：1文章，2笔记，3评论，4回复，5收藏夹',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '处理状态，0未处理，1已忽略，2已处理',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `deal_at` int(11) NOT NULL DEFAULT '0' COMMENT '处理时间',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【举报】举报表'
```
### 66.  `sys_report_category` 【举报】举报类别表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) | int | 11 | NO | NULL | 自增ID | 
| weight | int(11) | int | 11 | NO | 0 | 排序权重 | 
| name | varchar(32) | varchar | 32 | NO |  | 名称 | 
| status | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 启用状态，0禁用，1启用 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `sys_report_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `weight` int(11) NOT NULL DEFAULT '0' COMMENT '排序权重',
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '启用状态，0禁用，1启用',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【举报】举报类别表'
```
### 67.  `syslog_backend_202010` <系统日志>后台管理api调用日志表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| admin_id | int(11) | int | 11 | NO | 0 | 后台管理员ID | 
| right_id | int(11) | int | 11 | NO | 0 | 权限ID | 
| api_route | char(50) | char | 50 | NO |  | 接口路由 | 
| params | longtext | longtext |  | NO | NULL | 参数 | 
| old_json | longtext | longtext |  | NO | NULL | 如果为更新操作，记录修改前的值 | 
| new_json | longtext | longtext |  | NO | NULL | 如果为更新操作，记录修改后的值 | 
| ip | char(15) | char | 15 | NO |  | 主机IP | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
建表语句：
```sql
CREATE TABLE `syslog_backend_202010` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '后台管理员ID',
  `right_id` int(11) NOT NULL DEFAULT '0' COMMENT '权限ID',
  `api_route` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '接口路由',
  `params` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '参数',
  `old_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '如果为更新操作，记录修改前的值',
  `new_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '如果为更新操作，记录修改后的值',
  `ip` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '主机IP',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<系统日志>后台管理api调用日志表'
```
### 68.  `syslog_frontend_202010` <系统日志>前台用户api调用日志表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| api_route | char(50) | char | 50 | NO |  | 接口路由 | 
| method | varchar(8) | varchar | 8 | NO |  | 请求方式 | 
| params | longtext | longtext |  | NO | NULL | 参数 | 
| code | int(11) | int | 11 | NO | 200 | 状态码（包括http和自定义） | 
| referer | varchar(255) | varchar | 255 | NO |  | header中的referer | 
| http_user_agent | varchar(255) | varchar | 255 | NO |  | header中的user-agent | 
| ip | char(15) | char | 15 | NO |  | 主机ID | 
| created_at | int(11) | int | 11 | NO | 0 | 操作时间 | 
建表语句：
```sql
CREATE TABLE `syslog_frontend_202010` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `api_route` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '接口路由',
  `method` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '请求方式',
  `params` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '参数',
  `code` int(11) NOT NULL DEFAULT '200' COMMENT '状态码（包括http和自定义）',
  `referer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'header中的referer',
  `http_user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'header中的user-agent',
  `ip` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '主机ID',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '操作时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE,
  KEY `idx_api_route` (`api_route`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='<系统日志>前台用户api调用日志表'
```
### 69.  `tourist` 游客表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| tourist_id | char(24) | char | 24 | NO |  | 游客ID | 
| device_id | char(50) | char | 50 | NO |  | 设备ID | 
| user_id | char(24) | char | 24 | NO |  | 登陆后对应的游客ID | 
| platform | tinyint(1) | tinyint | 1 | NO | 1 | 1PC，2安卓，3iOS | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `tourist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `tourist_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '游客ID',
  `device_id` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '设备ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登陆后对应的游客ID',
  `platform` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1PC，2安卓，3iOS',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `uk_tourist_id` (`tourist_id`) USING BTREE,
  UNIQUE KEY `uk_device_id` (`device_id`) USING BTREE,
  KEY `idx_platform` (`platform`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【游客】游客表'
```
### 70.  `user` 用户表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| study_id | int(11) | int | 11 | NO | 0 | 学号 | 
| industry_id | int(11) | int | 11 | NO | 0 | 行业id | 
| education_id | int(11) | int | 11 | NO | 0 | 教育id | 
| job_id | int(11) | int | 11 | NO | 0 | 职业id | 
| identity | tinyint(1) | tinyint | 1 | NO | 1 | 身份：1普通用户，2作者，3游客 | 
| phone | varchar(20) | varchar | 20 | NO |  | 用户手机号 | 
| password_hash | varchar(255) | varchar | 255 | NO |  | 密码 | 
| nickname | varchar(60) | varchar | 60 | NO |  | 昵称 | 
| avatar | varchar(255) | varchar | 255 | NO |  | 用户头像 | 
| sign | varchar(255) | varchar | 255 | NO |  | 个性签名 | 
| description | varchar(500) | varchar | 500 | NO |  | 个人简介 | 
| gender | tinyint(1) | tinyint | 1 | NO | 0 | 0保密，1男，2女 | 
| birthday | int(11) | int | 11 | NO | 0 | 出生年份 | 
| country | int(11) | int | 11 | NO | 0 | 国家 地址表自增 id | 
| province | int(11) | int | 11 | NO | 0 | 省 地址表自增 id | 
| city | int(11) | int | 11 | NO | 0 | 市 地址表自增 id | 
| address | varchar(200) | varchar | 200 | NO |  | 地址拼接  国家，省，市 | 
| status | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 用户状态，0禁用，1启用 | 
| is_robot | tinyint(1) | tinyint | 1 | NO | 0 | 是否为机器人，0否，1是 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `study_id` int(11) NOT NULL DEFAULT '0' COMMENT '学号',
  `industry_id` int(11) NOT NULL DEFAULT '0' COMMENT '行业id',
  `education_id` int(11) NOT NULL DEFAULT '0' COMMENT '教育id',
  `job_id` int(11) NOT NULL DEFAULT '0' COMMENT '职业id',
  `identity` tinyint(1) NOT NULL DEFAULT '1' COMMENT '身份：1普通用户，2作者，3游客',
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户手机号',
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '密码',
  `nickname` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户头像',
  `sign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '个性签名',
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '个人简介',
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0保密，1男，2女',
  `birthday` int(11) NOT NULL DEFAULT '0' COMMENT '出生年份',
  `country` int(11) NOT NULL DEFAULT '0' COMMENT '国家 地址表自增 id',
  `province` int(11) NOT NULL DEFAULT '0' COMMENT '省 地址表自增 id',
  `city` int(11) NOT NULL DEFAULT '0' COMMENT '市 地址表自增 id',
  `address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '地址拼接  国家，省，市',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '用户状态，0禁用，1启用',
  `is_robot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为机器人，0否，1是',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `uk_user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=688 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【用户】用户表'
```
### 71.  `user_announce_0` 系统公告_发送群体表，用于后台管理记录公告发送群体
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| announce_id | int(11) | int | 11 | NO | 0 | 对应[announce]表ID | 
| is_read | tinyint(1) | tinyint | 1 | NO | 0 | 是否已读，0未读，1已读 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `user_announce_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `announce_id` int(11) NOT NULL DEFAULT '0' COMMENT '对应[announce]表ID',
  `is_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已读，0未读，1已读',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE,
  KEY `idx_announce_id` (`announce_id`) USING BTREE,
  KEY `idx_is_read` (`is_read`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【用户公告】用户_公告表'
```
### 72.  `user_attention_0` 关注表（我关注的）
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) | int | 11 | NO | NULL |  | 
| target_id | varchar(24) | varchar | 24 | NO |  | 目标id | 
| user_attention_id | varchar(24) | varchar | 24 | NO |  | 关注者用户id | 
| user_id | varchar(24) | varchar | 24 | NO |  | 目标用户ID | 
| is_shield | tinyint(1) | tinyint | 1 | NO | 0 | 是否屏蔽，1否2是 | 
| is_deleted | tinyint(1) | tinyint | 1 | NO | 0 | 0正常，1删除 | 
| apply_at | int(11) | int | 11 | NO | 0 | 发布时间 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间 | 
| updated_at | int(11) | int | 11 | NO | 0 | 最后修改时间戳 | 
| target_type | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 目标type 1文章 2笔记 5动态 | 
| is_view | tinyint(1) unsigned | tinyint | 1 | NO | 1 | 是否全部用户可见，0否1是 | 
建表语句：
```sql
CREATE TABLE `user_attention_0` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `target_id` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '目标id',
  `user_attention_id` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '关注者用户id',
  `user_id` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '目标用户ID',
  `is_shield` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否屏蔽，1否2是',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0正常，1删除',
  `apply_at` int(11) NOT NULL DEFAULT '0' COMMENT '发布时间',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '最后修改时间戳',
  `target_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '目标type 1文章 2笔记 5动态',
  `is_view` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否全部用户可见，0否1是',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_attention_id` (`user_attention_id`) USING BTREE,
  KEY `target_id` (`target_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【广场关注】广场关注表'
```
### 73.  `user_browse_history_0` 【浏览历史记录】用户浏览历史记录表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| target_id | char(24) | char | 24 | NO |  | 目标ID | 
| target_type | tinyint(1) | tinyint | 1 | NO | 1 | 目标类型，1文章，2笔记，3评论，4回复，5动态，6收藏夹 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `user_browse_history_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '目标ID',
  `target_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '目标类型，1文章，2笔记，3评论，4回复，5动态，6收藏夹',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【浏览历史记录】用户浏览历史记录表'
```
### 74.  `user_collect_0` 用户收藏表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| package_id | char(24) | char | 24 | NO |  | 收藏夹ID | 
| target_id | char(24) | char | 24 | NO |  | 目标ID | 
| target_type | tinyint(1) | tinyint | 1 | NO | 1 | 目标类型：1文章，2笔记 | 
| is_deleted | tinyint(1) | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
| collect_id | char(24) | char | 24 | NO |  | 收藏ID | 
建表语句：
```sql
CREATE TABLE `user_collect_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `package_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '收藏夹ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '目标ID',
  `target_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '目标类型：1文章，2笔记',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  `collect_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '收藏ID',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `article_id` (`target_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=609 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='用户收藏表'
```
### 75.  `user_collect_package_0` 用户收藏夹（以用户ID分表）
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| collect_package_id | char(24) | char | 24 | NO |  | 收藏夹ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| name | char(90) | char | 90 | NO |  | 名称 | 
| description | varchar(400) | varchar | 400 | NO |  | 描述 | 
| total | int(11) unsigned | int | 11 | NO | 0 | 收藏夹内容个数 | 
| is_default | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否为默认收藏夹，1否，2是 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| is_public | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否公开，1私有，2公开 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `user_collect_package_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `collect_package_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '收藏夹ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `name` char(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `description` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '描述',
  `total` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '收藏夹内容个数',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为默认收藏夹，1否，2是',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `is_public` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否公开，1私有，2公开',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE,
  KEY `idx_is_default` (`is_default`) USING BTREE,
  KEY `idx_is_deleted` (`is_deleted`) USING BTREE,
  KEY `idx_is_public` (`is_public`) USING BTREE,
  KEY `uk_collect_package_id` (`collect_package_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='用户收藏夹（以用户ID分表）'
```
### 76.  `user_following_relationship_0` 【关注】用户关注关系表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| follow_id | char(24) | char | 24 | NO |  | 用户关注的/关注用户的ID | 
| attention_status | tinyint(1) | tinyint | 1 | NO | NULL | 0没关系，1u_id关注f_id，2f_id关注u_id，3互关 | 
| weight | tinyint(1) | tinyint | 1 | NO | 0 | 排序权重，官方用户为1，否则为0 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `user_following_relationship_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `follow_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户关注的/关注用户的ID',
  `attention_status` tinyint(1) NOT NULL COMMENT '0没关系，1u_id关注f_id，2f_id关注u_id，3互关',
  `weight` tinyint(1) NOT NULL DEFAULT '0' COMMENT '排序权重，官方用户为1，否则为0',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE,
  KEY `idx_follow_id` (`follow_id`) USING BTREE,
  KEY `idx_type` (`attention_status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=883 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【关注】用户关注关系表'
```
### 77.  `user_following_relationship_00k4rtvdjehd53qa2s0909gm` 【关注】用户关注关系表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| follow_id | char(24) | char | 24 | NO |  | 用户关注的/关注用户的ID | 
| attention_status | tinyint(1) | tinyint | 1 | NO | NULL | 0没关系，1u_id关注f_id，2f_id关注u_id，3互关 | 
| weight | tinyint(1) | tinyint | 1 | NO | 0 | 排序权重，官方用户为1，否则为0 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `user_following_relationship_00k4rtvdjehd53qa2s0909gm` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `follow_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户关注的/关注用户的ID',
  `attention_status` tinyint(1) NOT NULL COMMENT '0没关系，1u_id关注f_id，2f_id关注u_id，3互关',
  `weight` tinyint(1) NOT NULL DEFAULT '0' COMMENT '排序权重，官方用户为1，否则为0',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE,
  KEY `idx_follow_id` (`follow_id`) USING BTREE,
  KEY `idx_type` (`attention_status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=367 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【关注】用户关注关系表'
```
### 78.  `user_following_relationship_00k5m3dxleaexwoz8akprrit` 【关注】用户关注关系表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| follow_id | char(24) | char | 24 | NO |  | 用户关注的/关注用户的ID | 
| attention_status | tinyint(1) | tinyint | 1 | NO | NULL | 0没关系，1u_id关注f_id，2f_id关注u_id，3互关 | 
| weight | tinyint(1) | tinyint | 1 | NO | 0 | 排序权重，官方用户为1，否则为0 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `user_following_relationship_00k5m3dxleaexwoz8akprrit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `follow_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户关注的/关注用户的ID',
  `attention_status` tinyint(1) NOT NULL COMMENT '0没关系，1u_id关注f_id，2f_id关注u_id，3互关',
  `weight` tinyint(1) NOT NULL DEFAULT '0' COMMENT '排序权重，官方用户为1，否则为0',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE,
  KEY `idx_follow_id` (`follow_id`) USING BTREE,
  KEY `idx_type` (`attention_status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=367 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【关注】用户关注关系表'
```
### 79.  `user_message_comment_receive_0` 点赞消息【接收者】表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| sender_id | char(24) | char | 24 | NO |  | 评论/回复动作发起者ID | 
| receive_id | char(24) | char | 24 | NO |  | 评论/回复动作接收者ID | 
| comment_id | char(24) | char | 24 | NO |  | 评论ID | 
| reply_id | char(24) | char | 24 | NO |  | 回复ID | 
| target_id | char(24) | char | 24 | NO |  | 评论/回复主体对象ID | 
| target_type | tinyint(1) | tinyint | 1 | NO | 1 | 评论/回复主体对象类型：1文章，2笔记，3评论，4回复，5收藏夹 | 
| type | tinyint(1) | tinyint | 1 | NO | 1 | 消息类型，1评论，2回复 | 
| is_read | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否已读，0未读，1已读 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
建表语句：
```sql
CREATE TABLE `user_message_comment_receive_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `sender_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '评论/回复动作发起者ID',
  `receive_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '评论/回复动作接收者ID',
  `comment_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '评论ID',
  `reply_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '回复ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '评论/回复主体对象ID',
  `target_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '评论/回复主体对象类型：1文章，2笔记，3评论，4回复，5收藏夹',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '消息类型，1评论，2回复',
  `is_read` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否已读，0未读，1已读',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_sender_id` (`sender_id`) USING BTREE,
  KEY `idx_receive_id` (`receive_id`) USING BTREE,
  KEY `idx_target_id` (`target_id`) USING BTREE,
  KEY `idx_is_deleted` (`is_deleted`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【用户消息-评论接收】评论/回复消息【接收者】表'
```
### 80.  `user_message_comment_send_0` 点赞消息【接收者】表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| sender_id | char(24) | char | 24 | NO |  | 评论/回复动作发起者ID | 
| receive_id | char(24) | char | 24 | NO |  | 评论/回复动作接收者ID | 
| comment_id | char(24) | char | 24 | NO |  | 评论/回复ID | 
| reply_id | char(24) | char | 24 | NO |  | 回复ID | 
| target_id | char(24) | char | 24 | NO |  | 评论/回复主体对象ID | 
| target_type | tinyint(1) | tinyint | 1 | NO | 1 | 评论/回复主体对象类型：1文章，2笔记，3评论，4回复，5收藏夹 | 
| type | tinyint(1) | tinyint | 1 | NO | 1 | 消息类型，1评论，2回复 | 
| is_read | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否已读，0未读，1已读 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
建表语句：
```sql
CREATE TABLE `user_message_comment_send_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `sender_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '评论/回复动作发起者ID',
  `receive_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '评论/回复动作接收者ID',
  `comment_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '评论/回复ID',
  `reply_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '回复ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '评论/回复主体对象ID',
  `target_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '评论/回复主体对象类型：1文章，2笔记，3评论，4回复，5收藏夹',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '消息类型，1评论，2回复',
  `is_read` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否已读，0未读，1已读',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_sender_id` (`sender_id`) USING BTREE,
  KEY `idx_receive_id` (`receive_id`) USING BTREE,
  KEY `idx_target_id` (`target_id`) USING BTREE,
  KEY `idx_is_deleted` (`is_deleted`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【用户消息-评论发送】评论/回复消息【发送者】表'
```
### 81.  `user_message_count_0` 
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| user_id | char(24) | char | 24 | NO |  | 用户ID | 
| message_type | tinyint(1) | tinyint | 1 | NO | 0 | 消息类型，0公告，1点赞，2收藏，3评论/回复 | 
| count | int(11) | int | 11 | NO | 0 | 未读消息数 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 更新时间戳 | 
建表语句：
```sql
CREATE TABLE `user_message_count_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户ID',
  `message_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '消息类型，0公告，1点赞，2收藏，3评论/回复',
  `count` int(11) NOT NULL DEFAULT '0' COMMENT '未读消息数',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_user_id` (`user_id`) USING BTREE,
  KEY `idx_message_type` (`message_type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【消息数】未读消息计数表'
```
### 82.  `user_message_like_receive_0` 点赞消息【接收者】表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| sender_id | char(24) | char | 24 | NO |  | 点赞动作发起者ID | 
| receive_id | char(24) | char | 24 | NO |  | 点赞动作接收者ID | 
| target_id | char(24) | char | 24 | NO |  | 目标对象ID | 
| target_type | tinyint(1) | tinyint | 1 | NO | 1 | 目标对象类型：1文章，2笔记，3评论，4回复，5动态，6收藏夹 | 
| is_read | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否已读，0未读，1已读 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 最后修改时间戳 | 
建表语句：
```sql
CREATE TABLE `user_message_like_receive_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `sender_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '点赞动作发起者ID',
  `receive_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '点赞动作接收者ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '目标对象ID',
  `target_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '目标对象类型：1文章，2笔记，3评论，4回复，5动态，6收藏夹',
  `is_read` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否已读，0未读，1已读',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '最后修改时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_sender_id` (`sender_id`) USING BTREE,
  KEY `idx_receive_id` (`receive_id`) USING BTREE,
  KEY `idx_target_id` (`target_id`) USING BTREE,
  KEY `idx_is_deleted` (`is_deleted`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=706 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【用户消息-点赞接收】点赞消息【接收者】表'
```
### 83.  `user_message_like_send_0` 点赞消息【操作者】表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| sender_id | char(24) | char | 24 | NO |  | 点赞动作发起者ID | 
| receive_id | char(24) | char | 24 | NO |  | 点赞动作接收者ID | 
| target_id | char(24) | char | 24 | NO |  | 目标对象ID | 
| target_type | tinyint(1) | tinyint | 1 | NO | 1 | 目标对象类型：1文章，2笔记，3评论，4回复，5动态，6收藏夹 | 
| is_read | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否已读，0未读，1已读 | 
| is_deleted | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否删除，0正常，1删除 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 最后修改时间戳 | 
建表语句：
```sql
CREATE TABLE `user_message_like_send_0` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `sender_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '点赞动作发起者ID',
  `receive_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '点赞动作接收者ID',
  `target_id` char(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '目标对象ID',
  `target_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '目标对象类型：1文章，2笔记，3评论，4回复，5动态，6收藏夹',
  `is_read` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否已读，0未读，1已读',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除，0正常，1删除',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '最后修改时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_sender_id` (`sender_id`) USING BTREE,
  KEY `idx_receive_id` (`receive_id`) USING BTREE,
  KEY `idx_target_id` (`target_id`) USING BTREE,
  KEY `idx_is_deleted` (`is_deleted`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=643 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【用户消息-点赞发送】点赞消息【发送者】表'
```
### 84.  `user_verify_code` 【验证码】用户_验证码校验表
| 字段名 | 数据类型 | 字段类型 | 长度 | 是否为空 | 默认值 | 备注 |
| ------ | -------- | -------- | ---- | -------- | ------ | ---- |
| id | int(11) unsigned | int | 11 | NO | NULL | 自增ID | 
| phone | varchar(20) | varchar | 20 | NO |  | 手机号 | 
| verify_code | varchar(10) | varchar | 10 | NO |  | 手机验证码 | 
| try_count | tinyint(1) | tinyint | 1 | NO | 0 | 尝试次数 | 
| sms_template | tinyint(1) | tinyint | 1 | NO | 1 | 使用场景 验证码模板 暂时弃用 1 登录验证码 2.绑定手机号 3. 解绑手机号 4注册，5修改密码 | 
| is_used | tinyint(1) unsigned | tinyint | 1 | NO | 0 | 是否被使用，0否，1是 | 
| expired_at | int(11) | int | 11 | NO | 0 | 验证码过期时间戳 | 
| created_at | int(11) | int | 11 | NO | 0 | 创建时间戳 | 
| updated_at | int(11) | int | 11 | NO | 0 | 过期时间戳 | 
建表语句：
```sql
CREATE TABLE `user_verify_code` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `verify_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '手机验证码',
  `try_count` tinyint(1) NOT NULL DEFAULT '0' COMMENT '尝试次数',
  `sms_template` tinyint(1) NOT NULL DEFAULT '1' COMMENT '使用场景 验证码模板 暂时弃用 1 登录验证码 2.绑定手机号 3. 解绑手机号 4注册，5修改密码',
  `is_used` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否被使用，0否，1是',
  `expired_at` int(11) NOT NULL DEFAULT '0' COMMENT '验证码过期时间戳',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间戳',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '过期时间戳',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_phone` (`phone`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='【验证码】用户_验证码校验表'
```
