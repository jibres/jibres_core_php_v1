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


	private static function setting_list()
	{
			$list =
			[
				[
					'title'    => T_("Sitemap"),
					'keywords' => [T_("site"), T_("site map"), T_("sitemap"), 'sitemap', T_("map"), 'map'],
					// 'url'      => \dash\url::kingdom(). '/cms/sitemap',
					'addr'     => [T_("Content Management System"), T_("SEO") ],
					'icon'     => 'sitemap',
				],
				[
					'title'    => T_("Config"),
					'keywords' => [T_("setting"), T_("config"), T_("ratio"), 'image', T_("image ratio")],
					'url'      => \dash\url::kingdom(). '/cms/config',
				],
				[
					'title'    => T_("ArvanCloud"),
					'keywords' => [T_("Arvan"), T_("ArvanCloud"), T_("Storage"), 'Arvan', "ArvanCloud", "Arvan Cloud", "File"],
					// 'url'      => \dash\url::kingdom(). '/a/setting/thirdparty/arvanclouds3',
					'addr'     => [T_("Setting"), T_("Third Party Services"), T_("S3") ],
					'img'      => \dash\url::cdn(). '/img/thirdparty/arvancloud.svg',
				]
			];

		return $list;
	}


	private static function search_setting($_query)
	{
		$myList = self::setting_list();
		$result = [];

		foreach ($myList as $key => $value)
		{
			if(isset($value['title']))
			{
				if(strpos($value['title'], mb_strtolower($_query)) !== false)
				{
					unset($value['keywords']);
					$result[] = $value;
					continue;
				}
			}

			if(isset($value['keywords']))
			{
				$myKeykeywords = implode(' , ', $value['keywords']);
				$myKeykeywords = mb_strtolower($myKeykeywords);
				if(strpos($myKeykeywords, mb_strtolower($_query)) !== false)
				{
					unset($value['keywords']);
					$result[] = $value;
					continue;
				}
			}

			if(isset($value['addr']))
			{
				$myKeyAddr = implode(' , ', $value['addr']);
				$myKeyAddr = mb_strtolower($myKeyAddr);
				if(strpos($myKeyAddr, mb_strtolower($_query)) !== false)
				{
					unset($value['keywords']);
					$result[] = $value;
					continue;
				}
			}
		}

		return $result;
	}


	private static function create_item($_data)
	{

		$result   = [];
		$html     = null;
		$datalist = [];

		$html .= '<div class="row align-center">';

		if(isset($_data['img']))
		{
			$html .= '<div class="c-auto"><img class="little" src="'.  $_data['img'] .'"></div>';
		}
		if(isset($_data['icon']))
		{
			$html .= '<div class="c-auto"><i class="sf-'.  $_data['icon'] .'"></i></div>';
		}

		if(isset($_data['title']))
		{
			$datalist['title'] = $_data['title'];
			$html .= '<div class="c oneLine">';

			if(isset($_data['addr']))
			{
				$html .= "<div class='txtB'>". $_data['title']. "</div>";
				$html .= "<div>". implode(' / ', $_data['addr']). "</div>";
			}
			else
			{
				$html .= $_data['title'];
			}
			$html .= '</div>';
		}

		$html .= '</div>';
		// add price to html of item
		$result =
		[
			// select22
			'html'     => $html,
			'id'       => a($_data, 'title'),
			'datalist' => $datalist,
			'url'      => a($_data, 'url'),
		];

		return $result;
	}
}
?>