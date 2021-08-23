<?php
namespace content_site\options\product;


class product_tag
{

	public static function validator($_data)
	{
		$data = \dash\validate::code_0($_data);
		return $data;
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html()
	{

		$tag_list = \dash\app\terms\get::get_all_tag();

		$default = \content_site\section\view::get_current_index_detail('product_tag');

		if(!$default)
		{
			$default = self::default();
		}

		$tagSearchLink = \dash\url::kingdom(). '/a/tag';

		if($default)
		{
			$tagSearchLink .= '?tagid='. $default;
		}

		$title = T_("Filter by special tag");

		$html = '';

		$html .= '<form method="post" data-patch>';
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

	        $html .= '<select name="opt_product_tag" class="select22" id="product_tag" data-placeholder="'. T_("Select hashtag"). '">';

			$html .= '<option value="0">'. T_("All"). '</option>';

	        foreach ($tag_list as $key => $value)
	        {
	        	$selected = null;

	        	if($value['id'] === $default)
	        	{
	        		$selected = ' selected';
	        	}

	        	$html .= "<option value='$value[id]'$selected>$value[title]</option>";
	        }

	       	$html .= '</select>';
		}
  		$html .= '</form>';

		return $html;
	}

}
?>