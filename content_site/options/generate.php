<?php
namespace content_site\options;


class generate
{

	public static function form($_class = null, $_id = null)
	{
		$form = '<form method="post" autocomplete="off" data-patch';
		if($_class)
		{
			$form .= ' class="'. $_class. '"';
		}

		if($_id)
		{
			$form .= ' id="'. $_id. '"';
		}

		$form .= '>';

		return $form;
	}


	public static function _form()
	{
		return '</form>';
	}


	public static function opt_hidden($_class, $_value = 1)
	{
		if(strpos($_class, '\\') !== false)
		{
			$name = 'opt_'. \content_site\utility::className($_class);
		}
		else
		{
			$name = $_class;
		}

		return '<input type="hidden" name="'.$name.'" value="'. $_value. '">';
	}


	public static function multioption()
	{
		return '<input type="hidden" name="multioption" value="multi">';
	}


	public static function not_redirect()
	{
		return '<input type="hidden" name="not_redirect" value="1">';
	}


	public static function specialsave()
	{
		return '<input type="hidden" name="specialsave" value="specialsave">';
	}


	public static function msg($_text)
	{
		$html = '';

		$html .= "<div class='msg text-sm'>";
		{
			$html .= $_text;
		}
		$html .= '</div>';

		return $html;
	}


	public static function text($_name, $_value, $_lable = null, $_placeholder = null, $_class = null)
	{
		$html = '';

		if($_lable)
		{
			$html .= "<label for='id-$_name'>$_lable</label>";
		}
		$html .= "<div class='input $_class'>";
		{
			$html .= "<input type='text' name='$_name' id='id-$_name' value='$_value' placeholder='$_placeholder'>";
		}
		$html .= '</div>';

		return $html;
	}


	public static function rangeslider($_name, $_range, $_default, $_lable = null)
	{

		$html = '';
		$html .= '<div class="pb-2">';
		{
			if($_lable)
			{
				$html .= '<label for="id-'.$_name.'">'.$_lable.'</label>';
			}
			$html .= '<input type="text" name="'.$_name.'" id="id-'.$_name.'" data-rangeSlider data-skin="round" value="'.array_search($_default, $_range).'" data-values="'. implode(',', $_range). '">';
		}
		$html .= '</div>';

		return $html;

	}

	public static function select($_class, $_enum, $_default, $_lable = null)
	{
		if(strpos($_class, '\\') !== false)
		{
			$name = \content_site\utility::className($_class);
		}
		else
		{
			$name = $_class;
		}

		$html = '';

		if($_lable)
		{
			$html .= "<label for='id-$name'>$_lable</label>";
		}

		$html .= "<select name='opt_$name' class='select22' id='id-$name'>";

		foreach ($_enum as $key => $value)
		{
			$selected = null;

			if($value['key'] === $_default)
			{
				$selected = ' selected';
			}

			$html .= "<option value='$value[key]'$selected>$value[title]</option>";
		}

		$html .= '</select>';

		return $html;

	}




	public static function radio_line_add_ul($_uniqueName, $_html_child, $_fixDirection = null)
	{
		$html = '';
		$classList = 'filter-switch flex items-center relative p-1 lg:p-1.5 space-x-2 bg-gray-100 text-center rounded-lg font-bold text-blue-600 mb-2';
		if($_fixDirection)
		{
			if($_fixDirection)
			$classList .= ' fix';
		}

		$html .= "<ul id='$_uniqueName' class='$classList'>";
		{
			$html .= $_html_child;
		}
		$html .= '</ul>';

		return $html;
	}





	public static function radio_line_itemText($_name, $_value, $_text, $_checked = null, $_fontSizeSmall = null)
	{
		$myId = $_name. '-'. $_value. '-id';

		$html = '';
		$flexMode = 'flex-1';
		$fontSize = 'leading-7 text-sm';

		if($_fontSizeSmall)
		{
			$fontSize = 'leading-6 text-xs';
		}
		if(substr($_text, 0, 4) === '<svg')
		{
			// do noting
		}
		else if(mb_strlen($_text) > 8)
		{
			$flexMode = '';
		}

		$html .= "<li class='filter-switch-item $flexMode relative'>";
		{
			$html .= "<input type='radio' name='$_name' id='$myId' value='$_value' class='sr-only'";
			if($_checked)
			{
				$html .= ' checked';
			}
			$html .= '>';

			$classList = 'block px-1 md:px-2 text-gray-600 rounded-lg shadow bg-white transition overflow-hidden '. $fontSize;

			$html .= "<label for='$myId' class='$classList'>";
			if($_value === 'more')
			{
				$html .= '<svg class="mt-1 block mx-auto opacity-70" height="22" viewBox="0 0 22 22" width="22" xmlns="http://www.w3.org/2000/svg"><path d="M12.8 11a1.8 1.8 0 11-3.6 0 1.8 1.8 0 013.6 0zM4.8 11a1.8 1.8 0 11-3.6 0 1.8 1.8 0 013.6 0zM19 12.8a1.8 1.8 0 100-3.6 1.8 1.8 0 000 3.6z"></path></svg>';
			}
			else
			{
				$html .= $_text;
			}
			$html .= '</label>';
			// $html .= '<div aria-hidden="true" class="filter-active"></div>';
		}
		$html .= '</li>';

		return $html;
	}


	public static function checkbox($_name, $_title, $_checked = null)
	{
		$checked = null;

		if($_checked)
		{
			$checked = ' checked';
		}

		$html = '';
		$html .= '<label class="toggle2">';
    $html .= '<span>'. $_title .'</span>';
    $html .= '<input type="checkbox" name="'. $_name. '"'. $checked. '>';
    $html .= '</label>';

		return $html;
	}

}
?>