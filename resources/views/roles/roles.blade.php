@extends('layout.app')

@section('content')
<div class="container">
    <div class="table-container">
    	<h3> Role </h3>
        <table>
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Description</th>
                    <th>Edit</th>
                	<th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->role }}</td>
                    <td>{{ $role->description }}</td>
                    <td><a href="{{ route('roles.edit', $role->id) }}">Edit</a></td>
                    <td><a href="{{ route('roles.destroy', $role->id) }}" onclick="event.preventDefault(); 
                    	if (confirm('Are you sure you want to delete this role?')) { document.getElementById('delete-form-{{ $role->id }}').submit(); }">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br/>
        <input type="button" id="showFormButton" value="Add New Role"/>
    </div>
    <div class="form-container">
        <div class="form-container_2">
            <form id="roleForm" method="POST"  action="{{ route('roles.store') }}">
            @csrf
            <h2>Add New Role </h2>

            <label for="Role">Role:</label>
            <input type="text" id="role" name="role" value="{{ old('role') }}">
            @error('role')
                <p>{{ $message }}</p>
            @enderror

            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="{{ old('description') }}">
            @error('description')
                <p>{{ $message }}</p>
            @enderror

            <button type="submit">Submit</button>
            </form>
        </div>   
    </div>
</div>
<form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: none;">
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

