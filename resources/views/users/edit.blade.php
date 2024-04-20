@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Edit User</h1>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <input type="text" class="form-control" id="is_active" name="is_active" value="{{ $user->is_active }}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" id="password" name="password" value="{{ $user->password }}">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="roles[]" multiple>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->roles && $user->roles->contains($role->id) ? 'selected' : '' }}>
                            {{ $role->role }}
                        </option>
                    @endforeach
                </select>

            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection