@extends('layout.app')

@section('content')
    <div class="container">
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
        	<h1>Edit Role</h1>
            <div class="form-group">
                <label for="role">Role</label><br/>
                <input type="text" class="form-control" id="role" name="role" value="{{ $role->role }}"><br/>
            </div>
            <div class="form-group">
                <label for="description">Description</label><br/>
                <input type="text" class="form-control" id="description" name="description" value="{{ $role->description }}"><br/>
            </div><br/>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection