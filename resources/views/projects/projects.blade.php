@extends('layout.app')

@section('content')
<div class="container">
    <div class="table-container">
    	<h3> Project </h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Company</th>
                    <th>Person</th>
                    <th>Edit</th>
                	<th>Delete</th>
                </tr>
            </thead>
            <tbody>
                 @foreach($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->code }}</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->company_id }}</td>
                    <td> 
                        @if ($project->person)
                            @if (count($project->person) > 0)
                                @foreach ($project->person as $person)
                                    {{ $person->full_name }} ;
                                @endforeach
                            @else
                                N/a
                            @endif
                        @else
                            N/a
                        @endif
                    </td>
                    <td><a href="{{ route('projects.edit', $project->id) }}">Edit</a></td>
                    <td><a href="{{ route('projects.destroy', $project->id) }}" onclick="event.preventDefault(); 
                        if (confirm('Are you sure you want to delete this Project?')) { document.getElementById('delete-form-{{ $project->id }}').submit(); }">Delete</a></td>
                </tr>
                <form id="delete-form-{{ $project->id }}" action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                @endforeach
            </tbody>
        </table>
        <br/>
        <input type="button" id="showFormButton" value="Add New Project"/>  
    
        <div class="pagination-area">
            <ul class="pagination">
                <!-- {{ $projects->links('pagination::simple-bootstrap-4') }} -->
                {{ $projects->onEachSide(1)->links('pagination::bootstrap-4') }}

            </ul>
        </div>     
    </div>

    <div class="form-container" >
        <div class="form-container_2">
        <form id="countryForm" method="POST"  action="{{ route('projects.store') }}">
            @csrf
            <h2>Add New Project </h2>
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

            <label for="company">Choose a company:</label>
            <select name="company_id" id="company_id">
                <option value="">Select Company</option>
            @foreach ($companies as $company)
                <option value="{{$company->id}}">{{$company->name}}</option>
            @endforeach
            </select>

            <label for="person">Choose person</label><br/>
                <select name="person_id[]" id="person_id" multiple style="width:100%">
                    
                </select><br/><br/>
            <button type="submit">Submit</button>
        </form>
        </div>
    </div>
</div>


<script>
   $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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

    $('#company_id').change(function() {
        // Lấy ID của công ty đã chọn
        var companyId = $(this).val();
        console.log(companyId);
        // Gửi yêu cầu Ajax để lấy danh sách nhân viên theo ID công ty
        $.ajax({
            type: 'POST',
            url: '/globits_laravel/public/person/get-persons-by-company-id/' + companyId,
            success: function(response) {
                // Xóa danh sách nhân viên hiện tại
                $('#person_id').empty();

                // Thêm danh sách nhân viên mới từ response vào select
                response.forEach(function(person) {
                    console.log(person);
                    $('#person_id').append('<option value="' + person.id + '">' + person.full_name + '</option>');
                });

            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
        console.log("done"+companyId);
    });
});

</script>


@endsection

