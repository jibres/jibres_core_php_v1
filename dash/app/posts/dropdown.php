<?php
namespace dash\app\posts;


class dropdown
{
	public static function cms()
	{
		if(\dash\request::get('json') !== 'true')
		{
			return;
		}

		$query = \dash\validate::search(\dash\request::get('q'), false);
		if(!$query)
		{
			return;
		}
		$result    = [];
		$resultRaw = \dash\app\posts\search::list($query, []);

		foreach ($resultRaw as $key => $value)
		{
			$edit_link = \dash\url::kingdom(). '/cms/posts/edit?id='. a($value, 'id');
			$result['results'][] = self::getNeededFieldLink($value, T_("Post"), $edit_link);
		}

		$resultRawTag = \dash\app\terms\search::list($query, []);

		foreach ($resultRawTag as $key => $value)
		{
			$edit_link = \dash\url::kingdom(). '/cms/tag/edit?id='. a($value, 'id');
			$result['results'][] = self::getNeededFieldLink($value, T_("Tag"), $edit_link);
		}

		$search_setting = self::search_setting($query);
		foreach ($search_setting as $key => $value)
		{
			$result['results'][] = self::getNeededFieldLink($value, T_("Config"), a($value, 'url'));
		}

		\dash\code::jsonBoom($result);
	}


	private static function search_setting($_query)
	{
		$list =
		[
			[
				'title' => T_("Sitemap"),
				'words' => [T_("site"), T_("site map"), T_("sitemap"), 'sitemap', T_("map"), 'map'],
				'url' => \dash\url::kingdom(). '/cms/sitemap',
			],
			[
				'title' => T_("Config"),
				'words' => [T_("setting"), T_("config"), T_("ratio"), 'image', T_("image ratio")],
				'url' => \dash\url::kingdom(). '/cms/config',
			]
		];

		$result = [];

		foreach ($list as $key => $value)
		{
			if(isset($value['words']))
			{
				$myKeyWords = implode(' , ', $value['words']);
				if(strpos($myKeyWords, mb_strtolower($_query)) !== false)
				{
					unset($value['words']);
					$value['id'] = $key. a($value, 'title');
					$result[] = $value;
				}
			}
		}

		return $result;
	}


	/**
	 * This function call everywhere need to get product list in dropdown mode
	 * in sale page or buy page
	 */
	public static function dropdown()
	{
		if(\dash\request::get('json') !== 'true')
		{
			return;
		}

		$notif_result = [];
		$result       = [];
		$meta         = [];
		$msg          = T_("Posts not found."). ' ';

		$query = \dash\validate::search(\dash\request::get('q'), false);


		if($query)
		{
			$resultRaw    = \dash\app\posts\search::list($query, $meta);
			foreach ($resultRaw as $key => $value)
			{
				$result['results'][] = self::getNeededField($value);
			}
		}
		else
		{
			$result['results'][] = ['text' => T_("No result founded!"), 'id' => null, "disabled"  => true];
		}

		if(!$result)
		{
			$notif_result['message'] = $msg;
		}

		if(!$result)
		{
			$result = [];
			$result['results'][] = ['text' => T_("No result found!"), 'id' => null, "disabled"  => true];
		}

		\dash\code::jsonBoom($result);

	}

	private static function getNeededField($_data)
	{

		$result   = [];
		$id       = null;
		$name     = null;
		$datalist = [];
		$priceTxt = '<span class="description ltr">';

		if(isset($_data['thumb']))
		{
			$name .= '<img class="avatar image" src="'.  $_data['thumb'] .'"> ';
		}

		if(isset($_data['id']))
		{
			$id = $_data['id'];
			$datalist['id'] = $_data['id'];
		}

		if(isset($_data['title']))
		{
			$datalist['title'] = $_data['title'];
			$name .= '<span class="pRa10">'. $_data['title']. '</span>';

		}

		// add price to name of item
		$name   .= $priceTxt. '</span>';
		$result =
		[
			// select22
			'html'     => $name,
			'id'       => $id,
			'datalist' => $datalist,
		];

		return $result;
	}



	private static function getNeededFieldLink($_data, $_type, $_link)
	{

		$result   = [];
		$id       = null;
		$html     = null;
		$datalist = [];

		$html .= '<div class="row align-center">';
		if(isset($_data['thumb']))
		{
			$html .= '<div class="c-auto"><img src="'.  $_data['thumb'] .'"></div>';
		}



		if(isset($_data['id']))
		{
			$id = $_data['id'];
			$datalist['id'] = $_data['id'];
		}

		if(isset($_data['title']))
		{
			$datalist['title'] = $_data['title'];
			$html .= '<div class="c oneLine">'. $_data['title']. '</div>';
		}
		$html .= '<div class="c-auto">'. $_type. ' </div>';

		$html .= '</div>';
		// add price to html of item
		$result =
		[
			// select22
			'html'     => $html,
			'id'       => $id,
			'datalist' => $datalist,
			'url'      => $_link,
		];

		return $result;
	}


}
?>