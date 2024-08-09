<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    function editUser(Request $request)
    {
$user=User::find($request->id);
if ($request->name !=null){
    $user->name=$request->name;
}
if ($request->email !=null){
    $user->email=$request->email;
}
if ($request->password !=null){
    $user->password=bcrypt($request->password);
}
if ($request->role !=null){
    $user->syncRoles([$request->role]);
}
$user->save();
return back();
    }
    function newUser(Request $request)
    {
      if (User::where('email', $request->email)->exists()) {
          return back()->with([
              'type' => 'error',
              'message' => 'Email already exists',
              'title'=>'Not Added'
          ]);
      }
     $user= User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => bcrypt($request->password),
      ]);
      $user->assignRole($request->role);
      UserDetails::create([
          'user_id' => $user->id,
          'department_id' => 0,

      ]);
      return back();
    }
    function newTeam(Request $request)
    {
        if (UserDetails::where('user_id',$request->userId)->exists()) {
            UserDetails::find($request->userId)->update([
                'description' => $request->ckeditor,
            ]);
        }
        UserDetails::create([
            'description' => $request->ckeditor,
            'user_id' => $request->userId,
            'department_id' => 0
        ]);

        return back();

    }
    function changePassword(Request $request)
    {
        if (!\auth()->check()){
            return redirect('/login')->with([
                'type' => 'error',
                'message'=>'You are not authorized to access this page',
                'title' => 'Unauthorized'
            ]);
        }
        if (!Hash::check($request->current_password, Auth::user()->password)) {
           return back()->with([
               'type' => 'error',
               'message' => 'Your current password does not matches with the password you provided. Please try again.',
               'title'=>'Error'
           ]) ;
        }
        if ($request->password != $request->confirm_password) {
            return back()->with([
                'type' => 'error',
                'message' => 'Your confirm password does not matches with the password you provided. Please try again.',
                'title'=>'Error'
            ]);
        }
        auth()->user()->update(['password' => bcrypt($request->password)]);
        auth()->logout();
        return redirect('/login')->with([
            'type' => 'success',
            'message' => 'Your password has been changed successfully.',
            'title'=>'Success'
        ]);
    }
    function loginUser(Request $request)
    {
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (\auth()->user()->hasRole('admin') || \auth()->user()->hasRole('Super Admin')) {
               return redirect('/admin') ;
            }
            auth()->logout();
            return redirect('/login')->with([
                'type' => 'error',
                'message'=>'You are not authorized to access this page',
                'title'=>'Unauthorized'
            ]);
        }
        return back()->with([
            'type' => 'error',
            'message'=>'Wrong email or password',
            'title'=>'Unauthorized'
        ]);
    }
    function resetPassword(Request $request)
    {
        if ($request->password != $request->password_confirmation) {
          return back()->with([
              'type' => 'error',
              'message'=>'Password did not match',
              'title' => 'Error'
          ]);
        }
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
            ? redirect('/login')->with(['type'=>'success','message'=>'Password reset successfully','title'=>'Success'])
            : back()->with(['message' => __($status),'type'=>'error','title'=>'Error']);
    }
    function requestPassword(Request $request)
    {
        $status=Password::sendResetLink($request->only('email'));
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['message' => 'If you do not find it in your inbox,check your spam box',
                'type'=>'success','title'=>'Password Reset Email Sent'])
            : back()->with(['message' => __($status),'type'=>'error','title'=>'Unable to send Password Reset Email']);
    }
    function register(Request $request)
    {
        if ($request->password != $request->confirm_password) {
            return back()->with([
                'type' => 'error',
                'message'=>'Passwords do not match',
                'title' => 'Error'
            ]);
        }
        if (User::where('email', $request->email)->exists()) {
            return back()->with([
                'type' => 'error',
                'message'=>'Email already exists',
                'title' => 'Error'
            ]);
        }
       User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => bcrypt($request->password),
       ]) ;
       return redirect('/login')->with([
           'type' => 'success',
           'message'=>'You can now login',
           'title'=>'Account Created'
       ]);
    }
}
