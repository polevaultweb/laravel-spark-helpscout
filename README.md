## Help Scout Dynamic App support for Laravel Spark

### Installation

To get this up an running, you'll need to configure a few things in your Laravel Spark project and Help Scout.

#### Laravel 

- Run `composer require polevaultweb/laravel-spark-helpscout`
- Add `Polevaultweb\Laravel\Spark\HelpScout\DynamicAppServiceProvider::class,` to your `providers` array in `config/app.php`

Add some environment variables to you `.env` file:

- `HELPSCOUT_APP_TOKEN` - This is the random string used when creating the app on Help Scout
- `HELPSCOUT_APP_ENDPOINT_SECRET` - This is the secret used in the endpoint callback that Help Scout will access, eg. yourapp.com/helpscout/{secret}

Optional variables:

- `HELSPCOUT_APP_VALIDATE_USER_EXISTS_ONLY` - If defined this will just verify the user exists, regardless of Spark plan or plan status.

#### Help Scout

1. Visit the Help Scout [custom app dashboard](https://secure.helpscout.net/apps/custom/)
1. Create an app with the following settings:

| Setting     	| Value						                               	        |
|--------------	|-----------------------------------------------------------------  |
| App Name     	| Your App Name                             	                    |
| Content Type 	| Dynamic Content                                       	        |
| Callback URL 	| https://your-site.com/helpscout/HELPSCOUT_APP_ENDPOINT_SECRET 	|
| Secret Key   	| HELPSCOUT_APP_TOKEN 	                                            |