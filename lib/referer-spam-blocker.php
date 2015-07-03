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

		if ( !$domains || !is_array( $domains ) )
		{
			$domains = self::$default_domains;
		}

		return $domains;
	}

	public function block_spam()
	{
		$domains = self::get_domains();

		if ( count( $domains ) == 0 ) 
			return;

		$referer_url = wp_get_referer();

// $referer_url = 'http://www.4webmasters.org/somepage-now/dfskjsdf.html';

		$referer_host = parse_url( $referer_url, PHP_URL_HOST );
		foreach ( $domains as $domain )
		{
			if ( false !== stripos( $referer_host, $domain ) )
			{
				header( 'HTTP/1.1 403 Forbidden' );
				include dirname( __FILE__ ) . '/../views/access-denied.php';
				die;
			}
		}
	}

}
Referer_Spam_Blocker::init();