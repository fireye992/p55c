<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <h1>Add Item to Carousel</h1>
            <form action="{{ route('carousel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="media">Media</label>
                    <input type="file" name="media" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Add to Carousel</button>
            </form>
        </div>
    </main>
</x-app-layout>