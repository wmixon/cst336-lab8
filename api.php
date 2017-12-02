<?php



function getDatabaseConnection() {
    $host = "us-cdbr-iron-east-05.cleardb.net";
    $username = "bb108e997bcdab";
    $password = "7b071f8b";
    $dbname = "heroku_3d24ca78bc82e88"; 
    
    $host = "us-cdbr-iron-east-05.cleardb.net";
    $username = "bdb5384f6f52f0";
    $password = "caeb83fc";
    $dbname = "heroku_e85b7747a279cb7";
    
    // Create connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbConn; 
}



function getUsersThatMatchUserName() {
    
    $username = $_GET['username'];
    $dbConn = getDatabaseConnection(); 
    
    $sql = "SELECT * from user WHERE username='$username'"; 
    
    $statement = $dbConn->prepare($sql); 
    $statement->execute(); 
    $records = $statement->fetchAll(); 
    echo json_encode($records); 
}

function validatePassword() {
    $username = $_GET['username']; 
    $password = $_GET['password'];
    
    //database logic to confirm that the password matches the stored password in the DB
    
    echo sha1($password);
}

if ($_GET['action'] == 'validate-username' ) {
    getUsersThatMatchUserName(); 
} else if ($_GET['action'] == 'validate-password') {
    
}

//getUsersThatMatchUserName(); 

?>