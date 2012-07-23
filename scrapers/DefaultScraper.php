<?php
class DefaultScraper {
	public $linksRegex = '';
	public $imageRegex = '';
	public $filenameString = '';
	public $name = 'defaultscraper';
	
	public function __construct($scraper){
		$this->scraper = $scraper;	
	}
	
	public function parse($html){
		$xpath = new DOMXPath($html);
		$links = $xpath->query($this->linksRegex);
		$urls = array();
		echo "\r\n --- Searching for urls --- \r\n";
		foreach($links as $link){
			array_push($urls, $link->getAttribute('href'));
		}
		echo "\r\n --- Going through the urls finding images --- \r\n";
		foreach($urls as $url){
			$html = $this->scraper->getHTMLFromUrl($url);
			$xpath = new DOMXPath($html);
			$result = $xpath->query($this->imageRegex);
			foreach($result as $img){
				$this->download(array('url' => $url, 'src' => $img->getAttribute('src')));
			}
		}
	}
	
	public function download($image){
		$exploded = explode($this->filenameString, $image['url']);
		$file = file_get_contents($image['src']);
		$filename = $exploded[1] . '.jpg';
		file_put_contents('images/'.$this->name.'/'.$filename, $file);
		echo 'Downloaded: ' . $image['url'] . "\r\n";
	}
}