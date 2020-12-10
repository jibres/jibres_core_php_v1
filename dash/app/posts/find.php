<?php
namespace dash\app\posts;


class find
{
	public static $datarow = [];


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

		$language = \dash\language::current();
		$preview  = \dash\request::get('preview');

		// load attachments
		// if(substr($url, 0, 6) === 'image/' || substr($url, 0, 6) === 'video/' )
		// {
		// 	$datarow = \dash\db\posts::get(['url' => $url, 'limit' => 1]);
		// }
		// else
		// {
			$datarow = \dash\db\posts::get(['language' => $language, 'url' => $url, 'limit' => 1]);
		// }

		if(isset($datarow['user_id']) && (int) $datarow['user_id'] === (int) \dash\user::id())
		{
			// no problem to load this post
		}
		else
		{
			if($preview)
			{
				// no problem to load this post
			}
			else
			{
				if(isset($datarow['status']) && $datarow['status'] == 'publish')
				{
					// no problem to load this poll
				}
				else
				{
					$datarow = false;
				}
			}
		}

		// we have more than one record
		if(isset($datarow[0]))
		{
			$datarow = false;
		}

		if(isset($datarow['id']))
		{
			$id = $datarow['id'];
		}
		else
		{
			$datarow = false;
			$id  = 0;
		}

		if(is_array($datarow))
		{
			$datarow = \dash\app\posts\ready::row($datarow);
		}

		self::$datarow = $datarow;

		return $datarow;
	}
}
?>