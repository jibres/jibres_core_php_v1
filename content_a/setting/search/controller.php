<?php
namespace content_a\setting\search;

class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_setting');

		$query = \dash\validate::search(\dash\request::get('q'), false);

		if(!$query)
		{
			return;
		}
		$result = [];

		$search_setting = self::search_setting($query);
		foreach ($search_setting as $key => $value)
		{
			$result['results'][] = self::create_item($value);
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
				'link' => \dash\url::kingdom(). '/cms/sitemap',
			],
			[
				'title' => T_("Config"),
				'words' => [T_("setting"), T_("config"), T_("ratio"), 'image', T_("image ratio")],
				'link' => \dash\url::kingdom(). '/cms/config',
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
					$result[] =
					[
						'title' => a($value, 'title'),
						'link' => a($value, 'link'),
					];
				}
			}
		}

		return $result;
	}


	private static function create_item($_data)
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
		$html .= '<div class="c-auto">'. ' </div>';

		$html .= '</div>';
		// add price to html of item
		$result =
		[
			// select22
			'html'     => $html,
			'id'       => $id,
			'datalist' => $datalist,
			'url'      => a($_data, 'link'),
		];

		return $result;
	}
}
?>