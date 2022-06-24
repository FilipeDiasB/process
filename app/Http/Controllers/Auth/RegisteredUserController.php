<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->validated());

        $file = $request->file;

        if ($request->hasFile('file') && $file->isValid()) {
            $name = $file->hashName();

            $uploadPath = $request->file->storeAs('users', $name);

            if (!$uploadPath) {
                return redirect()->back();
            }
        }

        $user->update(['file' => $uploadPath]);

        return redirect()->back()->with('success', 'Usuário criado com sucesso');
    }
}
