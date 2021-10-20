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

    protected $validationRules  	= [];
    protected $validationMessages	= [];
    protected $skipValidation  		= false;



}