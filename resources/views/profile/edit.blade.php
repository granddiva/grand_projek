<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>

<h1>Edit Profile</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

{{-- Tampilkan foto profil jika ada --}}
@if($user && $user->profile_picture)
    <img src="{{ Storage::url($user->profile_picture) }}" width="200" alt="Profile Picture"><br><br>

    <form action="{{ route('profile.destroy') }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Picture</button>
    </form>
@endif

<br>

{{-- Form upload foto --}}
<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Upload New Profile Picture:</label><br>
    <input type="file" name="profile_picture" required>
    <button type="submit">Upload</button>
</form>

</body>
</html>
