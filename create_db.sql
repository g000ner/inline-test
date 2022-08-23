CREATE TABLE post (
    id INT PRIMARY KEY,
    user_id INT NOT NULL,
    title varchar(255),
    body text
);

CREATE TABLE comment (
    id INT PRIMARY KEY,
    post_id INT NOT NULL,
    name VARCHAR(255),
    email VARCHAR(128),
    body TEXT,
    FOREIGN KEY (post_id) REFERENCES post(id) 
);