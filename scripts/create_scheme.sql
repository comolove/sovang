--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `hp` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `grade` int(11) NOT NULL,
  PRIMARY KEY (`index`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Table structure for table `catering_mainSlide`
--

DROP TABLE IF EXISTS `catering_mainSlide`;
CREATE TABLE `catering_mainSlide` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `imageIndex` int(11) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Table structure for table `catering_order`
--

DROP TABLE IF EXISTS `catering_order`;
CREATE TABLE `catering_order` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `organization` varchar(60) DEFAULT NULL COMMENT '단체명',
  `person_in_charge` varchar(30) DEFAULT NULL COMMENT '담당자',
  `hp` varchar(60) DEFAULT NULL COMMENT '연락처',
  `email` varchar(60) DEFAULT NULL COMMENT '이메일',
  `date` datetime DEFAULT NULL COMMENT '날짜 + 시간',
  `headcount` varchar(60) DEFAULT NULL COMMENT '인원',
  `pay_type` varchar(60) DEFAULT NULL COMMENT '결제방법',
  `address` varchar(200) DEFAULT NULL COMMENT '주소',
  `category` varchar(60) DEFAULT NULL COMMENT '카테고리',
  `menu_item` varchar(60) DEFAULT NULL COMMENT '메뉴 항목',
  `menu_set` varchar(60) DEFAULT NULL COMMENT '메뉴 구성',
  `extra_menu` varchar(60) DEFAULT NULL COMMENT '추가 메뉴',
  `extra_message` varchar(500) DEFAULT NULL COMMENT '추가 메시지',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Table structure for table `catering_story`
--

DROP TABLE IF EXISTS `catering_story`;
CREATE TABLE `catering_story` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) DEFAULT NULL,
  `desc` varchar(60) DEFAULT NULL,
  `link` varchar(120) DEFAULT NULL,
  `front_img` int(11) DEFAULT NULL,
  `back_img` int(11) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Table structure for table `fellowship_people`
--

DROP TABLE IF EXISTS `fellowship_people`;
CREATE TABLE `fellowship_people` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `imageIndex` int(11) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE `image` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `pc` varchar(128) DEFAULT NULL,
  `mobile` varchar(128) DEFAULT NULL,
  `tablet` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=273 DEFAULT CHARSET=utf8;

--
-- Table structure for table `mainSlide`
--

DROP TABLE IF EXISTS `mainSlide`;
CREATE TABLE `mainSlide` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `imageIndex` int(11) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

ALTER TABLE `mainSlide` 
ADD COLUMN `link` VARCHAR(300) NULL AFTER `imageIndex`;

--
-- Table structure for table `notice`
--

DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `content` longtext,
  `author` varchar(60) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Table structure for table `notice_mobile`
--

DROP TABLE IF EXISTS `notice_mobile`;
CREATE TABLE `notice_mobile` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `content` longtext,
  `author` varchar(60) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Table structure for table `online_mall`
--

DROP TABLE IF EXISTS `online_mall`;
CREATE TABLE `online_mall` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(30) DEFAULT NULL,
  `item_desc` varchar(60) DEFAULT NULL,
  `link` varchar(120) DEFAULT NULL,
  `imageIndex` int(11) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Table structure for table `present_consult`
--

DROP TABLE IF EXISTS `present_consult`;
CREATE TABLE `present_consult` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `organization` varchar(60) DEFAULT NULL COMMENT '단체명',
  `person_in_charge` varchar(30) DEFAULT NULL COMMENT '담당자',
  `hp` varchar(60) DEFAULT NULL COMMENT '연락처',
  `email` varchar(60) DEFAULT NULL COMMENT '이메일',
  `question` varchar(500) DEFAULT NULL COMMENT '문의 사항',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Table structure for table `present_item`
--

DROP TABLE IF EXISTS `present_item`;
CREATE TABLE `present_item` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) DEFAULT NULL,
  `desc` varchar(60) DEFAULT NULL,
  `popup_title` varchar(60) DEFAULT NULL,
  `body` mediumtext,
  `thumb_img` int(11) DEFAULT NULL,
  `body_img` int(11) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Table structure for table `present_mainSlide`
--

DROP TABLE IF EXISTS `present_mainSlide`;
CREATE TABLE `present_mainSlide` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `imageIndex` int(11) NOT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Table structure for table `present_project`
--

DROP TABLE IF EXISTS `present_project`;
CREATE TABLE `present_project` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) DEFAULT NULL,
  `desc` varchar(60) DEFAULT NULL,
  `link` varchar(120) DEFAULT NULL,
  `front_img` int(11) DEFAULT NULL,
  `back_img` int(11) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Table structure for table `store`
--

DROP TABLE IF EXISTS `store`;
CREATE TABLE `store` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `store_name` varchar(60) DEFAULT NULL,
  `home_image` int(11) DEFAULT NULL,
  `link` varchar(120) DEFAULT NULL,
  `img_list` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;