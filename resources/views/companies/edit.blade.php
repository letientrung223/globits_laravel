<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Company</title>
</head>
<body>
    <h3>Edit Company</h3>
    <form method="POST" action="{{ route('companies.update', $company->id) }}">
        @csrf
        @method('PUT')
        <label for="code">Code:</label><br>
        <input type="text" id="code" name="code" value="{{ $company->code }}"><br>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ $company->name }}"><br>
        <label for="address">Address:</label><br>
        <textarea id="address" name="address">{{ $company->address }}</textarea><br>
        <button type="submit">Save Changes</button>
    </form>
</body>
</html>
