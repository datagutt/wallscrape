<?php
class Deviantart {
	public function __construct($scraper){
		$this->scraper = $scraper;	
	}
	
	public function parse($html){
		$xpath = new DOMXPath($html);
		$links = $xpath->query('//a[@class="thumb"]');
		$urls = array();
		$images = array();
		echo "\r\n --- Searching for urls --- \r\n";
		foreach($links as $link){
			array_push($urls, $link->getAttribute('href'));
		}
		echo "\r\n --- Going through the urls to get image address --- \r\n";
		foreach($urls as $url){
			$html = $this->scraper->getHTMLFromUrl($url);
			$xpath = new DOMXPath($html);
			$result = $xpath->query('//div[@id="zoomed-in"]/img[@id="gmi-ResViewSizer_fullimg"]');
			foreach($result as $img){
				array_push($images, array('url' => $url, 'src' => $img->getAttribute('src')));
			}
		}
		echo "\r\n --- Downloading images --- \r\n";
		$this->downloadAll($images);
	}
	
	public function downloadAll($images){
		foreach($images as $url => $image){
			$exploded = explode('/art/', $image['url']);
			$file = file_get_contents($image['src']);
			$filename = $exploded[1] . '.jpg';
			file_put_contents('images/deviantart/'.$filename, $file);
			echo 'Downloaded: ' . $image['url'];
		}
	}
}