CREATE TABLE `appointments` (
  `id` int(11) NOT NULL COMMENT '预约唯一标识',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `date` date NOT NULL COMMENT '预约日期',
  `time` time NOT NULL COMMENT '预约时间',
  `status` enum('pending','approved','rejected') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending' COMMENT '预约状态，默认待审核',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

CREATE TABLE `articles` (
  `id` int(11) NOT NULL COMMENT '文章唯一标识',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '文章标题',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '文章内容',
  `category_id` int(11) NOT NULL COMMENT '文章所属分类',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

CREATE TABLE `categories` (
  `id` int(11) NOT NULL COMMENT '分类唯一标识',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '分类名称',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

CREATE TABLE `mood_diaries` (
  `id` int(11) NOT NULL COMMENT '日记唯一标识',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `mood` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户心情标签',
  `description` text COLLATE utf8_unicode_ci COMMENT '心情描述',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `mood_diaries` (`id`, `user_id`, `mood`, `description`, `created_at`, `updated_at`) VALUES
(3, 2, 'very_happy', NULL, '2024-11-24 19:46:33', '2024-11-24 19:46:33'),
(4, 2, 'excited', 'd', '2024-11-24 19:46:48', '2024-11-24 19:46:48'),
(5, 2, 'content', NULL, '2024-11-24 19:46:52', '2024-11-24 19:46:52'),
(6, 2, 'very_sad', NULL, '2024-11-24 19:46:57', '2024-11-24 19:46:57'),
(7, 2, 'very_happy', NULL, '2024-11-24 19:47:02', '2024-11-24 19:47:02');

-- --------------------------------------------------------

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL COMMENT '文件唯一标识',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '文件名',
  `file_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '文件存储路径',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT '用户唯一标识',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户邮箱',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户密码（加密存储）',
  `role` enum('user','admin') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user' COMMENT '用户角色，默认普通用户',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$ZZ/y6e1HAm0kaGSNC7zPd.mOlKBC.ozTCoW4D2Zid7DKfmHMUNIVy', 'admin', '2024-11-24 17:37:20', '2024-11-25 01:44:46'),
(2, 'user', 'user@user.com', '$2y$10$WHaPH56312dfPrPdgtBXceaLOFJf3tbooIOvkviEXH9K0YZ2prMy6', 'user', '2024-11-24 17:37:45', '2024-11-24 17:37:45');

--
-- 转储表的索引
--

--
-- 表的索引 `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- 表的索引 `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `mood_diaries`
--
ALTER TABLE `mood_diaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- 表的索引 `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '预约唯一标识';

--
-- 使用表AUTO_INCREMENT `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章唯一标识';

--
-- 使用表AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类唯一标识';

--
-- 使用表AUTO_INCREMENT `mood_diaries`
--
ALTER TABLE `mood_diaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '日记唯一标识', AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文件唯一标识';

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户唯一标识', AUTO_INCREMENT=3;

--
-- 限制导出的表
--

--
-- 限制表 `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- 限制表 `mood_diaries`
--
ALTER TABLE `mood_diaries`
  ADD CONSTRAINT `mood_diaries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- 限制表 `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

