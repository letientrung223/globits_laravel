@extends('layout.app')

@section('content')
<div class="container">
    <div class="table-container">
    	<h3> Companies </h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Edit</th>
                	<th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->code }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->address }}</td>
                    <td><a href="{{ route('companies.edit', $company->id) }}">Edit</a></td>
                    <td><a href="{{ route('companies.destroy', $company->id) }}" onclick="event.preventDefault(); 
                    	if (confirm('Are you sure you want to delete this company?')) { document.getElementById('delete-form-{{ $company->id }}').submit(); }">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br/>
        <input type="button" id="showFormButton" value="Add New Company"/>
    </div>
    <div class="form-container">
        <div class="form-container_2">
            <form id="companyForm" method="POST" action="{{ route('companies.store') }}">
            @csrf
            <h2>Add New Company </h2>

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

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="{{ old('address') }}">
            @error('address')
                <p>{{ $message }}</p>
            @enderror

            <button type="submit">Submit</button>
        </form>
        </div>
    </div>
</div>

<form id="delete-form-{{ $company->id }}" action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display: none;">
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

