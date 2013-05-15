<?php
if ('bae'==$_SERVER['USER']) {
	return array_merge(include_once 'config_bae.php', include_once 'common.php');
}else {
	return array_merge(include_once 'config_local.php', include_once 'common.php');
}
