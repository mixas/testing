<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
    
	public function index(){
        render('pages/main','main');
	}
    public function main(){
        render('pages/main','main');
	}
    public function about(){
        render('pages/about','about');
    }
    public function contact(){
        render('pages/contact','contact');
	}
}