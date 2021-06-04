<?php
namespace lib\app\quickaccess;


class search
{

	/**
	 * Use in dashboard a search
	 */
	public static function search_in_all()
	{
		$query = \dash\validate::search(\dash\validate::search_string(), false);

		if(!$query)
		{
			return;
		}

		$result = [];

		$search_setting_list = \lib\app\quickaccess\setting::list();

		$search_setting = self::search_setting($query, $search_setting_list);

		foreach ($search_setting as $key => $value)
		{
			$result['results'][] = self::create_item($value);
		}

		$search_products = \lib\app\quickaccess\products::list($query);

		foreach ($search_products as $key => $value)
		{
			$result['results'][] = self::create_item($value);
		}

		$search_customers = \lib\app\quickaccess\customers::list($query);

		foreach ($search_customers as $key => $value)
		{
			$result['results'][] = self::create_item($value);
		}

		$search_hashtags = \lib\app\quickaccess\hashtags::list($query);

		foreach ($search_hashtags as $key => $value)
		{
			$result['results'][] = self::create_item($value);
		}


		$search_tags = \lib\app\quickaccess\tags::list($query);

		foreach ($search_tags as $key => $value)
		{
			$result['results'][] = self::create_item($value);
		}

		$search_forms = \lib\app\quickaccess\forms::list($query);

		foreach ($search_forms as $key => $value)
		{
			$result['results'][] = self::create_item($value);
		}

		$search_factors = \lib\app\quickaccess\factors::list($query);

		foreach ($search_factors as $key => $value)
		{
			$result['results'][] = self::create_item($value);
		}

		\dash\code::jsonBoom($result);
	}


	/**
	 * Only search in setting
	 */
	public static function search_in_setting()
	{
		$query = \dash\validate::search(\dash\validate::search_string(), false);

		if(!$query)
		{
			return;
		}

		$result = [];

		$search_setting_list = \lib\app\quickaccess\setting::list();

		$search_setting = self::search_setting($query, $search_setting_list);

		foreach ($search_setting as $key => $value)
		{
			$result['results'][] = self::create_item($value);
		}

		\dash\code::jsonBoom($result);
	}




	private static function search_setting($_query, $_list)
	{
		$result = [];


		foreach ($_list as $key => $value)
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