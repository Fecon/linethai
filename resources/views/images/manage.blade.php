<div class="container mt-4">
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('upload') }}" class="btn btn-outline-primary me-2">Upload Images</a>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-success">Manage Images</a>
    </div>
</div>
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success my-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse ($images as $image)
            <div class="col-md-2 mb-2">
                <div class="card">
                    <img src="{{ asset($image->image_path) }}" class="card-img-top" alt="{{ $image->title }}">
                    <div class="card-body text-center">
                        <form action="{{ route('images.destroy', $image->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No images uploaded yet.</p>
        @endforelse
    </div>
</div>
