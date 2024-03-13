<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use App\Models\Worker;
use App\Models\Admin;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // ログに $request->role の値を出力
        \Log::info('Role value from form: ' . $request->role);
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:0,1'], // 管理者(0)か作業員(1)のどちらか
        ]);
        
        

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_approved' => 0,
        ]);
        
         if ($request->role == 0) {
            $admin=Admin::create([
            'name' => $request->name,
            'email' => $request->email,
        
          ]);
          
           // 管理者情報が作成されたら、$user の admin_id に管理者の ID を設定する
                  $user->admin_id = $admin->id;
                  $user->save();
          
        } else {
            $worker=Worker::create([
            'name' => $request->name,
            'email' => $request->email,
          ]);
          
          // 作業員情報が作成されたら、$user の worker_id に作業員の ID を設定する
               $user->worker_id = $worker->id;
               $user->save();
               
            
        };
        

        event(new Registered($user));

        Auth::login($user);

        // ユーザーのロールに応じて適切なダッシュボードにリダイレクト
        if ($request->role == 0) {
            // 管理者用のダッシュボードにリダイレクト
            return Redirect::route('admin.dashboard');
        } else {
            // 作業員用のダッシュボードにリダイレクト
            return redirect()->action([\App\Http\Controllers\WorkerController::class, 'index']);
        }
    }
}
