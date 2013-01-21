<?php
class Url {
	private $url;
	private $ssl;
	private $rewrite = array();
	
	public function __construct($url, $ssl = '') {
		$this->url = $url;
		$this->ssl = $ssl;
	}
		
	public function addRewrite($rewrite) {
		$this->rewrite[] = $rewrite;
	}
	//ocshop seo_pro multilang
	//public function link($route, $args = '', $connection = 'NONSSL') {
	public function link($route, $args = '', $connection = 'NONSSL', $code = '') {
	//end ocshop seo_pro multilang
		if ($connection ==  'NONSSL') {
			$url = $this->url;	
		} else {
			$url = $this->ssl;	
		}
		
		//ocshop seo_pro multilang
		//$url .= 'index.php?route=' . $route;
		$url .= $code . 'index.php?route=' . $route;
		//end ocshop seo_pro multilang
			
		if ($args) {
			$url .= str_replace('&', '&amp;', '&' . ltrim($args, '&')); 
		}
		
		foreach ($this->rewrite as $rewrite) {
			//ocshop seo_pro multilang
			//$url = $rewrite->rewrite($url);
			$url = $rewrite->rewrite($url, $code);
			//end ocshop seo_pro multilang
		}
				
		return $url;
	}
}
?>