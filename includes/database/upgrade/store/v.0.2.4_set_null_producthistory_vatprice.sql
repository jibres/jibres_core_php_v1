UPDATE jibres_XXXXXXX.productprices SET jibres_XXXXXXX.productprices.vatprice = NULL, jibres_XXXXXXX.productprices.datemodified = jibres_XXXXXXX.productprices.datemodified  WHERE 1;
UPDATE jibres_XXXXXXX.productprices SET jibres_XXXXXXX.productprices.finalprice = (jibres_XXXXXXX.productprices.price - jibres_XXXXXXX.productprices.discount), jibres_XXXXXXX.productprices.datemodified = jibres_XXXXXXX.productprices.datemodified WHERE 1;