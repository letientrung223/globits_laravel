@extends('layout.app')

@section('content')
    <div class="table-container">
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h2>Edit Task </h2>
            <label for="Name">Task Name:</label><br/>
            <input type="text" id="name" name="name" value="{{ $task->name }}" style="width:100%"><br/>
            @error('name')
                <p>{{ $message }}</p>
            @enderror

            <label for="start_time"> Start time:</label><br/>
            <input 
                type="datetime-local"
                min="2023-06-07T00:00"
                max="2030-06-14T00:00"  
                id="start_time" 
                name="start_time" 
                value="{{ $task->start_time }}"><br/>
            @error('start_time')
                <p>{{ $message }}</p>
            @enderror

            <label for="end_time">End time:</label><br/>
            <input 
              type="datetime-local"
              min="2023-06-07T00:00"
              max="2030-06-14T00:00"  id="end_time" name="end_time" value="{{ $task->end_time }}"><br/>
            @error('end_time')
                <p>{{ $message }}</p>
            @enderror
             <label for="priority">Priority:</label><br/>
            <select name="priority" id="priority" style="width:100%">
                <option value="">Select Priority</option>
                <option value="1">High</option>
                <option value="2">Medium</option>
                <option value="3">Low</option>
            </select><br/>
            @error('priority')
                <p>{{ $message }}</p>
            @enderror

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" cols="45" value="{{ $task->description }}" style="width:100%">
                
            </textarea>
            @error('description')
                <p>{{ $message }}</p>
            @enderror

            <label for="status">Status:</label><br/>
            <select name="status" id="status" style="width:100%">
                <option value="">Select Status</option>
                <option value="1">New</option>
                <option value="2">Doing</option>
                <option value="3">Finished</option>
                <option value="4">Hold on</option>
            </select><br/>
            @error('status')
                <p>{{ $message }}</p>
            @enderror

            <label for="company">Choose Company:</label><br/>
            <select name="company_id" id="company_id" style="width:100%">
                <option value="">Select Company</option>
            @foreach ($companies as $company)
                <option value="{{$company->id}}">{{$company->name}}</option>
            @endforeach
            </select><br/>
            @error('company_id')
                <p>{{ $message }}</p>
            @enderror

            <label for="project">Choose project</label><br/>
                <select name="project_id" id="project_id" style="width:100%">
                    
                </select><br/>
            @error('project_id')
                <p>{{ $message }}</p>
            @enderror
            <label for="person">Choose person</label><br/>
                <select name="person_id" id="person_id" style="width:100%">
                    
                </select><br/>
             @error('person_id')
                <p>{{ $message }}</p>
            @enderror

            <button type="submit">Submit</button>
        </form>
    </div>
    <script>
   $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

        // Gửi yêu cầu Ajax để lấy danh sách nhân viên theo ID công ty
        $.ajax({
            type: 'POST',
            url: '/globits_laravel/public/project/get-projects-by-company-id/' + companyId,
            success: function(response) {
                // Xóa danh sách projects hiện tại
                $('#project_id').empty();

                // Thêm danh sách nhân viên mới từ response vào select
                response.forEach(function(project) {
                    console.log(project);
                    $('#project_id').append('<option value="' + project.id + '">' + project.name + '</option>');
                });

            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
});
</script>
@endsection