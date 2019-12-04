
function getElNumber(_el)
{
  var myNum = _el.val();
  // strip number
  if(!myNum)
  {
    return 0;
  }
  myNum = myNum.split(",").join("");
  myNum = myNum.split(" ").join("");
  myNum = myNum.split("-").join("");
  // trim
  myNum = myNum.trim();
  // change to en
  myNum = myNum.toEnglish();
  // parse int
  myNum = parseFloat(myNum);
  // return zero for NaN
  if (isNaN(myNum))
  {
    return 0;
  }
  return myNum;
}