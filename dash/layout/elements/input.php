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

		$html .= "<div class='input";
		if(a($_args, 'parent_class'))
		{
			$html .= " $_args[parent_class]";
		}
		$html .= "'>";
		{
			$html .= '<input';

			if(a($_args, 'type'))
			{
				$html .= " type='$_args[type]'";
			}

			if(a($_args, 'name'))
			{
				$html .= " name='$_args[name]'";
			}

			if(a($_args, 'placeholder'))
			{
				$html .= " placeholder='$_args[placeholder]'";
			}

			if(a($_args, 'value'))
			{
				$html .= " value='$_args[value]'";
			}

			if(a($_args, 'class'))
			{
				$html .= " class='$_args[class]'";
			}

			if(a($_args, 'format'))
			{
				$html .= " data-format='$_args[format]'";
			}

			$html .= '>';
		}
		$html .= '</div>';

		return $html;
	}


	public static function textarea(array $_args)
	{
		$html = '';
		$html .= '<textarea';


		if(a($_args, 'name'))
		{
			$html .= " name='$_args[name]'";
		}

		if(a($_args, 'placeholder'))
		{
			$html .= " placeholder='$_args[placeholder]'";
		}

		if(a($_args, 'row'))
		{
			$html .= " row='$_args[row]'";
		}

		$html .= " class='txt";
		if(a($_args, 'class'))
		{
			$html .= " $_args[class]";
		}
		$html .= "'"; // close class

		$html .= '>';
		{
			$html .= a($_args, 'value');
		}
		$html .= '</textarea>';

		return $html;
	}


	public static function hidden(array $_args)
	{
		$html = '';
		$html .= '<input type="hidden" name="'.a($_args, 'name').'" value="'. a($_args, 'value'). '">';
		return $html;
	}


	/**
	 * Generate select
	 *
	 * @param      array   $_args  The arguments
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
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
						$selected = '';

						if($key === a($_args, 'value'))
						{
							$selected = ' selected';
						}

						$html .= '<option value="'. $key. '"'.$selected.'>'. $value. '</option>';
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