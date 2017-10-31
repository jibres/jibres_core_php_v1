<?php
namespace content_a\staff\edit\model;
use \lib\utility;
use \lib\debug;

trait avatar
{
	/**
	 * Posts a staff avatar.
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public function post_staff_avatar($_args)
	{
		$file_code = $this->upload_avatar();

		if(!$file_code)
		{
			return false;
		}

		$id              = isset($_args->match->url[0][1]) ? $_args->match->url[0][1] : null;
		$request         = [];
		$request['id']   = $id;
		$request['file'] = $file_code;
		utility::set_request_array($request);

		// API ADD MEMBER FUNCTION
		$result = $this->add_staff(['method' => 'patch']);

		if(debug::$status)
		{
			$this->redirector($this->url('baseFull'). '/'. \lib\router::get_url());
		}
	}

}
?>