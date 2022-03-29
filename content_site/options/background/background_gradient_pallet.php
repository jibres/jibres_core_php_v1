<?php
namespace content_site\options\background;


class background_gradient_pallet
{

	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(static::pallet(), 'key'), 'field_title' => T_('Pallet')]);
		\content_site\utility::need_redirect(true);
		return $data;
	}


	public static function extends_option()
	{
		return background_pack::extends_option();
	}




	public static function pallet()
	{
		$list   = [];
		$list[] = ['key' => '1', 'style' => 'linear-gradient(310deg,rgb(214,233,255),rgb(214,229,255),rgb(209,214,255),rgb(221,209,255),rgb(243,209,255),rgb(255,204,245),rgb(255,204,223),rgb(255,200,199),rgb(255,216,199),rgb(255,221,199))',];
		$list[] = ['key' => '2', 'style' => 'linear-gradient(160deg,rgb(204,251,252),rgb(197,234,254),rgb(189,211,255))',];
		$list[] = ['key' => '3', 'style' => 'linear-gradient(150deg,rgb(255,242,158),rgb(255,239,153),rgb(255,231,140),rgb(255,217,121),rgb(255,197,98),rgb(255,171,75),rgb(255,143,52),rgb(255,115,33),rgb(255,95,20),rgb(255,87,15))',];
		$list[] = ['key' => '4', 'style' => 'linear-gradient(345deg,rgb(211,89,255),rgb(228,99,255),rgb(255,123,247),rgb(255,154,218),rgb(255,185,208),rgb(255,209,214),rgb(255,219,219))',];
		$list[] = ['key' => '5', 'style' => 'linear-gradient(150deg,rgb(0,224,245),rgb(31,158,255),rgb(51,85,255))',];
		$list[] = ['key' => '6', 'style' => 'linear-gradient(330deg,rgb(255,25,125),rgb(45,13,255),rgb(0,255,179))',];
		$list[] = ['key' => '7', 'style' => 'linear-gradient(150deg,rgb(0,176,158),rgb(19,77,93),rgb(16,23,31))',];
		$list[] = ['key' => '8', 'style' => 'linear-gradient(150deg,rgb(95,108,138),rgb(48,59,94),rgb(14,18,38))',];

		return $list;
	}



	public static function get_style($_key)
	{
		$enum = static::pallet();

		foreach ($enum as $key => $value)
		{
			if($value['key'] === $_key)
			{
				return $value['style'];
			}
		}

	}



	public static function admin_html()
	{
		$html = '';
		$default =  \content_site\section\view::get_current_index_detail('background_gradient_pallet');
		foreach (static::pallet() as $key => $value)
		{
			$json =
			[
				'opt_background_gradient_pallet' => $value['key'],
			];

			$json = json_encode($json);

			$html .= "<button data-ajaxify data-data='$json' class='picker reset2 w-10 h-10 inline-block rounded-lg align-middle mRa10 mb-2 border-none2' style='background: $value[style]'>";
			{
				if($default == $value['key'])
				{
					$html .= \dash\utility\icon::bootstrap('check', 'stroke-current text-gray-500 p-2', ['fill' => '#fff']);
				}

			}
			$html .= "</button>";
		}


		return $html;

	}

}
?>