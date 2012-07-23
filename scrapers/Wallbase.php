<?php
class Wallbase {
	public function __construct($scraper){
		$this->scraper = $scraper;	
	}
	
	public function parse($html){
		$xpath = new DOMXPath($html);
		$links = $xpath->query('//*[@class="thumb"]/a["href"]');
		$urls = array();
		$images = array();
		foreach($links as $link){
			array_push($urls, $link->getAttribute('href'));
		}
		foreach($urls as $url){
			$html = $this->scraper->getHTMLFromUrl($url);
			$xpath = new DOMXPath($html);
			$result = $xpath->query('//div[@id="bigwall"]/img["src"]');
			foreach($result as $img){
				array_push($images, array('url' => $url, 'src' => $img->getAttribute('src')));
			}
		}
		$this->downloadAll($images);
	}
	
	public function downloadAll($images){
		foreach($images as $url => $image){
			$exploded = explode('/wallpaper/', $image['url']);
			$file = file_get_contents($image['src']);
			$filename = $exploded[1] . '.jpg';
			file_put_contents('images/wallbase/'.$filename, $file);
			echo 'Downloaded: ' . $image['url'];
		}
	}
}