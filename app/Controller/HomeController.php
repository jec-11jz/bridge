<?php

class HomeController extends AppController {
	
	public $layout = 'menu';
	
	public function index()
	{
		
	}
	
	public function test(){
		$this->layout = '';
	}
}

?>