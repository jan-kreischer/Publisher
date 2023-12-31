<?php class AuthenticationController extends Controller {
	public function getLogin() {
		return View::make('authentication.login');
	}
	
	public function postLogin() {
		$url = URL::to('login');
		$rules = [
				'email_address' => 'required|email',
				'password' => 'required',
				'remember_me' => 'boolean',
		];
		
		$validator = Validator::make(Input::only(array_keys($rules)), $rules);
		
		if($validator->passes())
		{
			$credentials = [
					'email_address' => Input::get('email_address'),
					'password' => Input::get('password'),
					/*'email_confirmed' => 1,*/
					/*'email_confirmation_code' => NULL,*/
			];
			$remember_me = boolval(Input::get('remember_me'));
			/*if(Auth::validate($credentials)) {*/
				//var_dump(User::where('email_address', '=', Input::get('email_address'))->user_id);
				if(Auth::attempt($credentials, $remember_me)) 
				{
					if(Auth::user()->email_is_confirmed()) {
						return Redirect::intended('/');
					}
					else {
						Auth::logout();
						return Redirect::back()->withInput()->withErrors(
								'your email needs to be confirmed at first!'
						);
					}
				}
			//}
			else 
			{
				return Redirect::back()->withInput()->withErrors(
					'password or email wrong!'
				);
			}
			
		}
		else 
		{
			return Redirect::back()->withErrors($validator);
		}
	}
	
	public function getRegister() {
		//if not authenticated
		//if(!Auth::check()) {
			return View::make('authentication.register');
		/*}
		else {
			Redirect::to('login');
		}*/
	}
	
	public function postRegister() {
		$registration_active = TRUE;
		if($registration_active === FALSE) {
			return Redirect::to('login')->with(['alert_error' => 'Sorry, Registration is currently disabled!']);
		}
		
		$rules = ['email_address' => Config::get('c.user.email_address.rules'),
					   'password' => 'required|min:4|max:32',
					   'first_name' => 'required|alpha|min:2|max:32',
					   'last_name'  => 'required|alpha|min:2|max:32',
					   'gender' => 'required|string|min:1|max:1',
				 ];
		
		$input = Input::only(array_keys($rules));
		
		$validator = Validator::make($input, $rules);
		
		if($validator->passes()){
			$user = new User;
			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->email_address = Input::get('email_address');
			$user->password = Hash::make(Input::get('password'));
			$email_confirmation_code = str_random(32);
			$user->email_confirmation_code = $email_confirmation_code;
			if(Input::get('gender') == 'm')
			{
				$user->user_gender = 'm';
			}
			else 
			{
				$user->user_gender = 'f';
			}
			$user->save();
			
			$options = [
				'email_confirmation_code' => $email_confirmation_code,
				'created_at' => $user->created_at->timestamp,
			];
			
			if($user) {
				Mail::send('emails.auth.confirmation', $options, function($message)
				{
					$message->from('info@publisr.com', 'publisr.com' );
					$message->to(Input::get('email_address'), (Input::get('first_name') . ' ' . Input::get('last_name')))->subject('Welcome to Publisr. Email Confirmation');
				});
			}
			
			//if everything else was done correctly 
			//we can than save the user to DB
			return Redirect::to('login')->with([
					'alert_success' => 'Thanks for registering! Check Your Email: ' . Input::get('email_address'),
			]);
		}
		
		else 
		{
			return Redirect::route('register')->withErrors($validator)->withInput();
		}
		
	}
	
	public function getLogout() {
		if(Auth::check()) {
			//clears out all of the current session data
			Session::flush();
			//processes logout
			Auth::logout();
		}
		return Redirect::to('/');
	}
	
	public function getConfirm()
	{
		//Methodic of this function
		//find user by email confirmation code
		//compare with email address hash
		//set email_confirmed field to true
		//set confirmation code to null
		//----------------
		$rules = [
			'ecc' => 'required|size:32',
		];
		//check if both required fields exist
		$validator = Validator::make(Input::only(array_keys($rules)), $rules);
		
		if($validator->passes()){
			//eah and ecc exist, so we can grab and store them
			//input variables need to be sanitazed
			$email_confirmation_code = $_GET['ecc'];
			
			//everything is setup for processing
			//input is sanitzed and 32 caracters long
			$query = User::where('email_confirmation_code', '=', $email_confirmation_code)
			->update([
					'email_confirmed' => 1,
					'email_confirmation_code' => NULL
			]);
			//Session::flash('message', 'This is a message!');
			return Redirect::to('login')->with('alert_success', 'Email Confirmed. Start Publishing with us!');
		}
		else {
			//absolute error
			//cant be right
			return Redirect::to('contact')->with('alert_info', 'Email Confirmed. Start Publishing with us!');
		}
	}
}