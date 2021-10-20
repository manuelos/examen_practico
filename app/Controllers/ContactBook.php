<?php
namespace App\Controllers;

use App\Models\ContactsModel;

class ContactBook extends BaseController{
    public function __construct(){
        helper('form');
    }
    
    public function index(){
        $contactsModel 		= new ContactsModel($db);
        
        $contacts  			= [
			'contacts' 		=> $contactsModel->paginate(3), 
			'pagination' 	=> $contactsModel->pager
		];

        return view('head').view('contacts', $contacts);
    }
}
