<!-- resources/views/users/show.blade.php -->
<x-app-layout>

    <h1>{{ $user->name }}</h1>
    <p>Email: {{ $user->email }}</p>
    <p>Prénom: {{ $user->first_name }}</p>

</x-app-layout>