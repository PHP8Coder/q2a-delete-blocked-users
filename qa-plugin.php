<?php
/*
    Plugin Name: Delete Blocked Users
    Plugin URI: https://phpx.dev/
    Plugin Description: Batch delete all blocked users (QA_USER_FLAGS_USER_BLOCKED)
    Plugin Version: 1.0
    Plugin Date: 2025-04-20
    Plugin Author: Torsten Wenzel
    Plugin License: GPLv2
    Plugin Minimum Question2Answer Version: 1.8
*/

if (!defined('QA_VERSION')) {
    header('Location: ../../');
    exit;
}

qa_register_plugin_module('module', 'delete-blocked-users-admin.php', 'delete_blocked_users_admin', 'Delete Blocked Users');
