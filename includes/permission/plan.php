<?php

$master   = [];

$master[] = 'factorAccess';
$master[] = 'factorEditAccess';

$master[] = 'factorSaleList';
$master[] = 'factorMySaleList';
$master[] = 'factorSaleAdd';
$master[] = 'factorSaleViewDetail';


$master[] = 'factorBuyList';
$master[] = 'factorMyBuyList';
$master[] = 'factorBuyAdd';
$master[] = 'factorBuyViewDetail';



$master[] = 'productAdd';
$master[] = 'productList';
$master[] = 'productSummary';
$master[] = 'productAdvanceSearchView';

$master[] = 'productPriceAccess';
$master[] = 'productFinalpriceAccess';
$master[] = 'productDatemodifiedAccess';
$master[] = 'productBuypriceAccess';
$master[] = 'productDiscountAccess';
$master[] = 'productProfitAccess';
$master[] = 'productStockAccess';


$master[] = 'productInitialbalanceEdit';
$master[] = 'productEditGeneral';
$master[] = 'productManagementView';
$master[] = 'productStatusEdit';
$master[] = 'productDelete';
$master[] = 'productGlance';
$master[] = 'productSite';
$master[] = 'productStock';
$master[] = 'productReport';
$master[] = 'productFactor';
$master[] = 'productThumbEdit';
$master[] = 'productGalleryEdit';
$master[] = 'productDescriptionEdit';
$master[] = 'productPriceHistoryView';
$master[] = 'productImport';
$master[] = 'productExport';

$master[] = 'productCategoryListView';
$master[] = 'productCategoryListAdd';
$master[] = 'productCategoryListDelete';
$master[] = 'productCategoryListEdit';

$master[] = 'productUnitListView';
$master[] = 'productUnitListAdd';
$master[] = 'productUnitListDelete';
$master[] = 'productUnitListEdit';





$master[] = 'permissionList';
$master[] = 'permissionAddEdit';
$master[] = 'permissionDelete';



$master[] = 'staffAccess';
$master[] = 'StaffAccess';

$master[] = 'supplierAccess';
$master[] = 'SupplierAccess';

$master[] = 'customerAccess';
$master[] = 'CustomerAccess';

$master[] = 'customerAdd';
$master[] = 'supplierAdd';
$master[] = 'staffAdd';

$master[] = 'staffExport';
$master[] = 'customerExport';
$master[] = 'supplierExport';

$master[] = 'thirdPartyPermissionChange';
$master[] = 'thirdpartyAssignTag';
$master[] = 'thirdpartyNoteAdd';
$master[] = 'thirdpartyNoteView';
$master[] = 'thirdpartyPermissionEdit';
$master[] = 'thirdpartyManageView';
$master[] = 'thirdpartyTypeEdit';
$master[] = 'thirdpartyAvatarDelete';
$master[] = 'thirdpartyAvatarSet';
$master[] = 'thirdpartyMobileEdit';
$master[] = 'thirdpartyContactEdit';
$master[] = 'thirdpartyCompanyDetailView';
$master[] = 'thirdpartyCompanyDetailEdit';
$master[] = 'thirdpartyAddressEdit';
$master[] = 'thirdpartyAddressView';
$master[] = 'thirdpartyAddressDelete';
$master[] = 'thirdpartyAddressAdd';
$master[] = 'thirdpartyElectronicDocumentEdit';
$master[] = 'thirdpartyIdentifyView';
$master[] = 'thirdpartyIdentifyEdit';
$master[] = 'thirdpartyTagView';
$master[] = 'thirdpartyGlance';
$master[] = 'thirdpartyBudgetView';
$master[] = 'thirdpartyFactorView';
$master[] = 'thirdpartyCreditView';
$master[] = 'thirdpartyDashboardVariableView';
$master[] = 'thirdpartyTransactionView';
$master[] = 'thirdpartyTransactionPlus';
$master[] = 'thirdpartyTransactionMinus';
$master[] = 'thirdpartyTransactionCreditView';
$master[] = 'thirdpartyTransactionCreditEdit';
$master[] = 'thirdpartyBillingView';
$master[] = 'thirdpartyMobileView';
$master[] = 'cpThirdpartyTagAdd';


$master[] = 'settingEdit';
$master[] = 'settingView';
$master[] = 'settingEditPlan';
$master[] = 'settingEditPos';
$master[] = 'settingEditFactor';
$master[] = 'settingEditFund';
$master[] = 'settingEditInventory';
$master[] = 'settingEditLogo';


$master[] = 'reportView';
$master[] = 'reportListChartHours';
$master[] = 'reportDaily';
$master[] = 'reportMonth';

$master[] = "propertyAdd";
$master[] = "propertyDelete";
$master[] = "thirdpartyNoteDelete";
$master[] = "thirdpartySold";
$master[] = "thirdpartyLogView";
$master[] = "thirdpartyProfile";
$master[] = "thirdpartyTransaction";
$master[] = "productPropertyEdit";

$master[] = "categoryView";
$master[] = "categoryPropertyAddEdit";
$master[] = "categoryRemove";
$master[] = "categoryAdd";
$master[] = "categoryEdit";


$master[] = "aPermissionView";
$master[] = "aPermissionAddEdit";
$master[] = "aPermissionDelete";



// make plan array
$plan = [];


// ----------------------------------------------- TRIAL -------------------------------------------- //
$trial   = $master;

// $trial[] = "mPermissionAdd";

$plan['trial'] =
[
  'title'      => 'trial',
  'public'     => true,
  'monthly'    => 0,
  'yearly'     => 0,
  'first_year' => 0,
  'contain'    => $trial,
];

// ----------------------------------------------- FREE -------------------------------------------- //
$free   = $master;

// $free[] = "mPermissionAdd";

$plan['free'] =
[
  'title'      => 'free',
  'public'     => true,
  'monthly'    => 0,
  'yearly'     => 0,
  'first_year' => 0,
  'contain'    => $free,
];



// ----------------------------------------------- SIMPLE -------------------------------------------- //
$start   = $master;

// $start[] = "mPermissionAdd";

$plan['start'] =
[
  'title'      => 'start',
  'public'     => true,
  'monthly'    => 14000,
  'yearly'     => 140000,
  'first_year' => 50000,
  'contain'    => $start,
];



// ----------------------------------------------- SIMPLE -------------------------------------------- //
$simple   = $master;

// $simple[] = "mPermissionAdd";

$plan['simple'] =
[
  'title'      => 'simple',
  'public'     => true,
  'monthly'    => 30000,
  'yearly'     => 300000,
  'first_year' => 150000,
  'contain'    => $simple,
];




// ----------------------------------------------- STANDARD ------------------------------------------ //
$standard   = $master;
// $standard[] = "mPermissionAdd";


$plan['standard'] =
[
  'title'      => 'standard',
  'public'     => true,
  'monthly'    => 75000,
  'yearly'     => 750000,
  'first_year' => 300000,
  'contain'    => $standard,
];


self::$plan = $plan;
?>
