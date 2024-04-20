<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Person</title>
</head>
<body>
    <div class="container">
        <h1>Edit Person</h1>
        <form action="{{ route('persons.update', $person->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $person->full_name }}">
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <input type="text" class="form-control" id="gender" name="gender" value="{{ $person->gender }}">
            </div>
            <div class="form-group">
                <label for="birthday">Birthday</label>
                <input type="date" class="form-control" id="birthday" name="birthday" value="{{ $person->birthday }}">
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $person->phone_number }}">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $person->address }}">
            </div>
            <div class="form-group">
                <label for="company">Choose a company:</label>
                <select name="company_id" id="company_id" value="{{$person->company_id}}">
                  @foreach ($companies as $company){
                        <option value="{{$company->id}}">{{$company->name}}</option>
                  }
                  @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>