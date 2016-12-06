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
            $this->_exit('<span class="badge error">NOT FOUND</span>');
        }

        if (env('HELSPCOUT_APP_VALIDATE_USER_EXISTS_ONLY')) {
            $html = '<span class="badge success">ACTIVE</span>';
            $html = $this->html($user, $html);
            $this->_exit($html);
        }

        $plan = $user->sparkPlan();
        $html = '';
        if ($plan) {
            $html .= '<li>' . $plan->name . '</li>';
            $html .= '<li><span class="badge ' . ($plan->active ? 'success' : 'error') . '">' . ($plan->active ? 'ACTIVE' : 'INACTIVE') . '</span></li>';
        }
        $html = $this->html($user, $html);
        $this->_exit($html);
    }

    /**
     * @param User $user
     * @param string $content
     *
     * @return string
     */
    protected function html($user, $content)
    {
        $html = '<ul class="unstyled">';
        $html .= '<li><a href="' . url('/spark/kiosk#/users/' . $user->id) . '">' . $user->name . '</a></li>';
        $html .= $content;
        $html .= '</ul>';

        return $html;
    }

    protected function _exit($message)
    {
        header('Content-Type: application/json');
        echo json_encode(array('html' => $message));
        exit;
    }

}