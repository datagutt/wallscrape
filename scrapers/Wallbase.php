<?php
class Wallbase extends DefaultScraper {
	public $linksRegex = '//*[@class="thumb"]/a["href"]';
	public $imageRegex = '//div[@id="bigwall"]/img["src"]';
	public $filenameString = '/wallpaper/';
	public $name = 'wallbase';
}