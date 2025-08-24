@extends('frontend.layouts.master')

@push('styles')

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

    <section class="bg-white">
        <div class="container mx-auto">
            <div class="grid grid-cols-12 gap-4 sm:gap-8 p-6">
                <div class="col-span-2">
                    <div class="sticky bottom-0 space-y-3">
                        <h3 class="text-lg font-medium text-purple-800 mb-4">Pages</h3>
                        <div id="thumbnail-container" class="space-y-2">

                            <div class="grid grid-cols-2 gap-1 border-2 border-purple-200 hover:border-purple-300 rounded-lg">
                                <button class="aspect-[4/3] rounded-lg transition-all duration-200 hover:scale-105 ">
                                    <div class="relative w-full h-full rounded-lg overflow-hidden">
                                        <img src="https://placehold.co/400x600?text=Cover+Page&font=roboto" alt="" class="w-full h-full object-cover">
                                        <div class="absolute bottom-1 left-1 bg-white/90 text-xs px-1 py-0.5 rounded text-purple-800 font-medium">
                                            Cover Page
                                        </div>
                                    </div>
                                </button>
                            </div>

                            <div class="grid grid-cols-2 gap-1 border-2 border-purple-200 hover:border-purple-300 rounded-lg">
                                <button class="aspect-[4/3] transition-all duration-200 hover:scale-105">
                                    <div class="relative w-full h-full rounded-lg overflow-hidden">
                                        <img src="https://placehold.co/400x600?text=Page+1&font=roboto" alt="Page ${leftPage.label}" class="w-full h-full object-cover rounded-lg">
                                        <div class="absolute bottom-1 left-1 bg-white/90 text-xs px-1 py-0.5 rounded text-purple-800 font-medium">
                                            Page 1
                                        </div>
                                    </div>
                                </button>
                                <button class="aspect-[4/3] rounded-lg transition-all duration-200 hover:scale-105 ">
                                    <div class="relative w-full h-full rounded-lg overflow-hidden">
                                        <img src="https://placehold.co/400x600?text=Page+2&font=roboto" alt="Page ${leftPage.label}" class="w-full h-full object-cover rounded-lg">
                                        <div class="absolute bottom-1 left-1 bg-white/90 text-xs px-1 py-0.5 rounded text-purple-800 font-medium">
                                            Page 2
                                        </div>
                                    </div>
                                </button>
                            </div>

                            <div class="grid grid-cols-2 gap-1 border-2 border-purple-200 hover:border-purple-300 rounded-lg">
                                <button class="aspect-[4/3] transition-all duration-200 hover:scale-105">
                                    <div class="relative w-full h-full rounded-lg overflow-hidden">
                                        <img src="https://placehold.co/400x600?text=Page+3&font=roboto" alt="Page ${leftPage.label}" class="w-full h-full object-cover rounded-lg">
                                        <div class="absolute bottom-1 left-1 bg-white/90 text-xs px-1 py-0.5 rounded text-purple-800 font-medium">
                                            Page 3
                                        </div>
                                    </div>
                                </button>
                                <button class="aspect-[4/3] rounded-lg transition-all duration-200 hover:scale-105 ">
                                    <div class="relative w-full h-full rounded-lg overflow-hidden">
                                        <img src="https://placehold.co/400x600?text=Page+4&font=roboto" alt="Page ${leftPage.label}" class="w-full h-full object-cover rounded-lg">
                                        <div class="absolute bottom-1 left-1 bg-white/90 text-xs px-1 py-0.5 rounded text-purple-800 font-medium">
                                            Page 4
                                        </div>
                                    </div>
                                </button>
                            </div>


                            <div class="grid grid-cols-2 gap-1 border-2 border-purple-200 hover:border-purple-300 rounded-lg">
                                <button class="aspect-[4/3] transition-all duration-200 hover:scale-105">
                                    <div class="relative w-full h-full rounded-lg overflow-hidden">
                                        <img src="https://placehold.co/400x600?text=Page+5&font=roboto" alt="Page ${leftPage.label}" class="w-full h-full object-cover rounded-lg">
                                        <div class="absolute bottom-1 left-1 bg-white/90 text-xs px-1 py-0.5 rounded text-purple-800 font-medium">
                                            Page 5
                                        </div>
                                    </div>
                                </button>
                                <button class="aspect-[4/3] rounded-lg transition-all duration-200 hover:scale-105 ">
                                    <div class="relative w-full h-full rounded-lg overflow-hidden">
                                        <img src="https://placehold.co/400x600?text=Page+6&font=roboto" alt="Page ${leftPage.label}" class="w-full h-full object-cover rounded-lg">
                                        <div class="absolute bottom-1 left-1 bg-white/90 text-xs px-1 py-0.5 rounded text-purple-800 font-medium">
                                            Page 6
                                        </div>
                                    </div>
                                </button>
                            </div>


                            <div class="grid grid-cols-2 gap-1 border-2 border-purple-200 hover:border-purple-300 rounded-lg">
                                <button class="aspect-[4/3] transition-all duration-200 hover:scale-105">
                                    <div class="relative w-full h-full rounded-lg overflow-hidden">
                                        <img src="https://placehold.co/400x600?text=Page+7&font=roboto" alt="Page ${leftPage.label}" class="w-full h-full object-cover rounded-lg">
                                        <div class="absolute bottom-1 left-1 bg-white/90 text-xs px-1 py-0.5 rounded text-purple-800 font-medium">
                                            Page 7
                                        </div>
                                    </div>
                                </button>
                                <button class="aspect-[4/3] rounded-lg transition-all duration-200 hover:scale-105 ">
                                    <div class="relative w-full h-full rounded-lg overflow-hidden">
                                        <img src="https://placehold.co/400x600?text=Page+8&font=roboto" alt="Page ${leftPage.label}" class="w-full h-full object-cover rounded-lg">
                                        <div class="absolute bottom-1 left-1 bg-white/90 text-xs px-1 py-0.5 rounded text-purple-800 font-medium">
                                            Page 8
                                        </div>
                                    </div>
                                </button>
                            </div>

                            <div class="grid grid-cols-2 gap-1 border-2 border-purple-200 hover:border-purple-300 rounded-lg">
                                <button class="aspect-[4/3] rounded-lg transition-all duration-200 hover:scale-105 ">
                                    <div class="relative w-full h-full rounded-lg overflow-hidden">
                                        <img src="https://placehold.co/400x600?text=End+Page&font=roboto" alt="" class="w-full h-full object-cover">
                                        <div class="absolute bottom-1 left-1 bg-white/90 text-xs px-1 py-0.5 rounded text-purple-800 font-medium">
                                            Cover Page
                                        </div>
                                    </div>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-span-10">
                    <div class="relative">
                        <div class="bg-white rounded-xl shadow-lg p-4 mb-6">
                            <div class="relative rounded-lg overflow-hidden m-6">
                                <div class="flex h-96 align-center justify-center">
                                    <!-- Left Page -->
                                    <div class="w-[40rem] h-[25rem]">
                                        <div id="left-page" class="relative w-full h-full">
                                            <img src="https://placehold.co/400x600?text=Cover+Page&font=roboto" alt="Page 1" class="w-full h-full object-cover rounded-lg">
                                            <!-- Refresh Button -->
                                            <button
                                                class="absolute top-4 right-4 bg-white/90 hover:bg-white rounded-full p-2 shadow-md transition-all duration-200 z-50">
                                                <i data-lucide="rotate-ccw" class="w-4 h-4 text-purple-700"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-lg overflow-hidden m-6">
                                <div class="flex h-96 align-center justify-center">
                                    <!-- Left Page -->
                                    <div class="w-[40rem] h-[25rem]">
                                        <div id="left-page" class="relative w-full h-full">
                                            <img src="https://placehold.co/400x600?text=Page+1&font=roboto" alt="Page 1" class="w-full h-full object-cover rounded-lg">

                                            <!-- Refresh Button -->
                                            <button
                                                class="absolute top-4 right-4 bg-white/90 hover:bg-white rounded-full p-2 shadow-md transition-all duration-200 z-50">
                                                <i data-lucide="rotate-ccw" class="w-4 h-4 text-purple-700"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Book Binding -->
                                    <div class="w-1 bg-gradient-to-b from-gray-200 via-gray-300 to-gray-200 shadow-inner">
                                    </div>

                                    <!-- Right Page -->
                                    <div class="w-[40rem] h-[25rem]">
                                        <div id="right-page" class="relative w-full h-full">
                                            <img src="https://placehold.co/400x600?text=Page+2&font=roboto" alt="Page 1" class="w-full h-full object-cover rounded-lg">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-lg overflow-hidden m-6">
                                <div class="flex h-96 align-center justify-center">
                                    <!-- Left Page -->
                                    <div class="w-[40rem] h-[25rem]">
                                        <div id="left-page" class="relative w-full h-full">
                                            <img src="https://placehold.co/400x600?text=Page+3&font=roboto" alt="Page 3" class="w-full h-full object-cover rounded-lg">

                                            <!-- Refresh Button -->
                                            <button
                                                class="absolute top-4 right-4 bg-white/90 hover:bg-white rounded-full p-2 shadow-md transition-all duration-200 z-50">
                                                <i data-lucide="rotate-ccw" class="w-4 h-4 text-purple-700"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Book Binding -->
                                    <div class="w-1 bg-gradient-to-b from-gray-200 via-gray-300 to-gray-200 shadow-inner">
                                    </div>

                                    <!-- Right Page -->
                                    <div class="w-[40rem] h-[25rem]">
                                        <div id="right-page" class="relative w-full h-full">
                                            <img src="https://placehold.co/400x600?text=Page+4&font=roboto" alt="Page 4" class="w-full h-full object-cover rounded-lg">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-lg overflow-hidden m-6">
                                <div class="flex h-96 align-center justify-center">
                                    <!-- Left Page -->
                                    <div class="w-[40rem] h-[25rem]">
                                        <div id="left-page" class="relative w-full h-full">
                                            <img src="https://placehold.co/400x600?text=Page+5&font=roboto" alt="Page 5" class="w-full h-full object-cover rounded-lg">

                                            <!-- Refresh Button -->
                                            <button
                                                class="absolute top-4 right-4 bg-white/90 hover:bg-white rounded-full p-2 shadow-md transition-all duration-200 z-50">
                                                <i data-lucide="rotate-ccw" class="w-4 h-4 text-purple-700"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Book Binding -->
                                    <div class="w-1 bg-gradient-to-b from-gray-200 via-gray-300 to-gray-200 shadow-inner">
                                    </div>

                                    <!-- Right Page -->
                                    <div class="w-[40rem] h-[25rem]">
                                        <div id="right-page" class="relative w-full h-full">
                                            <img src="https://placehold.co/400x600?text=Page+6&font=roboto" alt="Page 6" class="w-full h-full object-cover rounded-lg">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-lg overflow-hidden m-6">
                                <div class="flex h-96 align-center justify-center">
                                    <!-- Left Page -->
                                    <div class="w-[40rem] h-[25rem]">
                                        <div id="left-page" class="relative w-full h-full">
                                            <img src="https://placehold.co/400x600?text=Page+7&font=roboto" alt="Page 7" class="w-full h-full object-cover rounded-lg">

                                            <!-- Refresh Button -->
                                            <button
                                                class="absolute top-4 right-4 bg-white/90 hover:bg-white rounded-full p-2 shadow-md transition-all duration-200 z-50">
                                                <i data-lucide="rotate-ccw" class="w-4 h-4 text-purple-700"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Book Binding -->
                                    <div class="w-1 bg-gradient-to-b from-gray-200 via-gray-300 to-gray-200 shadow-inner">
                                    </div>

                                    <!-- Right Page -->
                                    <div class="w-[40rem] h-[25rem]">
                                        <div id="right-page" class="relative w-full h-full">
                                            <img src="https://placehold.co/400x600?text=Page+8&font=roboto" alt="Page 8" class="w-full h-full object-cover rounded-lg">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-lg overflow-hidden m-6">
                                <div class="flex h-96 align-center justify-center">
                                    <!-- Left Page -->
                                    <div class="w-[40rem] h-[25rem]">
                                        <div id="left-page" class="relative w-full h-full">
                                            <img src="https://placehold.co/400x600?text=End+Page&font=roboto" alt="End Page" class="w-full h-full object-cover rounded-lg">

                                            <!-- Refresh Button -->
                                            <button
                                                class="absolute top-4 right-4 bg-white/90 hover:bg-white rounded-full p-2 shadow-md transition-all duration-200 z-50">
                                                <i data-lucide="rotate-ccw" class="w-4 h-4 text-purple-700"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

@endsection

@push('scripts')
@endpush
