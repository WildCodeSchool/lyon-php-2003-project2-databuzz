-- Exported from QuickDBD: https://www.quickdatabasediagrams.com/
-- Link to schema: https://app.quickdatabasediagrams.com/#/d/vGD8bt
-- NOTE! If you have used non-SQL datatypes in your design, you will have to change these here.


CREATE TABLE `user` (
    `id` Int  NOT NULL ,
    `username` VARCHAR(255)  NOT NULL ,
    `password` VARCHAR(255)  NOT NULL ,
    `firstname` VARCHAR(255)  NOT NULL ,
    `lastname` VARCHAR(255)  NOT NULL ,
    `email` VARCHAR(320)  NOT NULL ,
    PRIMARY KEY (
        `id`
    )
);

CREATE TABLE `buzz` (
    `user_id` Int  NOT NULL ,
    `tvshow_id` Int  NOT NULL ,
    PRIMARY KEY (
        `user_id`,`tvshow_id`
    )
);

CREATE TABLE `tvshow` (
    `id` Int  NOT NULL ,
    `img` VARCHAR(255)  NOT NULL ,
    `title` VARCHAR(255)  NOT NULL ,
    `synopsis` TEXT  NOT NULL ,
    `year` INT  NOT NULL ,
    PRIMARY KEY (
        `id`
    )
);

CREATE TABLE `season` (
    `id` Int  NOT NULL ,
    `tvshow_id` Int  NOT NULL ,
    `season_number` Int  NOT NULL ,
    `nbEpisodes` Int  NOT NULL ,
    `synopsis` Text  NOT NULL ,
    `img` VARCHAR(255)  NOT NULL ,
    PRIMARY KEY (
        `id`
    )
);

CREATE TABLE `episode` (
    `id` Int  NOT NULL ,
    `season_id` Int  NOT NULL ,
    `episode_number` Int  NOT NULL ,
    `title` VARCHAR(255)  NOT NULL ,
    `synopsis` TEXT  NOT NULL ,
    PRIMARY KEY (
        `id`
    )
);

CREATE TABLE `seen` (
    `user_id` Int  NOT NULL ,
    `episode_id` Int  NOT NULL ,
    PRIMARY KEY (
        `user_id`,`episode_id`
    )
);

CREATE TABLE `friends` (
    `user_id_1` int  NOT NULL ,
    `user_id_2` int  NOT NULL ,
    PRIMARY KEY (
        `user_id_1`,`user_id_2`
    )
);

CREATE TABLE `genre` (
    `id` Int  NOT NULL ,
    `name` VARCHAR(255)  NOT NULL ,
    PRIMARY KEY (
        `id`
    )
);

CREATE TABLE `genre_tvshow` (
    `tvshow_id` int  NOT NULL ,
    `genre_id` int  NOT NULL ,
    PRIMARY KEY (
        `tvshow_id`,`genre_id`
    )
);

CREATE TABLE `genre_user` (
    `user_id` int  NOT NULL ,
    `genre_id` int  NOT NULL ,
    PRIMARY KEY (
        `user_id`,`genre_id`
    )
);

ALTER TABLE `buzz` ADD CONSTRAINT `fk_buzz_user_id` FOREIGN KEY(`user_id`)
REFERENCES `user` (`id`);

ALTER TABLE `buzz` ADD CONSTRAINT `fk_buzz_tvshow_id` FOREIGN KEY(`tvshow_id`)
REFERENCES `tvshow` (`id`);

ALTER TABLE `season` ADD CONSTRAINT `fk_season_tvshow_id` FOREIGN KEY(`tvshow_id`)
REFERENCES `tvshow` (`id`);

ALTER TABLE `episode` ADD CONSTRAINT `fk_episode_season_id` FOREIGN KEY(`season_id`)
REFERENCES `season` (`id`);

ALTER TABLE `seen` ADD CONSTRAINT `fk_seen_user_id` FOREIGN KEY(`user_id`)
REFERENCES `user` (`id`);

ALTER TABLE `seen` ADD CONSTRAINT `fk_seen_episode_id` FOREIGN KEY(`episode_id`)
REFERENCES `episode` (`id`);

ALTER TABLE `friends` ADD CONSTRAINT `fk_friends_user_id_1` FOREIGN KEY(`user_id_1`)
REFERENCES `user` (`id`);

ALTER TABLE `friends` ADD CONSTRAINT `fk_friends_user_id_2` FOREIGN KEY(`user_id_2`)
REFERENCES `user` (`id`);

ALTER TABLE `genre_tvshow` ADD CONSTRAINT `fk_genre_tvshow_tvshow_id` FOREIGN KEY(`tvshow_id`)
REFERENCES `tvshow` (`id`);

ALTER TABLE `genre_tvshow` ADD CONSTRAINT `fk_genre_tvshow_genre_id` FOREIGN KEY(`genre_id`)
REFERENCES `genre` (`id`);

ALTER TABLE `genre_user` ADD CONSTRAINT `fk_genre_user_user_id` FOREIGN KEY(`user_id`)
REFERENCES `user` (`id`);

ALTER TABLE `genre_user` ADD CONSTRAINT `fk_genre_user_genre_id` FOREIGN KEY(`genre_id`)
REFERENCES `genre` (`id`);

