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

    public function form(){
        return view('head').view('form');
    }

    public function restservice(){
		$request        	= \Config\Services::request();
		$fulladdress 		= $request->getPostGet('fulladdress');

		$curl_handle=curl_init();
		curl_setopt($curl_handle, CURLOPT_URL,'https://nominatim.openstreetmap.org/search?format=json&limit=1&q={'.$fulladdress.'}');
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERAGENT, 'ContactBook');
		$buffer  = curl_exec($curl_handle);
		curl_close($curl_handle);
		echo $buffer;
	}

	public function save(){
        $contactsModel 	 	= new ContactsModel($db);
        $request        	= \Config\Services::request();
        $data           	= array(
			'name'          => trim($request->getPostGet('name')),
			'email'         => trim($request->getPostGet('email')),
            'street_address'=> trim($request->getPostGet('street_address')),
            'number_address'=> trim($request->getPostGet('number_address')),
            'suburb_address'=> trim($request->getPostGet('suburb_address')),
            'zip_code'		=> trim($request->getPostGet('zip_code')),
            'city'			=> trim($request->getPostGet('city')),
            'state'			=> trim($request->getPostGet('state')),
            'phone'			=> trim($request->getPostGet('phone')),
            'latitude'		=> trim($request->getPostGet('latitude')),
            'longitude'		=> trim($request->getPostGet('longitude'))
		);
		$id 				= $request->getPostGet('id');
		if($id){
			$data['id'] 	= $id;
		}
		if($contactsModel->save($data)===false){
			// var_dump($contactsModel->errors());
		}

		$contacts  			= [
			'contacts' 		=> $contactsModel->paginate(3), 
			'pagination' 	=> $contactsModel->pager
		];
		

        return view('head').view('contacts', $contacts);
    }
}
