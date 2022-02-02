<?php
namespace dash\layout;

class button
{

	public static function html_btnSave($_is_pwa = false)
	{

		if(\dash\face::btnSave())
		{
			$html = '';
			$btnSave_form_id = \dash\face::btnSave();

			$btnSave_name = 'submitall';
			if(\dash\face::btnSaveName())
			{
				$btnSave_name = \dash\face::btnSaveName();
			}

			$btnSave_class = 'btn-primary';
			if(\dash\face::btnSaveClass())
			{
				$btnSave_class = \dash\face::btnSaveClass();
			}

			if($_is_pwa)
			{
				$btnSave_class = 'save';
			}

			$btnSave_attr = null;
			if(\dash\face::btnSaveAttr())
			{
				$btnSave_attr = \dash\face::btnSaveAttr();
			}

			$btnSave_value = null;
			if(\dash\face::btnSaveValue())
			{
				$btnSave_value = \dash\face::btnSaveValue();
			}

			$btnSave_text = T_("Save");
			if(\dash\face::btnSaveText() && !$_is_pwa)
			{
				$btnSave_text = \dash\face::btnSaveText();
			}

			$btnSave_is_form     = false;
			$btnSave_form_action = null;
			if(\dash\face::btnSaveForm())
			{
				$btnSave_is_form = true;
				$btnSave_form_action = \dash\face::btnSaveForm();
			}

			$btnSave_input_hidden = [];
			if(\dash\face::btnSaveInputHidden() && is_array(\dash\face::btnSaveInputHidden()))
			{
				$btnSave_input_hidden = \dash\face::btnSaveInputHidden();
			}

			if($btnSave_is_form)
			{
				$html .= "<form method='post' autocomplete='off' action='$btnSave_form_action'>";
				{
					$html .= "<input type='hidden' name='$btnSave_name' value='$btnSave_value'>";
					if($btnSave_input_hidden)
					{
						foreach ($btnSave_input_hidden as $key => $value)
						{
							$html .= "<input type='hidden' name='$key' value='$value'>";
						}
					}

					$html .= "<button class='$btnSave_class' $btnSave_attr>$btnSave_text</button>";
				}
				$html .= '</form>';
			}
			else
			{
				$connect_to_form = " form='$btnSave_form_id'";
				if(is_bool($btnSave_form_id))
				{
					$connect_to_form = null;
				}

				$html .= "<button class='$btnSave_class'$connect_to_form name='$btnSave_name' value='$btnSave_value' $btnSave_attr>$btnSave_text</button>";
			}

			return $html;
		}

		return null;


	}


	public static function html_btnDuplicate($_is_pwa = false)
	{
		if($btnDuplicate = \dash\face::btnDuplicate())
		{
			$html = '';
			$html .= "<a href='$btnDuplicate' class='btn-light btn-icon btn-sm mx-2'>";
			$html .= \dash\utility\icon::svg('duplicate', 'minor');
			$html .= '<span>'. T_("Duplicate"). '</span>';
			$html .= "</a>";
			return $html;
		}
		return null;
	}
}
?>