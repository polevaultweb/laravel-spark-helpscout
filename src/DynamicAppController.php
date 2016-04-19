<?php
namespace Polevaultweb\Laravel\Spark\HelpScout;

use App\Http\Controllers\Controller;
use HelpScoutApp\DynamicApp;

class DynamicAppController extends Controller {

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