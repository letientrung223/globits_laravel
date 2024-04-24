@extends('layout.app')
@section('content')
    <div class="container">
        <form action="{{ route('persons.update', $person->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h1>Edit Person</h1>
            <div class="form-group">
                <label for="full_name">Full Name</label><br/>
                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $person->full_name }}"><br/>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label><br/>
                <input type="text" class="form-control" id="gender" name="gender" value="{{ $person->gender }}"><br/>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday</label><br/>
                <input type="date" class="form-control" id="birthday" name="birthday" value="{{ $person->birthday }}"><br/>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label><br/>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $person->phone_number }}"><br/>
            </div>
            <div class="form-group">
                <label for="address">Address</label><br/>
                <input type="text" class="form-control" id="address" name="address" value="{{ $person->address }}"><br/>
            </div>
            <div class="form-group">
                <label for="company">Choose a company:</label><br/>
                <select name="company_id" id="company_id" value="{{$person->company_id}}">
                  @foreach ($companies as $company){
                        <option value="{{$company->id}}">{{$company->name}}</option>
                  }
                  @endforeach
                </select><br/>
            </div><br/>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection