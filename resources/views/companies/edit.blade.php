@extends('layout.app')
@section('content')
    <div class="container">
    <form method="POST" action="{{ route('companies.update', $company->id) }}">
        @csrf
        @method('PUT')
        <h3>Edit Company</h3>

        <label for="code">Code:</label><br>
        <input type="text" id="code" name="code" value="{{ $company->code }}"><br>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ $company->name }}"><br>
        <label for="address">Address:</label><br>
        <textarea id="address" name="address">{{ $company->address }}</textarea><br>
        <button type="submit">Save Changes</button>
    </form>
    <div class="department-container">
        <h3>DANH MỤC PHÒNG BAN</h3>      
        @if($departments)
        <table id="departmentTable">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>Actions</th>
                    <th>Code</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departments->where('parent_id', null) as $department)
                    <tr class="parent-department">
                        <td><input type="checkbox" 
                            class="departmentCheckbox" data-department-id="{{ $department->id }}"></td>
                        <td><!-- Icon chỉnh sửa -->
                            <a href="{{ route('departments.edit', $department->id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                

                            <!-- Icon xoá -->
                            <a href="{{ route('departments.destroy', $department->id) }}"  onclick="event.preventDefault(); 
                        if (confirm('Are you sure you want to delete this department?')) { document.getElementById('delete-form-{{ $department->id }}').submit(); }">
                                <i class="fa fa-trash"></i>
                            </a></td>
                        <td>{{ $department->code }}</td>
                        <td>{{ $department->name }}</td>

                    </tr>
                    @if(count($department->children) > 0)
                        @foreach($department->children as $child)
                            <tr class="child-of-department{{ $department->id }} child-department" style="display: none;">
                                <td>
                                    <input type="checkbox" class="departmentCheckbox" data-department-id="{{ $child->id }}">
                                </td>
                                <td><!-- Icon chỉnh sửa -->
                                    <a href="{{ route('departments.edit', $child->id) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    
                                    <!-- Icon xoá -->
                                    <a href="{{ route('departments.destroy', $child->id) }}" onclick="event.preventDefault(); 
                        if (confirm('Are you sure you want to delete this department?')) { document.getElementById('delete-form-{{ $child->id }}').submit(); }"

                                    >
                                        <i class="fa fa-trash"></i>
                                    </a></td>
                                <td>{{ $child->code }}</td>
                                <td>{{ $child->name }}</td>
                            </tr>
                            <form id="delete-form-{{ $child->id }}" action="{{ route('departments.destroy', $child->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                            </form>
                        @endforeach
                    @endif
                    <form id="delete-form-{{ $department->id }}" action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                @endforeach
            </tbody>
        </table>
        @endif
        <div class="form-container" id="addForm">
            <div class="form-container_2">
                <form id="companyForm" method="POST" action="{{ route('departments.store') }}">
                @csrf
                <h2>Add New Department </h2>

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
                <!-- <label for="name">ID Company:</label> -->
                <input type="hidden" id="company_id" name="company_id" value="{{ $company->id }}">
                <button type="submit">Submit</button>
            </form>
            </div>
        </div>
        </form>
        <button id="showFormBtn" class="add-new">+ Thêm mới </button>
        <button class="add-excel">+ Nhập Excel </button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('selectAll'); 
    const showFormBtn = document.getElementById('showFormBtn'); 
    const addForm = document.getElementById('addForm'); 

    showFormBtn.addEventListener('click', function() {
        addForm.style.display = 'block'; // Hiển thị form khi nhấp vào nút
    });

    const departmentCheckboxes = document.querySelectorAll('.departmentCheckbox');

    showFormBtn.addEventListener('click', function() {
        addForm.style.display = 'block'; // Hiển thị form khi nhấp vào nút
    });

    selectAllCheckbox.addEventListener('change', function() {
            departmentCheckboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
    });
    departmentCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const departmentId = checkbox.dataset.departmentId;
            const childRows = document.querySelectorAll('.child-of-department' + departmentId);

            childRows.forEach(function(row) {
                row.style.display = checkbox.checked ? 'table-row' : 'none';
            });
        });
    });
});
</script>

@endsection
