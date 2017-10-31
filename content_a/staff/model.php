<?php
namespace content_a\staff;
use \lib\utility;
use \lib\debug;

class model extends \content_a\main\model
{

	/**
	 * Gets the staff list.
	 *
	 * @return     <type>  The staff list.
	 */
	public function getstaffList($_meta = [])
	{
		$request         = [];
		$request['type'] = 'staff';
		if(isset($_meta['search']))
		{
			$request['search'] = $_meta['search'];
		}
		utility::set_request_array($request);
		$result =  $this->get_list_staff();
		return $result;
	}
}
?>