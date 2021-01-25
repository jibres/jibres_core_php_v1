<?php
namespace dash;

class plan_list
{
	/**
	 * All permission caller used in system
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	protected static function _master_contain()
	{
		$master =
		[
			/* the group caller must be exists in plan */
			'setting',
			'products',
			'orders',
			'form',
			'accounting',
			'application',
			'setting',
			'crm',
			'cms',
			'support',
			'report',
			/* the group caller must be exists in plan */
		];

		$master = array_merge($master, array_keys(self::public_show_master_contain()));

		return $master;
	}



	public static function group_permission()
	{
		$group               = [];

		$group['products'] =
		[
			'key'      => 'products',
			'title'    => T_("Products"),
			'desc'     => T_("Access to display and edit products as well as items such as product tag, categories and anything about the products."),
			'advance'  => [],
		];

		$group['orders'] =
		[
			'key'      => 'orders',
			'title'    => T_("Orders"),
			'desc'     => T_("Access to view and manage orders as well as view and manage customers' shopping cart"),
			'advance'  => [],
		];


		$group['form'] =
		[
			'key'      => 'form',
			'title'    => T_("Form builder"),
			'desc'     => T_("Access to form builder, Add new from, Manage form answer, ..."),
			'advance'  => [],
		];

		$group['accounting'] =
		[
			'key'      => 'accounting',
			'title'    => T_("accounting"),
			'desc'     => null, //T_("Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
			'advance'  => [],
		];


		// $group['application'] =
		// [
		// 	'key'      => 'application',
		// 	'title'    => T_("Manage application"),
		// 	'desc'     => null, //T_("Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
		// 	'advance'  => [],
		// ];


		$group['setting'] =
		[
			'key'      => 'setting',
			'title'    => T_("Manage Setting"),
			'desc'     => T_("Access to change and manage business settings"),
			'advance'  => [],
		];

		$group['crm'] =
		[
			'key'      => 'crm',
			'title'    => T_("CRM"),
			'desc'     => T_("Customer relationship management includes customer management, settings for access levels and ..."),
			'advance'  => [],
		];

		$group['cms'] =
		[
			'key'      => 'cms',
			'title'    => T_("CMS"),
			'desc'     => T_("Manage media and business content such as news and site pages"),
			'advance'  => [],
		];

		$group['support'] =
		[
			'key'      => 'support',
			'title'    => T_("Manage support center"),
			'desc'     => T_("Access the support section and the business help center and ticket answering"),
			'advance'  => [],
		];


		// $group['report'] =
		// [
		// 	'key'      => 'report',
		// 	'title'    => T_("Reports"),
		// 	'desc'     => null, //T_("Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups."),
		// 	'advance'  => [],
		// ];





		return $group;
	}





	public static function public_show_master_contain()
	{
		$master                                 = [];

		// $master['EnterByAnother']               = ['jibres' => true, 'business' => false,  'group' => 'manage',	     'caller' => 'EnterByAnother', 				'title' => T_('EnterByAnother'), 'require' => []];

		// --------------- PRODUCT
		$master['productAdd']                   = ['jibres' => false, 'business' => true,  'group' => 'products', 	'caller' => 'productAdd', 					'title' => T_('Add new product'), 'require' => []];
		$master['ProductEdit']                  = ['jibres' => false, 'business' => true,  'group' => 'products', 	'caller' => 'ProductEdit', 					'title' => T_('Edit product'), 'require' => []];
		$master['ProductDelete']                = ['jibres' => false, 'business' => true,  'group' => 'products', 	'caller' => 'ProductDelete', 				'title' => T_('Delete product'), 'require' => []];
		$master['mamageProductUnit']            = ['jibres' => false, 'business' => true,  'group' => 'products', 	'caller' => 'mamageProductUnit', 			'title' => T_('Mamage Product Unit'), 'require' => []];
		$master['manageProductCompany']         = ['jibres' => false, 'business' => true,  'group' => 'products', 	'caller' => 'manageProductCompany', 		'title' => T_('Manage Product Company'), 'require' => []];
		$master['manageProductTag']             = ['jibres' => false, 'business' => true,  'group' => 'products', 	'caller' => 'manageProductTag', 			'title' => T_('Manage Product Tag'), 'require' => []];
		$master['manageProductCategory']        = ['jibres' => false, 'business' => true,  'group' => 'products', 	'caller' => 'manageProductCategory', 		'title' => T_('Manage Product Category'), 'require' => []];


		// --------------- FACTOR + CART + SALE
		$master['factorSaleAdd']                = ['jibres' => false, 'business' => true,  'group' => 'orders', 	'caller' => 'factorSaleAdd', 				'title' => T_('Add new sale order'), 'require' => []];
		$master['manageCart']                   = ['jibres' => false, 'business' => true,  'group' => 'orders', 	'caller' => 'manageCart', 				 	'title' => T_('Manage Cart'), 'require' => []];
		$master['manageFactors']                = ['jibres' => false, 'business' => true,  'group' => 'orders', 	'caller' => 'manageFactors', 			 	'title' => T_('Manage Factors'), 'require' => []];
		$master['orderNotificationReceiver']    = ['jibres' => false, 'business' => true,  'group' => 'orders', 	'caller' => 'orderNotificationReceiver', 	'title' => T_('Order Notification Receiver'), 'require' => []];


		// --------------- SETTING
		$master['settingEdit']                  = ['jibres' => false, 'business' => true,  'group' => 'setting', 	'caller' => 'settingEdit', 					'title' => T_('Manage business setting'), 'require' => []];


		// --------------- FORMS
		$master['ManageForm']                   = ['jibres' => false, 'business' => true,  'group' => 'form', 	'caller' => 'ManageForm', 						'title' => T_('Manage Form'), 'require' => []];
		$master['AdvanceFormAnalyze']           = ['jibres' => false, 'business' => true,  'group' => 'form', 	'caller' => 'AdvanceFormAnalyze', 				'title' => T_('Advance Form Analyze'), 'require' => []];
		$master['ManageFormTags']               = ['jibres' => false, 'business' => true,  'group' => 'form', 	'caller' => 'ManageFormTags', 					'title' => T_('Manage Form Tags'), 'require' => []];
		$master['FormRemoveAnswer']             = ['jibres' => false, 'business' => true,  'group' => 'form', 	'caller' => 'FormRemoveAnswer', 				'title' => T_('Remove form answer'), 'require' => []];
		$master['FormDescription']              = ['jibres' => false, 'business' => true,  'group' => 'form', 	'caller' => 'FormDescription', 					'title' => T_('Form Description'), 'require' => []];



		// --------------- CRM
		$master['crmCustomerManagement']        = ['jibres' => false, 'business' => true,  'group' => 'crm', 		'caller' => 'crmCustomerManagement', 		'title' => T_('Manage Customers'), 'require' => []];
		$master['crmManageCustomerPayment']     = ['jibres' => false, 'business' => true,  'group' => 'crm', 		'caller' => 'crmManageCustomerPayment', 	'title' => T_('Manage customer payemnts'), 'require' => []];
		$master['crmPermissionManagement']      = ['jibres' => false, 'business' => true,  'group' => 'crm', 		'caller' => 'crmPermissionManagement', 		'title' => T_('Permission Management'), 'require' => []];
		$master['crmTransactionsList']          = ['jibres' => false, 'business' => true,  'group' => 'crm', 		'caller' => 'crmTransactionsList', 			'title' => T_('Show Payemnt List'), 'require' => []];
		$master['crmLog']                       = ['jibres' => false, 'business' => true,  'group' => 'crm', 		'caller' => 'crmLog', 						'title' => T_('Show logs'), 'require' => []];
		$master['crmSms']                       = ['jibres' => false, 'business' => true,  'group' => 'crm', 		'caller' => 'crmSms', 						'title' => T_('Show sms list'), 'require' => []];
		$master['crmTelegram']                  = ['jibres' => false, 'business' => true,  'group' => 'crm', 		'caller' => 'crmTelegram', 					'title' => T_('Show Telegram messages list'), 'require' => []];

		$master['crmShowTicketsList']           = ['jibres' => false, 'business' => true,  'group' => 'crm', 		'caller' => 'crmShowTicketsList', 			'title' => T_('Show Tickets List'), 'require' => []];
		$master['crmTicketManager']             = ['jibres' => false, 'business' => true,  'group' => 'crm', 		'caller' => 'crmTicketManager', 			'title' => T_('Ticket Manager'), 'require' => []];

		$master['crmAddNewNotification']        = ['jibres' => false, 'business' => true,  'group' => 'crm', 		'caller' => 'crmAddNewNotification', 		'title' => T_('Add New Notification'), 'require' => []];


		// --------------- CMS
		$master['cmsManagePost']                = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cmsManagePost', 				'title' => T_('Manage Post'), 'require' => []];
		$master['cmsManageAllPost']             = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cmsManageAllPost', 			'title' => T_('Manage All Post'), 'require' => []];
		$master['cmsPostPublisher']             = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cmsPostPublisher', 			'title' => T_('Publish post'), 'require' => []];
		$master['cmsPostRemove']                = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cmsPostRemove', 				'title' => T_('Remove post'), 'require' => []];
		$master['cmsManageHelpCenter']          = ['jibres' => true,  'business' => false,  'group' => 'cms', 		'caller' => 'cmsManageHelpCenter', 			'title' => T_('Manage Help Center'), 'require' => []];

		$master['cmsCommentView']               = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cmsCommentView', 				'title' => T_('View Comments'), 'require' => []];
		$master['cmsManageComment']             = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cmsManageComment', 			'title' => T_('Manage Comments'), 'require' => []];

		$master['cmsManageTag']                 = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cmsManageTag', 				'title' => T_('Manage Tags'), 'require' => []];

		$master['cmsAttachmentView']            = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cmsAttachmentView', 			'title' => T_('View Attachment'), 'require' => []];
		$master['cmsAttachmentAdd']             = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cmsAttachmentAdd', 			'title' => T_('Add New Attachment'), 'require' => []];
		$master['cmsManageAttachment']          = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cmsManageAttachment', 			'title' => T_('Manage Attachments'), 'require' => []];

		$master['cmsSetting']                   = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cmsSetting',	 				'title' => T_('CMS customization'), 'require' => []];

		return $master;
	}



}
?>