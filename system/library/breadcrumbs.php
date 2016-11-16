<?php
class Breadcrumbs {
	
	private $links;
	
	public function __construct() {
		$this->links = array();
		
		$this->add(lang('text_home'), '/');
	}
	
	public function add($text, $link) {
		$this->links[$text] = $link;
	}
	
	public function render() {
		$output = '';
		
		if($this->links) {
			$output .= '<ul class="breadcrumb">';
			
			foreach($this->links as $text => $link) {
				$output .= '<li><a href="'.$link.'">'.$text.'</a></li>';
			}
			
			$output .= '</ul>';
		}
		
		return $output;
	}
	
}