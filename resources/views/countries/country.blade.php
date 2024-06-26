@extends('layout.app')

@section('content')
<div class="container">
    <div class="table-container">
    	<h3> Country </h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Edit</th>
                	<th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($countries as $country)
                <tr>
                    <td>{{ $country->id }}</td>
                    <td>{{ $country->code }}</td>
                    <td>{{ $country->name }}</td>
                    <td>{{ $country->description }}</td>
                    <td><a href="{{ route('countries.edit', $country->id) }}">Edit</a></td>
                    <td><a href="{{ route('countries.destroy', $country->id) }}" onclick="event.preventDefault(); 
                    	if (confirm('Are you sure you want to delete this country?')) { document.getElementById('delete-form-{{ $country->id }}').submit(); }">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br/>
        <input type="button" id="showFormButton" value="Add New Country"/>
    </div>
    <div class="form-container" >
        <div class="form-container_2">
        <form id="countryForm" method="POST"  action="{{ route('countries.store') }}">
            @csrf
            <h2>Add New Country </h2>
            <label for="code">Code:</label>
            <input type="text" id="code" name="code" value="{{ old('code') }}">
            @error('code')
                <p>{{ $message }}</p>
            @enderror

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
            @error('name')
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
<form id="delete-form-{{ $country->id }}" action="{{ route('countries.destroy', $country->id) }}" method="POST" style="display: none;">
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

