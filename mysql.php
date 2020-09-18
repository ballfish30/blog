create table User(
    id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    email varchar(25) not null UNIQUE,
    passwd varchar(60) not null,
    userName varchar(25) not null UNIQUE,
    accountName varchar(25) not null UNIQUE
);

create table Article(
    id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    title varchar(25) not null,
    content varchar(120) not null,
    userId int(11) not null,
    CONSTRAINT fk_articleUser_id FOREIGN KEY (userId) REFERENCES User(id) 
);

create table comment(
    id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    content varchar(150) not null,
    userId int(11) not null,
    articleId int(11) not null,
    CONSTRAINT fk_article_id FOREIGN KEY (articleId) REFERENCES Article(id),
    CONSTRAINT fk_commentUser_id FOREIGN KEY (userId) REFERENCES User(id)
);