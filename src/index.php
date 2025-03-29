<?php
require_once 'Db.php';
require_once 'Report.php';

$report = new Report(new Db());

$report->getData();

$report->generateHtml();