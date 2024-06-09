<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <x-app.navbar />
    {{-- <a href="{{ route('carousel.index') }}" class="btn btn-sm  btn-white  mb-0 me-1" >Manage media</a> --}}
    <div class="position-relative overflow-hidden">
        <h3 class="text-center">Horizontal Media</h3>
        <div class="swiper mySwiper mt-4 mb-2 swiper-cards swiper-3d swiper-initialized swiper-horizontal swiper-pointer-events swiper-watch-progress">
            <div class="swiper-wrapper" style="cursor: grab; transition-duration: 0ms;">
                @foreach($horizontalItems as $item)
                    <div class="swiper-slide" style="width: 600px;">
                        <div class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                            @if (str_contains($item->media_type, 'image'))
                                <div class="media-container horizontal">
                                    <img src="{{ asset('storage/' . $item->media_path) }}" class="media">
                                    <div class="overlay">
                                        <h5 class="text-white font-weight-bolder">{{ $item->media_type }}</h5>
                                    </div>
                                </div>
                            @else
                                <div class="media-container horizontal">
                                    <video class="media" controls>
                                        <source src="{{ asset('storage/' . $item->media_path) }}" type="{{ $item->media_type }}">
                                    </video>
                                    <div class="overlay">
                                        <h5 class="text-white font-weight-bolder">{{ $item->media_type }}</h5>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"></div>
            <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"></div>
        </div>

        <h3 class="text-center">Vertical Media</h3>
        <div class="swiper mySwiper mt-4 mb-2 swiper-cards swiper-3d swiper-initialized swiper-horizontal swiper-pointer-events swiper-watch-progress">
            <div class="swiper-wrapper" style="cursor: grab; transition-duration: 0ms;">
                @foreach($verticalItems as $item)
                    <div class="swiper-slide" style="width: 600px;">
                        <div class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                            @if (str_contains($item->media_type, 'image'))
                                <div class="media-container vertical">
                                    <img src="{{ asset('storage/' . $item->media_path) }}" class="media">
                                    <div class="overlay">
                                        <h5 class="text-white font-weight-bolder">{{ $item->media_type }}</h5>
                                    </div>
                                </div>
                            @else
                                <div class="media-container vertical">
                                    <video class="media" controls>
                                        <source src="{{ asset('storage/' . $item->media_path) }}" type="{{ $item->media_type }}">
                                    </video>
                                    <div class="overlay">
                                        <h5 class="text-white font-weight-bolder">{{ $item->media_type }}</h5>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"></div>
            <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"></div>
        </div>
    </div>
    </main>
</x-app-layout>

<style>
    .media-container.horizontal {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 56.25%; /* Aspect ratio 16:9 */
        overflow: hidden;
        background: #000;
    }

    .media-container.vertical {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 177.78%; /* Aspect ratio 9:16 */
        overflow: hidden;
        background: #000;
    }

    .media {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: translate(-50%, -50%);
    }

    .overlay {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background: rgba(0, 0, 0, 0.5);
        padding: 5px 10px;
        border-radius: 5px;
    }
</style>
