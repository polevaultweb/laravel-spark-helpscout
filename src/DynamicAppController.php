<?php
namespace Polevaultweb\Laravel\Spark\HelpScout;

use App\Http\Controllers\Controller;
use HelpScoutApp\DynamicApp;
use Laravel\Spark\User;

class DynamicAppController extends Controller
{

    public function index($secret)
    {
        if ($secret !== env('HELPSCOUT_APP_ENDPOINT_SECRET')) {
            return;
        }

        $app_token = env('HELPSCOUT_APP_TOKEN');
        $helpscout = new DynamicApp($app_token);

        if ( ! $helpscout->isSignatureValid()) {
            $this->_exit('Unable to verify signature');
        }

        $customer = $helpscout->getCustomer();
        $email    = $customer->getEmail();

        $user = User::where('email', $email)->first();

        if (is_null($user)) {
            $this->_exit('<span class="badge error">User not found</span>');
        }

        if (env('HELSPCOUT_APP_VALIDATE_BILLING')) {
            $plan = $user->sparkPlan();
            $html = '<ul class="unstyled">';
            $html .= '<li><strong>' . $user->name . '</strong></li>';
            $html .= '<li>' . $plan->name . '</li>';
            $html .= '<li><span class="badge ' . ($plan->active ? 'success' : 'error') . '">' . ($plan->active ? 'ACTIVE' : 'INACTIVE') . '</span></li>';
            $html .= '</ul>';
            $this->_exit($html);
        } else {
            $this->_exit('<span class="badge success">User verified</span>');
        }
    }

    protected function _exit($message)
    {
        header('Content-Type: application/json');
        echo json_encode(array('html' => $message));
        exit;
    }

}