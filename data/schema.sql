CREATE TABLE `users`
(
    `id`       int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name`     varchar(50)  NOT NULL,
    `email`    varchar(255) NOT NULL,
    `password` varchar(300) NOT NULL,
    PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='news/announcements to display on client dashboard';

CREATE TABLE `notes`
(
    `id`       int(11) unsigned NOT NULL AUTO_INCREMENT,
    `title`     varchar(150)  NOT NULL,
    `text`    blob NOT NULL,
    `date`    int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='news/announcements to display on client dashboard';

INSERT INTO `users` (name, email, password)
VALUES ('Jon', 'jon.doa@gmail.com', '123456'); /* TODO: Wird nicht in den Container inserted */