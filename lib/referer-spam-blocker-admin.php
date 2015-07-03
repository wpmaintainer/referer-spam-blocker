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
		add_action( 'admin_init', array( $this, 'admin_init' ) );
	}

	public function admin_init()
	{
		/**
		  *	 Reset to default.
		 **/
		if ( isset( $_GET['rsb-update'] ) )
		{
			$domains = Referer_Spam_Blocker::get_domains();
			
			if ( count( $domains ) > 0 ) 
				return;

			delete_option( 'rsb_domain_list' );

			$domains = Referer_Spam_Blocker::get_domains();

			wp_redirect( self::get_admin_url() );
			die;
		}

		/**
		 * Check for add domain
		 **/
		if ( isset( $_POST['rsb'] ) && isset( $_POST['rsb-nonce'] ) && wp_verify_nonce( $_POST['rsb-nonce'], 'rsb-add' ) && current_user_can( 'edit_users' ) )
		{
			if ( !isset( $_POST['rsb']['domain'] ) ) 
			{
				return;
			}
			else
			{
				$domain = stripslashes( $_POST['rsb']['domain'] );
			}

			$notes = '';

			if ( isset( $_POST['rsb'] ))
			{
				$notes = stripslashes( $_POST['rsb']['note'] );
			}

			$domains = Referer_Spam_Blocker::get_domains();
			if ( isset( $domains[ $domain ] ) )
			{
				wp_redirect( self::get_admin_url( array( 'exists' => $domain ) ) );
				die;
			}

			if ( false !== stripos( site_url(), $domain ) )
			{
				wp_redirect( self::get_admin_url( array( 'site-match' => $domain ) ) );
				die;
			}


			Referer_Spam_Blocker::add_domain( $domain, $notes );
			wp_redirect( self::get_admin_url( array( 'added' => $domain ) ) );
			die;
		}

		/**
		 * Check for single delete
		 **/
		if ( isset( $_GET['rsb-delete'] ) && $_GET['rsb-delete'] && current_user_can( 'edit_users' ) )
		{
			Referer_Spam_Blocker::remove_domain( $_GET['rsb-delete'] );
			wp_redirect( self::get_admin_url( array( 'deleted' => 1 ) ) );
			die;
		}

		/**
		 * Delete multiple items
		 **/
		if ( isset( $_POST['rsb-nonce'] ) && wp_verify_nonce( $_POST['rsb-nonce'], 'rsb-delete' ) )
		{
			if ( !isset( $_POST['rsb-delete'] ) || !is_array( $_POST['rsb-delete'] ) )
				return;

			foreach ( $_POST['rsb-delete'] as $domain )
			{
				Referer_Spam_Blocker::remove_domain( $domain );
			}
			wp_redirect( self::get_admin_url( array( 'deleted' => 1 ) ) );
			die;
		}
	}

	public function admin_menu()
	{
		add_submenu_page( 'options-general.php', 'Referer Spam Blocker', 'Referer Spam Blocker', 'edit_users', self::get_admin_slug(), array( $this, 'main' ) );
	}

	public function main()
	{
		if ( isset( $_GET['site-match'] ) )
		{
			$error = 'Sorry, but "' . $_GET['site-match'] . '" will match your site\'s domain. Please choose a more specific keyword.';
		}
		if ( isset( $_GET['deleted'] ) )
		{
			$message = 'The selected domain keyword(s) have been deleted.';
		}
		if ( isset( $_GET['exists'] ) )
		{
			$error = 'The domain keyword "' . $_GET['exists'] . '" already exists!';
		}
		if ( isset( $_GET['added'] ) )
		{
			$message = 'The domain keyword "' . esc_html( $_GET['added'] ) . '" has been added to the list of blocked referers.';
		}
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
