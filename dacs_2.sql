/*
 Navicat Premium Data Transfer

 Source Server         : Test
 Source Server Type    : MySQL
 Source Server Version : 80033
 Source Host           : localhost:3306
 Source Schema         : dacs_2

 Target Server Type    : MySQL
 Target Server Version : 80033
 File Encoding         : 65001

 Date: 24/12/2023 09:54:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admins_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admins
-- ----------------------------

-- ----------------------------
-- Table structure for blog
-- ----------------------------
DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `review` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `HotelName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_user_id`(`userid` ASC) USING BTREE,
  CONSTRAINT `fk_user_id` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of blog
-- ----------------------------

-- ----------------------------
-- Table structure for book
-- ----------------------------
DROP TABLE IF EXISTS `book`;
CREATE TABLE `book`  (
  `book_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reservate_id` int UNSIGNED NULL DEFAULT NULL,
  `book_status` tinyint NOT NULL DEFAULT 0,
  `book_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`book_id`) USING BTREE,
  INDEX `fk_reservate_id`(`reservate_id` ASC) USING BTREE,
  INDEX `idx_book_code`(`book_code` ASC) USING BTREE,
  CONSTRAINT `fk_reservate_id` FOREIGN KEY (`reservate_id`) REFERENCES `reservate` (`reservate_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 39 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of book
-- ----------------------------
INSERT INTO `book` VALUES (36, 46, 0, '5a6b0', '2023-12-06 00:09:45', '2023-12-12 23:12:10');
INSERT INTO `book` VALUES (38, 48, 0, '131e8', '2023-12-13 16:32:05', '2023-12-16 10:52:03');
INSERT INTO `book` VALUES (39, 50, 1, '068e2', '2023-12-23 21:27:07', '2023-12-23 21:27:07');
INSERT INTO `book` VALUES (40, 51, 1, 'c37ad', '2023-12-23 22:23:59', '2023-12-23 22:23:59');
INSERT INTO `book` VALUES (41, 52, 1, 'ee9c6', '2023-12-24 05:33:05', '2023-12-24 05:33:05');
INSERT INTO `book` VALUES (42, 53, 1, 'a89b9', '2023-12-24 07:18:39', '2023-12-24 07:18:39');

-- ----------------------------
-- Table structure for bookingdetails
-- ----------------------------
DROP TABLE IF EXISTS `bookingdetails`;
CREATE TABLE `bookingdetails`  (
  `book_details_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `room_id` int UNSIGNED NULL DEFAULT NULL,
  `book_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_price` bigint NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `payment_confirmed` tinyint NOT NULL DEFAULT 0,
  PRIMARY KEY (`book_details_id`) USING BTREE,
  INDEX `fk_room_id`(`room_id` ASC) USING BTREE,
  INDEX `fk_book_code`(`book_code` ASC) USING BTREE,
  CONSTRAINT `fk_book_code` FOREIGN KEY (`book_code`) REFERENCES `book` (`book_code`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_room_id` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of bookingdetails
-- ----------------------------
INSERT INTO `bookingdetails` VALUES (5, 5, '5a6b0', '1 Giường Cỡ Queen', 573563, 1, '2023-12-06 00:09:45', '2023-12-24 06:04:44', 1);
INSERT INTO `bookingdetails` VALUES (6, 14, '131e8', '1 giường cỡ King', 600000, 1, '2023-12-13 16:32:05', '2023-12-24 09:43:51', 1);
INSERT INTO `bookingdetails` VALUES (7, 13, '068e2', '1 giường đôi lớn', 450000, 1, '2023-12-23 21:27:07', '2023-12-24 06:05:08', 1);
INSERT INTO `bookingdetails` VALUES (8, 13, 'c37ad', '1 giường đôi lớn', 450000, 1, '2023-12-23 22:23:59', '2023-12-23 22:23:59', 0);
INSERT INTO `bookingdetails` VALUES (10, 15, 'a89b9', '1 giường cỡ vừa', 350000, 3, '2023-12-24 07:18:39', '2023-12-24 07:18:51', 1);

-- ----------------------------
-- Table structure for contacts
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of contacts
-- ----------------------------
INSERT INTO `contacts` VALUES (5, 'Thaonhi19122', 'trungkien2804@gmail.com', 'djfdhjhf', 'hello', '2023-11-28 20:03:20', '2023-11-28 20:03:20');
INSERT INTO `contacts` VALUES (6, 'Thaonhi19122', 'trungkien2804@gmail.com', 'djfdhjhf', 'hello', '2023-11-28 20:03:20', '2023-11-28 20:03:20');
INSERT INTO `contacts` VALUES (8, 'fff', 'lemyduyen.kute06066@gmail.com', 'fff', 'ffff', '2023-11-30 00:22:53', '2023-11-30 00:22:53');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for invoice
-- ----------------------------
DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice`  (
  `invoice_id` int NOT NULL AUTO_INCREMENT,
  `bookingdetails_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`invoice_id`) USING BTREE,
  INDEX `fk_book_detail_id`(`bookingdetails_id` ASC) USING BTREE,
  CONSTRAINT `fk_book_detail_id` FOREIGN KEY (`bookingdetails_id`) REFERENCES `bookingdetails` (`book_details_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of invoice
-- ----------------------------
INSERT INTO `invoice` VALUES (1, 5, '2023-12-24 06:39:42', '2023-12-24 06:39:42');
INSERT INTO `invoice` VALUES (2, 7, '2023-12-24 06:39:42', '2023-12-24 06:39:42');
INSERT INTO `invoice` VALUES (3, 10, '2023-12-24 07:18:55', '2023-12-24 07:18:55');
INSERT INTO `invoice` VALUES (4, 6, '2023-12-24 09:43:54', '2023-12-24 09:43:54');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (3, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (7, '2023_11_27_132052_create_admins_table', 2);
INSERT INTO `migrations` VALUES (8, '2023_11_27_132816_create_images_table', 3);
INSERT INTO `migrations` VALUES (9, '2023_11_28_094520_create_contacts_table', 3);
INSERT INTO `migrations` VALUES (10, '2023_11_30_234414_create_blog_table', 4);
INSERT INTO `migrations` VALUES (11, '2023_12_01_195712_create_products_table', 5);
INSERT INTO `migrations` VALUES (12, '2023_12_01_201942_create_products_table', 6);
INSERT INTO `migrations` VALUES (13, '2023_12_02_014409_create_room_table', 7);
INSERT INTO `migrations` VALUES (14, '2023_12_02_163001_create_room_table', 8);
INSERT INTO `migrations` VALUES (15, '2023_12_02_191144_create_room_table', 9);
INSERT INTO `migrations` VALUES (16, '2023_12_05_030830_create_bookingdetails_table', 10);
INSERT INTO `migrations` VALUES (17, '2023_12_05_030915_create_book_table', 10);
INSERT INTO `migrations` VALUES (18, '2023_12_05_033613_create_reservate_table', 10);
INSERT INTO `migrations` VALUES (19, '2023_12_05_104840_create_book_table', 11);
INSERT INTO `migrations` VALUES (20, '2023_12_05_104920_create_reservate_table', 11);
INSERT INTO `migrations` VALUES (21, '2023_12_05_105010_create_bookdetails_table', 11);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `HotelID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ImageHotel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `NumberOfRoom` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`HotelID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (3, 'NOVOTEL DA NANG', 'C:\\xampp\\tmp\\phpD56D.tmp', '36 Bach Dang, Da Nang', 0, NULL, '2023-12-10 11:00:02', 0);
INSERT INTO `products` VALUES (4, 'GRANDVRIO HOTEL DANANG', '9.jpg', 'Số 01 - 03 Đống Đa, quận Hải Châu, thành phố Đà Nẵng', 0, NULL, NULL, 0);
INSERT INTO `products` VALUES (5, 'ALTARA SUITES ĐÀ NẴNG', '4.jpg', 'Số 120 Đ. Võ Nguyên Giáp, phường Phước Mỹ, Quận Sơn Trà, Đà Nẵng', 0, NULL, NULL, 0);
INSERT INTO `products` VALUES (6, 'DANANG MARRIOTT RESORT & SPA', '7.jpg', '07 Trường Sa, Ngũ Hành Sơn, Đà Nẵng', 0, NULL, NULL, 0);
INSERT INTO `products` VALUES (7, 'GIC LUXURY HOTEL AND SPA', '8.jpg', '59 Lê Duẩn - Hải Châu - Đà Nẵng, Hải Châu, Đà Nẵng, Việt Nam', 0, NULL, NULL, 0);
INSERT INTO `products` VALUES (8, 'HILTON DA NANG', '10.jpg', 'Số 50 Bach Dang, Quan Hai Chau, Da Nang', 0, NULL, NULL, 0);
INSERT INTO `products` VALUES (9, 'SANOUVA DANANG HOTEL', '19.jpg', '68 Phan Châu Trinh, Hải Châu 1, Đà Nẵng', 0, NULL, NULL, 0);
INSERT INTO `products` VALUES (10, 'Continent Hotel Danang', '20.jpg', 'Ngã tư Lê Văn Quí và An Đồn 6, Quận Sơn Trà, Đà Nẵng', 0, NULL, NULL, 0);

-- ----------------------------
-- Table structure for reservate
-- ----------------------------
DROP TABLE IF EXISTS `reservate`;
CREATE TABLE `reservate`  (
  `reservate_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `reservate_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservate_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservate_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservate_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservate_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`reservate_id`) USING BTREE,
  INDEX `fk_userid`(`userid` ASC) USING BTREE,
  CONSTRAINT `fk_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of reservate
-- ----------------------------
INSERT INTO `reservate` VALUES (46, 'kien', 'dong ha', '0498744676', 'trungkien@gmail.com', '0', '2023-12-06 00:09:45', '2023-12-11 22:33:04', 3);
INSERT INTO `reservate` VALUES (48, 'phiquan', 'hà', '123', 'npq@gmail.com', '1', '2023-12-13 16:32:05', '2023-12-16 10:41:07', 12);
INSERT INTO `reservate` VALUES (50, 'Phi quân', 'quảng nam', '1235435', 'npq@gmail.com', '1', '2023-12-23 21:27:07', '2023-12-23 21:27:07', NULL);
INSERT INTO `reservate` VALUES (51, 'Phi quân', 'đà nẵng', '123', 'npq@gmail.com', '0', '2023-12-23 22:23:59', '2023-12-23 22:23:59', 26);
INSERT INTO `reservate` VALUES (52, 'Nguyễn Phi Quân', 'quảng nam', '02131355', 'phiquan0947@gmail.com', '0', '2023-12-24 05:33:05', '2023-12-24 05:33:05', 27);
INSERT INTO `reservate` VALUES (53, 'Nguyễn Phi Quân', 'hà', '03333333', 'phiquan0947@gmail.com', '0', '2023-12-24 07:18:39', '2023-12-24 07:18:39', 27);

-- ----------------------------
-- Table structure for room
-- ----------------------------
DROP TABLE IF EXISTS `room`;
CREATE TABLE `room`  (
  `room_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `HotelID` int UNSIGNED NULL DEFAULT NULL,
  `room_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_Image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_price` bigint NOT NULL,
  `room_no` int NOT NULL,
  `room_status` tinyint NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`room_id`) USING BTREE,
  INDEX `fk_hotelid`(`HotelID` ASC) USING BTREE,
  CONSTRAINT `fk_hotelid` FOREIGN KEY (`HotelID`) REFERENCES `products` (`HotelID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of room
-- ----------------------------
INSERT INTO `room` VALUES (1, 3, '1 giường đôi lớn', 'room1.webp', 813539, 2, 1, NULL, '2023-12-24 04:31:56');
INSERT INTO `room` VALUES (2, 4, '1 Giường Cỡ Queen', 'room2.webp', 1606450, 2, 1, NULL, '2023-12-24 04:31:58');
INSERT INTO `room` VALUES (3, 5, '2 Giường Đơn', 'room3.webp', 1543038, 2, 1, NULL, '2023-12-11 12:37:52');
INSERT INTO `room` VALUES (4, 6, '1 Giường Cỡ King', 'room4.webp', 2345417, 2, 1, NULL, '2023-12-11 12:38:00');
INSERT INTO `room` VALUES (5, 7, '1 Giường Cỡ Queen', 'room5.webp', 573563, 2, 1, NULL, '2023-12-24 04:32:01');
INSERT INTO `room` VALUES (6, 3, '2 Giường Đơn', 'room6.webp', 1296750, 1, 1, NULL, '2023-12-24 04:32:07');
INSERT INTO `room` VALUES (7, 8, '1 Giường Cỡ Queen', 'room3.webp', 500000, 2, 1, NULL, '2023-12-24 04:32:04');
INSERT INTO `room` VALUES (8, 9, '2 giường đôi lớn', 'room7.webp', 1606000, 2, 1, NULL, '2023-12-24 04:31:54');
INSERT INTO `room` VALUES (9, 4, '1 giường đôi', 'r4.webp', 253555, 2, 1, NULL, '2023-12-24 04:32:15');
INSERT INTO `room` VALUES (10, 5, '2 giường đôi', 'r1.jpg', 452777, 2, 1, NULL, '2023-12-24 04:32:26');
INSERT INTO `room` VALUES (11, 6, '2 giường cỡ King', 'r2.jpg', 563000, 2, 1, NULL, '2023-12-24 04:32:21');
INSERT INTO `room` VALUES (12, 7, '1 giường lớn', 'r3.png', 346366, 2, 1, NULL, '2023-12-24 04:32:34');
INSERT INTO `room` VALUES (13, 9, '1 giường đôi lớn', 'r5.jpg', 450000, 2, 1, NULL, '2023-12-24 04:32:30');
INSERT INTO `room` VALUES (14, 10, '1 giường cỡ King', 'r6.jpg', 600000, 2, 1, NULL, '2023-12-24 04:32:39');
INSERT INTO `room` VALUES (15, 10, '1 giường cỡ vừa', 'r7.webp', 350000, 2, 1, NULL, '2023-12-11 12:37:56');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `birthday` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin12@gmail.com', '0', NULL, '123456', NULL, '2023-11-27 13:55:57', '2023-12-13 15:32:03', NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (2, 'nhi', 'nhipt.22it@vku.udn.vn', '0', NULL, '$2y$10$AWWHf2rCWqt/JNGuqRNh6.pPRBsCq//Q36HEoKHp6WnsAPm3YZBam', NULL, '2023-11-30 01:30:35', '2023-11-30 01:30:35', NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (3, 'nhi', 'trungkien2804@gmail.com', '0', NULL, '$2y$10$E/mVgZczC2JWHSClRZaocethTs0HOwLaVg2sUyeDn/wXeY8N/eG7G', NULL, '2023-11-30 10:48:07', '2023-11-30 10:48:07', NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (4, 'bichngoc', 'bichngoc12@gmail.com', '0', NULL, '$2y$10$lIVwb2rmGJtwqxWEJX.dce.YjH.x9MxlTYNhrP/Jerei2QDdfM1/W', NULL, '2023-11-30 15:45:36', '2023-11-30 15:45:36', NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (5, 'nhi', 'phanthaonhi1912@gmail.com', '0', NULL, '$2y$10$061QDYaBSaLpNSdZKqYYjuQ7wb4vFF1pnKmPHq3.OWMLBpVDFtTgS', NULL, '2023-11-30 21:13:06', '2023-11-30 21:13:06', NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (6, 'tienha', 'tienha@gmail.com', '0', NULL, '$2y$10$YaKVTDsjP0rEPZbNbeoMue/2P39uuL798qh2tVbWvuohLDHvLgzqu', NULL, '2023-12-03 21:32:48', '2023-12-03 21:32:48', NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (8, 'nhi', 'nhi1912@gmail.com', '0', NULL, '$2y$10$ar8T07qJJDA/gBYAydSf/u7cBG6vcOLzRexomQ6eS9PEtJb.ErE1y', NULL, '2023-12-04 01:12:20', '2023-12-04 01:12:20', NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (9, 'dieuha', 'dieuha140677@gmail.com', '1', NULL, 'dieuha140677', NULL, NULL, '2023-12-12 10:13:25', NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (12, 'test', 'test12@gmail.com', '0', NULL, '$2y$10$8pTVZUPKX2qKhyiHjaQ6KenqdaA7K05gXVnr1bBd5I0EkmlqtnRUm', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (16, 'tung', 'sontung@gmail.com', '0', NULL, '$2y$10$zGqnhMXwnC7SOOJJvm5mw.86tYid52Rt9hNMGKGmZCtmFU7VTnoru', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (26, 'Phi quân', 'npq@gmail.com', '0', NULL, '$2y$10$nDRpOsnneQxOKKb7RVTnq./S8EUeT9XWr8SnvT588hSTNGARViimS', NULL, '2023-12-13 16:29:44', '2023-12-23 21:17:41', 'Nam', '012345678', 'Hà tĩnh', '2023-12-14');
INSERT INTO `users` VALUES (27, 'Nguyễn Phi Quân', 'phiquan0947@gmail.com', '1', NULL, '$2y$10$ag86XPi.rpOGjd2a9BOtCeJ0NBX.OVG08LJsVzl6vr4vAEGIseMMS', NULL, '2023-12-23 22:44:46', '2023-12-23 22:45:50', NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
