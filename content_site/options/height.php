<?php
namespace content_site\options;


class height
{
	private static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'auto', 'title' => T_("Auto") , 'class' => 'max-height:80vh; height:50vw; padding: 50px 0;', 'default' => true];
		// max-height:80vh; height:50vw; padding: 50px 0;
		$enum[] = ['key' => 'xs',   'title' => T_("Short") , 'class' => 'max-height:20vh; height:90px; md:height:125px; padding: 50px 0;', ];
		// max-height:...; height:90px; md:height:125px; padding: 50px 0;
		$enum[] = ['key' => 'sm',   'title' => T_("Fairly Short") , 'class' => 'max-height:30vh; height:225px; md:height:300px; padding: 50px 0;', ];
		// max-height:..; height:225px; md:height:300px; padding: 50px 0;
		$enum[] = ['key' => 'md',   'title' => T_("Medium") , 'class' => 'max-height:40vh; height:350px; md:height:475px; padding: 50px 0;', ];
		// max-height:...; height:350px; md:height:475px; padding: 50px 0;
		$enum[] = ['key' => 'lg',   'title' => T_("Tall") , 'class' => 'max-height:90vh; height:470px; md:height:650px; padding: 50px 0;', ];
		// max-height:...; height:470px; md:height:650px; padding: 50px 0;
		$enum[] = ['key' => 'xl',   'title' => T_("Full Screen") , 'class' => 'max-height:100vh height:580px; md:height:775px; padding: 50px 0;', ];
		// max-height:... height:580px; md:height:775px; padding: 50px 0;
		// min-height:100vh; min-height:100%; md:height:775px; padding: 50px 0;

		return $enum;
	}

	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Height')]);
		return $data;
	}


	public static function default()
	{
		return 'normal';
	}


	public static function class_name($_key)
	{
		$enum = self::enum();

		foreach ($enum as $key => $value)
		{
			if(!$_key)
			{
				if(isset($value['default']) && $value['default'])
				{
					return $value['class'];
				}
			}
			else
			{
				if($value['key'] === $_key)
				{
					return $value['class'];
				}
			}
		}
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('height');

		if(!$default)
		{
			$default = self::default();
		}

		$title = T_("Set item height");

		$html = '';
		$html .= '<form method="post" data-patch>';
		{
	    	$html .= '<input type="hidden" name="option" value="height">';
			$html .= "<label for='height'>$title</label>";
	        $html .= '<select name="height" class="select22" id="height">';

	        foreach (self::enum() as $key => $value)
	        {
	        	$selected = null;

	        	if($value['key'] === $default)
	        	{
	        		$selected = ' selected';
	        	}

	        	$html .= "<option value='$value[key]'$selected>$value[title]</option>";
	        }

	       	$html .= '</select>';
		}
  		$html .= '</form>';

		return $html;
	}

}
?>