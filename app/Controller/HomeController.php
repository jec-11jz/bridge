<?php

class HomeController extends AppController {
	
	public function index()
	{
		$this->layout = 'menu';
	}
	
	public function test(){
		$this->layout = '';
	}
}

?>