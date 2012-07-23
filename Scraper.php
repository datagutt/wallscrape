<?php
class Scraper {
	public $urls = array();
	
	public function __construct($urls){
		//@libxml_use_internal_errors(true);
		$this->urls = $urls;
	}
	
	public function loadScraper($scraper){
		if(file_exists('scrapers/'.$scraper.'.php')){
			require_once 'scrapers/'.$scraper.'.php';
		}
	}
	
	public function run(){
		foreach($this->urls as $scraper => $url){
			if(!class_exists($scraper)){
				$this->loadScraper($scraper);
			}
			$s = new $scraper($this);
			$s->parse($this->getHTMLFromUrl($url));
		}
	}
	
	public function getHTMLFromUrl($url){
		$html = new DOMDocument();
		@$html->loadHTMLFile($url);
	    return $html;
	}
}