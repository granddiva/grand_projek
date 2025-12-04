<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
</head>
<body>

<h1>User Profile</h1>

@if($user->profile_picture)
    <img src="{{ Storage::url($user->profile_picture) }}" width="200">
@else
    <p>No profile picture uploaded.</p>
@endif

</body>
</html>
