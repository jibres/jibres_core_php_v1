<?php
namespace content_a\product\thumb;
use \lib\utility;
use \lib\debug;

class model extends \content_a\product\edit\model
{

	/**
	 * Uploads an thumb.
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function upload_thumb()
	{
		if(utility::files('thumb'))
		{
			$uploaded_file = \lib\app\file::upload(['debug' => false, 'upload_name' => 'thumb']);

			if(isset($uploaded_file['url']))
			{
				return $uploaded_file['url'];
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
		$file_url     = self::upload_thumb();

		// we have an error in upload thumb
		if($file_url === false)
		{
			return false;
		}

		$request          = [];
		$request['thumb'] = $file_url;
		$request['id']    = \lib\router::get_url(2);

		\lib\app\product::edit($request);

		if(debug::$status)
		{
			$this->redirector($this->url('full'));
		}
	}
}
?>