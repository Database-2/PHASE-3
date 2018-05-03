DROP TABLE if exists thumb;
DROP TABLE if exists dislike;
DROP TABLE if exists comment;
DROP TABLE if exists twitts;
DROP TABLE if exists follow;
DROP TABLE if exists message;
DROP TABLE if exists user;

CREATE TABLE `user` (
 `uid` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(255) NOT NULL,
 `password` varchar(255) NOT NULL,
 `email` varchar(255) NOT NULL,
 `location` varchar(255) NOT NULL,
 `regis_date` datetime NOT NULL,
 PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


CREATE TABLE `twitts` (
 `tid` int(11) NOT NULL AUTO_INCREMENT,
 `uid` int(11) NOT NULL,
 `body` varchar(255) NOT NULL,
 `post_time` datetime NOT NULL,
 PRIMARY KEY (`tid`),
 KEY `uid` (`uid`),
 CONSTRAINT `twitts_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `follow` (
 `follower_id` int(11) NOT NULL,
 `following_id` int(11) NOT NULL,
 `follow_time` datetime NOT NULL,
 PRIMARY KEY (`follower_id`,`following_id`),
 KEY `follower_id` (`follower_id`,`following_id`),
 KEY `following_id` (`following_id`),
 CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`following_id`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `message` (
 `message_id` int(11) NOT NULL AUTO_INCREMENT,
 `sender_id` int(11) NOT NULL,
 `receiver_id` int(11) NOT NULL,
 `body` varchar(255) NOT NULL,
 `send_time` datetime NOT NULL,
 PRIMARY KEY (`message_id`),
 KEY `sender_id` (`sender_id`,`receiver_id`),
 KEY `message_ibfk_2` (`receiver_id`),
 CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `message_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `comment` (
 `cid` int(11) NOT NULL AUTO_INCREMENT,
 `uid` int(11) NOT NULL,
 `tid` int(11) NOT NULL,
 `body` varchar(255) NOT NULL,
 `comment_time` datetime NOT NULL,
 PRIMARY KEY (`cid`,`uid`,`tid`),
 KEY `uid` (`uid`),
 KEY `tid` (`tid`),
 CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `twitts` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `thumb` (
 `like_id` int(11) NOT NULL AUTO_INCREMENT,
 `uid` int(11) NOT NULL,
 `tid` int(11) NOT NULL,
 PRIMARY KEY (`like_id`,`uid`,`tid`),
 KEY `uid` (`uid`,`tid`),
 KEY `tid` (`tid`),
 CONSTRAINT `thumb_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `twitts` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `thumb_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `dislike` (
 `dislike_id` int(11) NOT NULL AUTO_INCREMENT,
 `uid` int(11) NOT NULL,
 `tid` int(11) NOT NULL,
 PRIMARY KEY (`dislike_id`,`uid`,`tid`),
 KEY `uid` (`uid`,`tid`),
 KEY `tid` (`tid`),
 CONSTRAINT `dislike_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `twitts` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `dislike_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






















