<?php
namespace content_a\setting\logo;


class model extends \content_a\main\model
{

	/**
	 * Uploads a logo.
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function upload_logo()
	{
		if(\dash\request::files('logo'))
		{
			$uploaded_file = \dash\app\file::upload(['debug' => false, 'upload_name' => 'logo']);

			if(isset($uploaded_file['url']))
			{
				return $uploaded_file['url'];
			}
			// if in upload have error return
			if(!\lib\engine\process::status())
			{
				return false;
			}
		}
		return null;
	}


	/**
	 * Posts an add.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function post_logo($_args)
	{
		$upload = self::upload_logo();

		if($upload)
		{
			\lib\app\store::edit_logo($upload);
		}
		else
		{
			\lib\notif::error(T_("No file was sended"), 'logo');
			return false;
		}

		if(\lib\engine\process::status())
		{
			\lib\redirect::pwd();
		}
	}
}
?>