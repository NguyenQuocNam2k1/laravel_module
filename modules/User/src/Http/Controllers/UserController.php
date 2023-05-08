<?php
namespace Modules\User\src\Http\Controllers;
use App\Http\Controllers\Controller;
use Modules\User\src\Models\User;

class UserController extends Controller {

    public function index() {
        return view('User::lists');
    }

    public function show($id) {
        return view('User::detail', compact('id'));
    }

    public function create() {
        $user = new User();
        $user->name = 'Nam';
        $user->email = 'nam@gmail.com';
        $user->save();
    }
}