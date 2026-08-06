<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): Response { return Inertia::render('Admin/Users/Index', ['users' => User::latest()->paginate(25), 'roles' => User::ADMIN_ROLES]); }
    public function store(Request $request): RedirectResponse { User::create($this->data($request)); return back()->with('success', 'User created.'); }
    public function update(Request $request, User $user): RedirectResponse { $user->update($this->data($request, $user)); return back()->with('success', 'User updated.'); }
    public function destroy(Request $request, User $user): RedirectResponse { abort_if($request->user()->is($user), 422, 'You cannot delete your own account.'); $user->delete(); return back()->with('success', 'User deleted.'); }
    private function data(Request $request, ?User $user = null): array {
        $rules=['name'=>['required','string','max:255'],'email'=>['required','email','max:255',Rule::unique('users')->ignore($user)],'role'=>['required',Rule::in(User::ADMIN_ROLES)],'password'=>$user?['nullable','string','min:12','confirmed']:['required','string','min:12','confirmed']];
        $data=$request->validate($rules); if(empty($data['password'])) unset($data['password']); else $data['password']=Hash::make($data['password']); return $data;
    }
}
