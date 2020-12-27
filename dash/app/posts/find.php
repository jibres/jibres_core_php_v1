<?php
namespace dash\app\posts;


class find
{
	public static $dataRow = [];


	public static function post()
	{
		$url = \dash\url::directory();
		$url = \dash\url::urlfilterer($url);


		if(substr($url, 0, 7) == 'static/' || substr($url, 0, 6) == 'files/' || substr($url, 0, 7) == 'static_' || substr($url, 0, 6) == 'files_')
		{
			return false;
		}

		if(file_exists(\dash\engine\content::get_addr(). "template/static/$url.html"))
		{
			return false;
		}

		$url = str_replace("'", '', $url);
		$url = str_replace('"', '', $url);
		$url = str_replace('`', '', $url);
		$url = str_replace('%', '', $url);

		$preview  = \dash\request::get('preview') ? true : false;

		$user_id = \dash\user::id();

		if(\dash\engine\store::inStore())
		{
			// not check language
			$language = null;
		}
		else
		{
			$language = \dash\language::current();
		}

		$get_post =
		[
			'url'      => $url,
		];

		if($language)
		{
			$get_post['language'] = $language;
		}

		if(!$preview)
		{
			$get_post['status'] = 'publish';
		}

		$dataRow = \dash\db\posts\get::get_one($get_post);

		// post not founded
		if(!$dataRow || !is_array($dataRow))
		{
			return false;
		}

		$dataRow             = \dash\app\posts\ready::row($dataRow);
		$id                  = \dash\coding::decode($dataRow['id']);

		$tag                 = \dash\app\posts\get::get_post_tag($id);
		$dataRow['tags']     = $tag;

		self::$dataRow = $dataRow;

		return $dataRow;
	}
}
?>