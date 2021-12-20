<?php
namespace dash\layout\elements;


class form
{

	public static function form(array $_args = []) : string
	{
		$form = '<form';

		if(!a($_args, 'method'))
		{
			$_args['method'] = 'get';
		}
		$form .= ' method="'.$_args['method'].'"';

		$form .= ' autocomplete="off"';

		if(a($_args, 'data-patch'))
		{
			$form .= " data-patch";
		}

		if(a($_args, 'class'))
		{
			$form .= ' class="'. $_args['class']. '"';
		}

		if(a($_args, 'id'))
		{
			$form .= ' id="'. $_args['id']. '"';
		}

		$form .= '>';

		return $form;
	}


	public static function _form() : string
	{
		return '</form>';
	}

}
?>