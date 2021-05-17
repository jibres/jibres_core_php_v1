UPDATE jibres_XXXXXXX.productcategory SET productcategory.parent1 = NULL, productcategory.parent2 = NULL, productcategory.parent3 = NULL, productcategory.parent4 = NULL WHERE 1;
UPDATE jibres_XXXXXXX.productcategory SET productcategory.firstlevel = 1 WHERE productcategory.showonwebsite = 1;
