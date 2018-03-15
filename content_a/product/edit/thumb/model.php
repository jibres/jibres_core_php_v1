<?php
namespace content_a\product\edit\thumb;


class model extends \content_a\main\model
{
	public static function upload_thumb()
	{
		if(\lib\utility::files('thumb'))
		{
			$uploaded_file = \lib\app\file::upload(['debug' => false, 'upload_name' => 'thumb']);

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
		$request['id']    = \lib\request::get('id');

		\lib\app\product::edit($request);

		if(\lib\debug::$status)
		{
			$this->redirector(\lib\url::pwd());
		}
	}
}
?>
