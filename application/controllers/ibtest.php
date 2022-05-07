<?php
if (!defined('APP_RUN')) {
    exit('No direct access allowed');
}
$data = [
    'ibilling' => 'yes',
    'file_build' => $file_build,
];
header('Content-type: application/json');
echo json_encode($data);
