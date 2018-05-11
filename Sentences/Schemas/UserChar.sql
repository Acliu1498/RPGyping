USE egr302;
-- DROP TABLE IF EXISTS UserItem;
DROP TABLE IF EXISTS GamesPlayed;
CREATE TABLE GamesPlayed(
    fkCharID int PRIMARY KEY,
    NumSentences int DEFAULT 0,
    NumStages int DEFAULT 0,
    CONSTRAINT FK_GamesCharID FOREIGN KEY (fkCharID) REFERENCES UserCharacter(fkCharID) 
);



