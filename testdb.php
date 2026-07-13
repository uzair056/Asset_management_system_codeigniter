<?php
$db = 'C:/xampp/htdocs/webdev/codeignator/Employee_Asset_Management_System/writable/asset_management.sqlite';
$conn = new SQLite3($db);
if ($conn) {
    echo "connected\n";
    $conn->close();
} else {
    echo "failed\n";
}
