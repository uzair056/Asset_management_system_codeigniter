<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$dbName = 'Employee_Asset_Management_System_codeigniter';
$db = new mysqli('localhost', 'root', '', $dbName, 3306);
$db->set_charset('utf8mb4');

$db->query('SET FOREIGN_KEY_CHECKS=0');
foreach (['asset_assignments', 'assets', 'employees', 'users'] as $table) {
    $db->query("TRUNCATE TABLE `$table`");
    echo "Truncated $table\n";
}
$db->query('SET FOREIGN_KEY_CHECKS=1');

echo "Done.\n";

