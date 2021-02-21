CREATE TABLE `locations`
(
    `id`    int(11) UNSIGNED NOT NULL,
    `no`    varchar(255) NOT NULL DEFAULT '',
    `title` varchar(255) NOT NULL,
    `state` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `locations` (`id`, `no`, `title`, `state`)
VALUES (1, 'L00001', '雲彩裡', 1),
       (2, 'L00002', '神奇的宇宙', 0),
       (3, 'L00003', '一澄到底的清澈', 1),
       (4, 'L00004', '花草的香息', 0),
       (5, 'L00005', '獨身漫步的時候', 1);

CREATE TABLE `location_data`
(
    `id`          int(11) NOT NULL,
    `location_no` varchar(255) NOT NULL DEFAULT '',
    `data`        varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `location_data` (`id`, `location_no`, `data`)
VALUES (6, 'L00001', '「至難得者，謂操曰：運籌決算有神功，二虎還須遜一龍。初到任，即設五色棒十餘條於縣之四門。有犯禁者，。'),
       (7, 'L00002', '長，右有翼德ー，各引兵追襲張梁。那張角，一名張世平，一試矛兮一試刀。初到任，即設五色棒十餘里。後張。'),
       (8, 'L00003', '有資財，當乘此車蓋。」遂一面遣中郎已被逮，別人領兵，我更助汝一千官軍，前來潁川打探消息，約期剿捕。。'),
       (9, 'L00004', '壘。汝可引本部五百餘人，以天書三卷授之，曰：「此張角正殺敗董卓回寨。玄德謂關、張寶勢窮力乏，必獲惡。'),
       (10, 'L00005', '朱雋，其道盧植也。玄德曰：「天公將軍。」劉焉然其說，隨即引兵攻擊賊寨，火燄張天，急引兵追襲張梁、張。');

CREATE TABLE `roses`
(
    `id`          int(11) UNSIGNED NOT NULL COMMENT 'Primary Key',
    `no`          varchar(255) NOT NULL DEFAULT '',
    `location_no` varchar(255) NOT NULL DEFAULT '',
    `sakura_no`   varchar(255) NOT NULL DEFAULT '',
    `title`       varchar(255) NOT NULL COMMENT 'Record title',
    `state`       tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Record state'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `roses` (`id`, `no`, `location_no`, `sakura_no`, `title`, `state`)
VALUES (1, 'R00001', 'L00001', 'S00021', 'Rose 1', 0),
       (2, 'R00002', 'L00001', 'S00014', 'Rose 2', 0),
       (3, 'R00003', 'L00001', 'S00022', 'Rose 3', 0),
       (4, 'R00004', 'L00001', 'S00008', 'Rose 4', 1),
       (5, 'R00005', 'L00001', 'S00007', 'Rose 5', 0),
       (6, 'R00006', 'L00002', 'S00009', 'Rose 6', 1),
       (7, 'R00007', 'L00002', 'S00019', 'Rose 7', 0),
       (8, 'R00008', 'L00002', 'S00003', 'Rose 8', 1),
       (9, 'R00009', 'L00002', 'S00018', 'Rose 9', 0),
       (10, 'R00010', 'L00002', 'S00001', 'Rose 10', 1),
       (11, 'R00011', 'L00003', 'S00025', 'Rose 11', 0),
       (12, 'R00012', 'L00003', 'S00006', 'Rose 12', 1),
       (13, 'R00013', 'L00003', 'S00004', 'Rose 13', 0),
       (14, 'R00014', 'L00003', 'S00011', 'Rose 14', 0),
       (15, 'R00015', 'L00003', 'S00015', 'Rose 15', 1),
       (16, 'R00016', 'L00004', 'S00012', 'Rose 16', 1),
       (17, 'R00017', 'L00004', 'S00013', 'Rose 17', 0),
       (18, 'R00018', 'L00004', 'S00002', 'Rose 18', 0),
       (19, 'R00019', 'L00004', 'S00023', 'Rose 19', 1),
       (20, 'R00020', 'L00004', 'S00020', 'Rose 20', 1),
       (21, 'R00021', 'L00005', 'S00024', 'Rose 21', 0),
       (22, 'R00022', 'L00005', 'S00010', 'Rose 22', 1),
       (23, 'R00023', 'L00005', 'S00016', 'Rose 23', 0),
       (24, 'R00024', 'L00005', 'S00017', 'Rose 24', 1),
       (25, 'R00025', 'L00005', 'S00005', 'Rose 25', 1);

CREATE TABLE `sakuras`
(
    `id`          int(11) UNSIGNED NOT NULL COMMENT 'Primary Key',
    `no`          varchar(255) NOT NULL DEFAULT '',
    `location_no` varchar(255) NOT NULL DEFAULT '',
    `rose_no`     varchar(255) NOT NULL DEFAULT '',
    `title`       varchar(255) NOT NULL COMMENT 'Record title',
    `state`       tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Record state'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sakuras` (`id`, `no`, `location_no`, `rose_no`, `title`, `state`)
VALUES (1, 'S00001', 'L00001', '', 'Sakura 1', 1),
       (2, 'S00002', 'L00001', '', 'Sakura 2', 1),
       (3, 'S00003', 'L00001', '', 'Sakura 3', 0),
       (4, 'S00004', 'L00001', '', 'Sakura 4', 1),
       (5, 'S00005', 'L00001', '', 'Sakura 5', 0),
       (6, 'S00006', 'L00002', '', 'Sakura 6', 0),
       (7, 'S00007', 'L00002', '', 'Sakura 7', 0),
       (8, 'S00008', 'L00002', '', 'Sakura 8', 1),
       (9, 'S00009', 'L00002', '', 'Sakura 9', 1),
       (10, 'S00010', 'L00002', '', 'Sakura 10', 0),
       (11, 'S00011', 'L00003', '', 'Sakura 11', 1),
       (12, 'S00012', 'L00003', '', 'Sakura 21', 0),
       (13, 'S00013', 'L00003', '', 'Sakura 31', 0),
       (14, 'S00014', 'L00003', '', 'Sakura 41', 0),
       (15, 'S00015', 'L00003', '', 'Sakura 15', 0),
       (16, 'S00016', 'L00004', '', 'Sakura 16', 1),
       (17, 'S00017', 'L00004', '', 'Sakura 17', 0),
       (18, 'S00018', 'L00004', '', 'Sakura 18', 1),
       (19, 'S00019', 'L00004', '', 'Sakura 19', 1),
       (20, 'S00020', 'L00004', '', 'Sakura 20', 1),
       (21, 'S00021', 'L00005', '', 'Sakura 21', 1),
       (22, 'S00022', 'L00005', '', 'Sakura 22', 1),
       (23, 'S00023', 'L00005', '', 'Sakura 23', 0),
       (24, 'S00024', 'L00005', '', 'Sakura 24', 1),
       (25, 'S00025', 'L00005', '', 'Sakura 25', 0);

CREATE TABLE `sakura_rose_maps` (
                                    `sakura_no` varchar(255) NOT NULL DEFAULT '',
                                    `rose_no` varchar(255) NOT NULL DEFAULT '',
                                    `type` varchar(50) DEFAULT NULL,
                                    `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sakura_rose_maps` (`sakura_no`, `rose_no`, `type`, `created`) VALUES
('S00001', 'R00015', 'north', '2020-11-01 00:37:05'),
('S00001', 'R00017', 'south', '2021-02-08 09:29:51'),
('S00001', 'R00002', 'north', '2020-12-06 06:11:36'),
('S00002', 'R00004', 'north', '2020-10-29 11:28:35'),
('S00002', 'R00019', 'south', '2020-11-01 23:48:22'),
('S00002', 'R00003', 'north', '2020-11-16 16:42:55'),
('S00003', 'R00016', 'north', '2021-01-18 16:16:24'),
('S00003', 'R00025', 'south', '2020-11-01 20:40:04'),
('S00004', 'R00021', 'north', '2020-11-04 20:24:43'),
('S00004', 'R00024', 'north', '2020-11-20 20:10:14'),
('S00004', 'R00004', 'north', '2021-01-30 19:43:53'),
('S00005', 'R00007', 'north', '2020-12-20 03:35:36'),
('S00005', 'R00005', 'north', '2021-02-01 15:46:34'),
('S00005', 'R00006', 'south', '2021-01-26 14:26:11'),
('S00006', 'R00012', 'north', '2020-12-13 00:04:48'),
('S00006', 'R00016', 'south', '2021-01-09 14:05:39'),
('S00006', 'R00004', 'south', '2021-02-17 21:27:23'),
('S00007', 'R00011', 'south', '2021-02-15 11:20:10'),
('S00007', 'R00001', 'north', '2021-02-01 15:32:11'),
('S00007', 'R00014', 'south', '2020-12-01 18:54:00'),
('S00008', 'R00007', 'south', '2021-02-20 13:47:00'),
('S00008', 'R00016', 'north', '2020-11-04 20:46:29'),
('S00008', 'R00004', 'north', '2020-12-07 09:18:21'),
('S00009', 'R00006', 'north', '2020-12-28 07:25:47'),
('S00009', 'R00017', 'north', '2021-01-04 08:27:26'),
('S00009', 'R00003', 'north', '2020-12-07 19:13:22'),
('S00010', 'R00011', 'north', '2021-02-19 07:44:41'),
('S00010', 'R00022', 'north', '2021-02-04 18:30:14'),
('S00010', 'R00023', 'north', '2020-12-05 20:30:37'),
('S00011', 'R00023', 'south', '2020-11-07 08:02:34'),
('S00011', 'R00011', 'north', '2020-12-17 11:41:14'),
('S00011', 'R00014', 'north', '2021-02-09 09:32:01'),
('S00012', 'R00025', 'south', '2020-11-18 02:03:14'),
('S00012', 'R00015', 'south', '2020-11-20 19:33:40'),
('S00012', 'R00008', 'north', '2020-12-21 23:45:31'),
('S00013', 'R00003', 'north', '2021-01-22 11:20:05'),
('S00013', 'R00005', 'north', '2020-12-01 03:44:04'),
('S00013', 'R00008', 'south', '2020-11-23 17:40:16'),
('S00014', 'R00002', 'south', '2020-11-27 09:16:03'),
('S00014', 'R00001', 'south', '2021-01-06 21:26:20'),
('S00014', 'R00007', 'north', '2020-11-27 01:43:41'),
('S00015', 'R00006', 'north', '2020-12-20 01:19:37'),
('S00015', 'R00007', 'south', '2020-12-25 00:40:35'),
('S00015', 'R00011', 'south', '2020-11-10 22:37:36'),
('S00016', 'R00012', 'south', '2020-11-08 00:06:29'),
('S00016', 'R00019', 'north', '2020-11-09 08:46:29'),
('S00016', 'R00002', 'south', '2020-11-24 23:39:51'),
('S00017', 'R00015', 'north', '2021-02-07 00:06:39'),
('S00017', 'R00004', 'north', '2021-01-12 15:00:36'),
('S00017', 'R00003', 'south', '2021-01-12 06:49:55'),
('S00018', 'R00004', 'south', '2020-12-01 12:21:18'),
('S00018', 'R00011', 'north', '2020-12-26 02:16:59'),
('S00018', 'R00019', 'south', '2021-01-10 21:34:32'),
('S00019', 'R00008', 'north', '2021-01-16 04:15:15'),
('S00019', 'R00017', 'south', '2020-12-26 03:46:12'),
('S00019', 'R00011', 'south', '2020-12-21 10:12:07'),
('S00020', 'R00011', 'north', '2021-01-29 19:48:50'),
('S00020', 'R00002', 'south', '2021-01-08 14:48:00'),
('S00020', 'R00007', 'north', '2021-01-16 18:40:23'),
('S00021', 'R00008', 'north', '2021-01-05 00:11:27'),
('S00021', 'R00025', 'north', '2021-02-06 21:02:59'),
('S00021', 'R00017', 'north', '2021-01-05 03:00:47'),
('S00022', 'R00022', 'south', '2020-12-06 04:01:48'),
('S00022', 'R00025', 'south', '2021-02-08 20:06:51'),
('S00022', 'R00006', 'south', '2020-12-19 05:55:42'),
('S00023', 'R00005', 'north', '2021-01-01 02:18:10'),
('S00023', 'R00002', 'south', '2020-12-18 16:57:18'),
('S00023', 'R00010', 'north', '2020-12-29 09:58:50'),
('S00024', 'R00012', 'south', '2020-12-06 22:15:51'),
('S00024', 'R00004', 'north', '2020-11-08 13:29:34'),
('S00024', 'R00011', 'north', '2020-12-20 09:40:31'),
('S00025', 'R00018', 'south', '2021-02-20 07:07:23'),
('S00025', 'R00009', 'north', '2021-01-02 20:02:15'),
('S00025', 'R00017', 'south', '2021-02-08 15:49:19'),
('S00004', 'R00001', 'south', '2021-01-20 13:20:04'),
('S00020', 'R00001', 'north', '2021-02-15 23:19:13'),
('S00010', 'R00001', 'south', '2021-01-03 22:56:04'),
('S00006', 'R00002', 'south', '2020-11-03 00:49:36'),
('S00010', 'R00002', 'north', '2020-12-24 21:13:20'),
('S00014', 'R00002', 'north', '2020-12-05 01:58:03'),
('S00008', 'R00003', 'south', '2020-11-12 22:17:08'),
('S00013', 'R00003', 'south', '2021-01-16 18:31:41'),
('S00025', 'R00003', 'south', '2020-11-03 15:13:55'),
('S00001', 'R00004', 'north', '2020-11-19 10:28:02'),
('S00020', 'R00004', 'north', '2021-01-27 10:45:18'),
('S00016', 'R00004', 'south', '2020-12-07 11:49:18'),
('S00011', 'R00005', 'south', '2020-12-10 11:50:48'),
('S00005', 'R00005', 'south', '2021-01-31 03:52:56'),
('S00018', 'R00005', 'north', '2021-02-17 02:12:28'),
('S00017', 'R00006', 'south', '2020-12-08 17:43:47'),
('S00013', 'R00006', 'south', '2021-02-08 23:55:02'),
('S00018', 'R00006', 'north', '2020-12-12 07:50:43'),
('S00009', 'R00007', 'north', '2020-11-27 00:28:40'),
('S00010', 'R00007', 'south', '2020-11-10 06:58:05'),
('S00017', 'R00007', 'north', '2021-01-27 18:24:34'),
('S00014', 'R00008', 'south', '2021-01-05 12:35:28'),
('S00014', 'R00008', 'south', '2021-01-07 11:50:31'),
('S00018', 'R00008', 'north', '2020-11-28 20:39:45'),
('S00024', 'R00009', 'north', '2020-12-27 04:47:22'),
('S00001', 'R00009', 'north', '2021-01-24 09:11:09'),
('S00021', 'R00009', 'north', '2020-11-25 01:53:49'),
('S00009', 'R00010', 'south', '2021-02-11 19:49:11'),
('S00018', 'R00010', 'north', '2021-02-05 10:51:22'),
('S00005', 'R00010', 'north', '2020-12-31 18:02:48'),
('S00001', 'R00011', 'south', '2020-11-18 13:46:46'),
('S00022', 'R00011', 'north', '2020-11-25 23:45:40'),
('S00024', 'R00011', 'south', '2021-01-15 09:34:54'),
('S00011', 'R00012', 'north', '2021-01-12 18:57:43'),
('S00002', 'R00012', 'south', '2020-11-25 17:17:25'),
('S00008', 'R00012', 'north', '2020-11-25 14:34:08'),
('S00025', 'R00013', 'south', '2020-12-23 01:05:17'),
('S00009', 'R00013', 'north', '2021-01-13 08:57:34'),
('S00021', 'R00013', 'south', '2021-02-06 16:45:31'),
('S00024', 'R00014', 'north', '2020-12-10 03:15:04'),
('S00010', 'R00014', 'north', '2020-11-22 22:59:01'),
('S00016', 'R00014', 'north', '2021-02-20 18:10:05'),
('S00015', 'R00015', 'north', '2020-12-02 06:26:56'),
('S00021', 'R00015', 'north', '2020-12-27 15:37:54'),
('S00021', 'R00015', 'south', '2021-01-16 10:02:15'),
('S00008', 'R00016', 'north', '2021-02-08 02:31:06'),
('S00012', 'R00016', 'south', '2020-12-08 00:48:58'),
('S00008', 'R00016', 'south', '2020-11-08 05:31:44'),
('S00025', 'R00017', 'north', '2020-12-15 10:11:57'),
('S00020', 'R00017', 'north', '2021-01-27 09:38:04'),
('S00017', 'R00017', 'north', '2021-01-14 11:54:43'),
('S00017', 'R00018', 'north', '2020-10-29 05:52:54'),
('S00009', 'R00018', 'north', '2020-10-30 07:33:56'),
('S00006', 'R00018', 'south', '2020-11-04 00:17:48'),
('S00009', 'R00019', 'south', '2020-11-24 06:54:03'),
('S00008', 'R00019', 'north', '2021-02-19 13:43:46'),
('S00006', 'R00019', 'north', '2020-11-22 08:30:11'),
('S00005', 'R00020', 'south', '2020-11-11 15:13:11'),
('S00017', 'R00020', 'north', '2021-02-17 11:35:34'),
('S00024', 'R00020', 'south', '2020-12-19 20:51:48'),
('S00010', 'R00021', 'north', '2020-12-09 06:32:29'),
('S00017', 'R00021', 'south', '2020-12-18 22:13:55'),
('S00020', 'R00021', 'south', '2020-11-12 18:45:41'),
('S00009', 'R00022', 'south', '2020-12-05 12:06:52'),
('S00002', 'R00022', 'north', '2020-11-25 03:30:50'),
('S00021', 'R00022', 'south', '2020-11-21 09:20:25'),
('S00016', 'R00023', 'north', '2020-12-03 16:16:28'),
('S00002', 'R00023', 'south', '2021-02-14 09:27:56'),
('S00005', 'R00023', 'north', '2021-01-23 11:57:07'),
('S00012', 'R00024', 'north', '2021-02-13 11:28:42'),
('S00025', 'R00024', 'south', '2020-12-13 15:52:19'),
('S00014', 'R00024', 'north', '2020-11-20 05:55:40'),
('S00002', 'R00025', 'north', '2021-01-27 15:01:36'),
('S00015', 'R00025', 'north', '2020-12-05 22:47:52'),
('S00009', 'R00025', 'south', '2020-12-02 05:54:45');

ALTER TABLE `locations`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `location_data`
    ADD PRIMARY KEY (`id`),
  ADD KEY `idx_location_data_location_no` (`location_no`);

ALTER TABLE `roses`
    ADD PRIMARY KEY (`id`),
  ADD KEY `cat_index` (`state`),
  ADD KEY `idx_roses_no` (`no`),
  ADD KEY `idx_roses_location_no` (`location_no`);

ALTER TABLE `sakuras`
    ADD PRIMARY KEY (`id`),
  ADD KEY `cat_index` (`state`),
  ADD KEY `idx_sakuras_no` (`no`),
  ADD KEY `idx_sakuras_location_no` (`location_no`);

ALTER TABLE `locations`
    MODIFY `id` INT (11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `location_data`
    MODIFY `id` INT (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `roses`
    MODIFY `id` INT (11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=26;

ALTER TABLE `sakuras`
    MODIFY `id` INT (11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=26;

ALTER TABLE `sakura_rose_maps`
  ADD KEY `idx_sakura_no` (`sakura_no`),
  ADD KEY `idx_rose_no` (`rose_no`);
