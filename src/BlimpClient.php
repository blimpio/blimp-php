<?php

require_once __DIR__ . '/Requests/library/Requests.php';
Requests::register_autoloader ();

require_once __DIR__ . '/Blimp/Client.php';

class_alias ('\Blimp\Client', 'BlimpClient');