<?php
/*
Plugin Name: Referer Spam Blocker
Description: Blocks most common HTTP referer spam domains and allows you to easily add custom domains.
Author: WP Maintainer
Author URI: http://wpmaintainer.com
*/
foreach ( glob( dirname( __FILE__ ) . '/lib/*.php' ) as $file )
{
	include $file;
}