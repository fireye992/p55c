<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">

            <h1>Manage Carousel</h1>
            <a href="{{ route('carousel.create') }}" class="btn btn-primary">Add Item</a>
            <ul class="list-group mt-3">
                @foreach ($items as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @if (str_contains($item->media_type, 'image'))
                            <img src="{{ asset('storage/' . $item->media_path) }}" alt="Media" width="100">
                        @else
                            <video width="100" controls>
                                <source src="{{ asset('storage/' . $item->media_path) }}"
                                    type="{{ $item->media_type }}">
                            </video>
                        @endif
                        <form action="{{ route('carousel.destroy', $item) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </main>
</x-app-layout>
