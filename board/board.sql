CREATE TABLE board(
    num INTEGER AUTO_INCREMENT,
    id VARCHAR(15) NOT NULL,
    name VARCHAR(20) NOT NULL,
    subject VARCHAR(80) NOT NULL,
    content TEXT,
    regist_day VARCHAR(20),
    hit INTEGER,
    file_name VARCHAR(40),
    file_type VARCHAR(40),
    file_copied VARCHAR(40),
    PRIMARY KEY(num),
    FOREIGN KEY(id) REFERENCES member(id)
);

-- FOREIGN KEY(id) REFERENCES member(id)넣게 되면 sql로 board에 넣으려고 할때
-- member의 id와 같은게 없다면 넣지 못하게 한다. 