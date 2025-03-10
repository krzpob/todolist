CREATE TABLE IF NOT EXISTS tasks (
    id BIGINT PRIMARY KEY auto_increment,
    task VARCHAR(500),
    status VARCHAR(10)
) CHARACTER SET utf8 COLLATE utf8_bin;

ALTER TABLE tasks ADD COLUMN email VARCHAR(255);

CREATE INDEX email_idx ON tasks(email);