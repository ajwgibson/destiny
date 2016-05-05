<?php 

namespace Admin;

use View;
use Redirect;
use User;
use Input;
use Hash;
use Validator;

class UserController extends AdminBaseController {

    protected $title = 'System users';


    public function index()
    {
        $users = User::orderBy('username', 'ASC')->get();

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'show all users');

        $this->layout->content =
            View::make('admin/users/index')
                ->with('users', $users);
    }


    public function editPassword($id)
    {
        $user = User::findOrFail($id);

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'change password for "' . $user->username . '"');

        $this->layout->content = 
            View::make('admin/users/password')
                ->with('user', $user);
    }


    public function updatePassword($id)
    {
        $input = Input::all();

        $validator = Validator::make(
            $input, 
            array('password' => 'required|confirmed|min:6'));

        if (!$validator->passes())
        {
            return 
                Redirect::route('admin.user.editPassword', $id)
                    ->withErrors($validator);
        }

        $user = User::findOrFail($id);
        $user->password = Hash::make(Input::get('password'));
        $user->save();

        return Redirect::route('admin.user.index', $id);
    }

}