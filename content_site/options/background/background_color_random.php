<?php
namespace content_site\options\background;


class background_color_random
{


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('background_color');

		if(!$default)
		{
			$default = self::default();
		}

		$title = T_("Background Color");

		$html = self::color_html('opt_background_color', $default, $title);

		return $html;
	}


	private static function postel_color_solid()
	{
		$list =
		[
			'#F7F6CF',			'#B6D8F2',			'#F4CFDF',			'#5784BA',			'#9AC8EB',			'#CCD4BF',			'#E7CBA9',			'#EEBAB2',
			'#F5F3E7',			'#F5E2E4',			'#F5BFD2',			'#E5DB9C',			'#D0BCAC',			'#BEB4C5',			'#E6A57E',			'#218B82',
			'#9AD9DB',			'#E5DBD9',			'#98D4BB',			'#EB96AA',			'#B8E0F6',			'#A4CCE3',			'#37667E',			'#DEC4D6',
			'#7B92AA',			'#DDF2F4',			'#84A6D6',			'#4382BB',			'#E4CEE0',			'#A15D98',			'#DC828F',			'#F7CE76',
			'#E8D6CF',			'#8C7386',			'#9C9359',			'#F4C815',			'#F9CAD7',			'#A57283',			'#C1D5DE',			'#DEEDE6',
			'#E9BBB5',			'#E7CBA9',			'#AAD9CD',			'#E8D595',			'#8DA47E',			'#CAE7E3',			'#B2B2B2',			'#EEB8C5',
			'#DCDBD9',			'#FEC7BC',			'#FBECDB',			'#F3CBBD',			'#90CDC3',			'#AF8C72',			'#938F43',			'#B8A390',
			'#E6D1D2',			'#DAD5D6',			'#B2B5B9',			'#8FA2A6',			'#8EA4C8',			'#C3B8AA',			'#DEDCE4',			'#DB93A5',
			'#C7CDC5',			'#698396',			'#A9C8C0',			'#DBBC8E',			'#AE8A8C',			'#7C98AB',			'#C2D9E1',			'#D29F8C',
			'#D9D3D2',			'#81B1CC',			'#FFD9CF',			'#C6AC85',			'#E2E5CB',			'#D9C2BD',			'#A2C4C6',			'#82B2B8',
		];

		return $list[array_rand($list)];
	}


	public static function gradient_sample_color()
	{
		return
		[
			['to bottom right', '#4BF140', '#FD2D5E',],
			['to bottom right', '#CC0FA2', '#A7B168',],
			['to bottom right', '#E09DD4', '#C75856',],
			['to bottom right', '#09B5C7', '#757089',],
			['to bottom right', '#CAE971', '#7CFBE9',],
			['to bottom right', '#33E885', '#0F542D',],
			['to bottom right', '#0FF53B', '#1663A9',],
			['to bottom right', '#915118', '#E6A691',],
			['to bottom right', '#39ECAD', '#2A8196',],
			['to bottom right', '#F81B73', '#1E19C5',],
			['to bottom right', '#0B2365', '#0DB8D9',],
			['to bottom right', '#9EF5E6', '#E378D1',],
			['to bottom right', '#2D1C60', '#961C3A',],
			['to bottom right', '#1F1004', '#674C4B',],
			['to bottom right', '#DBCABB', '#24F3B0',],
		];
	}


	public static function admin_html_solid()
	{
		$html  = '';

		$random = self::postel_color_solid();

		$html .= "<div data-ajaxify data-data='{\"opt_background_color\": \"$random\"}' class='btn xl'>";
		{
			$html .= '<img src="'. \dash\utility\icon::url('Redo'). '" alt="Random">';
		}
		$html .= "</div>";


		return $html;
	}

	public static function admin_html_gradient()
	{

	}


}
?>