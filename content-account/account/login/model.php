<?php
class model extends main_model
{
	function post_login()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->redirect 	= false;
		$mymobile	= str_replace(' ', '', post::mobile());
		$tmp_result	=  $this->sql()->tableUsers()->whereUser_mobile($mymobile)->select();

		if($tmp_result->num() == 1)
		{
			// mobile exist
			// login: check password then user can login
			// register: show error
			
			$tmp_result = $tmp_result->assoc();
			if (isset($tmp_result['user_pass']) && $tmp_result['user_pass'] == post::password())
			{
				// password is correct
				$_SESSION['user']	= array();
				$tmp_fields			=  array('type', 'gender', 'firstname', 'lastname', 'nickname', 'mobile', 'status', 'credit');
				foreach ($tmp_fields as $key => $value) 
				{
					$_SESSION['user'][$value]	= $tmp_result['user_'.$value];
				}
				$_SESSION['user']['permission_id']	= $tmp_result['permission_id'];
				debug_lib::true("Login successfully");
			}
			else
			{
				// password is incorrect
				unset($_SESSION['user']);
				debug_lib::fatal("Password is incorrect");
			}
		}

		elseif($tmp_result->num() == 0 )
		{
			// mobile does not exits
			// login: show mobile does not exist
			// register: ok, can register
			debug_lib::fatal("Mobile number is incorrect");
		}

		else
		{
			// mobile exist more than 2 times!
			debug_lib::fatal("Please forward this message to Administrator");
		}
	}
}
?>