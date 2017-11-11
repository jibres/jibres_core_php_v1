<?php
namespace content_a\staff\thumb;


class model extends \content_a\main\model
{

	/**
	 * UploAads an thumb.
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function upload_file($_name)
	{
		if(\lib\utility::files($_name))
		{
			$uploaded_file = \lib\app\file::upload(['debug' => false, 'upload_name' => $_name]);

			if(isset($uploaded_file['url']))
			{
				return $uploaded_file['url'];
			}
			// if in upload have error return
			if(!\lib\debug::$status)
			{
				return false;
			}
		}
		return null;
	}




	/**
	 * Posts an addstaff.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function post_thumb($_args)
	{

		$request                  = [];
		$request['nationalthumb'] = self::upload_file('nationalthumb');

		\lib\app\staff::edit($request, ['its_me' => true]);

		if(\lib\debug::$status)
		{
			$this->redirector($this->url('full'));
		}
	}
}
?>