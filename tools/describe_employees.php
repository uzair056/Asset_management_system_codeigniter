<?php

$db = new mysqli('localhost', 'root', '', 'Employee_Asset_Management_System_codeigniter', 3306);
if ($db->connect_error) {
    fwrite(STDERR, "DB connect error: {$db->connect_error}\n");
    exit(1);
}

$res = $db->query('DESCRIBE employees');
if (!$res) {
    fwrite(STDERR, "Query error: {$db->error}\n");
    exit(1);
}

while ($row = $res->fetch_assoc()) {
    echo $row['Field'] . "\t" . $row['Type'] . "\n";
}

