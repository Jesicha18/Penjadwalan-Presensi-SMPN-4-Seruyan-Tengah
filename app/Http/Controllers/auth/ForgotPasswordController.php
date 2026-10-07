<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    // Menampilkan form input email/username untuk lupa password
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // Mengirim token/link reset ke email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => ['required', 'email', 'exists:users,email']]);

        $user = User::where('email', $request->email)->first();
        $token = Str::random(64);

        // Simpan token ke tabel password_reset_tokens bawaan Laravel
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        // Kirim email menggunakan view sederhana
        Mail::send('emails.forgot-password', ['token' => $token, 'user' => $user], function($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password - SMPN 4 Seruyan Tengah');
        });

        return back()->with('status', 'Tautan pemulihan kata sandi telah dikirim ke email Anda.');
    }

    // Menampilkan form input password baru
    public function showResetForm($token, Request $request)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    // Eksekusi penyimpanan password baru
    public function reset(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'token' => ['required']
        ]);

        $resetData = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$resetData || !Hash::check($request->token, $resetData->token)) {
            return back()->withErrors(['email' => 'Token reset password tidak valid atau kedaluwarsa.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus token setelah digunakan
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Kata sandi berhasil diperbarui. Silakan login.');
    }
}