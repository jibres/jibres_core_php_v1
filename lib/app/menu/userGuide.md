# user guide for save site setting in database

> all record in database for website setting saved by  platform = 'website'.


## Menu

* platform = website
* cat      = menu
* key      = menu_1, menu_2, menu_3  _Get count from database and save in next menu_
* value
```
{
	"title" : "my menu title",
	"list":
	[
		{
			"title" : "my link title",
			"url" : "my url",
			"target" : 1
		},
		{
			"title" : "my link title",
			"url" : "my url",
			"target" : null
		}
	]
}
```



## Header


* platform = website
* cat      = header
* key      = header1, header_special, header_dark, ... _Unique slug get from jibres header list_
* value
```
{
	"header_menu_1" : "menu_1",  _// This key get from header1 setting and in this position just fill by menu key_
}
```

### Save active user header
> This record means the user use from this header

* platform = website
* cat      = header
* key      = active
* value    = header1




## Footer

* platform = website
* cat      = footer
* key      = footer1, footer_special, footer_dark, ... _Unique slug get from jibres footer list_
* value
```
{
	"footer_menu_1" : "menu_2",  _// This key get from footer1 setting and in this position just fill by menu key_
	"footer_menu_2" : "menu_2",
	"footer_text" : "footer_text_1",
}
```


