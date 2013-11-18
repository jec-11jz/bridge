<?php
App::uses('AppController', 'Controller');
 
class SampleController extends AppController {
 
  public function index() {
    $this->autoLayout = false;
  }
}