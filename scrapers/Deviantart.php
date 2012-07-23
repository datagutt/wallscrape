<?php
class Deviantart extends DefaultScraper {
	public $linksRegex = '//a[@class="thumb"]';
	public $imageRegex = '//div[@id="zoomed-in"]/img[@id="gmi-ResViewSizer_fullimg"]';
	public $filenameString = '/art/';
	public $name = 'deviantart';
}