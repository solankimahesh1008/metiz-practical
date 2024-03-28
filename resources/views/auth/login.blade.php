<div>
<form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
        <label for="username">{{ __('User Name') }}</label>
        <input id="username" type="text" name="username" value="{{ old('username') }}" required>
    </div>

    <div>
        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" name="password" required>
    </div>

    <div>
        <button type="submit">{{ __('Login') }}</button>
    </div>
</form>
</div>
