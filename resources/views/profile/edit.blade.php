<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    <div>
        <label for="name">Name</label>
        <input id="name" name="name" value="{{ $user->name }}" required>
    </div>
    <div>
        <label for="email">Email</label>
        <input id="email" name="email" value="{{ $user->email }}" type="email" required>
    </div>
    <button type="submit">Update Profile</button>
</form>
