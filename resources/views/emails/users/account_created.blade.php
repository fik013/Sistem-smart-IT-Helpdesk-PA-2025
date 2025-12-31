<x-mail::message>
# Selamat Datang di Smart IT Helpdesk

Halo **{{ $user->name }}**,

Akun Anda telah berhasil dibuat oleh Administrator. Berikut adalah detail kredensial untuk login ke dalam sistem:

<x-mail::panel>
**Email:** {{ $user->email }}
<br>
**Password:** {{ $password }}
</x-mail::panel>

Harap segera login dan ganti password Anda untuk keamanan akun.

<x-mail::button :url="route('login')">
Login Sekarang
</x-mail::button>

Jika Anda mengalami kendala saat login, silakan hubungi Administrator IT.

Terima Kasih,<br>
Tim IT Helpdesk
</x-mail::message>
