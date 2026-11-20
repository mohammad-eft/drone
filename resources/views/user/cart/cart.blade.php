
@extends('app.document')

@section('title', 'CircuitFly | سبد خرید')

@section('content')

    <div class="min-h-screen bg-[#090C0A] text-[#F4F7F5]">

        {{-- Header --}}
        <header class="bg-[#101412] border-b border-[#2A302C]">
            <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">

                <a href="{{ route('home') }}"
                    class="flex items-center gap-2 text-lg font-extrabold text-[#F4F7F5] hover:text-[#00F477] transition-colors">

                    <span class="w-2 h-2 rounded-full bg-[#00F477] shadow-[0_0_10px_#00F477]"></span>

                    CircuitFly
                </a>

                <a href="{{ route('home') }}"
                    class="text-xs sm:text-sm text-[#929B95] hover:text-[#00F477] transition-colors">
                    ادامه خرید
                </a>

            </div>
        </header>

        {{-- Main --}}
        <main class="max-w-5xl mx-auto px-4 py-5 lg:py-9">

            {{-- Page Title --}}
            <div class="mb-5 lg:mb-7">

                <div class="flex items-center gap-2 mb-2">

                    <span class="w-1.5 h-1.5 rounded-full bg-[#00F477]"></span>

                    <span class="text-[11px] font-bold tracking-wider text-[#00F477]">
                        CIRCUITFLY STORE
                    </span>

                </div>

                <h1 class="text-xl lg:text-2xl font-extrabold text-[#F4F7F5]">
                    سبد خرید
                </h1>

                <p class="text-xs text-[#929B95] mt-2">
                    محصولات انتخاب‌شده خود را بررسی و سفارش خود را نهایی کنید.
                </p>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 lg:gap-6">

                {{-- Cart Items --}}
                <div class="lg:col-span-2 space-y-3" id="cartItemsBlock">

                </div>

                {{-- Summary --}}
                <aside class="lg:col-span-1 hidden" id="totalBlock">

                    <div class="bg-[#191D1B] rounded-2xl p-5 border border-[#2A302C] shadow-[0_8px_25px_rgba(0,0,0,0.2)] lg:sticky lg:top-6">

                        {{-- Summary Header --}}
                        <div class="flex items-center justify-between mb-5">

                            <h2 class="font-extrabold text-[#F4F7F5] text-base">
                                خلاصه سفارش
                            </h2>

                            <span class="w-8 h-8 rounded-xl bg-[#00F477]/10 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4 fill-[#00F477]"
                                    viewBox="0 0 24 24">
                                    <path d="M7 4h-2l-2 4v2h2l2-2h12l2 2h2V8l-2-4h-2l-1 2H8L7 4zm-2 8v8h14v-8H5zm3 2h8v2H8v-2z"/>
                                </svg>
                            </span>

                        </div>

                        {{-- Discount --}}
                        <div class="space-y-3 text-sm discountBlock">

                            <div class="justify-between items-center hidden">
                                <span class="text-[#929B95]">
                                    تخفیف
                                </span>

                                <span class="text-[#00F477] font-bold in-fa" id="discountEl">
                                    0
                                </span>
                            </div>

                        </div>

                        {{-- Divider --}}
                        <div class="border-t border-dashed border-[#2A302C] my-5"></div>

                        {{-- Total Price --}}
                        <div class="flex justify-between items-center mb-5">

                            <span class="font-semibold text-sm text-[#929B95]">
                                مبلغ قابل پرداخت
                            </span>

                            <div class="text-left">

                                <p class="font-extrabold text-xl text-[#00F477] in-fa" id="totalPriceEl">
                                    0
                                </p>

                                <p class="text-[11px] text-[#929B95] mt-1">
                                    تومان
                                </p>

                            </div>

                        </div>

                        {{-- Checkout Button --}}
                        <a href="{{ route('checkout') }}"
                            class="group w-full flex items-center justify-center gap-3 text-center bg-[#00F477] hover:bg-[#39FF98] text-[#06140B] font-extrabold text-sm py-3.5 rounded-xl transition-all duration-300 shadow-[0_5px_18px_rgba(0,244,119,0.12)] hover:shadow-[0_7px_22px_rgba(0,244,119,0.22)] hover:-translate-y-0.5">

                            <span>تکمیل خرید</span>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512"
                                class="w-3.5 h-3.5 fill-current transition-transform duration-300 group-hover:-translate-x-1">
                                <path d="M7.4 273.4C2.7 268.8 0 262.6 0 256s2.7-12.8 7.4-17.4l176-168c9.6-9.2 24.8-8.8 33.9 .8s8.8 24.8-.8 33.9L83.9 232 424 232c13.3 0 24 10.7 24 24s-10.7 24-24 24L83.9 280 216.6 406.6c9.2 9.2 9.9 24.3 .8 33.9s-24.3 9.9-33.9 .8l-176-168z"/>
                            </svg>

                        </a>
                    </div>

                </aside>

            </div>

        </main>

    </div>

    <script>
        window.currentPage = 'cart';
    </script>

    <script src="{{ asset('js/cartPage.js') }}"></script>

@endsection
