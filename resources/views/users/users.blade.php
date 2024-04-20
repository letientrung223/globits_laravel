@extends('layout.app')

@section('content')
<div class="container">
    <div class="table-container">
    	<h3> User </h3>
        <table>
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Is active</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Edit</th>
                	<th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_active }}</td>
                    <td>{{ $user->password }}</td>
                    <td> 
                        @if ($user->role)
                            @if (count($user->role) > 0)
                                @foreach ($user->role as $role)
                                    {{ $role->role }}
                                @endforeach
                            @else
                                N/a
                            @endif
                        @else
                            N/a
                        @endif
                    </td>
                    <td><a href="{{ route('users.edit', $user->id) }}">Edit</a></td>
                    <td><a href="{{ route('users.destroy', $user->id) }}" onclick="event.preventDefault(); 
                    	if (confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br/>
        <input type="button" id="showFormButton" value="Add New User"/>
    </div>
    <div class="form-container">
        <div class="form-container_2">
            <form id="userForm" method="POST"  action="{{ route('users.store') }}">
            @csrf
            <h2>Add New User </h2>
            <label for="Email">Email:</label>
            <input type="text" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <p>{{ $message }}</p>
            @enderror

            <label for="is_active">Is active:</label>
            <input type="text" id="is_active" name="is_active" value="{{ old('is_active') }}">
            @error('is_active')
                <p>{{ $message }}</p>
            @enderror

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="{{ old('password') }}">
            @error('password')
                <p>{{ $message }}</p>
            @enderror

            <button type="submit">Submit</button>
            </form>
        </div>   
    </div>
</div>
<form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    let formContainerVisible = false;
    document.getElementById('showFormButton').addEventListener('click', function() {
        let formContainer = document.querySelector('.form-container');
        console.log(formContainerVisible);
        if (formContainerVisible) {
            formContainer.style.display = 'none';
            formContainerVisible = false;
        } else {
            formContainer.style.display = 'inline-block';
            formContainerVisible = true;
        }
    });
</script>

@endsection

