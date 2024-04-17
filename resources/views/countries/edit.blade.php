<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Country</title>
</head>
<body>
    <h3>Edit Country</h3>
    <form method="POST" action="{{ route('countries.update', $country->id) }}">
        @csrf
        @method('PUT')
        <label for="code">Code:</label><br>
        <input type="text" id="code" name="code" value="{{ $country->code }}"><br>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ $country->name }}"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description">{{ $country->description }}</textarea><br>
        <button type="submit">Save Changes</button>
    </form>
</body>
</html>
