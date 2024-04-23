<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function index() {
        $all_users = $this->user->withTrashed()->latest()->paginate(5); // SELECT * FROM users ORDER BY created_at DESC
        # withTrashed() is going to include the softDeleted users in the query.
        return view('admin.users.index')->with('all_users', $all_users);
    }

    public function deactivate($id) {
        $this->user->destroy($id);
        return redirect()->back();
    }

    public function activate($id) {
        # onlyTrashed() is going to retrieved the softdeleted users|ewcords
        # The restore() will un-delete a soft delete users, this will clear the deleted_at column
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}


