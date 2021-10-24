<?php
namespace content_site\options\product;


class product_tag
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
		$default = \content_site\section\view::get_current_index_detail('product_tag');

		if(!$default)
		{
			$default = self::default();
		}

		$tagSearchLink = \dash\url::kingdom(). '/a/products';

		$load_category = [];

		if($default)
		{
			$tagSearchLink .= '?tagid='. $default;
			$load_category = \lib\app\category\get::get($default);
		}

		$title = T_("Filter by special category");

		$html = '';

		$html .= \content_site\options\generate::form();
		{
			$html .= "<div class='row'>";
			{
				$html .= "<div class='c'>";
				{
					$html .= "<label for='product_tag'>$title</label>";
				}
				$html .= "</div>";

				$html .= "<div class='c-auto'>";
				{
					$html .= "<a target='_blank' class='link'  href='$tagSearchLink'><i class='sf-external-link'></i></a>";
				}
				$html .= "</div>";
			}
			$html .= "</div>";

	        $html .= '<select name="opt_product_tag" class="select22" id="product_tag" data-placeholder="'. T_("Select category"). '"  data-ajax--delay="100" data-ajax--url="'. \dash\url::kingdom(). '/a/category/api?json=true&getid=1">';

			$html .= '<option value="0">'. T_("All"). '</option>';

			if($load_category)
			{
	        	$html .= "<option value='". a($load_category, 'id')."' selected>". a($load_category, 'title'). "</option>";
			}

	       	$html .= '</select>';
		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>