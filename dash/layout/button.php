<?php
namespace dash\layout;

class button
{

	public static function html_btnSave($_is_pwa = false)
	{
	    if(\dash\face::btnSave())
	    {
	      $btnSave_form = \dash\face::btnSave();

	      $btnSave_name = 'submitall';
	      if(\dash\face::btnSaveName())
	      {
	        $btnSave_name = \dash\face::btnSaveName();
	      }

	      $btnSave_class = 'btn-success';
	      if(\dash\face::btnSaveClass())
	      {
	        $btnSave_class = \dash\face::btnSaveClass();
	      }

	      if($_is_pwa)
	      {
	      	$btnSave_class = 'save';
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

	      return "<button class='$btnSave_class' form='$btnSave_form' name='$btnSave_name' value='$btnSave_value'>$btnSave_text</button>";

	    }

	    return null;


	}
}
?>