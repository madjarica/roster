<?php
class AdminAccountController extends BaseController {

    public function postLogin() {
        $validator = Validator::make(Input::all(), array(
            'email' => 'required|email',
            'password' => 'required'
        ));

        if ($validator->fails()) {
            return Redirect::route('login')
                ->withErrors($validator)
                ->withInput();
        } else {
            $email = trim(Input::get('email'));
            $password = trim(Input::get('password'));

            $auth = Auth::attempt(array(
                'email' => $email,
                'password' => $password,
                'active' => 1
            ), true);

            if ($auth) {
                return Redirect::intended('/');
            } else {
                return Redirect::route('login')
                    ->with('error', 'Email/password incorrect or your credit card was declined.');
            }
        }
    }

    public function getLogOut() {
        Auth::logout();
        return Redirect::route('home');
    }

    public function getAddUser() {
        return View::make('admin.users.add-user');
    }

    public function postAddUser() {
        $validator = Validator::make(Input::all(), [
            'user_type' => 'required|integer',
            'email' => 'required|email|max:255|unique:users,email',
            'first_name' => 'required|max:60',
            'last_name' => 'required|max:60',
            'image' => 'max:5120|mimes:jpg,jpeg,png,gif'
        ]);

        if($validator->fails()) {
            return Redirect::route('admin-add-user')
                ->withErrors($validator)
                ->withInput();
        } else {

            $user_type = Input::get('user_type');
            $email = Input::get('email');
            $first_name = Input::get('first_name');
            $last_name = Input::get('last_name');
            $password = str_random(8);

            $location = '';

            if (Input::file('image') != "") {
                $image = Input::file('image');
                $image->getRealPath();
                $destinationPath = 'public/img/avatars/';
                $file_name = md5(rand() + time()) . '.' . $image->getClientOriginalExtension();

                if ($_FILES['image']['error'] == 0) {
                    move_uploaded_file($_FILES['image']['tmp_name'], "{$destinationPath}{$file_name}");
                }

                $location = 'img/avatars/' . $file_name;
            }

            $user = User::create(array(
                'email' => $email,
                'password' => Hash::make($password),
                'first_name' => $first_name,
                'last_name' => $last_name,
                'active' => 1,
                'status' => 1,
                'group' => $user_type,
                'profile_image' => $location
            ));

            if($user_type == 1) {
                $user->roles()->attach(1);
            } elseif($user_type == 2) {
                $user->roles()->attach(2);
            } elseif($user_type == 3) {
                $user->roles()->attach(3);
            }

            if($user) {

                Mail::send('emails.admin.new-user', array(
                    'password' => $password,
                    'first_name' => $first_name
                ), function($m) use ($user) {
                    $m->to($user->email, $user->first_name)->subject('Created account');
                });

                return Redirect::route('admin-add-user')
                    ->with('success', 'New account has been created, and email has been sent to user.');
            } else {
                return Redirect::route('admin-add-user')
                    ->with('error', 'There was an error creating account. Please try again later');
            }

        }
    }

    public function getViewUsers() {
        $users = User::get();
        return View::make('admin.users.view-users')
            ->with('users', $users);
    }

    public function getViewUser($id = null) {
        if(!isset($id)) {
            return Redirect::route('admin-view-users');
        } else {
            $user = User::where('id', '=', $id)->first();
            return View::make('admin.users.view-user')
                ->with('user', $user);
        }
    }

    public function getChangePassword() {
        return View::make('admin.change-password');
    }

    public function postChangePassword() {
        $validator = Validator::make(Input::all(), array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            're-enter_new_password' => 'required|same:new_password'
        ));

        if($validator->fails()) {
            return Redirect::route('admin-change-password')
                ->withErrors($validator);
        } else {
            $user = User::find(Auth::user()->id);
            $old_password = trim(Input::get('old_password'));
            $password = trim(Input::get('new_password'));

            if(Hash::check($old_password, $user->getAuthPassword())) {
                $user->password = Hash::make($password);

                if($user->save()) {
                    return Redirect::route('admin-home')
                        ->with('success', 'Password has been changed');
                }
            }
        }
        return Redirect::route('admin-home')
            ->with('error', 'There was an error changing password. Please try again later.');
    }

    public function getChangeProfileImage() {
        return View::make('admin.change-avatar');
    }

    public function getForgotPassword() {
        return View::make('admin.forgot-password');
    }

    public function postForgotPassword() {
        $validator = Validator::make(Input::all(), array(
            'email_address' => 'required|email'
        ));

        if($validator->fails()) {
            return Redirect::route('forgot-password')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = User::where('email', '=', Input::get('email_address'));

            if($user->count()) {
                $user = $user->first();
                $code                   = str_random(60);
                $password               = str_random(8);
                $first_name             = 'User';
                $user->code             = $code;
                $user->password_temp    = Hash::make($password);

                if($user->save()) {
                    Mail::send('emails.auth.forgot', array(
                        'link' => URL::route('account-recover', $code),
                        'first_name' => $first_name,
                        'password' => $password
                    ), function($m) use ($user) {
                        $m->to($user->email, $user->first_name)->subject('New password');
                    });

                    return Redirect::route('login')
                        ->with('success', 'We have send you an email with new password. Before using it, you\'ll need to activate your new password. If you have not received a message in 5 minutes, please check your SPAM folder.');
                }
            }
        }
        return Redirect::route('forgot-password')
            ->with('error', 'There was an error. Please try again later.');
    }

    public function getRecover($code) {
        $user = User::where('code', '=', $code)
            ->where('password_temp', '!=', '');

        if($user->count()) {
            $user = $user->first();
            $user->password = $user->password_temp;
            $user->password_temp = '';
            $user->code = '';

            if($user->save()) {
                return Redirect::route('login')
                    ->with('success', 'Your account has been recovered, and you can log in with your new password.');
            }
        }
        return Redirect::route('home')
            ->with('error', 'Unable to retrieve your account right now. Please try again later.');
    }
}