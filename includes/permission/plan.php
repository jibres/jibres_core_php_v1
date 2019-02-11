<?php
require_once ('master.php');

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
