<?php
namespace content_a\staff\edit\model;
use \lib\utility;
use \lib\debug;

trait address
{
	/**
	 * Posts a staff avatar.
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public function post_staff_address($_args)
	{
		$id                           = isset($_args->match->url[0][1]) ? $_args->match->url[0][1] : null;

		$request['id']                = $id;

		$meta                         = [];
		$meta['location']['country']  = utility::post('country');
		$meta['location']['province'] = utility::post('province');
		$meta['location']['city']     = utility::post('city');
		$meta['contact']['postcode']  = utility::post('zipcode');
		$meta['contact']['address']   = utility::post('addrress');


		$meta = \lib\utility\safe::safe($meta);

		utility::set_request_array($request);

		$result = $this->add_staff(['method' => 'patch', 'debug' => true, 'meta' => $meta]);


	}

}
?>