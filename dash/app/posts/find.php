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

		$language = \dash\language::current();
		$preview  = \dash\request::get('preview');

		// load attachments
		// if(substr($url, 0, 6) === 'image/' || substr($url, 0, 6) === 'video/' )
		// {
		// 	$dataRow = \dash\db\posts::get(['url' => $url, 'limit' => 1]);
		// }
		// else
		// {
			$dataRow = \dash\db\posts::get(['language' => $language, 'url' => $url, 'limit' => 1]);
		// }

		if(isset($dataRow['user_id']) && (int) $dataRow['user_id'] === (int) \dash\user::id())
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
				if(isset($dataRow['status']) && $dataRow['status'] == 'publish')
				{
					// no problem to load this poll
				}
				else
				{
					$dataRow = false;
				}
			}
		}

		// we have more than one record
		if(isset($dataRow[0]))
		{
			$dataRow = false;
		}

		if(isset($dataRow['id']))
		{
			$id = $dataRow['id'];
		}
		else
		{
			$dataRow = false;
			$id  = 0;
		}

		if(is_array($dataRow))
		{
			$dataRow = \dash\app\posts\ready::row($dataRow);
		}

		self::$dataRow = $dataRow;

		return $dataRow;
	}
}
?>