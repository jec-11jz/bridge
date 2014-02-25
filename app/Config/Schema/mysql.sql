-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- ホスト: localhost
-- 生成日時: 2014 年 2 月 24 日 04:18
-- サーバのバージョン: 5.5.29
-- PHP のバージョン: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `bridge-dev`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `attributes`
--

CREATE TABLE `attributes` (
  `id` char(36) NOT NULL,
  `name` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `attributes_tags`
--

CREATE TABLE `attributes_tags` (
  `id` char(36) NOT NULL,
  `attribute_id` char(36) NOT NULL,
  `tag_id` char(36) NOT NULL,
  `product_id` char(36) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attribute_id` (`attribute_id`,`tag_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `attributes_templates`
--

CREATE TABLE `attributes_templates` (
  `id` char(36) NOT NULL,
  `attribute_id` char(36) NOT NULL,
  `template_id` char(36) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `blogs`
--

CREATE TABLE `blogs` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `product_id` char(36) NOT NULL,
  `spoiler` int(2) NOT NULL DEFAULT '5',
  `simplified_content` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `trackback_count` int(5) NOT NULL DEFAULT '0',
  `access_count` int(10) NOT NULL DEFAULT '0' COMMENT '閲覧数',
  `trackback_id` char(36) NOT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `blogs_favorites`
--

CREATE TABLE `blogs_favorites` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `blog_id` char(36) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `blogs_tags`
--

CREATE TABLE `blogs_tags` (
  `id` char(36) NOT NULL,
  `tag_id` char(36) NOT NULL,
  `blog_id` char(36) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `categories`
--

CREATE TABLE `categories` (
  `id` char(36) NOT NULL,
  `name` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `comments`
--

CREATE TABLE `comments` (
  `id` char(36) NOT NULL,
  `author` varchar(30) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `comment` text NOT NULL,
  `blog_id` char(36) NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `email_auth`
--

CREATE TABLE `email_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` char(36) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status_type` varchar(200) NOT NULL,
  `acl` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userId` (`user_id`,`token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `images`
--

CREATE TABLE `images` (
  `id` char(36) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `upload_date` datetime NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `contents` mediumblob NOT NULL,
  `filesize` int(11) NOT NULL,
  `filetype` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `items`
--

CREATE TABLE `items` (
  `id` char(36) NOT NULL,
  `name` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `products`
--

CREATE TABLE `products` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `outline` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `access_count` int(10) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `products_favorites`
--

CREATE TABLE `products_favorites` (
  `id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `product_id` char(36) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1 = want to see, 2 = watched',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `products_tags`
--

CREATE TABLE `products_tags` (
  `id` char(36) NOT NULL,
  `tag_id` char(36) NOT NULL,
  `product_id` char(36) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `tags`
--

CREATE TABLE `tags` (
  `id` char(36) NOT NULL,
  `name` varchar(30) NOT NULL,
  `count` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `templates`
--

CREATE TABLE `templates` (
  `id` char(36) NOT NULL,
  `name` varchar(30) NOT NULL,
  `user_id` char(36) NOT NULL,
  `template_id` char(36) DEFAULT NULL COMMENT 'グループID',
  `status` int(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `template_configurations`
--

CREATE TABLE `template_configurations` (
  `id` char(36) NOT NULL,
  `template_id` char(36) NOT NULL,
  `item_id` char(36) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `trackback`
--

CREATE TABLE `trackback` (
  `id` char(36) NOT NULL,
  `trackback_blog_title` varchar(30) NOT NULL,
  `trackback_blog_url` char(255) NOT NULL,
  `summary` text NOT NULL,
  `trackback_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `check_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `used_blog_images`
--

CREATE TABLE `used_blog_images` (
  `id` char(36) NOT NULL,
  `blog_id` char(36) NOT NULL,
  `user_id` char(36) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `profile` text,
  `users_image` varchar(255) NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `group_id` int(36) NOT NULL,
  `status` int(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `users_friends`
--

CREATE TABLE `users_friends` (
  `id` char(36) NOT NULL,
  `owner_id` char(36) NOT NULL,
  `friend_id` char(36) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
