<?php 
namespace App\Helpers;

/**
* Create Conformation Code 
*/
class ConfGenrator
{
	
	function __construct()
	{

	}

	/**
	 * Genrate Conformation Codes
	 *
	 * @return void
	 * @author 
	 **/
	public function gen()
	{
		return rand( 11111, 99999 );
	}
}