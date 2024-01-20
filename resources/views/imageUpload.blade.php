<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Your Image Upload App</title>
</head>
    
<body class="bg-gray-100">
    <div class="container mx-auto mt-8 p-8">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @if ($message = Session::get('success'))
                <div class="alert alert-success mb-4">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                <img src="images/{{ Session::get('image') }}" class="mb-4">
            @endif
    
            @if (count($errors) > 0)
                <div class="alert alert-danger mb-4">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    
            <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Choose an image:</label>
                    <input type="file" name="image" id="image" class="border rounded w-full py-2 px-3">
                </div>
                <div class="flex items-center justify-end">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
  
</html>
