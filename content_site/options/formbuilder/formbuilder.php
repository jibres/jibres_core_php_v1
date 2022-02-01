<?php
namespace content_site\options\formbuilder;


class formbuilder
{

	public static function validator($_data)
	{
		if($_data)
		{
			return \dash\validate::id($_data);
		}
		else
		{
			return null;
		}
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('formbuilder');

		if(!$default)
		{
			$default = static::default();
		}

		$SearchLink = \dash\url::kingdom(). '/a/form/api?json=true';

		$load_form = [];

		$load_form_link = \dash\url::kingdom(). '/a/form';

		if($default)
		{
			$load_form = \lib\app\form\form\get::public_get($default);
			$load_form_link .= '/edit?id='. a($load_form, 'id');
		}

		$title = T_("Choose form");

		$html = '';

		$html .= \content_site\options\generate::form();
		{
			$html .= "<div class='row'>";
			{
				$html .= "<div class='c'>";
				{
					$html .= "<label for='formbuilder'>$title</label>";
				}
				$html .= "</div>";

				$html .= "<div class='c-auto'>";
				{
					$html .= '<a target="_blank" class="link-secondary text-xs leading-6 block" href="'. $load_form_link .'">'. T_("Manage"). ' <i class="sf-external-link pLa5"></i> </a>';
				}
				$html .= "</div>";
			}
			$html .= "</div>";

	        $html .= '<select name="opt_formbuilder" class="select22" id="formbuilder" data-placeholder="'. T_("Choose form"). '"  data-ajax--delay="100" data-ajax--url="'. $SearchLink .'">';

			$html .= '<option value="">'. T_("None"). '</option>';

			if($load_form)
			{
	        	$html .= "<option value='". a($load_form, 'id')."' selected>". a($load_form, 'title'). "</option>";
			}

	       	$html .= '</select>';
		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>