<?php
namespace Polevaultweb\LaravelSparkHelpScout;

use App\Http\Controllers\Controller;
use HelpScoutApp\DynamicApp;

class HelpScoutController extends Controller {

	public function index( $secret ) {
		// Check secret against env config
		if ( $secret !== env( 'HELPSCOUT_APP_ENDPOINT_SECRET' ) ) {
			return;
		}

	}

	protected function _exit( $message ) {
		header( 'Content-Type: application/json' );
		echo json_encode( array( 'html' => $message ) );
		exit;
	}

}