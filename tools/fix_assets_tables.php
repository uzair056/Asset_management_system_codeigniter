<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$dbName = 'Employee_Asset_Management_System_codeigniter';
$db = new mysqli('localhost', 'root', '', $dbName, 3306);
$db->set_charset('utf8mb4');

function tableExists(mysqli $db, string $dbName, string $table): bool
{
    $stmt = $db->prepare('SELECT COUNT(*) AS c FROM information_schema.TABLES WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?');
    $stmt->bind_param('ss', $dbName, $table);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    return ((int) ($res['c'] ?? 0)) > 0;
}

if (!tableExists($db, $dbName, 'assets')) {
    $db->query(
        "CREATE TABLE `assets` (
            `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(150) NOT NULL,
            `type` VARCHAR(50) NOT NULL,
            `serial_number` VARCHAR(100) NULL,
            `status` VARCHAR(30) NOT NULL DEFAULT 'available',
            `purchase_date` DATE NULL,
            `notes` TEXT NULL,
            `created_at` DATETIME NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
    );
    echo "Created table assets\n";
}

if (!tableExists($db, $dbName, 'asset_assignments')) {
    $db->query(
        "CREATE TABLE `asset_assignments` (
            `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `employee_id` INT(11) UNSIGNED NULL,
            `asset_id` INT(11) UNSIGNED NULL,
            `assigned_at` DATETIME NULL,
            `returned_at` DATETIME NULL,
            `status` VARCHAR(30) NOT NULL DEFAULT 'assigned',
            `notes` TEXT NULL,
            `created_at` DATETIME NULL,
            `updated_at` DATETIME NULL,
            `deleted_at` DATETIME NULL,
            PRIMARY KEY (`id`),
            KEY `idx_employee_id` (`employee_id`),
            KEY `idx_asset_id` (`asset_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
    );
    echo "Created table asset_assignments\n";
}

echo "Done.\n";

