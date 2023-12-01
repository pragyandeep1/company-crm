<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Company Details</title>
</head>
<body>
	<h1>Company Details</h1>

    <!-- Display company information -->
    <h2>{{ $company->name }}</h2>
    <p>Email: {{ $company->email }}</p>
    <p>Website: {{ $company->website }}</p>

    <!-- Display company logo -->
    <img src="{{ asset($company->logo) }}" alt="Company Logo">

    <!-- Other content -->

</body>
</html>