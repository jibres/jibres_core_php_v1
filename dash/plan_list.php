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
			'cart',
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

		$master['productAdd']                   = ['jibres' => false, 'business' => true,  'group' => 'products', 	'caller' => 'productAdd', 					'title' => T_('Add new product'), 'require' => []];
		$master['ProductEdit']                  = ['jibres' => false, 'business' => true,  'group' => 'products', 	'caller' => 'ProductEdit', 					'title' => T_('Edit product'), 'require' => []];
		$master['ProductDelete']                = ['jibres' => false, 'business' => true,  'group' => 'products', 	'caller' => 'ProductDelete', 				'title' => T_('Delete product'), 'require' => []];
		$master['mamageProductUnit']            = ['jibres' => false, 'business' => true,  'group' => 'products', 	'caller' => 'mamageProductUnit', 			'title' => T_('Mamage Product Unit'), 'require' => []];
		$master['manageProductCompany']         = ['jibres' => false, 'business' => true,  'group' => 'products', 	'caller' => 'manageProductCompany', 		'title' => T_('Manage Product Company'), 'require' => []];
		$master['manageProductComment']         = ['jibres' => false, 'business' => true,  'group' => 'products', 	'caller' => 'manageProductComment', 		'title' => T_('Manage Product Comment'), 'require' => []];
		$master['manageProductTag']             = ['jibres' => false, 'business' => true,  'group' => 'products', 	'caller' => 'manageProductTag', 			'title' => T_('Manage Product Tag'), 'require' => []];
		$master['manageProductCategory']        = ['jibres' => false, 'business' => true,  'group' => 'products', 	'caller' => 'manageProductCategory', 		'title' => T_('Manage Product Category'), 'require' => []];


		$master['factorSaleAdd']                = ['jibres' => false, 'business' => true,  'group' => 'orders', 	'caller' => 'factorSaleAdd', 				'title' => T_('Add new sale order'), 'require' => []];
		$master['manageCart']                   = ['jibres' => false, 'business' => true,  'group' => 'orders', 	'caller' => 'manageCart', 				 	'title' => T_('Manage Cart'), 'require' => []];
		$master['manageFactors']                = ['jibres' => false, 'business' => true,  'group' => 'orders', 	'caller' => 'manageFactors', 			 	'title' => T_('Manage Factors'), 'require' => []];
		$master['orderNotificationReceiver']    = ['jibres' => false, 'business' => true,  'group' => 'orders', 	'caller' => 'orderNotificationReceiver', 	'title' => T_('Order notification Receiver'), 'require' => []];


		$master['settingEdit']                  = ['jibres' => false, 'business' => true,  'group' => 'setting', 	'caller' => 'settingEdit', 					'title' => T_('Manage business setting'), 'require' => []];


		$master['ManageForm']                   = ['jibres' => false, 'business' => true,  'group' => 'form', 	'caller' => 'ManageForm', 						'title' => T_('Manage Form'), 'require' => []];
		$master['AdvanceFormAnalyze']           = ['jibres' => false, 'business' => true,  'group' => 'form', 	'caller' => 'AdvanceFormAnalyze', 				'title' => T_('Advance Form Analyze'), 'require' => []];
		$master['ManageFormTags']               = ['jibres' => false, 'business' => true,  'group' => 'form', 	'caller' => 'ManageFormTags', 					'title' => T_('Manage Form Tags'), 'require' => []];
		$master['FormRemoveAnswer']             = ['jibres' => false, 'business' => true,  'group' => 'form', 	'caller' => 'FormRemoveAnswer', 				'title' => T_('Remove form answer'), 'require' => []];
		$master['FormDescription']              = ['jibres' => false, 'business' => true,  'group' => 'form', 	'caller' => 'FormDescription', 					'title' => T_('Form Description'), 'require' => []];





		$master['contentCrm']                   = ['jibres' => true,  'business' => true,  'group' => 'crm', 		'caller' => 'contentCrm', 					'title' => T_('contentCrm'), 'require' => []];
		$master['staffAccess']                  = ['jibres' => false, 'business' => true,  'group' => 'crm', 		'caller' => 'staffAccess', 					'title' => T_('staffAccess'), 'require' => []];
		$master['customerAccess']               = ['jibres' => false, 'business' => true,  'group' => 'crm', 		'caller' => 'customerAccess', 				'title' => T_('customerAccess'), 'require' => []];
		$master['cpPermissionView']             = ['jibres' => true,  'business' => true,  'group' => 'crm', 		'caller' => 'cpPermissionView', 			'title' => T_('cpPermissionView'), 'require' => []];
		$master['cpPermissionAdd']              = ['jibres' => true,  'business' => true,  'group' => 'crm', 		'caller' => 'cpPermissionAdd', 				'title' => T_('cpPermissionAdd'), 'require' => []];
		$master['cpPermissionEdit']             = ['jibres' => true,  'business' => true,  'group' => 'crm', 		'caller' => 'cpPermissionEdit', 			'title' => T_('cpPermissionEdit'), 'require' => []];
		$master['cpPermissionDelete']           = ['jibres' => true,  'business' => true,  'group' => 'crm', 		'caller' => 'cpPermissionDelete', 			'title' => T_('cpPermissionDelete'), 'require' => []];
		$master['cpUsersPasswordChange']        = ['jibres' => true,  'business' => true,  'group' => 'crm', 		'caller' => 'cpUsersPasswordChange', 		'title' => T_('cpUsersPasswordChange'), 'require' => []];
		$master['cpUsersPermission']            = ['jibres' => true,  'business' => true,  'group' => 'crm', 		'caller' => 'cpUsersPermission', 			'title' => T_('cpUsersPermission'), 'require' => []];
		$master['cpUsersAdd']                   = ['jibres' => true,  'business' => true,  'group' => 'crm', 		'caller' => 'cpUsersAdd', 					'title' => T_('cpUsersAdd'), 'require' => []];
		$master['aCustomerView']                = ['jibres' => false, 'business' => true,  'group' => 'crm', 		'caller' => 'aCustomerView', 				'title' => T_('aCustomerView'), 'require' => []];
		$master['aCustomerEdit']                = ['jibres' => false, 'business' => true,  'group' => 'crm', 		'caller' => 'aCustomerEdit', 				'title' => T_('aCustomerEdit'), 'require' => []];
		$master['mClassroomAdd']                = ['jibres' => false, 'business' => true,  'group' => 'crm', 		'caller' => 'mClassroomAdd', 				'title' => T_('mClassroomAdd'), 'require' => []];




		$master['contentCp']                    = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'contentCp', 					'title' => T_('contentCp'), 'require' => []];
		$master['cpSMS']                        = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpSMS', 						'title' => T_('cpSMS'), 'require' => []];
		$master['cpUsersEdit']                  = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpUsersEdit', 					'title' => T_('cpUsersEdit'), 'require' => []];
		$master['cpSmsSend']                    = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpSmsSend', 					'title' => T_('cpSmsSend'), 'require' => []];
		$master['cpUsersView']                  = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpUsersView', 					'title' => T_('cpUsersView'), 'require' => []];
		$master['contentPardakhtyar']           = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'contentPardakhtyar', 			'title' => T_('contentPardakhtyar'), 'require' => []];
		$master['cpPageAdd']                    = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpPageAdd', 					'title' => T_('cpPageAdd'), 'require' => []];
		$master['cpHelpCenterAdd']              = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpHelpCenterAdd', 				'title' => T_('cpHelpCenterAdd'), 'require' => []];
		$master['cpPostsAdd']                   = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpPostsAdd', 					'title' => T_('cpPostsAdd'), 'require' => []];
		$master['cpPostsViewAll']               = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpPostsViewAll', 				'title' => T_('cpPostsViewAll'), 'require' => []];
		$master['cpPageView']                   = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpPageView', 					'title' => T_('cpPageView'), 'require' => []];
		$master['cpHelpCenterView']             = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpHelpCenterView', 			'title' => T_('cpHelpCenterView'), 'require' => []];
		$master['cpPostsView']                  = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpPostsView', 					'title' => T_('cpPostsView'), 'require' => []];
		$master['cpPageEdit']                   = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpPageEdit', 					'title' => T_('cpPageEdit'), 'require' => []];
		$master['cpHelpCenterEdit']             = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpHelpCenterEdit', 			'title' => T_('cpHelpCenterEdit'), 'require' => []];
		$master['cpPostsEdit']                  = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpPostsEdit', 					'title' => T_('cpPostsEdit'), 'require' => []];
		$master['cpPostsEditStatus']            = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpPostsEditStatus', 			'title' => T_('cpPostsEditStatus'), 'require' => []];
		$master['cpHelpCenterEditStatus']       = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpHelpCenterEditStatus', 		'title' => T_('cpHelpCenterEditStatus'), 'require' => []];
		$master['cpHelpCenterEditPublished']    = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpHelpCenterEditPublished', 	'title' => T_('cpHelpCenterEditPublished'), 'require' => []];
		$master['cpChangePostCreator']          = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpChangePostCreator', 			'title' => T_('cpChangePostCreator'), 'require' => []];
		$master['cpPostsDelete']                = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpPostsDelete', 				'title' => T_('cpPostsDelete'), 'require' => []];
		$master['cpCommentsView']               = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpCommentsView', 				'title' => T_('cpCommentsView'), 'require' => []];
		$master['cpCommentsEdit']               = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpCommentsEdit', 				'title' => T_('cpCommentsEdit'), 'require' => []];
		$master['cpCategoryDelete']             = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpCategoryDelete', 			'title' => T_('cpCategoryDelete'), 'require' => []];
		$master['cpTagHelpDelete']              = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpTagHelpDelete', 				'title' => T_('cpTagHelpDelete'), 'require' => []];
		$master['cpTagSupportDelete']           = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpTagSupportDelete', 			'title' => T_('cpTagSupportDelete'), 'require' => []];
		$master['cpTagDelete']                  = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpTagDelete', 					'title' => T_('cpTagDelete'), 'require' => []];
		$master['cpCategoryEdit']               = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpCategoryEdit', 				'title' => T_('cpCategoryEdit'), 'require' => []];
		$master['cpTagHelpEdit']                = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpTagHelpEdit', 				'title' => T_('cpTagHelpEdit'), 'require' => []];
		$master['cpTagSupportEdit']             = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpTagSupportEdit', 			'title' => T_('cpTagSupportEdit'), 'require' => []];
		$master['cpTagEdit']                    = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpTagEdit', 					'title' => T_('cpTagEdit'), 'require' => []];
		$master['cpCategoryAdd']                = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpCategoryAdd', 				'title' => T_('cpCategoryAdd'), 'require' => []];
		$master['cpTagSupportAdd']              = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpTagSupportAdd', 				'title' => T_('cpTagSupportAdd'), 'require' => []];
		$master['cpTagHelpAdd']                 = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpTagHelpAdd', 				'title' => T_('cpTagHelpAdd'), 'require' => []];
		$master['cpTagAdd']                     = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpTagAdd', 					'title' => T_('cpTagAdd'), 'require' => []];
		$master['cpCategoryView']               = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpCategoryView', 				'title' => T_('cpCategoryView'), 'require' => []];
		$master['cpTagHelpView']                = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpTagHelpView', 				'title' => T_('cpTagHelpView'), 'require' => []];
		$master['cpTagSupportView']             = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpTagSupportView', 			'title' => T_('cpTagSupportView'), 'require' => []];
		$master['cpTagView']                    = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpTagView', 					'title' => T_('cpTagView'), 'require' => []];
		$master['cpDayEvent']                   = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpDayEvent', 					'title' => T_('cpDayEvent'), 'require' => []];
		$master['cpTransaction']                = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpTransaction', 				'title' => T_('cpTransaction'), 'require' => []];
		$master['cpTransactionAdd']             = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpTransactionAdd', 			'title' => T_('cpTransactionAdd'), 'require' => []];
		$master['cpHelpCenterViewAll']          = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpHelpCenterViewAll', 			'title' => T_('cpHelpCenterViewAll'), 'require' => []];
		$master['cpPostsEditPublished']         = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpPostsEditPublished', 		'title' => T_('cpPostsEditPublished'), 'require' => []];
		$master['cpPostsEditForOthers']         = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpPostsEditForOthers', 		'title' => T_('cpPostsEditForOthers'), 'require' => []];
		$master['cpHelpCenterDelete']           = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpHelpCenterDelete', 			'title' => T_('cpHelpCenterDelete'), 'require' => []];
		$master['cpPageDelete']                 = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpPageDelete', 				'title' => T_('cpPageDelete'), 'require' => []];
		$master['cpHelpCenterDeleteForOthers']  = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpHelpCenterDeleteForOthers', 	'title' => T_('cpHelpCenterDeleteForOthers'), 'require' => []];
		$master['cpPostsDeleteForOthers']       = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpPostsDeleteForOthers', 		'title' => T_('cpPostsDeleteForOthers'), 'require' => []];
		$master['cpCommentsDelete']             = ['jibres' => true,  'business' => true,  'group' => 'cms', 		'caller' => 'cpCommentsDelete', 			'title' => T_('cpCommentsDelete'), 'require' => []];

		$master['supportTicketManage']          = ['jibres' => true,  'business' => true,  'group' => 'support', 	'caller' => 'supportTicketManage', 			'title' => T_('supportTicketManage'), 'require' => []];
		$master['supportTicketAddNote']         = ['jibres' => true,  'business' => true,  'group' => 'support', 	'caller' => 'supportTicketAddNote', 		'title' => T_('supportTicketAddNote'), 'require' => []];
		$master['supportEditMessage']           = ['jibres' => true,  'business' => true,  'group' => 'support', 	'caller' => 'supportEditMessage', 			'title' => T_('supportEditMessage'), 'require' => []];
		$master['supportTicketSignature']       = ['jibres' => true,  'business' => true,  'group' => 'support', 	'caller' => 'supportTicketSignature', 		'title' => T_('supportTicketSignature'), 'require' => []];
		$master['cpHelpCenterEditForOthers']    = ['jibres' => true,  'business' => true,  'group' => 'support', 	'caller' => 'cpHelpCenterEditForOthers', 	'title' => T_('cpHelpCenterEditForOthers'), 'require' => []];
		$master['supportTicketAnswer']          = ['jibres' => true,  'business' => true,  'group' => 'support', 	'caller' => 'supportTicketAnswer', 			'title' => T_('supportTicketAnswer'), 'require' => []];
		$master['supportTicketManageSubdomain'] = ['jibres' => true,  'business' => true,  'group' => 'support', 	'caller' => 'supportTicketManageSubdomain', 'title' => T_('supportTicketManageSubdomain'), 'require' => []];
		$master['supportTicketAssignTag']       = ['jibres' => true,  'business' => true,  'group' => 'support', 	'caller' => 'supportTicketAssignTag', 		'title' => T_('supportTicketAssignTag'), 'require' => []];
		$master['supportTicketClose']           = ['jibres' => true,  'business' => true,  'group' => 'support', 	'caller' => 'supportTicketClose', 			'title' => T_('supportTicketClose'), 'require' => []];
		$master['supportTicketReOpen']          = ['jibres' => true,  'business' => true,  'group' => 'support', 	'caller' => 'supportTicketReOpen', 			'title' => T_('supportTicketReOpen'), 'require' => []];
		$master['supportTicketDelete']          = ['jibres' => true,  'business' => true,  'group' => 'support', 	'caller' => 'supportTicketDelete', 			'title' => T_('supportTicketDelete'), 'require' => []];
		$master['supportTicketShowMobile']      = ['jibres' => true,  'business' => true,  'group' => 'support', 	'caller' => 'supportTicketShowMobile', 		'title' => T_('supportTicketShowMobile'), 'require' => []];
		$master['supportTicketReport']          = ['jibres' => true,  'business' => true,  'group' => 'support', 	'caller' => 'supportTicketReport', 			'title' => T_('supportTicketReport'), 'require' => []];

		return $master;
	}


}
?>