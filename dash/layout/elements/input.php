<?php
namespace dash\layout\elements;


class input
{
	public static function __callStatic($_fn, $_args)
	{
		$html = '';
		$args = a($_args, 0);

		if(!a($args, 'type'))
		{
			$args['type'] = $_fn;
		}

		switch ($_fn)
		{
			case 'tel':
			case 'text':
			case 'number':
			case 'password':
				$html .= self::input($args);
				break;

			case 'textarea':
			case 'hidden':
				$html .= self::$_fn($args);
				break;

			default:
				$html .= '';
				break;
		}

		return $html;
	}



	public static function input(array $_args)
	{
		$html = '';

		$html .= '<div class="input">';
		{
			$html .= '<input type="'. a($_args, 'type'). '" placeholder="'. a($_args, 'placeholder'). '" value="'. a($_args, 'value'). '">';
		}
		$html .= '</div>';

		return $html;
	}


	public static function textarea(array $_args)
	{
		$html = '';
		$html .= '<textarea class="txt" type="'. $_type. '" placeholder="'. a($_args, 'placeholder'). '">'. a($_args, 'value'). '</textarea>';
		return $html;
	}


	public static function hidden(array $_args)
	{
		$html = '';
		$html .= '<input type="hidden" name="'.a($_args, 'name').'" value="'. a($_args, 'value'). '">';
		return $html;
	}



}
?>