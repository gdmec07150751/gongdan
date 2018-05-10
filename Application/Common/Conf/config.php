<?php
return array(
	'DEFAULT_MODULE'        =>  'Home',
    'DEFAULT_CONTROLLER'    =>  'Public',
    'DEFAULT_ACTION'        =>  'login',
	'LOAD_EXT_FILE' =>'common',
	'USER_AUTH_KEY'	=>'auth_id',
	'USER_AUTH_WAY'	=>'public/login',
	'LOAD_EXT_CONFIG'=>'db',
	'TMPL_ACTION_ERROR' => 'Static:jump',
    'TMPL_ACTION_SUCCESS' => 'Static:jump',
/*    'URL_CASE_INSENSITIVE' => true, // 默认false 表示URL区分大小写 true则表示不区分大小写
'URL_MODEL' => 2, // URL模式*/

);