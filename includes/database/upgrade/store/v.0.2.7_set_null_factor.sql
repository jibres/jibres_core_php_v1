UPDATE jibres_XXXXXXX.factors SET jibres_XXXXXXX.factors.subvat = NULL WHERE 1;

UPDATE jibres_XXXXXXX.factors SET jibres_XXXXXXX.factors.subtotal = (jibres_XXXXXXX.factors.subprice - jibres_XXXXXXX.factors.subdiscount) WHERE 1;

UPDATE jibres_XXXXXXX.factors SET jibres_XXXXXXX.factors.total = (jibres_XXXXXXX.factors.subtotal) WHERE 1;