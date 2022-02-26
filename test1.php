<?php
$t=file_get_contents('db_files/users.json');
print_r(json_decode($t));