USE egr302;
DROP TABLE if EXISTS EnemyLocation;
DROP TABLE if EXISTS UserLocation;
DROP TABLE if EXISTS SentenceList;
DROP TABLE if EXISTS Stage;
-- DROP TABLE if EXISTS Sentence;
CREATE TABLE Stage(
    StageNum int PRIMARY KEY,
    Location varChar(25),
    BackgroundImage varChar(255)
);

-- CREATE TABLE Sentence(
--     VerseName varChar(30) PRIMARY KEY,
--     Sentence varChar(255),
--     Length int
-- );

CREATE TABLE SentenceList(
    fkVerseName varChar(30),
    fkStageNum int,
    PRIMARY KEY(fkVerseName, fkStageNum),
    CONSTRAINT fk_VerseName FOREIGN KEY (fkVerseName) REFERENCES Sentence(VerseName),
    CONSTRAINT fk_Location FOREIGN KEY (fkStageNum) REFERENCES Stage(StageNum)
);

CREATE TABLE EnemyLocation(
    fkCharID int,
    fkStageNum int,
    PRIMARY KEY (fkCharID, fkStageNum),
    FOREIGN KEY (fkCharID) REFERENCES EnemyCharacter(fkCharID),
    FOREIGN KEY (fkStageNum) REFERENCES Stage(StageNum)
);

CREATE TABLE UserLocation(
    fkCharID int,
    fkStageNum int,
    PRIMARY KEY(fkCharID, fkStageNum),
    FOREIGN KEY (fkCharID) REFERENCES UserCharacter(fkCharID),
    FOREIGN KEY (fkStageNum) REFERENCES Stage(StageNum)
);
