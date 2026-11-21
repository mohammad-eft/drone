
@extends('app.document')

@section('title', 'پهپاد استور | دسته‌بندی‌ها')

@section('content')
    <div class="min-h-screen bg-[#090C0A] px-4 py-6 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="max-w-[1600px] mx-auto mb-8">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
                <div>
                    <span class="text-[#00F477] text-xs font-bold tracking-wider">
                        PAHPAD STORE
                    </span>

                    <h1 class="text-white text-2xl sm:text-3xl font-black mt-2">
                        دسته‌بندی محصولات
                    </h1>

                    <p class="text-[#929B95] text-sm mt-2">
                        دسته‌بندی مورد نظرت رو انتخاب کن و محصولات مرتبط رو ببین.
                    </p>
                </div>

                <div class="text-sm text-[#929B95]">
                    <span class="text-[#00F477] font-bold">{{ count($categories) }}</span>
                    دسته‌بندی
                </div>
            </div>
        </div>

        {{-- Categories --}}
        <div class="max-w-[1600px] mx-auto grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-7 gap-4">

            @foreach ($categories as $category)
                <a href="{{ route('category.relatedProducts', [$category]) }}"
                   target="_blank"
                   class="group relative min-w-0 overflow-hidden rounded-2xl border border-[#2A302C] bg-[#191D1B] p-4 transition-all duration-300 hover:-translate-y-1 hover:border-[#00F477]/50 hover:bg-[#202522]">

                    {{-- Decorative glow --}}
                    <div class="absolute -top-12 -right-12 w-28 h-28 rounded-full bg-[#00F477]/[0.04] blur-2xl transition-all duration-300 group-hover:bg-[#00F477]/[0.12]"></div>

                    {{-- Image --}}
                    <div class="relative flex items-center justify-center h-32 mb-4 rounded-xl bg-[#101412] border border-[#2A302C] group-hover:border-[#00F477]/20 transition-colors duration-300">
                        <img
                            src="{{ asset('storage/' . $category->image) }}"
                            alt="{{ $category->title }}"
                            loading="lazy"
                            class="max-w-[85%] max-h-[95px] object-contain transition-transform duration-300 group-hover:scale-110"
                        >
                    </div>

                    {{-- Title --}}
                    <div class="relative flex items-center justify-between gap-2 mb-2">
                        <h2 class="text-white text-sm font-bold truncate group-hover:text-[#00F477] transition-colors">
                            {{ $category->title }}
                        </h2>

                        <span class="shrink-0 flex items-center justify-center w-6 h-6 rounded-lg bg-[#202522] text-[#929B95] group-hover:bg-[#00F477] group-hover:text-[#06140B] transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="m9 18 6-6-6-6"/>
                            </svg>
                        </span>
                    </div>

                    {{-- Description --}}
                    <p class="relative text-[#929B95] text-[11px] leading-6 line-clamp-2 min-h-[44px]">
                        {{ $category->description ?: 'مشاهده محصولات این دسته‌بندی' }}
                    </p>

                    {{-- Bottom accent --}}
                    <div class="absolute bottom-0 right-0 left-0 h-[2px] bg-[#00F477] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-right"></div>
                </a>
            @endforeach

        </div>

        {{-- Empty State --}}
        @if($categories->isEmpty())
            <div class="max-w-[1600px] mx-auto flex flex-col items-center justify-center py-24 text-center">
                <div class="w-20 h-20 rounded-2xl bg-[#191D1B] border border-[#2A302C] flex items-center justify-center mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9 text-[#929B95]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M3 7.5 12 3l9 4.5v9L12 21l-9-4.5z"/>
                        <path d="m3.5 7.5 8.5 4.5 8.5-4.5M12 12v9"/>
                    </svg>
                </div>

                <h2 class="text-white font-bold text-lg">
                    هنوز دسته‌بندی‌ای ثبت نشده!
                </h2>

                <p class="text-[#929B95] text-sm mt-2">
                    به‌زودی دسته‌بندی محصولات در این بخش نمایش داده می‌شود.
                </p>
            </div>
        @endif

    </div>
@endsection
