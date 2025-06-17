<?php
error_reporting(0);

// Vulnerable file upload
if(isset($_FILES['file'])) {
    move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
    echo "File uploaded successfully!";
}

// Vulnerable SQL query
if(isset($_GET['user'])) {
    $user = $_GET['user'];
    $query = "SELECT * FROM users WHERE username = '$user'";
    echo "Query: " . $query;
}

// Vulnerable command execution
if(isset($_GET['cmd'])) {
    $cmd = $_GET['cmd'];
    system($cmd);
}

// Vulnerable file inclusion
if(isset($_GET['page'])) {
    $page = $_GET['page'];
    include($page);
}

// Vulnerable XML parsing (WDDX)
if(isset($_POST['xml'])) {
    $xml = $_POST['xml'];
    wddx_deserialize($xml);
}

// Vulnerable string handling (mbstring)
if(isset($_GET['str'])) {
    $str = $_GET['str'];
    mb_strcut($str, 0, 100);
}

// Vulnerable ZIP handling
if(isset($_GET['zip'])) {
    $zip = new ZipArchive();
    $zip->open($_GET['zip']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vulnerable PHP App</title>
</head>
<body>
    <h1>Vulnerable PHP Application</h1>
    
    <h2>File Upload</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="Upload">
    </form>

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

    <h2>File Inclusion</h2>
    <form method="GET">
        <input type="text" name="page" placeholder="Enter page">
        <input type="submit" value="Include">
    </form>

    <h2>XML Processing</h2>
    <form method="POST">
        <textarea name="xml" placeholder="Enter XML"></textarea>
        <input type="submit" value="Process">
    </form>

    <h2>String Processing</h2>
    <form method="GET">
        <input type="text" name="str" placeholder="Enter string">
        <input type="submit" value="Process">
    </form>

    <h2>ZIP Processing</h2>
    <form method="GET">
        <input type="text" name="zip" placeholder="Enter ZIP file path">
        <input type="submit" value="Process">
    </form>
</body>
</html>
