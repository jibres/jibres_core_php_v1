ALTER TABLE jibres_XXXXXXX.factoraction ADD `category` ENUM('comment', 'status', 'paystatus', 'tracking') CHARACTER SET utf8mb4 NULL DEFAULT NULL AFTER `action`;


ALTER TABLE jibres_XXXXXXX.factoraction CHANGE `action` `action`
ENUM(
'tracking',
'comment',
'order',
'expire',
'cancel',
'go_to_bank',
'pay_successfull',
'pay_error',
'pay_cancel',
'pay_verified',
'pay_unverified',
'sending',
'pending_pay',
'pending_verify',
'pending_prepare',
'pending_send',
'deliver',
'reject',
'spam',
'deleted',
'initial',
'registered',
'awaiting',
'confirmed',
'preparing',
'delivered',
'revert',
'sucess',
'archive',
'awaiting_payment',
'awaiting_verify_payment',
'unsuccessful_payment',
'payment_unverified',
'successful_payment'
)
CHARACTER SET utf8mb4 NULL DEFAULT NULL;



UPDATE jibres_XXXXXXX.factoraction SET factoraction.action = 'registered' WHERE factoraction.action = 'order';
UPDATE jibres_XXXXXXX.factoraction SET factoraction.action = 'successful_payment' WHERE factoraction.action = 'pay_successfull';
UPDATE jibres_XXXXXXX.factoraction SET factoraction.action = 'successful_payment' WHERE factoraction.action = 'pay_verified';
UPDATE jibres_XXXXXXX.factoraction SET factoraction.action = 'payment_unverified' WHERE factoraction.action = 'pay_unverified';
UPDATE jibres_XXXXXXX.factoraction SET factoraction.action = 'awaiting_payment' WHERE factoraction.action = 'pending_pay';
UPDATE jibres_XXXXXXX.factoraction SET factoraction.action = 'awaiting' WHERE factoraction.action = 'pending_verify';
UPDATE jibres_XXXXXXX.factoraction SET factoraction.action = 'preparing' WHERE factoraction.action = 'pending_prepare';
UPDATE jibres_XXXXXXX.factoraction SET factoraction.action = 'sending' WHERE factoraction.action = 'pending_send';
UPDATE jibres_XXXXXXX.factoraction SET factoraction.action = 'delivered' WHERE factoraction.action = 'deliver';
UPDATE jibres_XXXXXXX.factoraction SET factoraction.action = 'revert' WHERE factoraction.action = 'reject';



ALTER TABLE jibres_XXXXXXX.factoraction CHANGE `action` `action`
ENUM(
'tracking',
'comment',
'draft',
'registered',
'awaiting',
'confirmed',
'cancel',
'expire',
'preparing',
'sending',
'delivered',
'revert',
'sucsess',
'archive',
'deleted',
'spam',
'go_to_bank',
'pay_error',
'pay_cancel',
'awaiting_payment',
'awaiting_verify_payment',
'unsuccessful_payment',
'payment_unverified',
'successful_payment'
)
CHARACTER SET utf8mb4 NULL DEFAULT NULL;



UPDATE jibres_XXXXXXX.factoraction SET factoraction.category = 'comment' WHERE factoraction.action = 'comment';
UPDATE jibres_XXXXXXX.factoraction SET factoraction.category = 'tracking' WHERE factoraction.action = 'tracking';


UPDATE jibres_XXXXXXX.factoraction SET factoraction.category = 'status' WHERE factoraction.action IN ('draft','registered','awaiting','confirmed','cancel','expire','preparing','sending','delivered','revert','sucsess','archive','deleted','spam');
UPDATE jibres_XXXXXXX.factoraction SET factoraction.category = 'paystatus' WHERE factoraction.action IN ('go_to_bank','pay_error','pay_cancel','awaiting_payment','awaiting_verify_payment','unsuccessful_payment','payment_unverified','successful_payment');