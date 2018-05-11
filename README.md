Statements used to create the database tables:
    Go to php folder and enter into the sql folder
        In class.sql: class_TBL
        In parent.sql: parent_TBL
                       teacher_TBL
                       student_TBL
                       generalUser_TBL
        In school.sql: school_TBL
    
    Go to Sentences folder and enter into the Schemas folders
        In Character.sql:
                        GameCharacter
                        UserCharacter
                        EnemyCharacter
        In Stages.sql: 
                        Stage
                        SentenceList
                        EnemyLocation
                        UserLocation
        In UserChar.sql: 
                        GamesPlayed
        
Inserting Dummy Data and Inital data into database:
    Go to databaseInit:
        DatabaseCharacters is a php file used to create new game characters when a user is created
        
        DatabaseEnemies is a php file that uses JSON text found in Enemies.txt
            to create enemies within the game.
            
        DatabaseLocations is a php file that uses JSON text found in Location.txt
            to create the locations used in the game
            
        DatabaseSenteces uses a regular text file to fill the database with sentences
            that will be used in th game
        
    
Sample Data Script:
    Create generalUser account (GeneralUserSignUpPage.php)
        You will be able to view a profile, play a game, log out, etc from here
    Create teacher account (TeacherSignUpPage.php)
        When you have created a teacher account you need to remember to use the access code to attach a student to that teacher
        You will be able to create a class name and add students to that particular class and then view the classes. (CreateClassName.php)
        Each class will be a link to view all the information about the students in that particular class
    Create a student account (StudentSignUpPage.php)
        Access code inserted must exist in teacher account previously made
    Login back into teacher account (Login.php)
        Create class and select students
            Students will be displayed who share the same access code as your account
        Go back to profile (Teacher_Profile.php)
        Click on class just created and view students registered (ClassList.php)
            The class list consists of some student info such as their name, wpm
    View Leaderboard (Leaderboard.php)
        this is a leaderboard that consists of both general users and students along with data ordered by either wpm, accuracy, or level

Passing Data to and from game Javascript:
    Go to DatabaseAccess:
        initGame.php is a php file that grabs the information that will be used
            within the game and passes it to the JS files through JSON encoding.
            
        SaveGame.php is a file that is ran through an AJAX request and is sent
            a JSON string that is used to update the database from the results
            of the game.
        