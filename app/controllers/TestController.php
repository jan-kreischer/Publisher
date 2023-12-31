<?php 
class TestController extends BaseController {
	public function postTest3 () {
		$name = 'userimage';
		$allowed_size = 2000000; //in bytes
		$allowed_extensions = ['jpg', 'jpeg', 'png'];
		$response_data = [];
		
		if(Auth::check()) {
			$user_id = Auth::user()->user_id;
			
			if(Input::hasFile($name)) {
				
				$userimage = Input::file($name);
				$userimage_name = str_random(22) . time();
				$userimage_size = intval($userimage->getSize());
				$userimage_extension = $userimage->getClientOriginalExtension();
				$userimage_path = Config::get('conf.img.user');
				
				if($userimage_size < $allowed_size) {
					if(in_array($userimage_extension, $allowed_extensions)) {
						try {
							$upload_success = $userimage->move($userimage_path, $userimage_name . '.' . $userimage_extension);
							if($upload_success) {
								$userimage = new Userimage();
								$userimage->user_id = $user_id;
								$userimage->userimage_name = $userimage_name;
								$userimage->userimage_extension = $userimage_extension;
								$userimage->userimage_size = $userimage_size;
								$userimage->userimage_width = 1;
								$userimage->userimage_height = 1;
								$userimage->userimage_description = 'fuck';
								$userimage->save();
								
								$response_data['userimage'] = $userimage_path . '/' .
															  $userimage_name . '.' .
															  $userimage_extension;
								//Exit Point on Success
								$response_data['success'] = TRUE;
								return Response::json($response_data);
							} 
							else {
								$response_data['error'] = 'invalid upload';
								$response_data['message'] = 'invalid upload';
							}
						}
						catch(Exception $e) {
							$response_data['message'] = $e->getMessage();
						}
					}
					else {
						$response_data['message'] = 'invalid extension';
					}
				}
				else {
					$response_data['message'] = 'invalid size';
				}
			}
			else {
				$response_data['message'] = 'invalid file';
			}
		}
		else {
			$response_data['message'] = 'invalid permissions';
		}
		
		//Exit Point on Failure
		$response_data['success'] = FALSE;
		return Response::json($response_data);
		
	}
}