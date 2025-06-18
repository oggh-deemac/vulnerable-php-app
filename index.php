<?php
// Disable error reporting to hide warnings
error_reporting(0);

// 1. SQL Injection - Using mysql_* functions (deprecated and vulnerable)
if(isset($_GET['user'])) {
    $user = $_GET['user'];
    $conn = mysql_connect("localhost", "root", "");
    mysql_select_db("test");
    $query = "SELECT * FROM users WHERE username = '$user'";
    $result = mysql_query($query);
}

// 2. Command Injection - Direct system call
if(isset($_GET['cmd'])) {
    $cmd = $_GET['cmd'];
    system($cmd);
}

// 3. File Upload - No validation
if(isset($_FILES['file'])) {
    $target = $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $target);
}

// 4. Local File Inclusion - Direct include
if(isset($_GET['page'])) {
    $page = $_GET['page'];
    include($page);
}

// 5. XSS - Direct output
if(isset($_GET['name'])) {
    $name = $_GET['name'];
    echo "<h1>Welcome " . $name . "!</h1>";
}

// 6. XML External Entity (XXE)
if(isset($_POST['xml'])) {
    $xml = $_POST['xml'];
    $dom = new DOMDocument();
    $dom->loadXML($xml, LIBXML_NOENT | LIBXML_DTDLOAD);
}

// 7. Insecure Deserialization
if(isset($_POST['data'])) {
    $data = $_POST['data'];
    unserialize($data);
}

// 8. Hardcoded Credentials
$db_user = "admin";
$db_pass = "super_secret_password123";
$db_host = "localhost";

// 9. Insecure Cookie
setcookie("user", "admin", 0, "/", "", false, false);

// 10. Debug Information Exposure
if(isset($_GET['debug'])) {
    phpinfo();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vulnerable PHP App</title>
</head>
<body>
    <h1>Vulnerable PHP Application</h1>
    
    <h2>SQL Injection</h2>
    <form method="GET">
        <input type="text" name="user" placeholder="Enter username">
        <input type="submit" value="Search">
    </form>

    <h2>Command Execution</h2>
    <form method="GET">
        <input type="text" name="cmd" placeholder="Enter command">
        <input type="submit" value="Execute">
    </form>

    <h2>File Upload</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="Upload">
    </form>

    <h2>File Inclusion</h2>
    <form method="GET">
        <input type="text" name="page" placeholder="Enter page">
        <input type="submit" value="Include">
    </form>

    <h2>XSS</h2>
    <form method="GET">
        <input type="text" name="name" placeholder="Enter your name">
        <input type="submit" value="Submit">
    </form>

    <h2>XXE</h2>
    <form method="POST">
        <textarea name="xml" placeholder="Enter XML"></textarea>
        <input type="submit" value="Process">
    </form>

    <h2>Insecure Deserialization</h2>
    <form method="POST">
        <textarea name="data" placeholder="Enter serialized data"></textarea>
        <input type="submit" value="Process">
    </form>

    <h2>Debug Information</h2>
    <form method="GET">
        <input type="hidden" name="debug" value="1">
        <input type="submit" value="Show Debug Info">
    </form>
</body>
</html>
