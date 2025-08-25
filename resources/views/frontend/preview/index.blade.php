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

        .thumb-image-blur {
            filter: blur(4px);
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
                gap: 2rem;
                max-width: 1400px;
                margin: 0 auto;
                padding: 2rem;
            }

            .mobile-layout {
                display: none;
            }

            .sidebar {
                width: 240px;
                flex-shrink: 0;
                position: sticky;
                top: 2rem;
                height: fit-content;
                max-height: calc(100vh - 4rem);
                overflow-y: auto;
                background-color: #ffffff;
                border-radius: 1.5rem;
                padding: 1.5rem;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }

            .main-content {
                flex: 1;
                min-width: 0;
            }

            .content-container {
                display: flex;
                flex-direction: column;
                gap: 3rem;
                align-items: center;
            }

            .single-image-container {
                width: 100%;
                max-width: 600px;
            }

            .dual-image-container {
                width: 100%;
                max-width: 1000px;
            }
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
                flex: 1;
            }

            .swiper-slide {
                width: 100vw;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 1rem;
            }

            .swiper-slide img {
                width: 100%;
                max-width: 100%;
                height: auto;
                max-height: 100%;
                object-fit: contain;
                border-radius: 1rem;
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
                flex: none;
            }

            .mobile-thumbnail-item {
                display: inline-block;
                width: 100px;
                height: 80px;
                margin-right: 1rem;
                flex-shrink: 0;
                border-radius: 0.5rem;
                overflow: hidden;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .mobile-thumbnail-item:last-child {
                margin-right: 0;
            }
        }

        .thumbnail-active {
            border-color: #3b82f6 !important;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .thumbnail-item {
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 0.75rem;
            overflow: hidden;
            border: 2px solid transparent;
        }

        .thumbnail-item:hover {
            transform: scale(1.02);
            opacity: 0.8;
        }

        .dual-images-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0;
        }

        .dual-thumb-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2px;
        }

        .image-container {
            position: relative;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .image-container img {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
        }

        /* Smooth scrolling for the main content */
        .main-content {
            scroll-behavior: smooth;
        }
    </style>
@endpush

@section('content')
    <!-- Header -->
    <section
        class="bg-gradient-to-r from-purple-50 to-purple-50 border-b border-t border-purple-200 px-6 py-4 sticky top-0 z-30">
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

    <!-- Desktop Layout -->
    <div class="desktop-layout hidden lg:flex">
        <!-- Sticky Sidebar with Thumbnails -->
        <div class="sidebar scrollbar-hide">
            <div class="space-y-4">
                <!-- Thumbnail for cover image (single image) -->
                <div id="thumb-0" class="thumbnail-item" data-target="image-0">
                    <div class="relative">
                        <img src="{{ asset('frontend/img/preview/1.jpg') }}" alt="Front Cover"
                            class="w-full aspect-video object-cover thumb-image-blur" data-thumb-id="0">
                        <p class="text-xs text-gray-600 text-center mt-2">Cover</p>
                    </div>
                </div>

                <!-- Thumbnails for dual images (pages 1-8) -->
                <div class="thumbnail-item" data-target="image-1">
                    <div class="dual-thumb-container">
                        <div class="relative">
                            <img src="{{ asset('frontend/img/preview/2.jpg') }}" alt="Page 1"
                                class="w-full aspect-video object-cover thumb-image-blur" data-thumb-id="1a">
                        </div>
                        <div class="relative">
                            <img src="{{ asset('frontend/img/preview/3.jpg') }}" alt="Page 2"
                                class="w-full aspect-video object-cover thumb-image-blur" data-thumb-id="1b">
                        </div>
                    </div>
                    <p class="text-xs text-gray-600 text-center mt-2">Pages 1-2</p>
                </div>

                <div class="thumbnail-item" data-target="image-2">
                    <div class="dual-thumb-container">
                        <div class="relative">
                            <img src="{{ asset('frontend/img/preview/3.jpg') }}" alt="Page 3"
                                class="w-full aspect-video object-cover thumb-image-blur" data-thumb-id="2a">
                        </div>
                        <div class="relative">
                            <img src="{{ asset('frontend/img/preview/4.jpg') }}" alt="Page 4"
                                class="w-full aspect-video object-cover thumb-image-blur" data-thumb-id="2b">
                        </div>
                    </div>
                    <p class="text-xs text-gray-600 text-center mt-2">Pages 3-4</p>
                </div>

                <div class="thumbnail-item" data-target="image-3">
                    <div class="dual-thumb-container">
                        <div class="relative">
                            <img src="{{ asset('frontend/img/preview/4.jpg') }}" alt="Page 5"
                                class="w-full aspect-video object-cover thumb-image-blur" data-thumb-id="3a">
                        </div>
                        <div class="relative">
                            <img src="{{ asset('frontend/img/preview/2.jpg') }}" alt="Page 6"
                                class="w-full aspect-video object-cover thumb-image-blur" data-thumb-id="3b">
                        </div>
                    </div>
                    <p class="text-xs text-gray-600 text-center mt-2">Pages 5-6</p>
                </div>

                <div class="thumbnail-item" data-target="image-4">
                    <div class="dual-thumb-container">
                        <div class="relative">
                            <img src="{{ asset('frontend/img/preview/2.jpg') }}" alt="Page 7"
                                class="w-full aspect-video object-cover thumb-image-blur" data-thumb-id="4a">
                        </div>
                        <div class="relative">
                            <img src="{{ asset('frontend/img/preview/4.jpg') }}" alt="Page 8"
                                class="w-full aspect-video object-cover thumb-image-blur" data-thumb-id="4b">
                        </div>
                    </div>
                    <p class="text-xs text-gray-600 text-center mt-2">Pages 7-8</p>
                </div>

                <!-- Thumbnail for back cover (single image) -->
                <div id="thumb-5" class="thumbnail-item" data-target="image-5">
                    <div class="relative">
                        <img src="{{ asset('frontend/img/preview/5.jpg') }}" alt="Back Cover"
                            class="w-full aspect-video object-cover thumb-image-blur" data-thumb-id="5">
                        <p class="text-xs text-gray-600 text-center mt-2">Back Cover</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area with Images -->
        <div class="main-content">
            <div class="content-container">
                <!-- Cover Image (single) -->
                <div id="image-0" class="single-image-container">
                    <div class="image-container">
                        <img id="img-0" src="{{ asset('frontend/img/preview/1.jpg') }}" alt="Cover"
                            class="w-full aspect-video object-cover image-blur">
                        <div id="overlay-0" class="image-overlay">
                            <div class="loader" id="loader-0"></div>
                        </div>
                    </div>
                </div>

                <!-- Dual Images (Pages 1-2) -->
                <div id="image-1" class="dual-image-container">
                    <div class="image-container">
                        <div class="dual-images-container">
                            <div class="relative">
                                <img id="img-1a" src="{{ asset('frontend/img/preview/2.jpg') }}" alt="Page 1"
                                    class="w-full aspect-video object-cover image-blur">
                                <div id="overlay-1a" class="image-overlay">
                                    <i id="lock-1a" class="fas fa-lock lock-icon"></i>
                                    <div class="loader hidden" id="loader-1a"></div>
                                </div>
                            </div>
                            <div class="relative">
                                <img id="img-1b" src="{{ asset('frontend/img/preview/3.jpg') }}" alt="Page 2"
                                    class="w-full aspect-video object-cover image-blur">
                                <div id="overlay-1b" class="image-overlay">
                                    <i id="lock-1b" class="fas fa-lock lock-icon"></i>
                                    <div class="loader hidden" id="loader-1b"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dual Images (Pages 3-4) -->
                <div id="image-2" class="dual-image-container">
                    <div class="image-container">
                        <div class="dual-images-container">
                            <div class="relative">
                                <img id="img-2a" src="{{ asset('frontend/img/preview/3.jpg') }}" alt="Page 3"
                                    class="w-full aspect-video object-cover image-blur">
                                <div id="overlay-2a" class="image-overlay">
                                    <i id="lock-2a" class="fas fa-lock lock-icon"></i>
                                    <div class="loader hidden" id="loader-2a"></div>
                                </div>
                            </div>
                            <div class="relative">
                                <img id="img-2b" src="{{ asset('frontend/img/preview/4.jpg') }}" alt="Page 4"
                                    class="w-full aspect-video object-cover image-blur">
                                <div id="overlay-2b" class="image-overlay">
                                    <i id="lock-2b" class="fas fa-lock lock-icon"></i>
                                    <div class="loader hidden" id="loader-2b"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dual Images (Pages 5-6) -->
                <div id="image-3" class="dual-image-container">
                    <div class="image-container">
                        <div class="dual-images-container">
                            <div class="relative">
                                <img id="img-3a" src="{{ asset('frontend/img/preview/4.jpg') }}" alt="Page 5"
                                    class="w-full aspect-video object-cover image-blur">
                                <div id="overlay-3a" class="image-overlay">
                                    <i id="lock-3a" class="fas fa-lock lock-icon"></i>
                                    <div class="loader hidden" id="loader-3a"></div>
                                </div>
                            </div>
                            <div class="relative">
                                <img id="img-3b" src="{{ asset('frontend/img/preview/2.jpg') }}" alt="Page 6"
                                    class="w-full aspect-video object-cover image-blur">
                                <div id="overlay-3b" class="image-overlay">
                                    <i id="lock-3b" class="fas fa-lock lock-icon"></i>
                                    <div class="loader hidden" id="loader-3b"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dual Images (Pages 7-8) -->
                <div id="image-4" class="dual-image-container">
                    <div class="image-container">
                        <div class="dual-images-container">
                            <div class="relative">
                                <img id="img-4a" src="{{ asset('frontend/img/preview/2.jpg') }}" alt="Page 7"
                                    class="w-full aspect-video object-cover image-blur">
                                <div id="overlay-4a" class="image-overlay">
                                    <i id="lock-4a" class="fas fa-lock lock-icon"></i>
                                    <div class="loader hidden" id="loader-4a"></div>
                                </div>
                            </div>
                            <div class="relative">
                                <img id="img-4b" src="{{ asset('frontend/img/preview/4.jpg') }}" alt="Page 8"
                                    class="w-full aspect-video object-cover image-blur">
                                <div id="overlay-4b" class="image-overlay">
                                    <i id="lock-4b" class="fas fa-lock lock-icon"></i>
                                    <div class="loader hidden" id="loader-4b"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Back Cover Image (single) -->
                <div id="image-5" class="single-image-container">
                    <div class="image-container">
                        <img id="img-5" src="{{ asset('frontend/img/preview/5.jpg') }}" alt="Back Cover"
                            class="w-full aspect-video object-cover image-blur">
                        <div id="overlay-5" class="image-overlay">
                            <i id="lock-5" class="fas fa-lock lock-icon"></i>
                            <div class="loader hidden" id="loader-5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Layout with Swiper -->
    <div class="mobile-layout lg:hidden">
        <!-- Main image swiper container -->
        <div class="relative swiper mainSwiper">
            <div class="swiper-wrapper">
                <!-- Cover Image -->
                <div class="swiper-slide" data-slide="0">
                    <div class="relative w-full max-w-md mx-auto">
                        <img id="mobile-img-0" src="{{ asset('frontend/img/preview/1.jpg') }}" alt="Cover"
                            class="w-full aspect-video object-cover rounded-lg image-blur">
                        <div id="mobile-overlay-0" class="image-overlay rounded-lg">
                            <div class="loader" id="mobile-loader-0"></div>
                        </div>
                    </div>
                </div>
                <!-- Page 1 -->
                <div class="swiper-slide" data-slide="1">
                    <div class="relative w-full max-w-md mx-auto">
                        <img id="mobile-img-1" src="{{ asset('frontend/img/preview/2.jpg') }}" alt="Page 1"
                            class="w-full aspect-video object-cover rounded-lg image-blur">
                        <div id="mobile-overlay-1" class="image-overlay rounded-lg">
                            <i id="mobile-lock-1" class="fas fa-lock lock-icon"></i>
                            <div class="loader hidden" id="mobile-loader-1"></div>
                        </div>
                    </div>
                </div>
                <!-- Page 2 -->
                <div class="swiper-slide" data-slide="2">
                    <div class="relative w-full max-w-md mx-auto">
                        <img id="mobile-img-2" src="{{ asset('frontend/img/preview/3.jpg') }}" alt="Page 2"
                            class="w-full aspect-video object-cover rounded-lg image-blur">
                        <div id="mobile-overlay-2" class="image-overlay rounded-lg">
                            <i id="mobile-lock-2" class="fas fa-lock lock-icon"></i>
                            <div class="loader hidden" id="mobile-loader-2"></div>
                        </div>
                    </div>
                </div>
                <!-- Page 3 -->
                <div class="swiper-slide" data-slide="3">
                    <div class="relative w-full max-w-md mx-auto">
                        <img id="mobile-img-3" src="{{ asset('frontend/img/preview/3.jpg') }}" alt="Page 3"
                            class="w-full aspect-video object-cover rounded-lg image-blur">
                        <div id="mobile-overlay-3" class="image-overlay rounded-lg">
                            <i id="mobile-lock-3" class="fas fa-lock lock-icon"></i>
                            <div class="loader hidden" id="mobile-loader-3"></div>
                        </div>
                    </div>
                </div>
                <!-- Page 4 -->
                <div class="swiper-slide" data-slide="4">
                    <div class="relative w-full max-w-md mx-auto">
                        <img id="mobile-img-4" src="{{ asset('frontend/img/preview/4.jpg') }}" alt="Page 4"
                            class="w-full aspect-video object-cover rounded-lg image-blur">
                        <div id="mobile-overlay-4" class="image-overlay rounded-lg">
                            <i id="mobile-lock-4" class="fas fa-lock lock-icon"></i>
                            <div class="loader hidden" id="mobile-loader-4"></div>
                        </div>
                    </div>
                </div>
                <!-- Page 5 -->
                <div class="swiper-slide" data-slide="5">
                    <div class="relative w-full max-w-md mx-auto">
                        <img id="mobile-img-5" src="{{ asset('frontend/img/preview/4.jpg') }}" alt="Page 5"
                            class="w-full aspect-video object-cover rounded-lg image-blur">
                        <div id="mobile-overlay-5" class="image-overlay rounded-lg">
                            <i id="mobile-lock-5" class="fas fa-lock lock-icon"></i>
                            <div class="loader hidden" id="mobile-loader-5"></div>
                        </div>
                    </div>
                </div>
                <!-- Page 6 -->
                <div class="swiper-slide" data-slide="6">
                    <div class="relative w-full max-w-md mx-auto">
                        <img id="mobile-img-6" src="{{ asset('frontend/img/preview/2.jpg') }}" alt="Page 6"
                            class="w-full aspect-video object-cover rounded-lg image-blur">
                        <div id="mobile-overlay-6" class="image-overlay rounded-lg">
                            <i id="mobile-lock-6" class="fas fa-lock lock-icon"></i>
                            <div class="loader hidden" id="mobile-loader-6"></div>
                        </div>
                    </div>
                </div>
                <!-- Page 7 -->
                <div class="swiper-slide" data-slide="7">
                    <div class="relative w-full max-w-md mx-auto">
                        <img id="mobile-img-7" src="{{ asset('frontend/img/preview/2.jpg') }}" alt="Page 7"
                            class="w-full aspect-video object-cover rounded-lg image-blur">
                        <div id="mobile-overlay-7" class="image-overlay rounded-lg">
                            <i id="mobile-lock-7" class="fas fa-lock lock-icon"></i>
                            <div class="loader hidden" id="mobile-loader-7"></div>
                        </div>
                    </div>
                </div>
                <!-- Page 8 -->
                <div class="swiper-slide" data-slide="8">
                    <div class="relative w-full max-w-md mx-auto">
                        <img id="mobile-img-8" src="{{ asset('frontend/img/preview/4.jpg') }}" alt="Page 8"
                            class="w-full aspect-video object-cover rounded-lg image-blur">
                        <div id="mobile-overlay-8" class="image-overlay rounded-lg">
                            <i id="mobile-lock-8" class="fas fa-lock lock-icon"></i>
                            <div class="loader hidden" id="mobile-loader-8"></div>
                        </div>
                    </div>
                </div>
                <!-- Back Cover -->
                <div class="swiper-slide" data-slide="9">
                    <div class="relative w-full max-w-md mx-auto">
                        <img id="mobile-img-9" src="{{ asset('frontend/img/preview/5.jpg') }}" alt="Back Cover"
                            class="w-full aspect-video object-cover rounded-lg image-blur">
                        <div id="mobile-overlay-9" class="image-overlay rounded-lg">
                            <i id="mobile-lock-9" class="fas fa-lock lock-icon"></i>
                            <div class="loader hidden" id="mobile-loader-9"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Horizontal mobile thumbnail bar -->
        <div class="mobile-thumbnails scrollbar-hide">
            <div class="flex space-x-4">
                <div class="mobile-thumbnail-item border-2 border-transparent" data-index="0">
                    <img src="{{ asset('frontend/img/preview/1.jpg') }}" alt="Cover"
                        class="w-full h-full object-cover thumb-image-blur" data-mobile-thumb-id="0">
                </div>
                <div class="mobile-thumbnail-item border-2 border-transparent" data-index="1">
                    <img src="{{ asset('frontend/img/preview/2.jpg') }}" alt="Page 1"
                        class="w-full h-full object-cover thumb-image-blur" data-mobile-thumb-id="1">
                </div>
                <div class="mobile-thumbnail-item border-2 border-transparent" data-index="2">
                    <img src="{{ asset('frontend/img/preview/3.jpg') }}" alt="Page 2"
                        class="w-full h-full object-cover thumb-image-blur" data-mobile-thumb-id="2">
                </div>
                <div class="mobile-thumbnail-item border-2 border-transparent" data-index="3">
                    <img src="{{ asset('frontend/img/preview/3.jpg') }}" alt="Page 3"
                        class="w-full h-full object-cover thumb-image-blur" data-mobile-thumb-id="3">
                </div>
                <div class="mobile-thumbnail-item border-2 border-transparent" data-index="4">
                    <img src="{{ asset('frontend/img/preview/4.jpg') }}" alt="Page 4"
                        class="w-full h-full object-cover thumb-image-blur" data-mobile-thumb-id="4">
                </div>
                <div class="mobile-thumbnail-item border-2 border-transparent" data-index="5">
                    <img src="{{ asset('frontend/img/preview/4.jpg') }}" alt="Page 5"
                        class="w-full h-full object-cover thumb-image-blur" data-mobile-thumb-id="5">
                </div>
                <div class="mobile-thumbnail-item border-2 border-transparent" data-index="6">
                    <img src="{{ asset('frontend/img/preview/2.jpg') }}" alt="Page 6"
                        class="w-full h-full object-cover thumb-image-blur" data-mobile-thumb-id="6">
                </div>
                <div class="mobile-thumbnail-item border-2 border-transparent" data-index="7">
                    <img src="{{ asset('frontend/img/preview/2.jpg') }}" alt="Page 7"
                        class="w-full h-full object-cover thumb-image-blur" data-mobile-thumb-id="7">
                </div>
                <div class="mobile-thumbnail-item border-2 border-transparent" data-index="8">
                    <img src="{{ asset('frontend/img/preview/4.jpg') }}" alt="Page 8"
                        class="w-full h-full object-cover thumb-image-blur" data-mobile-thumb-id="8">
                </div>
                <div class="mobile-thumbnail-item border-2 border-transparent" data-index="9">
                    <img src="{{ asset('frontend/img/preview/5.jpg') }}" alt="Back Cover"
                        class="w-full h-full object-cover thumb-image-blur" data-mobile-thumb-id="9">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Image state management
        const imageStates = {
            // Desktop images
            desktop: {
                'img-0': {
                    isLocked: false,
                    loaderActive: true,
                    thumbId: '0'
                },
                'img-1a': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '1a'
                },
                'img-1b': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '1b'
                },
                'img-2a': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '2a'
                },
                'img-2b': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '2b'
                },
                'img-3a': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '3a'
                },
                'img-3b': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '3b'
                },
                'img-4a': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '4a'
                },
                'img-4b': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '4b'
                },
                'img-5': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '5'
                }
            },
            // Mobile images
            mobile: {
                'mobile-img-0': {
                    isLocked: false,
                    loaderActive: true,
                    thumbId: '0'
                },
                'mobile-img-1': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '1'
                },
                'mobile-img-2': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '2'
                },
                'mobile-img-3': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '3'
                },
                'mobile-img-4': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '4'
                },
                'mobile-img-5': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '5'
                },
                'mobile-img-6': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '6'
                },
                'mobile-img-7': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '7'
                },
                'mobile-img-8': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '8'
                },
                'mobile-img-9': {
                    isLocked: true,
                    loaderActive: false,
                    thumbId: '9'
                }
            }
        };

        // Initialize image states on page load
        function initializeImageStates() {
            // Desktop initialization
            Object.keys(imageStates.desktop).forEach(function(imgId) {
                const state = imageStates.desktop[imgId];
                const imgElement = $(`#${imgId}`);
                const overlay = imgElement.closest('.relative').find('.image-overlay');
                const loader = overlay.find('.loader');
                const lockIcon = overlay.find('.lock-icon');

                // Apply blur to all images initially
                imgElement.addClass('image-blur');

                if (state.isLocked) {
                    // Locked images show lock icon
                    lockIcon.removeClass('hidden');
                    loader.addClass('hidden');
                    console.log('Locked:', imgId);
                } else {
                    // Unlocked images (cover) show loader initially
                    lockIcon.addClass('hidden');
                    loader.removeClass('hidden');
                    console.log('Unlocked:', imgId);

                    // Auto-unlock cover after 1 minute (60000ms)
                    setTimeout(function() {
                        unlockImage(imgId, 'desktop');
                    }, 1000);
                }
            });

            // Mobile initialization
            Object.keys(imageStates.mobile).forEach(function(imgId) {
                const state = imageStates.mobile[imgId];
                const imgElement = $(`#${imgId}`);
                const overlay = imgElement.closest('.relative').find('.image-overlay');
                const loader = overlay.find('.loader');
                const lockIcon = overlay.find('.lock-icon');

                // Apply blur to all images initially
                imgElement.addClass('image-blur');

                if (state.isLocked) {
                    // Locked images show lock icon
                    lockIcon.removeClass('hidden');
                    loader.addClass('hidden');
                } else {
                    // Unlocked images (cover) show loader initially
                    lockIcon.addClass('hidden');
                    loader.removeClass('hidden');

                    // Auto-unlock cover after 1 minute (60000ms)
                    setTimeout(function() {
                        unlockImage(imgId, 'mobile');
                    }, 60000);
                }
            });

            // Initialize all thumbnails as blurred
            $('.thumb-image-blur').addClass('thumb-image-blur');
        }

        // Unlock image function
        function unlockImage(imageId, type) {
            const state = imageStates[type][imageId];
            if (!state) return;

            const imgElement = $(`#${imageId}`);
            const overlay = imgElement.closest('.relative').find('.image-overlay');
            const loader = overlay.find('.loader');
            const lockIcon = overlay.find('.lock-icon');

            // Update state
            state.isLocked = false;
            state.loaderActive = true;

            // Show loader, hide lock
            lockIcon.addClass('hidden!');
            loader.removeClass('hidden');

            // Simulate loading time (5-10 seconds)
            const loadingTime = Math.random() * (10000 - 5000) + 5000;

            setTimeout(function() {
                // Remove blur and hide overlay
                imgElement.removeClass('image-blur');
                overlay.hide();

                // Update state
                state.loaderActive = false;
                console.log('Unlocked:', imageId);
                loader.addClass('hidden!');
                console.log('Loading complete for:', imageId, loader);

                // Remove blur from corresponding thumbnail
                removeThumbBlur(state.thumbId, type);
            }, loadingTime);
        }

        // Remove thumbnail blur
        function removeThumbBlur(thumbId, type) {
            if (type === 'desktop') {
                $(`[data-thumb-id="${thumbId}"]`).removeClass('thumb-image-blur');
            } else {
                $(`[data-mobile-thumb-id="${thumbId}"]`).removeClass('thumb-image-blur');
            }
        }

        // Smooth scroll to target element
        function scrollToElement(targetId) {
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                const headerHeight = 120; // Account for sticky header
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerHeight;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        }

        $(document).ready(function() {
            // Initialize image states
            initializeImageStates();

            // Set first thumbnail as active
            $('#thumb-0').addClass('thumbnail-active');
            $('.mobile-thumbnail-item[data-index="0"]').addClass('thumbnail-active');

            // Desktop thumbnail click handler
            $('.thumbnail-item').on('click', function() {
                const targetId = $(this).data('target');

                // Remove active class from all thumbnails and add to clicked one
                $('.thumbnail-item').removeClass('thumbnail-active');
                $(this).addClass('thumbnail-active');

                // Scroll to target image
                scrollToElement(targetId);
            });

            // Desktop lock icon click handler
            $(document).on('click', '.lock-icon:not([id^="mobile-"])', function() {
                const lockId = $(this).attr('id');
                const imageId = lockId.replace('lock-', 'img-');
                unlockImage(imageId, 'desktop');
            });

            // Mobile lock icon click handler
            $(document).on('click', '.lock-icon[id^="mobile-"]', function() {
                const lockId = $(this).attr('id');
                const imageId = lockId.replace('lock-', 'img-');
                unlockImage(imageId, 'mobile');
            });

            // Initialize Swiper for mobile
            const swiper = new Swiper('.mainSwiper', {
                loop: false,
                slidesPerView: 1,
                spaceBetween: 0,
                centeredSlides: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                on: {
                    slideChange: function() {
                        const activeIndex = this.activeIndex;
                        $('.mobile-thumbnail-item').removeClass('thumbnail-active');
                        $(`.mobile-thumbnail-item[data-index="${activeIndex}"]`).addClass(
                            'thumbnail-active');

                        // Auto-scroll thumbnail into view
                        const activeThumbnail = $(
                            `.mobile-thumbnail-item[data-index="${activeIndex}"]`)[0];
                        if (activeThumbnail) {
                            activeThumbnail.scrollIntoView({
                                behavior: 'smooth',
                                block: 'nearest',
                                inline: 'center'
                            });
                        }
                    }
                }
            });

            // Mobile thumbnail click handler
            $('.mobile-thumbnail-item').on('click', function() {
                const index = parseInt($(this).data('index'));
                swiper.slideTo(index);

                $('.mobile-thumbnail-item').removeClass('thumbnail-active');
                $(this).addClass('thumbnail-active');
            });

            // Intersection Observer for desktop thumbnail highlighting
            if (window.IntersectionObserver) {
                const observerOptions = {
                    root: null,
                    rootMargin: '-20% 0px -70% 0px',
                    threshold: 0.1
                };

                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            const targetId = entry.target.id;
                            $('.thumbnail-item').removeClass('thumbnail-active');
                            $(`.thumbnail-item[data-target="${targetId}"]`).addClass(
                                'thumbnail-active');
                        }
                    });
                }, observerOptions);

                // Observe all main image containers
                $('#image-0, #image-1, #image-2, #image-3, #image-4, #image-5').each(function() {
                    observer.observe(this);
                });
            }

            // Handle window resize to maintain sticky behavior
            $(window).on('resize', function() {
                // Force recalculation of sticky positioning
                $('.sidebar').css('position', 'relative').height();
                $('.sidebar').css('position', 'sticky');
            });
        });
    </script>
@endpush
