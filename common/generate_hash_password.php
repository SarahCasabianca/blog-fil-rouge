<?php
$passwords = ['admin123', 'owner123', 'customer123'];

foreach ($passwords as $password) {
    echo $password . ' → ' . password_hash($password, PASSWORD_DEFAULT) . '<br><br>';
}