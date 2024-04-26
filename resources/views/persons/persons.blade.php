@extends('layout.app')

@section('content')
<div class="container">
    <div class="table-container">
    	<h3> People </h3>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Phone number</th>
                    <th>Address</th>
                    <th>Company</th>
                    <th>Edit</th>
                	<th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($persons as $person)
                <tr>
                    <td>{{ $person->full_name }}</td>
                    <td>{{ $person->gender }}</td>
                    <td>{{ $person->birthday }}</td>
                    <td>{{ $person->phone_number }}</td>
                    <td>{{ $person->address }}</td>
                    <td>
                        @php
                            $company = $companies->where('id', $person->company_id)->first();
                        @endphp
                        @if($company)
                            {{ $company->name }}
                        @else
                            N/A
                        @endif
                    </td>

                    <td><a href="{{ route('persons.edit', $person->id) }}">Edit</a></td>
                    <td><a href="{{ route('persons.destroy', $person->id) }}" 
                        onclick="event.preventDefault(); 
                    	if (confirm('Are you sure you want to delete this person?')) { document.getElementById('delete-form-{{ $person->id }}').submit(); }">Delete</a></td>
                </tr>
                 <form id="delete-form-{{ $person->id }}" action="{{ route('persons.destroy', $person->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                @endforeach
            </tbody>
        </table>
        <br/>
        <input type="button" id="showFormButton" value="Add New Person"/>
        <div class="pagination-area">
            <ul class="pagination">
                {{ $persons->onEachSide(1)->links('pagination::bootstrap-4') }}

            </ul>
        </div>
    </div>
    <div class="form-container">
        <div class="form-container_2">
            <form id="personForm" method="POST" action="{{ route('persons.store') }}">
        @csrf
        <h2>Add New Person </h2>

        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}">
        @error('full_name')
            <p>{{ $message }}</p>
        @enderror

        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender" value="{{ old('gender') }}">
        @error('gender')
            <p>{{ $message }}</p>
        @enderror

        <label for="birthday">Birthday:</label>
        <input type="text" id="birthday" name="birthday" value="{{ old('birthday') }}">
        @error('birthday')
            <p>{{ $message }}</p>
        @enderror

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
        @error('phone_number')
            <p>{{ $message }}</p>
        @enderror

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="{{ old('address') }}">
        @error('address')
            <p>{{ $message }}</p>
        @enderror

        <label for="company">Choose a company:</label>
        <select name="company_id" id="company_id">
          @foreach ($companies as $company){
                <option value="{{$company->id}}">{{$company->name}}</option>
          }
          @endforeach
        </select>

        <button type="submit">Submit</button>
    </form>
        </div>
    </div>
</div>



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

