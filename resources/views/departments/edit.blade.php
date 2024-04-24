@extends('layout.app')

@section('content')

    <h3>Edit Country</h3>
    <form method="POST" action="{{ route('departments.update', $department->id) }}">
        @csrf
        @method('PUT')
        <label for="code">Code:</label><br>
        <input type="text" id="code" name="code" value="{{ $department->code }}"><br>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ $department->name }}"><br>
        <input type="hidden" id="company_id" name="company_id" value="{{ $department->company_id }}">
        <!-- <input type="hidden" id="parent_id" name="parent_id" value="{{ $department->parent_id }}"> -->
        <label for="parent_id">Department:</label><br/>
	    <select id="parent_id" name="parent_id">
	        <option value="">-- Select Department --</option>
	        @foreach($departments as $department)
	            <option value="{{ $department->id }}">{{ $department->name }}</option>
	        @endforeach
	    </select><br/><br/>
        <button type="submit">Save Changes</button>
    </form>
@endsection