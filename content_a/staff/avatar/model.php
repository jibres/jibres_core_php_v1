<?php
namespace content_a\staff\avatar;


class model extends \content_a\main\model
{

	/**
	 * UploAads an avatar.
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function upload_avatar()
	{
		if(\lib\utility::files('avatar'))
		{
			$uploaded_file = \lib\app\file::upload(['debug' => false, 'upload_name' => 'avatar']);

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
	public function post_avatar($_args)
	{
		$file_url     = self::upload_avatar();

		// we have an error in upload avatar
		if($file_url === false)
		{
			return false;
		}

		$request           = [];
		$request['avatar'] = $file_url;
		$request['id']     = \lib\utility::get('id');

		\lib\app\staff::edit($request);

		if(\lib\debug::$status)
		{
			$this->redirector($this->url('full'));
		}
	}
}
?>