<div class="container mt-5">
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following issues:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="images" class="form-label">Select Images</label>
            <input type="file" name="images[]" id="images" class="block w-full" multiple required
                accept="image/*">
        </div>
        <div class="d-grid gap-2 col-6">
            <button type="submit" class="btn btn-outline-primary">Upload</button>
        </div>
    </form>
</div>