<?php
class Referer_Spam_Blocker
{
	public static $instance;

	public static $default_domains = array(
		'priceg' => 'Default entry',
		'darodar' => 'Default entry',
		'hulfingtonpost' => 'Default entry',
		'ilovevitaly' => 'Default entry',
		'buy-cheap-online' => 'Default entry',
		'free-share-buttons' => 'Default entry',
		'4webmasters' => 'Default entry',
		'theguardlan' => 'Default entry',
		'semalt' => 'Default entry',
		'buttons-for-website' => 'Default entry',
		'see-your-website-here' => 'Default entry',
		'googlsucks' => 'Default entry',
		'guardlink' => 'Default entry',
		'Get-Free-Traffic-Now' => 'Default entry',
		'event-tracking' => 'Default entry',
		'free-share-buttons' => 'Default entry',
		'free-social-buttons' => 'Default entry',
		'simple-share-buttons' => 'Default entry'
	);

	public static function init()
	{
		null === self::$instance && self::$instance = new self();
		return self::$instance;
	}

	private function __construct()
	{
		add_action( 'init', array( $this, 'block_spam' ) );
	}

	public static function get_domains()
	{
		$domains = get_option( 'rsb_domain_list' );

		if ( !is_array( $domains ) && false === $domains )
		{
			$domains = self::$default_domains;
			update_option( 'rsb_domain_list', $domains );
		}
		ksort( $domains );
		return apply_filters( 'referer_spam_blocker_domains', $domains );
	}

	public static function add_domain( $domain, $notes = '' )
	{
		$domains = self::get_domains();
		$domains[ $domain ] = $notes;
		update_option( 'rsb_domain_list', $domains );
		return $domains;
	}

	public static function remove_domain( $key )
	{
		$domains = self::get_domains();

		if ( isset( $domains[ $key ] ) )
		{
			unset( $domains[ $key ] );
		}
		
		if ( !is_array( $domains ) )
		{
			$domains = array();
		}

		update_option( 'rsb_domain_list', $domains );
	}

	public function block_spam()
	{
		$domains = self::get_domains();

		if ( count( $domains ) == 0 ) 
			return;

		$referer_url = wp_get_referer();

		/**
		 * For debugging purposes.
		**/
		if ( isset( $_GET['rsb-preview'] ) )
		{
			$referer_url = 'http://www.4webmasters.org/';
		}

		$referer_host = parse_url( $referer_url, PHP_URL_HOST );

		foreach ( array_keys( $domains ) as $domain )
		{
			if ( false !== stripos( $referer_host, $domain ) )
			{
				$status = apply_filters( 'referer_spam_blocker_status_header', 'HTTP/1.1 403 Forbidden' );
				header( $status );

				$template = dirname( __FILE__ ) . '/../views/access-denied.php';
				$template = apply_filters( 'referer_spam_blocker_template', $template );
				include $template;
				die;
			}
		}
	}

}
Referer_Spam_Blocker::init();