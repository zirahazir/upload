<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 class="text-center mb-4">Upload Bulk Data in Excel</h3>

                {!! Form::open([
                    'route' => 'store',
                    'method' => 'POST',
                    'enctype' => 'multipart/form-data',
                    'id' => 'upload-form',
                ]) !!}
                <div class="button-container">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <input type="file" name="file" id="file-input" required>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
                {!! Form::close() !!}

                <div id="progress-message" class="mt-4" style="display: none;">
                    <div class="alert alert-info">
                        <b class="blink">Uploading file...</b>
                    </div>
                </div>

                <div id="status-message" class="mt-4" style="display: none;">
                    <div class="alert alert-success"><b>Upload complete!</b></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#upload-form').on('submit', function(e) {
                e.preventDefault();

                $('#progress-message').show();
                $('#status-message').hide();

                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('store') }}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#progress-message').hide();
                        $('#status-message').show();
                        console.log(response.message);
                    },
                    error: function(xhr, status, error) {
                        alert('Upload failed!');
                    }
                });
            });
        });
    </script>
</body>

</html>
