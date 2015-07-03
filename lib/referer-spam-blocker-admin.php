<?php
class Referer_Spam_Blocker_Admin
{
	public static $instance;

	public static function init()
	{
		null === self::$instance && self::$instance = new self();
		return self::$instance;
	}

	private function __construct()
	{
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	public function admin_menu()
	{
		add_submenu_page( 'options-general.php', 'Referer Spam Blocker', 'Referer Spam Blocker', 'edit_users', self::get_admin_slug(), array( $this, 'main' ) );
	}

	public function main()
	{
		include dirname( __FILE__ ) . '/../views/admin.php';
	}

	public static function get_admin_slug()
	{
		return 'wpm-rsb';
	}

	public static function get_admin_url( $params = false )
	{
		$url = 'options-general.php?';
		
		if ( !$params ) 
		{
			$params = array();
		}
		
		$params['page'] = self::get_admin_slug();

		return admin_url( $url . http_build_query( $params ) );
	}
}
Referer_Spam_Blocker_Admin::init();
