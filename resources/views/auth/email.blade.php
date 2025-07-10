<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <input type="email" name="email" placeholder="Masukkan Email" required>
    <button type="submit">Kirim Link Reset</button>
</form>
