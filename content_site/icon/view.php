<?php
namespace content_site\icon;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Choose from icons"));

		\dash\data::back_text(T_("Back"));
		\dash\data::back_link(\dash\request::get('callback'));

		\dash\data::userToggleSidebar(false);

		\dash\data::include_adminPanelBuilder(true);

		\dash\data::myIconList(self::icon_list());

	}

	public static function icon_list()
	{
		return
		[
			'AbandonedCart','Accessibility','Activities','AddCode','AddImage','Add','AddNote','AddProduct','Affiliate','Analytics','Apps','Archive','Attachment','Automation','Backspace','Balance','Bank','Barcode','Behavior','BillingStatementDollar','BillingStatementEuro','BillingStatementPound','BillingStatementRupee','BillingStatementYen','Blockquote','Blog','Bug','ButtonCornerPill','ButtonCornerRounded','ButtonCornerSquare','BuyButtonButtonLayout','BuyButtonHorizontalLayout','BuyButton','BuyButtonVerticalLayout','Calendar','CalendarTick','Camera','Capital','CardReaderChip','CardReader','CardReaderTap','CartDown','Cart','CartUp','CashDollar','CashEuro','CashPound','CashRupee','CashYen','Categories','Channels','Chat','ChecklistAlternate','Checklist','Checkout','CircleAlert','CircleCancel','CircleDisabled','CircleDots','CircleDown','CircleInformation','CircleLeft','CircleMinus','CirclePlus','CircleRight','CircleTick','CircleUp','Clock','Code','Collections','Colors','Column1','ColumnWithText','Columns2','Columns3','Compose','Confetti','CreditCard','CreditCardPercent','CreditCardSecure','CustomerMinus','CustomerPlus','Customers','DataVisualization','Delete','Desktop','DetailedPopUp','DiamondAlert','DigitalMediaReceiver','DiscountAutomatic','DiscountCode','Discounts','DnsSettings','DomainNew','Domains','DraftOrders','DragDrop','Edit','Email','EmailNewsletter','Envelope','Exchange','ExistingInventory','Exit','Favicon','Favorite','FeaturedCollection','FeaturedContent','Filter','FirstOrder','FirstVisit','Flag','FlipCamera','FolderDown','Folder','FolderMinus','FolderPlus','FolderUp','FollowUpEmail','Food','Footer','Forms','FraudProtect','FraudProtectPending','FraudProtectUnprotected','GamesConsole','GiftCard','Globe','Grammar','Hashtag','Header','Heart','HideKeyboard','Hint','Home','Icons','Illustration','ImageAlt','Image','ImageWithText','ImageWithTextOverlay','Images','ImportStore','Incoming','Inventory','Iq','Jobs','Key','LabelPrinter','LandingPage','Legal','List','LiveView','Location','Lock','LogoBlock','ManagedStore','Marketing','Maximize','Mention','Microphone','Minimize','MobileAccept','MobileBackArrow','MobileCancel','MobileChevron','MobileHamburger','MobileHorizontalDots','Mobile','MobilePlus','MobileVerticalDots','Moneris','Nature','Navigation','Note','Notification','OnlineStore','Orders','Outgoing','Package','PageDown','Page','PageMinus','PagePlus','PageUp','PaintBrush','PauseCircle','Pause','Payments','PhoneIn','Phone','PhoneOut','Pin','PlayCircle','Play','PointOfSale','Popular','Print','Products','Profile','QuestionMark','QuickSale','Receipt','RecentSearches','Redo','ReferralCode','Referral','Refresh','Refund','RemoveProduct','RepeatOrder','Replace','Reports','Resources','Risk','Sandbox','Search','Section','Secure','Send','Settings','Shipment','Shopcodes','SidebarLeft','SidebarRight','Slideshow','SmileyHappy','SmileyJoy','SmileyNeutral','SmileySad','SocialAd','SocialPost','SoftPack','SortAscending','SortDescending','Sound','Store','StoreStatus','Tablet','TapChip','Tax','Team','Template','TextAlignmentCenter','TextAlignmentLeft','TextAlignmentRight','TextBlock','Text','ThemeEdit','ThemeStore','Themes','ThumbsDown','ThumbsUp','TimelineAttachment','Tips','Tools','TransactionFeeDollar','TransactionFeeEuro','TransactionFeePound','TransactionFeeRupee','TransactionFeeYen','Transaction','TransferIn','Transfer','TransferOut','TransferWithinShopify','Transport','Troubleshoot','Type','Undo','Unfulfilled','UnknownDevice','UpdateInventory','Upload','Variant','View','ViewportNarrow','ViewportWide','Vocabulary','Wand','Wearable','Wholesale','Wifi',
		];
	}




}
?>