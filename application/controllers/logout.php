<?php

session_destroy();
Admin::logout();
header('location: ' . U . 'admin/');
