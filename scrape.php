<?php
ini_set('display_errors', 1);
error_reporting(-1);
require 'Scraper.php';
$scraper = new Scraper(array(
	'wallbase' => 'http://wallbase.cc/toplist'
));
$scraper->run();