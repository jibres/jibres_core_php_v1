<?php
namespace lib\app\form\generate;


trait token
{


	private static function startTimeHtml(array $_load_form)
	{

		$dateTime = date("Y-m-d H:i:s");

		if(a($_load_form, 'myStartDate'))
		{
			$dateTime              = date("Y-m-d H:i:s", $_load_form['myStartDate']);
			self::$formTimeLimited = true;
		}

		self::$formDetail = $_load_form;
		self::$startTime  = strtotime($dateTime);

		$html = '<input type="hidden" name="startdate" value="' . $dateTime . '">';
		return $html;

	}


	private static function setLoadTokenInputHTML($load_form) : string
	{
		$html = '';
		if(isset($load_form['formLoad']['token']))
		{
			$html .= sprintf(
				'<input type="hidden" name="formloadtoken" value="%s">',
				$load_form['formLoad']['token']
			);
		}

		if(isset($load_form['formLoad']['id']))
		{
			$html .= sprintf(
				'<input type="hidden" name="formloadtid" value="%s">',
				$load_form['formLoad']['id']
			);
		}

		return $html;

	}

}
