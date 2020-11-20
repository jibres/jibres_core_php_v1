
ALTER TABLE jibres_XXXXXXX.factors CHANGE `status` `status`
ENUM(
'enable',
'disable',
'draft',
'order',
'expire',
'cancel',
'pending_pay',
'pending_verify',
'pending_prepare',
'pending_send',
'sending',
'deliver',
'reject',
'spam',
'deleted',
'registered',
'awaiting',
'confirmed',
'preparing',
'delivered',
'revert',
'success',
'archive'
) CHARACTER SET utf8mb4 NULL DEFAULT NULL;



ALTER TABLE jibres_XXXXXXX.factors ADD `paystatus`
ENUM(
'awaiting_payment',
'awaiting_verify_payment',
'unsuccessful_payment',
'payment_unverified',
'successful_payment'
)
CHARACTER SET utf8mb4 NULL DEFAULT NULL;


UPDATE jibres_XXXXXXX.factors SET factors.status = 'registered' WHERE factors.status = 'enable';
UPDATE jibres_XXXXXXX.factors SET factors.status = 'cancel' WHERE factors.status = 'disable';
UPDATE jibres_XXXXXXX.factors SET factors.status = 'registered' WHERE factors.status = 'order';
UPDATE jibres_XXXXXXX.factors SET factors.status = 'awaiting' WHERE factors.status = 'pending_verify';
UPDATE jibres_XXXXXXX.factors SET factors.status = 'preparing' WHERE factors.status = 'pending_prepare';
UPDATE jibres_XXXXXXX.factors SET factors.status = 'sending' WHERE factors.status = 'pending_send';
UPDATE jibres_XXXXXXX.factors SET factors.status = 'delivered' WHERE factors.status = 'deliver';
UPDATE jibres_XXXXXXX.factors SET factors.status = 'revert' WHERE factors.status = 'reject';

UPDATE jibres_XXXXXXX.factors SET factors.status = 'registered', factors.paystatus = 'awaiting_payment' WHERE factors.status = 'pending_pay';


ALTER TABLE jibres_XXXXXXX.factors CHANGE `status` `status`
ENUM(
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
'success',
'archive',
'deleted',
'spam'
)
CHARACTER SET utf8mb4 NULL DEFAULT NULL;
