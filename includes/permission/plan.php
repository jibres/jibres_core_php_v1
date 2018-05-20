<?php
// make plan array
$plan = [];

// ----------------------------------------------- SIMPLE -------------------------------------------- //
$simple   = [];

$simple[] = "mPermissionAdd";

$plan['simple'] =
[
  'title'              => 'simple',
  'public'             => true,
  'monthly'            => 100000,
  'yearly'             => 1000000,
  'teacher_permission' => null,
  'contain'            => $simple,
];




// ----------------------------------------------- STANDARD ------------------------------------------ //

$standard   = [];
$standard[] = 'mGroupView';



$plan['standard'] =
[
  'title'              => 'standard',
  'public'             => true,
  'monthly'            => 500000,
  'yearly'             => 5000000,
  'teacher_permission' => null,
  'contain'            => $standard,
];



self::$plan = $plan;
?>
