USE egr302;

DROP TABLE if EXISTS EnemyCharacter;
DROP TABLE if EXISTS UserCharacter;
DROP TABLE if EXISTS GameCharacter;

CREATE TABLE GameCharacter(
    CharID int PRIMARY KEY,
    Attack int DEFAULT 10,
    Defense int DEFAULT 5,
    Health int DEFAULT 100
);


CREATE TABLE UserCharacter(
    fkCharID int,
    fkUserID int,
    Wpm double(5,2) NULL DEFAULT 0,
    Accuracy double(5,2) DEFAULT 0,
    CurrXP int DEFAULT 0,
    XP2LVL int DEFAULT 100,
    Charlevel int DEFAULT 1,
    PRIMARY KEY(fkCharID, fkUserID),
    CONSTRAINT FK_CharID FOREIGN KEY (fkCharID) REFERENCES GameCharacter(CharID),
    CONSTRAINT FK_UserID FOREIGN KEY (fkUserID) REFERENCES parent_TBL(accountID)
);

This was in the DB:
UserCharacter: fkCharID int PRIMARY KEY NOT NULL, Wpm double(5,2) NULL, CONSTRAINT for fkCharID



CREATE TABLE EnemyCharacter(
    fkCharID int PRIMARY KEY,
    EnemyName varChar(25),
    EnemyImage varChar(255),
    XP int NOT NULL,
    CONSTRAINT FK_EnemyCharID FOREIGN KEY (fkCharID) REFERENCES GameCharacter(CharID)
);



