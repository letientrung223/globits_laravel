@extends('layout.app')

@section('content')
    <div class="table-container">
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <h2>Edit Project </h2>
            <label for="code">Code:</label>
            <input type="text" id="code" name="code" value="{{ $project->code }}"> <br/>
            @error('code')
                <p>{{ $message }}</p>
            @enderror

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $project->name }}"> <br/>
            @error('name')
                <p>{{ $message }}</p>
            @enderror

            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="{{ $project->description }}"> <br/>
            @error('description')
                <p>{{ $message }}</p>
            @enderror

            <label for="company">Choose a company:</label>
            <select name="company_id" id="company_id">
                <option value="">Select Company</option>
              @foreach ($companies as $company)
                    <option value="{{$company->id}}">{{$company->name}}</option>
              @endforeach
            </select> <br/>

            <label for="person">Choose person</label><br/>
                <select name="person_id[]" id="person_id" multiple style="width:40%">
					@if ($project->person()->exists())
						@foreach ($project->person as $person)
							<option value="{{ $person->id }}">{{ $person->full_name }}</option>
						@endforeach
					@else
						<option value="">N/a</option>
					@endif
                </select><br/><br/>
              
              


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
        console.log("done"+companyId);
    });
});

</script>
@endsection