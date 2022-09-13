<?php

namespace lib\app\plan;

class planAlert
{

    public static function check($_plan_history)
    {
		if(isset($_plan_history['expirydate']) && $_plan_history['expirydate'])
		{
			$pxpirydate = $_plan_history['expirydate'];
		}
		else
		{
			return false;
		}

		$notifAlert = [];

		if(isset($_plan_history['notifalert']) && $_plan_history['notifalert'])
		{
			if(is_array($_plan_history['notifalert']))
			{
				$notifAlert = $_plan_history['notifalert'];
			}
			elseif(is_string($_plan_history['notifalert']))
			{
				$notifAlert = json_decode($_plan_history['notifalert'], true);
				if(!is_array($notifAlert))
				{
					$notifAlert = [];
				}
			}
		}




        // print_r($_plan_history);exit();
    }


}