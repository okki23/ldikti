/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : db_ldikti

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 19/01/2020 09:52:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_jabatan
-- ----------------------------
DROP TABLE IF EXISTS `m_jabatan`;
CREATE TABLE `m_jabatan`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `eselon` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_jabatan
-- ----------------------------
INSERT INTO `m_jabatan` VALUES (1, 'PLT Administrasi Keuangan', 'IID');
INSERT INTO `m_jabatan` VALUES (2, 'PLT Sistem Admin', 'I D');
INSERT INTO `m_jabatan` VALUES (3, 'Kasubag Sisfo', 'IV A');
INSERT INTO `m_jabatan` VALUES (5, 'PLT Manajemen Information System', NULL);

-- ----------------------------
-- Table structure for m_jenis_surat
-- ----------------------------
DROP TABLE IF EXISTS `m_jenis_surat`;
CREATE TABLE `m_jenis_surat`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `jenis_surat` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_jenis_surat
-- ----------------------------
INSERT INTO `m_jenis_surat` VALUES (1, 'Surat Undangan');
INSERT INTO `m_jenis_surat` VALUES (2, 'Surat Peringatan');

-- ----------------------------
-- Table structure for m_pegawai
-- ----------------------------
DROP TABLE IF EXISTS `m_pegawai`;
CREATE TABLE `m_pegawai`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_jabatan` int(10) NULL DEFAULT NULL,
  `nip` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jk` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `telp` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_pegawai
-- ----------------------------
INSERT INTO `m_pegawai` VALUES (1, 1, '284762', 'Okki Setyawan', 'Jl.Bintara', 'L', '021994353', 'okkisetyawan@gmail.com');
INSERT INTO `m_pegawai` VALUES (2, 3, '974543', 'Suparman', 'Jl.Swayada', 'L', '0218345379', 'suparman@mail.com');
INSERT INTO `m_pegawai` VALUES (6, 2, '2374274', 'Yahya', 'Jl.A', 'L', '0218734', 'jancuk@mail.com');
INSERT INTO `m_pegawai` VALUES (7, 3, '5635346354634536', 'Udin', 'Jl.Bintara', 'L', '0218954373', 'din@mail.com');

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(10) NULL DEFAULT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `level` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES (1, 1, 'okki', 'YQ==', '1');
INSERT INTO `m_user` VALUES (2, 2, 'suparman', 'YQ==', '2');
INSERT INTO `m_user` VALUES (3, 6, 'yahya', 'YQ==', '');

-- ----------------------------
-- Table structure for t_surat_keluar
-- ----------------------------
DROP TABLE IF EXISTS `t_surat_keluar`;
CREATE TABLE `t_surat_keluar`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_jenis_surat` int(10) NULL DEFAULT NULL,
  `no_surat` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_penerima` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat_penerima` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `telp_penerima` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal_keluar` date NULL DEFAULT NULL,
  `pic` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `file` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `date_update` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_surat_keluar
-- ----------------------------
INSERT INTO `t_surat_keluar` VALUES (1, 2, '202001190000001', 'OkkiS', 'Bekasi D', '02174353499', '2020-01-28', 'suparman', 'note_15jan2020.txt', '2020-01-19 09:15:07');

-- ----------------------------
-- Table structure for t_surat_masuk
-- ----------------------------
DROP TABLE IF EXISTS `t_surat_masuk`;
CREATE TABLE `t_surat_masuk`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_jenis_surat` int(10) NULL DEFAULT NULL,
  `no_surat` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pengirim` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat_pengirim` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `telp_pengirim` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal_masuk` date NULL DEFAULT NULL,
  `pic` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `disposisi` int(10) NULL DEFAULT NULL,
  `file` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `date_update` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_surat_masuk
-- ----------------------------
INSERT INTO `t_surat_masuk` VALUES (3, 1, '202001190000001', 'Okki SS', 'Jl', '02189345', '2020-01-19', 'suparman', 2, 'stg', '2020-01-19 09:22:06');

SET FOREIGN_KEY_CHECKS = 1;
