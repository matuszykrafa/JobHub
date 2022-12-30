<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function home() {
        $this->render('home');
    }
    public function offer() {
        $this->render('offer');
    }
    public function addoffer() {
        $this->render('add-offer');
    }
}