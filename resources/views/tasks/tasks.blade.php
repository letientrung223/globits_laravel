@extends('layout.app')

@section('content')
<div class="container">
    <div class="table-container" id ='task-table'>
    	<h3> Task </h3>
    	<div style="margin-bottom:10px ;">
            <form>
            <input type="text" name="search" id="search" placeholder="Search"/>
            <input type="button" id="searchBtn" value="Search"/>
            </form> <br>
            <button id="exportExcel" onclick="" style="background-color: #1F6F43; color: white; height: 25px; font-weight: bold; border: none;">Xuất Excel</button>


    	</div>
    	<div>
    		 Filter: 
    		 <select name="Filter" class="filter" id="filter_company_id">
    			<option value="" >Select company</option>
    			@foreach ($companies as $company)
                <option value="{{$company->id}}">{{$company->name}}</option>
                @endforeach
  			</select>
  			<select name="Filter" class="filter" id="filter_status">
    			<option value="" >Select status</option>
    			<option value="1" >New</option>
    			<option value="2" >Doing</option>
    			<option value="3" >Finished</option>
    			<option value="4" >Hold on</option>
  			</select> 
  			<select name="Filter" class="filter" id="filter_person_id">
    			<option value="" >Select person</option>
    			@foreach ($persons as $person)
                <option value="{{$person->id}}">{{$person->full_name}}</option>
                @endforeach
  			</select>
  			<select name="Filter" class="filter" id="filter_priority">
    			<option value="" >Select priority</option>
    			<option value="1" >High</option>
    			<option value="2" >Medium</option>
    			<option value="3" >Low</option>
  			</select>
  			<select name="Filter" class="filter" id="filter_project_id">
    			<option value="" >Select project</option>
    			@foreach ($projects as $project)
                <option value="{{$project->id}}">{{$project->name}}</option>
                @endforeach
  			</select>
    	</div><br/>
        <table id="taskTable">
            <thead>
                <tr>
                    <th>Project_ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Person_ID</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Edit</th>
                	<th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>
                        @foreach ($projects as $project)
                            @if ($task->project_id == $project->id)
                                {{ $project->name }}
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->person_id }}</td>
                    <td>{{ $task->start_time }}</td>
                    <td>{{ $task->end_time }}</td>
                    <td>{{ $task->priority }}</td>
                 
                    <td>{{ $task->status }}</td>
                    
                    <td><a href="{{ route('tasks.edit', $task->id) }}">Edit</a></td>
                    <td><a href="{{ route('tasks.destroy', $task->id) }}" onclick="event.preventDefault(); 
                    	if (confirm('Are you sure you want to delete this task?')) { document.getElementById('delete-form-{{ $task->id }}').submit(); }">Delete</a></td>
                </tr>
                <form id="delete-form-{{ $task->id }}" action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: none;">
				    @csrf
				    @method('DELETE')
				</form>
                @endforeach
            </tbody>
        </table>
        <br/>
        <input type="button" id="showFormButton" value="Add New Task"/>
        <div class="pagination-area">
            <ul class="pagination">
                {{ $tasks->onEachSide(1)->links('pagination::bootstrap-4') }}

            </ul>
        </div> <br/>
        <table id="resultTable" style="display:none;">
            <thead>
                <tr>
                    <th>Project_ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Person_ID</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>

    </div>
    <div class="form-container">
        <div class="form-container_2">
            <form id="taskForm" method="POST"  action="{{ route('tasks.store') }}">
            @csrf
            <h2>Add New Task </h2>
            <label for="Name">Task Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <p>{{ $message }}</p>
            @enderror

            <label for="start_time"> Start time:</label>
            <input 
                type="datetime-local"
                min="2023-06-07T00:00"
                max="2030-06-14T00:00"  
                id="start_time" 
                name="start_time" 
                value="{{ old('start_time') }}">
            @error('start_time')
                <p>{{ $message }}</p>
            @enderror

            <label for="end_time">End time:</label>
            <input 
              type="datetime-local"
              min="2023-06-07T00:00"
              max="2030-06-14T00:00"  id="end_time" name="end_time" value="{{ old('end_time') }}">
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
            <textarea id="description" name="description" rows="4" cols="45" value="{{ old('description') }}" style="width:100%">
                
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
    </div>
</div>


<script>
    function deleteTask(taskId) {
    var confirmation = confirm('Are you sure you want to delete this task?');
    if (confirmation) {
        $.ajax({
            url: '/globits_laravel/public/task/delete-task/' + taskId,
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}", // Token CSRF
                "id": taskId // ID của task
            },
            success: function(response) {
                alert(response.message);
                // Xóa hàng của Task khỏi bảng sau khi xóa thành công
                // $('#taskRow_' + taskId).remove();
                 location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
}

 function filter(id,value){
    $.ajax({
        url: '/globits_laravel/public/task/filter/'+id,
        type: 'GET',
        data: { data: value }, // Truyền dữ liệu tìm kiếm
        success: function(response) {
            $('#resultTable').show();
           $('#resultTable tbody tr').remove();
           console.log(response.data);
           if (response.data==""){alert("không có dữ liệu");}
           else{
            $.each(response.data, function(index, task) {
               var row = '<tr>' +
                '<td>' + task['project_id'] + '</td>' +
                '<td>' + task['name'] + '</td>' +
                '<td>' + task.description + '</td>' +
                '<td>' + task.person_id + '</td>' +
                '<td>' + task.start_time + '</td>' +
                '<td>' + task.end_time + '</td>' +
                '<td>' + task.priority + '</td>' +
                '<td>' + task.status + '</td>' +
                '<td><a href="{{ url('task') }}/edit/' + task.id + '">Edit</a></td>' +
                '<td><a href="#" class="delete-task" onclick="deleteTask(' + task.id + ')">Delete</a></td>' +
                '</tr>';
                $('#resultTable tbody').append(row);
                });}
               
            
        }
    });
 }   
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

    $('select#company_id').change(function() {
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
    $('select.filter').change(function(){
        var selectId = $(this).attr('id').substring(7);;
        var selectedValue = $(this).val();
        console.log("Ổn");
        filter(selectId,selectedValue);


    });
    
    $('#searchBtn').on('click', function() {
        let dataInput =  $('#search').val();
        console.log("trước "+dataInput);
        $.ajax({
        url: '/globits_laravel/public/task/search',
        type: 'GET',
        data: { data: dataInput }, // Truyền dữ liệu tìm kiếm
        success: function(response) {
            $('#resultTable').show();
           $('#resultTable tbody tr').remove();
           console.log(response.data);
           if (response.data==""){alert("không có dữ liệu");}
           else{
            $.each(response.data, function(index, task) {
               var row = '<tr>' +
                '<td>' + task['project_id'] + '</td>' +
                '<td>' + task['name'] + '</td>' +
                '<td>' + task.description + '</td>' +
                '<td>' + task.person_id + '</td>' +
                '<td>' + task.start_time + '</td>' +
                '<td>' + task.end_time + '</td>' +
                '<td>' + task.priority + '</td>' +
                '<td>' + task.status + '</td>' +
                '<td><a href="{{ url('task') }}/edit/' + task.id + '">Edit</a></td>' +
                '<td><a href="#" class="delete-task" onclick="deleteTask(' + task.id + ')">Delete</a></td>' +
                '</tr>';
                $('#resultTable tbody').append(row);
                });}
               
            
        }
    });
    });
    
});
      

</script>

@endsection

