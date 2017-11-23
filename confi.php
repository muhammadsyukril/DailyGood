<?php
// $conn = mysql_connect("localhost", "root", "");
// mysql_select_db('c9', $conn);

  $db = new SQLite3('Database.db');
    $query = <<<EOD
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name VARCHAR(32) NOT NULL,
        password VARCHAR(32) NOT NULL
    );
    CREATE TABLE IF NOT EXISTS userinfo (
            userid INTEGER PRIMARY KEY,
            city VARCHAR(32) NOT NULL,
            score INTEGER DEFAULT 0,
            completedtasks INTEGER DEFAULT 0,
            completedgoals INTEGER DEFAULT 0,
            FOREIGN KEY (userid) REFERENCES users(id)
    );
    
    CREATE TABLE IF NOT EXISTS tasks (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name CHAR(100) UNIQUE NOT NULL,
        scoretogive INTEGER DEFAULT 0
    );

    
    CREATE TABLE IF NOT EXISTS goals (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name CHAR(100) UNIQUE NOT NULL,
        scoretogive INTEGER DEFAULT 0
    );
    CREATE TABLE IF NOT EXISTS usertasks (
        userid INTEGER PRIMARY KEY,
        taskid1 INTEGER NOT NULL,
        taskid2 INTEGER NOT NULL,
        taskid3 INTEGER NOT NULL,
        date VARCHAR(32) NOT NULL,
        time VARCHAR(32) NOT NULL,
        FOREIGN KEY (userid) REFERENCES users(id)

    );
    CREATE TABLE IF NOT EXISTS usertask (
        userid INTEGER NOT NULL,
        taskid INTEGER NOT NULL, 
        status BIT DEFAULT 0,
        PRIMARY KEY(userid,taskid),
        FOREIGN KEY (userid) REFERENCES users(id),
        FOREIGN KEY (taskid) REFERENCES tasks(id)
    );
EOD;
    $db->exec($query);
    
    
    
    $query = <<<EOD
    INSERT OR IGNORE INTO users VALUES (0,'test0', 'test');
    INSERT OR IGNORE INTO users VALUES (1,'test1', 'test');
    INSERT OR IGNORE INTO users VALUES (2,'test2', 'test');
    INSERT OR IGNORE INTO users VALUES (3,'test3', 'test');
    INSERT OR IGNORE INTO tasks VALUES (0,'Eat cake.',10);
    INSERT OR IGNORE INTO tasks VALUES (1,'Ride a bike.',10);
    INSERT OR IGNORE INTO tasks VALUES (2,'Dont watch tv.',10);
    INSERT OR IGNORE INTO tasks VALUES (3,'Dont use car.',10);
    INSERT OR IGNORE INTO goals VALUES (0,'Complete ten goals.',10);
    INSERT OR IGNORE INTO goals VALUES (1,'Do all tasks.',10);
    INSERT OR IGNORE INTO goals VALUES (2,'Do 10 tasks in a week.',10);
    INSERT OR IGNORE INTO goals VALUES (3,'Do task everyday.',10);

EOD;
    $db->exec($query);
    
    

?>