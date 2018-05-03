delete from dislike;
delete from thumb;
delete from comment;
delete from message;
delete from twitts;
delete from follow;
delete from user;

ALTER TABLE user AUTO_INCREMENT=1;
ALTER TABLE twitts AUTO_INCREMENT=1;
ALTER TABLE message AUTO_INCREMENT=1;
ALTER TABLE comment AUTO_INCREMENT=1;
ALTER TABLE thumb AUTO_INCREMENT=1;
ALTER TABLE dislike AUTO_INCREMENT=1;


INSERT INTO user values(null,'chenxi','11111','chenxi@gmail.com','Lowell, MA',NOW());
INSERT INTO user values(null,'bel','22222','bel@gmail.com', 'Boston, MA' ,NOW());
INSERT INTO user values(null,'Alice','33333','Alice@gmail.com', 'Lowell, MA' ,NOW());

INSERT INTO follow values(1,2,NOW());
INSERT INTO follow values(1,3,NOW());
INSERT INTO follow values(2,1,NOW());

INSERT INTO twitts values(null,1,'hello world',NOW());
INSERT INTO twitts values(null,2,'i love my dog',NOW());
INSERT INTO twitts values(null,3,'i love my cat',NOW());

INSERT INTO message values(null,1,2, 'HOW ARE U', NOW());
INSERT INTO message values(null,2,1, 'FINE, HOW ARE U', NOW());

INSERT INTO comment values(null, 2, 1, 'ME TOO',NOW());
INSERT INTO comment values(null, 3, 1, 'NICE',NOW());

INSERT INTO thumb values(null,2,1);
INSERT INTO thumb values(null,1,1);

INSERT INTO dislike values(null,3,2);


