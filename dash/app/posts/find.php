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


		if(\dash\url::content() === 'n')
		{
			$dataRow = self::load_by_id();
		}
		else
		{
			$dataRow = self::load_by_url($url);
		}

		// post not founded
		if(!$dataRow || !is_array($dataRow))
		{
			return false;
		}

		if(isset($dataRow['status']) && $dataRow['status'] === 'deleted')
		{
			return false;
		}

		if(isset($dataRow['redirecturl']) && $dataRow['redirecturl'])
		{
			\dash\redirect::to($dataRow['redirecturl'], true, 302);
		}

		$id                  = \dash\coding::decode($dataRow['id']);

		$tag                 = \dash\app\posts\get::get_post_tag($id);
		$dataRow['tags']     = $tag;

		self::$dataRow = $dataRow;

		return $dataRow;
	}


	private static function load_by_url($url)
	{

		$url = str_replace("'", '', $url);
		$url = str_replace('"', '', $url);
		$url = str_replace('`', '', $url);
		$url = str_replace('%', '', $url);

		$preview  = \dash\request::get('preview') ? true : false;

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
		$dataRow = \dash\app\posts\ready::row($dataRow);

		return $dataRow;
	}


	private static function load_by_id()
	{

		$load_post = \dash\app\posts\get::get(\dash\url::module());

		if(!$load_post || !isset($load_post['slug']))
		{
			return false;
		}

		if(\dash\url::child())
		{
			if(isset($load_post['slug']) && $load_post['slug'] === \dash\url::child())
			{
				// ok. nothing
			}
			else
			{
				\dash\header::status(404, T_("Invalid slug of post"));
			}
		}

		return $load_post;
	}
}
?>