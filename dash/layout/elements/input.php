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
			case 'select':
				$html .= self::$_fn($args);
				break;

			default:
				trigger_error("invalid input function");
				// throw new Exception
				break;
		}

		return $html;
	}


	/**
	 * Generate html input
	 *
	 * @param      array   $_args  The arguments
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function multiple_html(array $_args)
	{
		$html  = '';

		foreach ($_args as $key => $value)
		{
			$type = a($value, 'type');
			if($type)
			{
				$html .= self::$type($value);
			}
		}

		return $html;
	}



	public static function input(array $_args)
	{
		$html = '';

		$html .= '<div class="input">';
		{
			$html .= '<input type="'. a($_args, 'type'). '" name="'. a($_args, 'name'). '" placeholder="'. a($_args, 'placeholder'). '" value="'. a($_args, 'value'). '">';
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


	public static function select(array $_args)
	{
		$html = '';

		$html .= '<div>';
		{
			$html .= '<select class="select22" name="'. a($_args, 'name'). '" data-placeholder="'. a($_args, 'placeholder'). '">';
			{
				if(is_array(a($_args, 'list')))
				{
					foreach ($_args['list'] as $key => $value)
					{
						$html .= '<option value="'. $key. '">'. $value. '</option>';
					}
				}
			}
			$html .= '</select>';
		}
		$html .= '</div>';

		return $html;
	}

}
?>