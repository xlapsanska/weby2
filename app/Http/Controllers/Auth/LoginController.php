<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

	public function username()
	{
		return config('ldap_auth.identifiers.eloquent');
	}

	protected function validateLogin(Request $request)
	{
		$this->validate($request, [
			$this->username() => 'required|string|regex:/^\w+$/',
			'password' => 'required|string',
		]);
	}

	protected function attemptLogin(Request $request)
	{

		$credentials = $request->only($this->username(), 'password');
		$username = $credentials[$this->username()];
		$password = $credentials['password'];

		$student = \App\Student::where("email","like", $username.'%')->first();

		if(($student != null) and (Hash::check($password, $student->password))) {

			$user = \App\User::where($this->username(), $username)->first();
			if (!$user) {

				$user = new \App\User();
				$user->username = $username;
				$user->ais_id = "00000";
				$user->password = '';
				$user->isAdmin = 0;

				$sync_attrs = $this->retrieveSyncAttributes($username);
				foreach ($sync_attrs as $field => $value) {
					$user->$field = $value !== null ? $value : '';
				}
			}

			$this->guard()->login($user, true);
			return true;
		}

		$user_format = env('LDAP_USER_FORMAT', 'cn=%s,'.env('LDAP_BASE_DN', ''));

		$userdn = sprintf($user_format, $username);

		$dn  = 'ou=People, dc=stuba, dc=sk';
		$ldaprdn  = "uid=$username, $dn";

		$ldapconn = ldap_connect("ldap.stuba.sk")
		or die("Could not connect to LDAP server.");

		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

		$bind = @ldap_bind($ldapconn, $ldaprdn, $password);
		if($bind) {
			$filter="(uid=$username)";
			$result = ldap_search($ldapconn,"dc=stuba,dc=sk",$filter);
			$entry = ldap_first_entry($ldapconn, $result);
			$usrId = ldap_get_values($ldapconn, $entry, "uisid")[0];
		}
		else
			$usrId = "00000";

		$user = \App\User::where("username", "admin")->first();
		if(($username == "admin") and Hash::check($password, $user->password)) {
			$this->guard()->login($user, true);
			return true;
		}

		if(Adldap::auth()->attempt($userdn, $password, $bindAsUser = true)) {
			// the user exists in the LDAP server, with the provided password

			$user = \App\User::where($this->username(), $username)->first();
			if (!$user) {
				// the user doesn't exist in the local database, so we have to create one

				$user = new \App\User();
				$user->username = $username;
				$user->ais_id = $usrId;
				$user->password = '';
				$user->isAdmin = 0;

				$sync_attrs = $this->retrieveSyncAttributes($username);
				foreach ($sync_attrs as $field => $value) {
					$user->$field = $value !== null ? $value : '';
				}
			}

			else {
				$user = \App\User::where($this->username(), $username)->first();
				if($user->ais_id == "00000") {
					$user_up = \App\User::find($user->id);
					$user_up->ais_id = $usrId;
					$user_up->save();
				}
			}

			$this->guard()->login($user, true);
			return true;
		}

		return false;
	}

	protected function retrieveSyncAttributes($username)
	{
		$ldapuser = Adldap::search()->where(env('LDAP_USER_ATTRIBUTE'), '=', $username)->first();
		if ( !$ldapuser ) {
			// log error
			return false;
		}
		$ldapuser_attrs = null;

		$attrs = [];

		foreach (config('ldap_auth.sync_attributes') as $local_attr => $ldap_attr) {
			if ( $local_attr == 'username' ) {
				continue;
			}

			$method = 'get' . $ldap_attr;
			if (method_exists($ldapuser, $method)) {
				$attrs[$local_attr] = $ldapuser->$method();
				continue;
			}

			if ($ldapuser_attrs === null) {
				$ldapuser_attrs = self::accessProtected($ldapuser, 'attributes');
			}

			if (!isset($ldapuser_attrs[$ldap_attr])) {
				// an exception could be thrown
				$attrs[$local_attr] = null;
				continue;
			}

			if (!is_array($ldapuser_attrs[$ldap_attr])) {
				$attrs[$local_attr] = $ldapuser_attrs[$ldap_attr];
			}

			if (count($ldapuser_attrs[$ldap_attr]) == 0) {
				// an exception could be thrown
				$attrs[$local_attr] = null;
				continue;
			}

			// now it returns the first item, but it could return
			// a comma-separated string or any other thing that suits you better
			$attrs[$local_attr] = $ldapuser_attrs[$ldap_attr][0];
			//$attrs[$local_attr] = implode(',', $ldapuser_attrs[$ldap_attr]);
		}

		return $attrs;
	}

	protected static function accessProtected ($obj, $prop)
	{
		$reflection = new \ReflectionClass($obj);
		$property = $reflection->getProperty($prop);
		$property->setAccessible(true);
		return $property->getValue($obj);
	}
}
