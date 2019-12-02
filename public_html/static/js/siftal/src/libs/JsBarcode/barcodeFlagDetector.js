var barcode_country = function (_code)
{
  code = parseInt(_code.substr(0, 3), 10);
  if(_code.length === 16 && code <= 19)
  {
    return 'IR';
  }
  if ((0 <= code && code <= 19)) {
    // return 'US,CA';
    return 'US';
  } /*else if ((20 <= code && code <= 29)) {
    return 'Restricted distribution (MO defined)';
  }*/ else if ((30 <= code && code <= 39)) {
    return 'US';
  } /*else if ((40 <= code && code <= 49)) {
    return 'Restricted distribution (MO defined)';
  } else if ((50 <= code && code <= 59)) {
    return 'Coupons';
  }*/ else if ((60 <= code && code <= 99)) {
    // return 'US,CA';
    return 'US';
  } else if ((100 <= code && code <= 139)) {
    return 'US';
  } /*else if ((200 <= code && code <= 299)) {
    return 'Restricted distribution (MO defined)';
  }*/ else if ((300 <= code && code <= 379)) {
    // return 'FR,MC';
    return 'FR';
  } else if (code === 380) {
    return 'BG';
  } else if (code === 383) {
    return 'SI';
  } else if (code === 385) {
    return 'HR';
  } else if (code === 387) {
    return 'BA';
  } else if (code === 389) {
    return 'ME';
  } else if ((400 <= code && code <= 440)) {
    return 'DE';
  } else if ((450 <= code && code <= 459)) {
    return 'JP';
  } else if ((460 <= code && code <= 469)) {
    return 'RU';
  } else if (code === 470) {
    return 'KG';
  } else if (code === 471) {
    return 'TW';
  } else if (code === 474) {
    return 'EE';
  } else if (code === 475) {
    return 'LV';
  } else if (code === 476) {
    return 'AZ';
  } else if (code === 477) {
    return 'LT';
  } else if (code === 478) {
    return 'UZ';
  } else if (code === 479) {
    return 'LK';
  } else if (code === 480) {
    return 'PH';
  } else if (code === 481) {
    return 'BY';
  } else if (code === 482) {
    return 'UA';
  } else if (code === 484) {
    return 'MD';
  } else if (code === 485) {
    return 'AM';
  } else if (code === 486) {
    return 'GE';
  } else if (code === 487) {
    return 'KZ';
  } else if (code === 488) {
    return 'TJ';
  } else if (code === 489) {
    return 'HK';
  } else if ((490 <= code && code <= 499)) {
    return 'JP';
  } else if ((500 <= code && code <= 509)) {
    return 'GB';
  } else if ((520 <= code && code <= 521)) {
    return 'GR';
  } else if (code === 528) {
    return 'LB';
  } else if (code === 529) {
    return 'CY';
  } else if (code === 530) {
    return 'AL';
  } else if (code === 531) {
    return 'MK';
  } else if (code === 535) {
    return 'MT';
  } else if (code === 539) {
    return 'IE';
  } else if ((540 <= code && code <= 549)) {
    // return 'BE,LU';
    return 'BE';
  } else if (code === 560) {
    return 'PT';
  } else if (code === 569) {
    return 'IS';
  } else if ((570 <= code && code <= 579)) {
    // return 'DK,FO,GL';
    return 'DK';
  } else if (code === 590) {
    return 'PL';
  } else if (code === 594) {
    return 'RO';
  } else if (code === 599) {
    return 'HU';
  } else if ((600 <= code && code <= 601)) {
    return 'ZA';
  } else if (code === 603) {
    return 'GH';
  } else if (code === 604) {
    return 'SN';
  } else if (code === 608) {
    return 'BH';
  } else if (code === 609) {
    return 'MU';
  } else if (code === 611) {
    return 'MA';
  } else if (code === 613) {
    return 'DZ';
  } else if (code === 615) {
    return 'NG';
  } else if (code === 616) {
    return 'KE';
  } else if (code === 618) {
    return 'CI';
  } else if (code === 619) {
    return 'TN';
  } else if (code === 621) {
    return 'SY';
  } else if (code === 622) {
    return 'EG';
  } else if (code === 624) {
    return 'LY';
  } else if (code === 625) {
    return 'JO';
  } else if (code === 626 || code === 216) {
    return 'IR';
  } else if (code === 627) {
    return 'KW';
  } else if (code === 628) {
    return 'SA';
  } else if (code === 629) {
    return 'AE';
  } else if ((640 <= code && code <= 649)) {
    return 'FI';
  } else if ((690 <= code && code <= 695)) {
    return 'CN';
  } else if ((700 <= code && code <= 709)) {
    return 'NO';
  } else if (code === 729) {
    return 'IL';
  } else if ((730 <= code && code <= 739)) {
    return 'SE';
  } else if (code === 740) {
    return 'GT';
  } else if (code === 741) {
    return 'SV';
  } else if (code === 742) {
    return 'HN';
  } else if (code === 743) {
    return 'NI';
  } else if (code === 744) {
    return 'CR';
  } else if (code === 745) {
    return 'PA';
  } else if (code === 746) {
    return 'DO';
  } else if (code === 750) {
    return 'MX';
  } else if ((754 <= code && code <= 755)) {
    return 'CA';
  } else if (code === 759) {
    return 'VE';
  } else if ((760 <= code && code <= 769)) {
    // return 'CH,LI';
    return 'CH';
  } else if ((770 <= code && code <= 771)) {
    return 'CO';
  } else if (code === 773) {
    return 'UY';
  } else if (code === 775) {
    return 'PE';
  } else if (code === 777) {
    return 'BO';
  } else if (code === 779) {
    return 'AR';
  } else if (code === 780) {
    return 'CL';
  } else if (code === 784) {
    return 'PY';
  } else if (code === 785) {
    return 'PE';
  } else if (code === 786) {
    return 'EC';
  } else if ((789 <= code && code <= 790)) {
    return 'BR';
  } else if ((800 <= code && code <= 839)) {
    // return 'IT,SM,VA';
    return 'IT';
  } else if ((840 <= code && code <= 849)) {
    // return 'ES,AD';
    return 'ES';
  } else if (code === 850) {
    return 'CU';
  } else if (code === 858) {
    return 'SK';
  } else if (code === 859) {
    return 'CZ';
  } else if (code === 860) {
    return 'RS';
  } else if (code === 865) {
    return 'MN';
  } else if (code === 867) {
    return 'KP';
  } else if ((868 <= code && code <= 869)) {
    return 'TR';
  } else if ((870 <= code && code <= 879)) {
    return 'AN';
  } else if (code === 880) {
    return 'KR';
  } else if (code === 884) {
    return 'KH';
  } else if (code === 885) {
    return 'TH';
  } else if (code === 888) {
    return 'SG';
  } else if (code === 890) {
    return 'IN';
  } else if (code === 893) {
    return 'VN';
  } else if (code === 896) {
    return 'PK';
  } else if (code === 899) {
    return 'ID';
  } else if ((900 <= code && code <= 919)) {
    return 'AT';
  } else if ((930 <= code && code <= 939)) {
    return 'AU';
  } else if ((940 <= code && code <= 949)) {
    return 'NZ';
  } /*else if (code === 950) {
    return 'GS1 Global Office: Special applications';
  } else if (code === 951) {
    return 'EPCglobal: Special applications';
  }*/ else if (code === 955) {
    return 'MY';
  } else if (code === 958) {
    return 'MO';
  } /*else if ((960 <= code && code <= 969)) {
    return 'GS1 Global Office: GTIN-8 allocations';
  } else if (code === 977) {
    return 'Serial publications (ISSN)';
  } else if ((978 <= code && code <= 979)) {
    return 'Bookland (ISBN) - 979-0 used for sheet music';
  } else if (code === 980) {
    return 'Refund receipts';
  } else if ((981 <= code && code <= 983)) {
    return 'Common Currency Coupons';
  } else if ((990 <= code && code <= 999)) {
    return 'Coupons';
  }*/ else {
    return '';
  }
};
