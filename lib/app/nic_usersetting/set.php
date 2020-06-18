<?php
namespace lib\app\nic_usersetting;


class set
{
	public static function set($_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T("Please login to continue"));
			return false;
		}

		$condition =
		[
			'ns1'             => 'dns',
			'ns2'             => 'dns',
			'ns3'             => 'dns',
			'ns4'             => 'dns',
			'autorenewperiod' => ['enum' => ['1year', '5year']],
			'domainlifetime'  => ['enum' => ['3day', '1week','1month', '6month', '1year']],

			'fullname'        => 'enstring_100',
			'phone'           => 'phone',
			'phonecc'         => 'intstring_3',
			'fax'             => 'phone',
			'faxcc'           => 'intstring_3',
			'notifsms'        => 'bit',
			'notifemail'      => 'bit',
			'firstname'       => 'string_100',
			'lastname'        => 'string_100',
			'firstname_en'    => 'enstring_100',
			'lastname_en'     => 'enstring_100',
			'nationalcode'    => 'nationalcode',
			'passportcode'    => 'string_50',
			'company'         => 'string_100',
			'category'        => 'string_100',
			'email'           => 'email',
			'country'         => ['enum' => ['AU','AF','AL','DZ','AS','AD','AO','AI','AQ','AG','AR','AM','AW','AT','AZ','BS','BH','BD','BB','BY','BE','BZ','BJ','BM','BO','BA','BW','BV','BR','IO','BN','BG','BF','BI','BT','KH','CM','CA','CV','KY','CF','TD','CL','CN','CX','CC','CO','KM','CG','CK','CR','HR','CY','CZ','DK','DJ','DM','DO','TP','EC','EG','SV','GQ','EE','ET','FK','FO','FJ','FI','SU','FX','FR','TF','GA','GM','GE','DE','GH','GI','GB','GR','GL','GD','GP','GU','GT','GW','GN','GF','GY','HT','HM','HN','HK','HU','IS','IN','ID','IQ','IE','IL','IT','CI','JM','JP','JO','JF','KZ','KE','KG','KI','KR','KW','LA','LV','LB','LS','LR','LY','LI','LT','LU','MO','MK','MG','MW','MY','MV','ML','MT','MH','MQ','MR','MU','YT','MX','FM','MD','MC','MN','ME','MS','MA','MZ','MM','NA','NR','NP','AN','NL','NC','NZ','NI','NE','NG','NU','NF','MP','NO','EM','OM','PK','PW','PA','PG','PY','PE','PH','PN','PL','PF','PT','ZN','PR','QA','RE','RO','RU','RW','GS','LC','WS','SM','SA','SN','SC','SL','SG','SK','SI','SB','SO','ZA','ES','LK','SH','PM','ST','KN','VC','RS','SR','SJ','SZ','SE','CH','TJ','TW','TZ','TH','TG','TK','TO','TT','TN','TR','TM','TC','TV','UM','UG','UA','AE','US','UY','UZ','VU','VA','VE','VN','VG','VI','WF','EH','YE','YU','ZM','ZW','ZR',]],
			'province'        => 'enstring_50',
			'city'            => 'enstring_50',
			'postcode'        => 'enstring_20',
			'address'         => 'enstring_50',
			'mobile'          => 'mobile',
		];

		$data = \dash\cleanse::input($_args, $condition, [], []);

		$args = \dash\cleanse::patch_mode($_args, $data);


		$load = \lib\db\nic_usersetting\get::my_setting(\dash\user::id());
		if(isset($load['id']))
		{
			$args['datemodified'] = date("Y-m-d H:i:s");
			\lib\db\nic_usersetting\update::update($args, $load['id']);
		}
		else
		{
			$args['user_id']     = \dash\user::id();
			$args['datecreated'] = date("Y-m-d H:i:s");
			\lib\db\nic_usersetting\insert::new_record($args);
		}

		\dash\notif::ok(T_("Setting saved"));


	}

}
?>