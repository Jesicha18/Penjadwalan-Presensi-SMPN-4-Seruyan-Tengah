<p>Dengan hormat,</p>

<p>Halo, <strong>{{ $user->email }}</strong>,</p>

<p>Anda menerima pesan ini karena kami menerima permintaan pemulihan atau pengaturan ulang kata sandi (<em>password</em>) untuk akun Anda pada aplikasi <strong>Sistem Penjadwalan dan Presensi SMPN 4 Seruyan Tengah</strong>.</p>

<p>Silakan klik tautan resmi di bawah ini untuk melanjutkan proses pengaturan ulang kata sandi Anda:</p>

<p style="margin: 25px 0;">
    <a href="{{ route('password.reset', ['token' => $token, 'email' => $user->email]) }}" style="padding: 12px 20px; background: #1e3a8a; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">Reset Kata Sandi</a>
</p>

<p>Tautan pemulihan kata sandi ini memiliki batas waktu kedaluwarsa demi keamanan akun Anda.</p>

<p>Apabila Anda tidak merasa melakukan permintaan pengaturan ulang kata sandi ini, mohon abaikan email ini dan pastikan akun Anda tetap aman.</p>

<br>
<p>Hormat kami,</p>
<p><strong>Administrator Sistem SMPN 4 Seruyan Tengah</strong></p>