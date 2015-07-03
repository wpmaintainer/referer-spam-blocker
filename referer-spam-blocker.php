<?php
/*
Plugin Name: Referer Spam Blocker
Description: Blocks most common HTTP referer spam domains and allows you to easily add custom domains.
Author: WP Maintainer
Author URI: http://wpmaintainer.com
Version: 0.1
License: GPLv2 or later
*/
foreach ( glob( dirname( __FILE__ ) . '/lib/*.php' ) as $file )
{
	include $file;
}