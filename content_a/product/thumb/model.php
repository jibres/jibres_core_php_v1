<?php
namespace content_a\product\thumb;
use \lib\utility;
use \lib\debug;

class model extends \content_a\product\model
{

	/**
	 * Uploads an thumb.
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public function upload_thumb()
	{
		if(utility::files('thumb'))
		{
			utility::set_request_array(['upload_name' => 'thumb']);
			$uploaded_file = $this->upload_file(['debug' => false]);
			if(isset($uploaded_file['code']))
			{
				return $uploaded_file['code'];
			}
			// if in upload have error return
			if(!debug::$status)
			{
				return false;
			}
		}
		return null;
	}




	/**
	 * Posts an addproduct.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function post_thumb($_args)
	{
		$this->user_id = $this->login('id');
		$file_code     = $this->upload_thumb();
		// we have an error in upload thumb
		if($file_code === false)
		{
			return false;
		}

		if($file_code)
		{
			$request['file'] = $file_code;
		}

		$product          = \lib\router::get_url(3);
		$request['id']   = $product;
		$request['team'] = $team = \lib\router::get_url(0);
		utility::set_request_array($request);

		// API ADD MEMBER FUNCTION
		$this->add_product(['method' => 'patch']);
		if(debug::$status)
		{
			$this->redirector($this->url('full'));
		}
	}
}
?>