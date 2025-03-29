<?php

require_once 'Db.php';
require_once 'BookShopInstall.php';

BookShopInstall::installAll(new Db());
