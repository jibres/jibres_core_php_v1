<?php
namespace content_site\options\background;


class background_color_random
{

	public static function validator($_data)
	{
		if($_data === 'random_bg_color')
		{
			$_data = self::postel_color_solid();
		}
		elseif($_data === 'random_bg_gradient')
		{
			$_data = self::gradient_sample_color();
		}

		return $_data;
	}


	public static function postel_color_solid()
	{
		$list =
		[
			'#f7f6cf',			'#b6d8f2',			'#f4cfdf',			'#5784ba',			'#9ac8eb',			'#ccd4bf',			'#e7cba9',			'#eebab2',
			'#f5f3e7',			'#f5e2e4',			'#f5bfd2',			'#e5db9c',			'#d0bcac',			'#beb4c5',			'#e6a57e',			'#218b82',
			'#9ad9db',			'#e5dbd9',			'#98d4bb',			'#eb96aa',			'#b8e0f6',			'#a4cce3',			'#37667e',			'#dec4d6',
			'#7b92aa',			'#ddf2f4',			'#84a6d6',			'#4382bb',			'#e4cee0',			'#a15d98',			'#dc828f',			'#f7ce76',
			'#e8d6cf',			'#8c7386',			'#9c9359',			'#f4c815',			'#f9cad7',			'#a57283',			'#c1d5de',			'#deede6',
			'#e9bbb5',			'#e7cba9',			'#aad9cd',			'#e8d595',			'#8da47e',			'#cae7e3',			'#b2b2b2',			'#eeb8c5',
			'#dcdbd9',			'#fec7bc',			'#fbecdb',			'#f3cbbd',			'#90cdc3',			'#af8c72',			'#938f43',			'#b8a390',
			'#e6d1d2',			'#dad5d6',			'#b2b5b9',			'#8fa2a6',			'#8ea4c8',			'#c3b8aa',			'#dedce4',			'#db93a5',
			'#c7cdc5',			'#698396',			'#a9c8c0',			'#dbbc8e',			'#ae8a8c',			'#7c98ab',			'#c2d9e1',			'#d29f8c',
			'#d9d3d2',			'#81b1cc',			'#ffd9cf',			'#c6ac85',			'#e2e5cb',			'#d9c2bd',			'#a2c4c6',			'#82b2b8',
		];

		return ['background_color' => $list[array_rand($list)]];
	}


	public static function gradient_sample_color()
	{
		$list =
		[
			['background_gradient_type' => 'to bottom right', 'background_gradient_from' => '#4bf140', 'background_gradient_to' => '#fd2d5e',],
			['background_gradient_type' => 'to bottom right', 'background_gradient_from' => '#cc0fa2', 'background_gradient_to' => '#a7b168',],
			['background_gradient_type' => 'to bottom right', 'background_gradient_from' => '#e09dd4', 'background_gradient_to' => '#c75856',],
			['background_gradient_type' => 'to bottom right', 'background_gradient_from' => '#09b5c7', 'background_gradient_to' => '#757089',],
			['background_gradient_type' => 'to bottom right', 'background_gradient_from' => '#cae971', 'background_gradient_to' => '#7cfbe9',],
			['background_gradient_type' => 'to bottom right', 'background_gradient_from' => '#33e885', 'background_gradient_to' => '#0f542d',],
			['background_gradient_type' => 'to bottom right', 'background_gradient_from' => '#0ff53b', 'background_gradient_to' => '#1663a9',],
			['background_gradient_type' => 'to bottom right', 'background_gradient_from' => '#915118', 'background_gradient_to' => '#e6a691',],
			['background_gradient_type' => 'to bottom right', 'background_gradient_from' => '#39ecad', 'background_gradient_to' => '#2a8196',],
			['background_gradient_type' => 'to bottom right', 'background_gradient_from' => '#f81b73', 'background_gradient_to' => '#1e19c5',],
			['background_gradient_type' => 'to bottom right', 'background_gradient_from' => '#0b2365', 'background_gradient_to' => '#0db8d9',],
			['background_gradient_type' => 'to bottom right', 'background_gradient_from' => '#9ef5e6', 'background_gradient_to' => '#e378d1',],
			['background_gradient_type' => 'to bottom right', 'background_gradient_from' => '#2d1c60', 'background_gradient_to' => '#961c3a',],
			['background_gradient_type' => 'to bottom right', 'background_gradient_from' => '#1f1004', 'background_gradient_to' => '#674c4b',],
			['background_gradient_type' => 'to bottom right', 'background_gradient_from' => '#dbcabb', 'background_gradient_to' => '#24f3b0',],
		];

		$result = $list[array_rand($list)];

		return $result;
	}


	public static function admin_html_solid()
	{

		$json =
		[
			'opt_background_color_random' => 'random_bg_color',
			// 'notredirect' => 1,
		];

		$json = json_encode($json);
		return self::admin_html($json);

	}

	public static function admin_html_gradient()
	{
		$json =
		[
			'opt_background_color_random' => 'random_bg_gradient',
			// 'notredirect' => 1,
		];

		$json = json_encode($json);

		return self::admin_html($json);
	}


	public static function admin_html($_json)
	{
		$html = '';

		$html .= "<div data-ajaxify data-data='$_json' class='picker reset inline-block align-middle mRa10 mB10'>";
		{
			$html .= '<img src="'. \dash\utility\icon::url('refresh'). '" alt="random" class="block">';
		}
		$html .= "</div>";

		return $html;

	}

}
?>