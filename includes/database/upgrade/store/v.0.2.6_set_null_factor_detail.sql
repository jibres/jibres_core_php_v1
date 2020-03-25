UPDATE jibres_XXXXXXX.factordetails SET jibres_XXXXXXX.factordetails.vat = NULL WHERE 1;

UPDATE jibres_XXXXXXX.factordetails SET jibres_XXXXXXX.factordetails.finalprice = (jibres_XXXXXXX.factordetails.price - jibres_XXXXXXX.factordetails.discount) WHERE 1;

UPDATE jibres_XXXXXXX.factordetails SET jibres_XXXXXXX.factordetails.sum = (jibres_XXXXXXX.factordetails.finalprice * jibres_XXXXXXX.factordetails.count) WHERE 1;