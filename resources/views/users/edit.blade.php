@extends('layout.app')

@section('content')
    <div class="container">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h1>Edit User</h1>
            <div class="form-group">
                <label for="email">Email</label><br/>
                <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}"><br/>
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label><br/>
                <input type="text" class="form-control" id="is_active" name="is_active" value="{{ $user->is_active }}"><br/>
            </div>
            <div class="form-group">
                <label for="password">Password</label><br/>
                <input type="text" class="form-control" id="password" name="password" value="{{ $user->password }}"><br/>
            </div>
            <div class="form-group">
                <label for="role">Role</label><br/>
                <select name="roles[]" multiple style="width:100%">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->roles && $user->roles->contains($role->id) ? 'selected' : '' }}>
                            {{ $role->role }}
                        </option>
                    @endforeach
                </select><br/><br/>

            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection