<?php namespace App\Models;

use CodeIgniter\Model;

class ContactsModel extends Model{
    protected $table            	= 'contacts';
    protected $primaryKey       	= 'id';

    protected $returnType       	= 'array';
    protected $useSoftDeletes   	= true;
    
    protected $allowedFields     	= [
		'name', 
		'email', 
		'street_address', 
		'number_address', 
		'suburb_address', 
		'zip_code', 
		'city', 
		'state', 
		'phone', 
		'latitude', 
		'longitude'
	];

    protected $useTimestamps		= false;
    protected $createdField			= 'created_at';
    protected $updatedField			= 'updated_at';

    protected $validationRules  	= [
		'name' => 'required',
		'email' => 'required|valid_email',
		'street_address' => 'required',
		'number_address' => 'required',
		'suburb_address' => 'required',
		'city' => 'required',
		'phone' => 'required|numeric|max_length[10]',
		'latitude' => 'required',
		'longitude' => 'required'
	];
    protected $validationMessages	= [
		'name' => [
			'required' => 'El campo de nombre es obligatorio.'
		],
		'email' => [
			'required' => 'El campo de correo electrónico es obligatorio.',
			'valid_email' => 'El campo de correo electrónico no es válido.'
		],
		'street_address' => [
			'required' => 'El campo de domicilio es obligatorio.'
		],
		'number_address' => [
			'required' => 'El campo de número es obligatorio.'
		],
		'suburb_address' => [
			'required' => 'El campo de colonia es obligatorio.'
		],
		'city' => [
			'required' => 'El campo de ciudad es obligatorio.'
		],
		'phone' => [
			'required' => 'El campo de teléfono es obligatorio.',
			'numeric' => 'El campo de teléfono debe contener sólo números.',
			'max_length' => 'El campo de teléfono debe contener máximo 10 caracteres.'
		],
		'latitude' => [
			'required' => 'El campo de latitud es obligatorio.'
		],
		'longitude' => [
			'required' => 'El campo de longitud es obligatorio.'
		]
	];
    protected $skipValidation  		= false;



}