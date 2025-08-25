@extends('frontend.layouts.master')

@push('styles')
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Swiper JS for Mobile View -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            background-color: #f3f4f6;
        }

        /* Hide scrollbar for the main content area */
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .image-blur {
            filter: blur(8px);
            transition: filter 0.5s ease-in-out;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.3);
            z-index: 10;
        }

        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3b82f6;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .lock-icon {
            font-size: 3rem;
            color: #ffffff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .lock-icon:hover {
            transform: scale(1.1);
            color: #3b82f6;
        }

        .unlock-icon {
            font-size: 3rem;
            color: #10b981;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        /* Desktop specific styles */
        @media (min-width: 1024px) {
            .desktop-layout {
                display: flex;
            }

            .mobile-layout {
                display: none;
            }

            /* .sidebar {
                    width: 15rem;
                    height: calc(100vh - 80px);
                    position: sticky;
                    top: 80px;
                    left: 0;
                    padding: 1.5rem;
                    background-color: #f9fafb;
                    overflow-y: auto;
                } */

            /* .main-content {
                    margin-left: 15rem;
                    padding: 2rem;
                    width: calc(100% - 15rem);
                } */
        }

        /* Mobile specific styles */
        @media (max-width: 1023px) {
            .desktop-layout {
                display: none;
            }

            .mobile-layout {
                display: flex;
                flex-direction: column;
                height: 100vh;
                width: 100vw;
            }

            .mainSwiper {
                width: 100%;
                /* Flex-1 makes it fill available space */
                flex: 1;
            }

            .swiper-slide {
                width: 100vw;
                height: 100%;
                /* Ensure the slide takes full height of the swiper container */
            }

            .swiper-slide img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .mobile-thumbnails {
                background-color: #ffffff;
                padding: 1rem;
                box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.1);
                z-index: 50;
                border-top-left-radius: 1rem;
                border-top-right-radius: 1rem;
                overflow-x: auto;
                white-space: nowrap;
                /* Flex-none prevents the thumbnails from growing or shrinking */
                flex: none;
            }

            .mobile-thumbnail-item {
                display: inline-block;
                width: 100px;
                height: 80px;
                margin-right: 1rem;
                flex-shrink: 0;
            }
        }

        .thumbnail-active {
            border-color: #3b82f6;
            transform: scale(1.05);
        }

        .thumbnail-item {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .thumbnail-item:hover {
            transform: scale(1.02);
            opacity: 0.8;
        }

        .dual-images-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }
    </style>
@endpush

@section('content')
    <!-- Header -->
    <section
        class=" bg-gradient-to-r from-purple-50 to-purple-50 border-b border-t border-purple-200 px-6 py-4 sticky top-0 z-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">
                <div class="flex items-center gap-4">
                    <h2 class="text-sm sm:text-xl font-semibold text-purple-900">The Magical Adventure of Luna</h2>
                </div>
                <div class="flex items-center text-sm text-purple-700">
                    First Name: <span class="font-medium">Child name</span> | Age: <span class="font-medium">Child
                        age</span>
                </div>
                <button
                    class="border border-purple-300 text-purple-700 hover:bg-purple-50 bg-transparent px-4 py-2 rounded-md transition-colors">
                    Change
                </button>
            </div>
        </div>
    </section>

    <div class="container mx-auto">
        <!-- Desktop Layout -->
        <div class="desktop-layout hidden lg:flex relative">
            <!-- Sticky Sidebar with Thumbnails -->
            <div
                class="sidebar scrollbar-hide rounded-3xl w-full max-w-56 p-6 shadow-md sticky top-40 left-0">
                <div class="space-y-4">
                    <!-- Thumbnail for first image (single image) -->
                    <div id="thumb-0"
                        class="thumbnail-item relative w-full border-2 border-transparent px-6 rounded-lg transition-all duration-300">
                        <div class="relative overflow-hidden">
                            <img src="{{asset('frontend/img/preview/1.jpg')}}" alt="Front Cover"
                                class="w-full h-full aspect-video object-cover" data-target="image-0">
                            <span class="absolute inset-0 backdrop-blur-xs bg-black/30"></span>
                        </div>
                        <p class="text-xs text-gray-600 text-center">Cover</p>
                    </div>

                    <!-- Thumbnails for dual images (1-4) -->
                    <div class="thumbnail-item relative w-full transition-all duration-300 shadow border-2 border-transparent"
                        data-target="image-1">
                        <div class="grid grid-cols-2">
                            <div>
                                <div class="relative">
                                    <img src="{{asset('frontend/img/preview/2.jpg')}}" alt="Thumbnail 2a"
                                        class="w-full aspect-video object-cover">
                                    <span class="absolute inset-0 backdrop-blur-xs bg-black/30"></span>
                                </div>
                                <p class="text-xs text-gray-600 text-center">Page 1</p>
                            </div>
                            <div>
                                <div class="relative">
                                    <img src="{{asset('frontend/img/preview/3.jpg')}}" alt="Thumbnail 2b"
                                        class="w-full aspect-video object-cover">
                                    <span class="absolute inset-0 backdrop-blur-xs bg-black/30"></span>
                                </div>
                                <p class="text-xs text-gray-600 text-center">Page 2</p>
                            </div>
                        </div>
                    </div>
                    <div class="thumbnail-item relative w-full transition-all duration-300 shadow border-2 border-transparent"
                        data-target="image-2">
                        <div class="grid grid-cols-2">
                            <div>
                                <div class="relative">
                                    <img src="{{asset('frontend/img/preview/3.jpg')}}" alt="Thumbnail 3a"
                                        class="w-full object-cover aspect-video">
                                    <span class="absolute inset-0 backdrop-blur-xs bg-black/30"></span>
                                </div>
                                <p class="text-xs text-gray-600 text-center">Page 3</p>
                            </div>
                            <div>
                                <div class="relative">
                                    <img src="{{asset('frontend/img/preview/4.jpg')}}" alt="Thumbnail 3b"
                                        class="w-full object-cover aspect-video">
                                    <span class="absolute inset-0 backdrop-blur-xs bg-black/30"></span>
                                </div>
                                <p class="text-xs text-gray-600 text-center">Page 4</p>
                            </div>
                        </div>
                    </div>
                    <div class="thumbnail-item relative w-full transition-all duration-300 shadow border-2 border-transparent"
                        data-target="image-3">
                        <div class="grid grid-cols-2">
                            <div>
                                <div class="relative">
                                    <img src="{{asset('frontend/img/preview/4.jpg')}}" alt="Thumbnail 4a"
                                        class="w-full object-cover aspect-video">
                                    <span class="absolute inset-0 backdrop-blur-xs bg-black/30"></span>
                                </div>
                                <p class="text-xs text-gray-600 text-center">Page 5</p>
                            </div>
                            <div>
                                <div class="relative">
                                    <img src="{{asset('frontend/img/preview/2.jpg')}}" alt="Thumbnail 4b"
                                        class="w-full object-cover aspect-video">
                                    <span class="absolute inset-0 backdrop-blur-xs bg-black/30"></span>
                                </div>
                                <p class="text-xs text-gray-600 text-center">Page 6</p>
                            </div>
                        </div>
                    </div>
                    <div class="thumbnail-item relative w-full transition-all duration-300 shadow border-2 border-transparent"
                        data-target="image-4">
                        <div class="grid grid-cols-2">
                            <div>
                                <div class="relative">
                                    <img src="{{asset('frontend/img/preview/2.jpg')}}" alt="Thumbnail 5a"
                                        class="w-full object-cover aspect-video">
                                    <span class="absolute inset-0 backdrop-blur-xs bg-black/30"></span>
                                </div>
                                <p class="text-xs text-gray-600 text-center">Page 7</p>
                            </div>
                            <div>
                                <div class="relative">
                                    <img src="{{asset('frontend/img/preview/4.jpg')}}" alt="Thumbnail 5b"
                                        class="w-full object-cover aspect-video">
                                    <span class="absolute inset-0 backdrop-blur-xs bg-black/30"></span>
                                </div>
                                <p class="text-xs text-gray-600 text-center">Page 8</p>
                            </div>
                        </div>
                    </div>

                    <!-- Thumbnail for last image (single image) -->
                    <div id="thumb-5"
                        class="thumbnail-item relative w-full border-2 border-transparent px-6 rounded-lg transition-all duration-300"
                        data-target="image-5">
                        <div class="relative">
                            <img src="{{asset('frontend/img/preview/5.jpg')}}" alt="Back Cover"
                                class="w-full h-full aspect-video object-cover" data-target="image-5">
                            <span class="absolute inset-0 backdrop-blur-xs bg-black/30"></span>
                        </div>
                        <p class="text-xs text-gray-600 text-center">Back Cover</p>
                    </div>
                </div>
            </div>

            <!-- Main Content Area with Images -->
            <div class="flex-1 scrollbar-hide space-y-8 flex flex-col items-center p-6">
                <!-- First Image (single) -->
                <div id="image-0" class="w-full max-w-xl relative rounded-2xl overflow-hidden shadow-xl">
                    <img id="img-0" src="{{asset('frontend/img/preview/1.jpg')}}" alt="Image 1"
                        class="w-full aspect-video object-cover rounded-2xl image-blur">
                    <div id="overlay-0" class="image-overlay">
                        <i id="lock-0" class="fas fa-lock lock-icon hidden!"></i>
                        <div class="loader" id="loader-0"></div>
                    </div>
                </div>

                <!-- Dual Images (1-4) -->
                <div id="image-1" class="w-full max-w-5xl relative rounded-2xl overflow-hidden shadow-xl">
                    <div class="dual-images-container">
                        <div class="relative">
                            <img id="img-1a" src="{{asset('frontend/img/preview/2.jpg')}}"
                                alt="Image 2a" class="w-full aspect-video object-cover rounded-tl-2xl rounded-bl-2xl">
                            <div id="overlay-1a" class="image-overlay">
                                <i id="lock-1a" class="fas fa-lock lock-icon"></i>
                                <div class="loader hidden" id="loader-1a"></div>
                            </div>
                        </div>
                        <div class="relative">
                            <img id="img-1b" src="{{asset('frontend/img/preview/3.jpg')}}"
                                alt="Image 2b" class="w-full aspect-video object-cover rounded-tr-2xl rounded-br-2xl">
                            <div id="overlay-1b" class="image-overlay">
                                <i id="lock-1b" class="fas fa-lock lock-icon"></i>
                                <div class="loader hidden" id="loader-1b"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="image-2" class="w-full max-w-5xl relative rounded-2xl overflow-hidden shadow-xl">
                    <div class="dual-images-container">
                        <div class="relative">
                            <img id="img-2a" src="{{asset('frontend/img/preview/3.jpg')}}"
                                alt="Image 3a" class="w-full aspect-video object-cover rounded-tl-2xl rounded-bl-2xl">
                            <div id="overlay-2a" class="image-overlay">
                                <i id="lock-2a" class="fas fa-lock lock-icon"></i>
                                <div class="loader hidden" id="loader-2a"></div>
                            </div>
                        </div>
                        <div class="relative">
                            <img id="img-2b" src="{{asset('frontend/img/preview/4.jpg')}}"
                                alt="Image 3b" class="w-full aspect-video object-cover rounded-tr-2xl rounded-br-2xl">
                            <div id="overlay-2b" class="image-overlay">
                                <i id="lock-2b" class="fas fa-lock lock-icon"></i>
                                <div class="loader hidden" id="loader-2b"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="image-3" class="w-full max-w-5xl relative rounded-2xl overflow-hidden shadow-xl">
                    <div class="dual-images-container">
                        <div class="relative">
                            <img id="img-3a" src="{{asset('frontend/img/preview/4.jpg')}}"
                                alt="Image 4a" class="w-full aspect-video object-cover rounded-tl-2xl rounded-bl-2xl">
                            <div id="overlay-3a" class="image-overlay">
                                <i id="lock-3a" class="fas fa-lock lock-icon"></i>
                                <div class="loader hidden" id="loader-3a"></div>
                            </div>
                        </div>
                        <div class="relative">
                            <img id="img-3b" src="{{asset('frontend/img/preview/2.jpg')}}"
                                alt="Image 4b" class="w-full aspect-video object-cover rounded-tr-2xl rounded-br-2xl">
                            <div id="overlay-3b" class="image-overlay">
                                <i id="lock-3b" class="fas fa-lock lock-icon"></i>
                                <div class="loader hidden" id="loader-3b"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="image-4" class="w-full max-w-5xl relative rounded-2xl overflow-hidden shadow-xl">
                    <div class="dual-images-container">
                        <div class="relative">
                            <img id="img-4a" src="{{asset('frontend/img/preview/2.jpg')}}"
                                alt="Image 5a" class="w-full aspect-video object-cover rounded-tl-2xl rounded-bl-2xl">
                            <div id="overlay-4a" class="image-overlay">
                                <i id="lock-4a" class="fas fa-lock lock-icon"></i>
                                <div class="loader hidden" id="loader-4a"></div>
                            </div>
                        </div>
                        <div class="relative">
                            <img id="img-4b" src="{{asset('frontend/img/preview/4.jpg')}}"
                                alt="Image 5b" class="w-full aspect-video object-cover rounded-tr-2xl rounded-br-2xl">
                            <div id="overlay-4b" class="image-overlay">
                                <i id="lock-4b" class="fas fa-lock lock-icon"></i>
                                <div class="loader hidden" id="loader-4b"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Last Image (single) -->
                <div id="image-5" class="w-full max-w-xl relative rounded-2xl overflow-hidden shadow-xl">
                    <img id="img-5" src="{{asset('frontend/img/preview/5.jpg')}}" alt="Image 6"
                        class="w-full aspect-video object-cover rounded-2xl">
                    <div id="overlay-5" class="image-overlay">
                        <i id="lock-5" class="fas fa-lock lock-icon"></i>
                        <div class="loader hidden" id="loader-5"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Layout with Swiper and new thumbnail bar -->
        <div class="mobile-layout lg:hidden flex flex-col h-screen">
            <!-- Main image swiper container -->
            <div class="relative swiper mainSwiper flex-1">
                <!-- Main image slides -->
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="https://placehold.co/600x400/3b82f6/FFFFFF?text=Image+1"
                            class="w-full h-full object-cover main-image" alt="Image 1">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://placehold.co/600x400/94a3b8/FFFFFF?text=Image+2"
                            class="w-full h-full object-cover main-image" alt="Image 2">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://placehold.co/600x400/e2e8f0/FFFFFF?text=Image+3"
                            class="w-full h-full object-cover main-image" alt="Image 3">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://placehold.co/600x400/94a3b8/FFFFFF?text=Image+4"
                            class="w-full h-full object-cover main-image" alt="Image 4">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://placehold.co/600x400/e2e8f0/FFFFFF?text=Image+5"
                            class="w-full h-full object-cover main-image" alt="Image 5">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://placehold.co/600x400/4c4c4c/FFFFFF?text=Image+6"
                            class="w-full h-full object-cover main-image" alt="Image 6">
                    </div>
                </div>
            </div>

            <!-- Horizontal mobile thumbnail bar -->
            <div id="mobileThumbnails" class="mobile-thumbnails scrollbar-hide flex-none">
                <div class="flex space-x-4">
                    <!-- Thumbnail for first image -->
                    <div class="mobile-thumbnail-item relative overflow-hidden rounded-lg border-2 border-transparent transition-all duration-300"
                        data-index="0">
                        <img src="https://placehold.co/600x400/3b82f6/FFFFFF?text=Image+1" alt="Thumbnail 1"
                            class="w-full h-full object-cover rounded-md">
                    </div>

                    <!-- Thumbnails for the rest of the images -->
                    <div class="mobile-thumbnail-item relative overflow-hidden rounded-lg border-2 border-transparent transition-all duration-300"
                        data-index="1">
                        <img src="https://placehold.co/600x400/94a3b8/FFFFFF?text=Image+2" alt="Thumbnail 2"
                            class="w-full h-full object-cover rounded-md">
                    </div>
                    <div class="mobile-thumbnail-item relative overflow-hidden rounded-lg border-2 border-transparent transition-all duration-300"
                        data-index="2">
                        <img src="https://placehold.co/600x400/e2e8f0/FFFFFF?text=Image+3" alt="Thumbnail 3"
                            class="w-full h-full object-cover rounded-md">
                    </div>
                    <div class="mobile-thumbnail-item relative overflow-hidden rounded-lg border-2 border-transparent transition-all duration-300"
                        data-index="3">
                        <img src="https://placehold.co/600x400/94a3b8/FFFFFF?text=Image+4" alt="Thumbnail 4"
                            class="w-full h-full object-cover rounded-md">
                    </div>
                    <div class="mobile-thumbnail-item relative overflow-hidden rounded-lg border-2 border-transparent transition-all duration-300"
                        data-index="4">
                        <img src="https://placehold.co/600x400/e2e8f0/FFFFFF?text=Image+5" alt="Thumbnail 5"
                            class="w-full h-full object-cover rounded-md">
                    </div>
                    <div class="mobile-thumbnail-item relative overflow-hidden rounded-lg border-2 border-transparent transition-all duration-300"
                        data-index="5">
                        <img src="https://placehold.co/600x400/4c4c4c/FFFFFF?text=Image+6" alt="Thumbnail 6"
                            class="w-full h-full object-cover rounded-md">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Array to manage the state of each image for locking/loading
        const imageStates = [
            // Image 0 (single)
            {
                id: 'img-0',
                isLocked: true,
                loaderActive: false,
                lockId: 'lock-0'
            },
            // Image 1 (dual)
            {
                id: 'img-1a',
                isLocked: true,
                loaderActive: false,
                lockId: 'lock-1a'
            },
            {
                id: 'img-1b',
                isLocked: true,
                loaderActive: false,
                lockId: 'lock-1b'
            },
            // Image 2 (dual)
            {
                id: 'img-2a',
                isLocked: true,
                loaderActive: false,
                lockId: 'lock-2a'
            },
            {
                id: 'img-2b',
                isLocked: true,
                loaderActive: false,
                lockId: 'lock-2b'
            },
            // Image 3 (dual)
            {
                id: 'img-3a',
                isLocked: true,
                loaderActive: false,
                lockId: 'lock-3a'
            },
            {
                id: 'img-3b',
                isLocked: true,
                loaderActive: false,
                lockId: 'lock-3b'
            },
            // Image 4 (dual)
            {
                id: 'img-4a',
                isLocked: true,
                loaderActive: false,
                lockId: 'lock-4a'
            },
            {
                id: 'img-4b',
                isLocked: true,
                loaderActive: false,
                lockId: 'lock-4b'
            },
            // Image 5 (single)
            {
                id: 'img-5',
                isLocked: true,
                loaderActive: false,
                lockId: 'lock-5'
            }
        ];

        // This function sets the initial state of the images on page load
        function initializeImageStates() {
            // Loop through each image state to apply initial styling
            $.each(imageStates, function(index, state) {
                const imgElement = $(`#${state.id}`);
                const lockIcon = state.lockId ? $(`#${state.lockId}`) : null;
                const overlay = imgElement.closest('.relative').find('.image-overlay');
                const loader = overlay.find('.loader');

                if (index === 0) {
                    // First image is blurred and has a loader active
                    imgElement.addClass('image-blur');
                    overlay.show();
                    loader.removeClass('hidden');

                    // Set a timeout for the first image to unlock after 1 minute
                    setTimeout(function() {
                        imgElement.removeClass('image-blur');
                        overlay.hide();
                    }, 1000); // 1 minute
                } else {
                    // All other images are locked and blurred
                    imgElement.addClass('image-blur');
                    if (lockIcon) {
                        lockIcon.removeClass('hidden');
                    }
                    loader.addClass('hidden');
                }
            });
        }

        // Handle the unlocking of a single image when its lock icon is clicked
        function unlockImage(id) {
            // Find the state object for the clicked image
            const state = imageStates.find(s => s.lockId === id);
            if (!state || !state.isLocked) return;

            // Find the relevant DOM elements
            const lockIcon = $(`#${state.lockId}`);
            const loader = $(`#loader-${state.lockId.substring(5)}`);
            const image = $(`#${state.id}`);

            // Update the state to indicate a loading state
            state.isLocked = false;
            state.loaderActive = true;

            // Show the loader and hide the lock icon
            lockIcon.addClass('hidden!');
            loader.removeClass('hidden');

            // Simulate a loading delay between 3 and 5 seconds
            const delay = Math.random() * (5000 - 3000) + 3000;
            setTimeout(function() {
                // After the delay, remove the blur and hide the loader
                image.removeClass('image-blur');
                loader.addClass('hidden');
                // The overlay will hide because there are no visible elements inside it
                // We'll explicitly hide it to be safe.
                image.closest('.relative').find('.image-overlay').hide();

                // Update the state to indicate it's no longer loading
                state.loaderActive = false;
            }, delay);
        }

        $(document).ready(function() {
            // Initial setup of image states
            initializeImageStates();

            // Set the first thumbnail as active initially
            $('#thumb-0').addClass('thumbnail-active');
            $('.mobile-thumbnail-item[data-index="0"]').addClass('thumbnail-active');

            // When a thumbnail is clicked, scroll the main content to the corresponding image
            $('.thumbnail-item').on('click', function() {
                // Find the ID of the main image to scroll to
                const targetId = $(this).data('target');
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    // Use the native scrollIntoView method for smoother and more reliable scrolling
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }

                // Update the active class on the thumbnails
                $('.thumbnail-item').removeClass('thumbnail-active');
                $(this).addClass('thumbnail-active');
            });

            // Handle clicks on the lock icons
            $(document).on('click', '.lock-icon', function() {
                const lockId = $(this).attr('id');
                unlockImage(lockId);
            });

            // Initialize Swiper for mobile view
            const swiper = new Swiper('.mainSwiper', {
                // Keep the loop for seamless swiping
                loop: true,
                // Autoplay is removed as per a previous request, but can be added back
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                // The 'effect' property is removed to allow swiping
                // Navigation buttons are removed for mobile, so this is no longer needed
                navigation: false,
                // Pagination is removed
                pagination: false,
            });

            // Attach the slideChange listener *after* the Swiper instance is created
            swiper.on('slideChange', function() {
                const activeIndex = swiper.realIndex;
                $('.mobile-thumbnail-item').removeClass('thumbnail-active');
                $(`.mobile-thumbnail-item[data-index="${activeIndex}"]`).addClass('thumbnail-active');
            });

            // Handle mobile thumbnail item clicks to change the swiper slide
            $('.mobile-thumbnail-item').on('click', function() {
                const index = $(this).data('index');
                swiper.slideToLoop(index);
            });

            // Handle mobile menu toggle
            $('#menu-button').on('click', function() {
                $('#mobile-menu').toggleClass('hidden');
            });
        });
    </script>
@endpush
