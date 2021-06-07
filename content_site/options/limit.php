<?php
namespace content_site\options;


class limit
{

	private static function this_range()
	{
		return [2,4,6,8,10,20,50,100];
	}


	public static function validator($_data)
	{
		$data = \dash\validate::int($_data);

		if(!in_array($data, self::this_range()))
		{
			\dash\notif::error(T_("This range is not defined!"));
			return false;
		}

		return $data;
	}


	public static function default()
	{
		return 2;
	}


	public static function admin_html($_section_detail)
	{

		if(isset($_section_detail['preview']['limit']) && $_section_detail['preview']['limit'])
		{
			$default            = $_section_detail['preview']['limit'];
		}
		else
		{
			$default = self::default();
		}

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
    	$html .= '<input type="hidden" name="option" value="limit">';

		$html .= '<div class="py-5">';
		$html .= '<label for="limit">'. T_("Count Show"). '</label>';
		// $html .= '<input type="text" name="limit" data-rangeSlider data-min="2" data-max="10" data-from="4" data-step="2" data-skin="round">';
		$html .= '<input type="text" name="limit" data-rangeSlider data-skin="round" data-values="'. implode(',', self::this_range()). '">';
		$html .= '</div>';

  		$html .= '</form>';

		return $html;
	}

}
?>