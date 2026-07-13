<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$dbName = 'Employee_Asset_Management_System_codeigniter';
$db = new mysqli('localhost', 'root', '', $dbName, 3306);
$db->set_charset('utf8mb4');

function columnExists(mysqli $db, string $dbName, string $table, string $column): bool
{
    $stmt = $db->prepare('SELECT COUNT(*) AS c FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND COLUMN_NAME = ?');
    $stmt->bind_param('sss', $dbName, $table, $column);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    return ((int) ($res['c'] ?? 0)) > 0;
}

$table = 'employees';
if (!columnExists($db, $dbName, $table, 'employee_name')) {
    $db->query("ALTER TABLE `employees` ADD COLUMN `employee_name` VARCHAR(150) NULL AFTER `user_id`");
    echo "Added employees.employee_name\n";
}
if (!columnExists($db, $dbName, $table, 'email')) {
    $db->query("ALTER TABLE `employees` ADD COLUMN `email` VARCHAR(150) NULL AFTER `designation`");
    echo "Added employees.email\n";
}
if (!columnExists($db, $dbName, $table, 'phone')) {
    $db->query("ALTER TABLE `employees` ADD COLUMN `phone` VARCHAR(30) NULL AFTER `email`");
    echo "Added employees.phone\n";
}
if (!columnExists($db, $dbName, $table, 'photo')) {
    $db->query("ALTER TABLE `employees` ADD COLUMN `photo` VARCHAR(255) NULL AFTER `phone`");
    echo "Added employees.photo\n";
}

echo "Done.\n";

