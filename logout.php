<?php
require_once('lib/Db.php');
require_once('./lib/functions.php');
session_destroy();
session_unset();
redirect('index.php');

