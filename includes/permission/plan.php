<?php
require_once ('master.php');

// make plan array
$plan = [];



// ----------------------------------------------- SIMPLE -------------------------------------------- //
$simple   = $master;

// $simple[] = "mPermissionAdd";

$plan['simple'] =
[
  'title'              => 'simple',
  'public'             => true,
  'monthly'            => 10000,
  'yearly'             => 100000,
  'teacher_permission' => null,
  'contain'            => $simple,
];




// ----------------------------------------------- STANDARD ------------------------------------------ //
$standard   = $master;
// $standard[] = "mPermissionAdd";


$plan['standard'] =
[
  'title'              => 'standard',
  'public'             => true,
  'monthly'            => 50000,
  'yearly'             => 500000,
  'teacher_permission' => null,
  'contain'            => $standard,
];



self::$plan = $plan;
?>
