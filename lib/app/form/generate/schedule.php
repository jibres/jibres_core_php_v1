<?php
namespace lib\app\form\generate;


trait schedule
{


	private static function check_schedule($_form_id)
	{
		if($_form_id && is_numeric($_form_id))
		{
			$load_form = \lib\db\form\get::by_id($_form_id);
		}
		else
		{
			return true;
		}

		if(isset($load_form['starttime']) && $load_form['starttime'])
		{
			if(time() < strtotime($load_form['starttime']))
			{
				$html = '';

				$html .= '<div class="alert-warning font-bold text-center">';
				{
					$html .= T_("Can not answer to this form at this time") . '<br>';
					$html .= T_("This form will be activated in :date", ['date' => \dash\fit::date_time($load_form['starttime'])]);

					if(a($load_form, 'setting'))
					{
						$setting = json_decode($load_form['setting'], true);
						if(isset($setting['beforestart']))
						{
							$html .= ' <br>' . $setting['beforestart'];
						}
					}
				}
				$html .= '</div>';

				self::$schedule_message = $html;

				return false;
			}
		}


		if(isset($load_form['endtime']) && $load_form['endtime'])
		{
			if(time() > strtotime($load_form['endtime']))
			{
				$html = '';

				$html .= '<div class="alert-warning font-bold text-center">';
				{
					$html .= T_("Can not answer to this form at this time") . '<br>';
					$html .= T_("This form has been active until :date", ['date' => \dash\fit::date_time($load_form['endtime'])]);

					if(a($load_form, 'setting'))
					{
						$setting = json_decode($load_form['setting'], true);
						if(isset($setting['afterend']))
						{
							$html .= ' <br>' . $setting['afterend'];
						}
					}
				}
				$html .= '</div>';


				self::$schedule_message = $html;

				return false;
			}
		}

		return true;
	}


}
