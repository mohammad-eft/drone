@extends('app.document')

@section('title', 'دیارابزار | فروشگاه ابزار آلات ساختمانی')

@section('content')

    @session('clearStorage')
        <script>
            localStorage.clear();
        </script>
    @endsession

    <main class="diar-home w-full flex flex-col gap-10 justify-start items-center my-3 lg:my-5">

        {{-- ========================= HERO ========================= --}}
        <section class="diar-hero max-w-[1800px] w-11/12 mx-auto relative overflow-hidden">
            <div class="diar-hero-copy">
                {{-- <span class="diar-hero-eyebrow"><i></i> PREMIUM DRONE COMPONENTS</span> --}}
                <h1>{{ $setting['heroTitle'] }}</h1>
                <p>{{ $setting['heroSubtitle'] }}</p>
                {{-- <div class="diar-hero-points">
                    <span>✦ قطعات تخصصی</span>
                    <span>✓ کیفیت تضمین‌شده</span>
                    <span>⚡ ارسال سریع</span>
                </div> --}}
                <div class="diar-hero-actions">
                    <a href="{{ $setting['heroPrimaryButtonLink'] }}" class="diar-hero-primary">
                        {{ $setting['heroPrimaryButton'] }} <span>←</span>
                    </a>
                    <a href="{{ $setting['heroSecondaryButtonLink'] }}" class="diar-hero-secondary">
                        {{ $setting['heroSecondaryButton'] }}
                    </a>
                </div>
            </div>
            <div class="diar-hero-visual">
                <div class="diar-hero-glow"></div>
                <img src="{{ asset('storage/' . $setting['heroBanner']) }}" alt="{{ $setting['heroTitle'] }}">
                {{-- <span class="diar-hero-image-caption">CIRCUITFLY / DRONE TECHNOLOGY</span> --}}
            </div>
            {{-- <div class="diar-hero-pagination"><span></span><i></i><i></i><i></i></div> --}}
        </section>

        {{-- ========================= PACKS ========================= --}}
        @if (count($packs) > 0)
            <section class="max-w-[1800px] w-11/12 mx-auto diar-section">

                <div class="w-full mx-auto flex flex-col items-center">

                    <div class="w-full flex flex-col items-center">
                        <div class="w-full flex gap-2 items-center">
                            <div class="w-[50px] h-1 bg-(--primary-text-color) rounded-full"></div>
                            <span class="text-sm lg:text-lg text-(--secondary-text-color)">
                                {{ $setting['packSubtitle'] }}
                            </span>
                        </div>

                        <div class="w-full flex flex-row justify-between items-center">
                            <span class="lg:text-[30px] text-xl text-(--primary-text-color) font-bold">
                                {{ $setting['packTitle'] }}
                            </span>

                            <a href="{{ route('pack.index') }}" class="diar-section-link text-sm">
                                مشاهده همه
                            </a>
                        </div>
                    </div>

                    <div class="w-full grid grid-cols-1 lg:grid-cols-3 2xl:grid-cols-4 gap-4 lg:gap-6 mt-5">

                        @foreach ($packs as $pack)
                            <div class="diar-pack-card relative overflow-hidden rounded-2xl">

                                <div class="relative h-[180px] lg:h-[250px] w-full">
                                    <img src="{{ asset('storage/' . $pack->image) }}" class="h-full w-full object-cover"
                                        alt="">

                                    <div class="absolute inset-y-0 right-0 w-[45%] diar-pack-shape">
                                        <div class="absolute -left-3 -top-8 h-28 w-28 rounded-full diar-pack-shape"></div>
                                        <div
                                            class="absolute -left-5 lg:-left-8 top-4 h-28 w-28 rounded-full diar-pack-shape">
                                        </div>
                                        <div
                                            class="absolute -left-2 lg:-left-8 top-1/2 h-40 w-40 -translate-y-1/2 rounded-full diar-pack-shape">
                                        </div>
                                        <div class="absolute -left-5 bottom-2 h-28 w-28 rounded-full diar-pack-shape"></div>
                                        <div class="absolute -left-3 -bottom-8 h-28 w-28 rounded-full diar-pack-shape">
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="absolute right-0 top-0 flex h-full w-[45%] items-center justify-center px-3 py-4 lg:py-8">
                                    <div class="text-right flex flex-col gap-3 relative z-10">

                                        <h3 class="text-lg lg:text-2xl font-bold diar-pack-title">
                                            {{ $pack->title }}
                                        </h3>

                                        <p class="text-sm leading-7 diar-pack-summary">
                                            {{ $pack->summary }}
                                        </p>

                                        <div class="flex">
                                            <a href="{{ route('pack.single', $pack->id) }}"
                                                class="diar-pack-button mt-3 rounded-full px-6 py-2 text-white text-sm lg:text-base">
                                                مشاهده
                                            </a>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>
            </section>
        @endif


        {{-- ========================= POPULAR PRODUCTS ========================= --}}
        <section class="max-w-[1800px] w-11/12 mx-auto flex flex-col gap-4 justify-start items-start diar-section">

            <div class="w-full flex flex-row gap-1 justify-between items-center">
                <h3 class="text-xl font-bold text-(--primary-text-color)">
                    محبوب ترین های این روز ها
                </h3>

                <a href="#" class="diar-section-link text-sm">
                    مشاهده همه
                </a>
            </div>

            <div
                class="max-w-full w-full py-2 px-1 grid grid-cols-2 lg:grid-cols-5 gap-4 justify-start overflow-x-auto lg:overflow-x-visible">

                @foreach ($products as $product)
                    <div class="diar-product-card w-full flex flex-col gap-2 justify-start items-center rounded-xl p-3 products"
                        data-product-id="{{ $product->id }}">

                        <div class="diar-product-image w-full flex justify-center items-center relative py-7">
                            <a href="{{ route('product.show', [$product->id]) }}" class="block">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                                    class="max-w-full max-h-24 lg:max-h-42 object-contain">
                            </a>

                            @if ($product->percent)
                                <span
                                    class="diar-discount absolute top-0 right-0 lg:px-2 px-1 lg:py-1 py-0.5 rounded-md text-xs max-lg:text-[9px] text-white">
                                    {{ $product->percent }}%
                                </span>
                            @endif
                        </div>

                        <div class="w-full flex flex-col gap-1.5 lg:gap-2.5 justify-start items-start">

                            <a href="{{ route('product.show', [$product->id]) }}"
                                class="diar-product-title lg:text-lg text-sm font-bold max-w-full truncate">
                                {{ $product->title }}
                            </a>
                            @if ($product->summary)
                                <span class="diar-product-summary text-sm h-10 max-h-10 ellipsis-2">
                                    {{ $product->summary }}
                                </span>
                            @endif
                            @if ($product->primary_price || $product->secondary_price)
                                <div class="flex items-center gap-3 min-h-7">
                                    @if ($product->secondary_price)
                                        <div class="line-through text-[#a1a1aa] text-[10px] in-fa">
                                            {{ $product->primary_price }} تومان
                                        </div>

                                        <div class="flex items-center justify-between gap-2">
                                            <strong class="diar-product-price text-[15px] in-fa">
                                                {{ $product->secondary_price }}
                                            </strong>

                                            <span class="text-[10px] text-[#71717a]">
                                                تومان
                                            </span>
                                        </div>
                                    @else
                                        <div class="flex items-center justify-between gap-2">
                                            <strong class="diar-product-price text-[15px] in-fa">
                                                {{ $product->primary_price }}
                                            </strong>

                                            <span class="text-[10px] text-[#71717a]">
                                                تومان
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="text-sm text-gray-400">جهت استعلام قیمت تماس بگیرید</div>
                            @endif


                            <div class="w-full h-12 addToCartBtns" data-product-id="{{ $product->id }}">

                                @if ($product->count > 0)
                                    <button onclick="addToCart(this)"
                                        class="diar-cart-button w-full px-4 h-full flex gap-2 justify-center items-center rounded-xl cursor-pointer transition-all duration-300 group">

                                        <svg class="size-4 shrink-0" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M3 3h2l2.2 11.5a2 2 0 0 0 2 1.6h8.9a2 2 0 0 0 2-1.6L22 7H6"/>
                <circle cx="10" cy="20" r="1"/>
                <circle cx="18" cy="20" r="1"/>
                <path d="M14 9v5M11.5 11.5h5"/>
            </svg>

                                        <span class="lg:text-sm text-[10px] font-bold transition-all duration-300">
                                            افزودن به سبد خرید
                                        </span>
                                    </button>
                                @else
                                    <button
                                        class="diar-unavailable-button w-full px-4 h-full flex gap-2 justify-center items-center rounded-xl relative cursor-not-allowed">
                                        <span class="lg:text-sm text-[10px] font-bold">
                                            عدم موجودی
                                        </span>
                                    </button>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>


        {{-- ========================= SECOND BANNER ========================= --}}
        <section
            class="diar-feature-banner max-w-[1800px] w-11/12 mx-auto flex max-lg:flex-col justify-start items-center rounded-2xl overflow-hidden">

            <div class="lg:w-1/2 w-full flex justify-center items-center relative">
                <img src="{{ asset('storage/' . $setting['secondBanner']) }}" alt=""
                    class="w-full h-full object-cover lg:max-h-90 max-h-70">
            </div>

            <div
                class="lg:w-1/2 w-full min-h-full flex lg:justify-start justify-center items-center lg:pr-20 lg:py-4 max-lg:px-5 max-lg:pt-7 max-lg:pb-8">
                <div class="w-full h-full flex flex-col gap-4 justify-center lg:items-start items-center">
{{-- 
                    <span class="diar-feature-label">
                        انتخاب حرفه‌ای برای حرفه‌ای‌ها
                    </span> --}}

                    <h3 class="lg:text-4xl text-2xl font-bold diar-feature-title">
                        {{ $setting['secondBannerTitle'] }}
                    </h3>

                    <p class="max-xl:text-sm max-lg:text-xs max-lg:text-center diar-feature-description">
                        {{ $setting['secondBannerSubtitle'] }}
                    </p>

                    <a href="{{ $setting['secondBannerButtonLink'] }}"
                        class="diar-feature-button px-7 lg:py-3 py-2 text-sm font-bold rounded-xl flex justify-center items-center mt-2">
                        {{ $setting['secondBannerButton'] }}
                    </a>

                </div>
            </div>
        </section>


        {{-- ========================= NEW PRODUCTS ========================= --}}
        <section class="max-w-[1800px] w-11/12 mx-auto flex flex-col gap-4 justify-start items-start diar-section">

            <div class="w-full flex flex-row justify-between items-center">
                <h3 class="text-xl font-bold text-(--primary-text-color)">
                    تازه به قفسه ها اضافه شده
                </h3>

                <a href="#" class="diar-section-link text-sm">
                    مشاهده همه
                </a>
            </div>

            <div
                class="max-w-full w-full py-2 px-1 grid grid-cols-2 lg:grid-cols-5 gap-4 justify-start overflow-x-auto lg:overflow-x-visible">

                @foreach ($newProducts as $product)
                    <div class="diar-product-card w-full flex flex-col gap-2 justify-start items-center rounded-xl p-3 pb-5 products"
                        data-product-id="{{ $product->id }}">

                        <div class="diar-product-image w-full flex justify-center items-center relative py-7">
                            <a href="{{ route('product.show', [$product->id]) }}" class="block">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                                    class="max-w-full max-h-24 lg:max-h-42 object-contain">
                            </a>

                            @if ($product->percent)
                                <span
                                    class="diar-discount absolute top-0 right-0 lg:px-2 px-1 lg:py-1 py-0.5 rounded-md text-xs max-lg:text-[9px] text-white">
                                    {{ $product->percent }}%
                                </span>
                            @endif
                        </div>

                        <div class="w-full flex flex-col gap-1.5 lg:gap-2.5 justify-start items-start">

                            <a href="{{ route('product.show', [$product->id]) }}"
                                class="diar-product-title lg:text-lg text-sm font-bold max-w-full truncate">
                                {{ $product->title }}
                            </a>
                            @if ($product->summary)
                                <span class="diar-product-summary text-sm h-10 max-h-10 ellipsis-2">
                                    {{ $product->summary }}
                                </span>
                            @endif

                            @if ($product->primary_price || $product->secondary_price)
                                <div class="flex items-center gap-3 min-h-7">


                                    @if ($product->secondary_price)
                                        <div class="line-through text-[#a1a1aa] text-[10px] in-fa">
                                            {{ $product->primary_price }} تومان
                                        </div>

                                        <div class="flex items-center justify-between gap-2">
                                            <strong class="diar-product-price text-[15px] in-fa">
                                                {{ $product->secondary_price }}
                                            </strong>

                                            <span class="text-[10px] text-[#71717a]">
                                                تومان
                                            </span>
                                        </div>
                                    @else
                                        <div class="flex items-center justify-between gap-2">
                                            <strong class="diar-product-price text-[15px] in-fa">
                                                {{ $product->primary_price }}
                                            </strong>

                                            <span class="text-[10px] text-[#71717a]">
                                                تومان
                                            </span>
                                        </div>
                                    @endif

                                </div>
                            @else
                                <div class="text-sm text-gray-400">جهت استعلام قیمت تماس بگیرید</div>
                            @endif

                            <div class="w-full h-12 addToCartBtns" data-product-id="{{ $product->id }}">

                                @if ($product->count > 0)
                                    <button onclick="addToCart(this)"
                                        class="diar-cart-button w-full px-4 h-full flex gap-2 justify-center items-center rounded-xl cursor-pointer transition-all duration-300 group">

                                        <svg class="size-4 shrink-0" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M3 3h2l2.2 11.5a2 2 0 0 0 2 1.6h8.9a2 2 0 0 0 2-1.6L22 7H6"/>
                <circle cx="10" cy="20" r="1"/>
                <circle cx="18" cy="20" r="1"/>
                <path d="M14 9v5M11.5 11.5h5"/>
            </svg>

                                        <span class="lg:text-sm text-[10px] font-bold transition-all duration-300">
                                            افزودن به سبد خرید
                                        </span>
                                    </button>
                                @else
                                    <button
                                        class="diar-unavailable-button w-full px-4 h-full flex gap-2 justify-center items-center rounded-xl relative cursor-not-allowed">
                                        <span class="lg:text-sm text-[10px] font-bold">
                                            عدم موجودی
                                        </span>
                                    </button>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>


        {{-- ========================= SIDE BANNERS ========================= --}}
        
        
        <section class="w-full flex justify-center py-5 bg-[#090C0A]">
            <div class="max-w-[1800px] w-11/12 mx-auto grid grid-cols-1 lg:grid-cols-12 gap-4 lg:h-64">

                {{-- Right Banner --}}
                <a href="{{ $setting['rightBannerLink'] }}"
                    class="group relative lg:col-span-5 w-full h-48 lg:h-full rounded-2xl overflow-hidden bg-[#191D1B] border border-[#2A302C]">

                    <img src="{{ asset('storage/' . $setting['rightBanner']) }}"
                        alt=""
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                    <div class="absolute inset-0 bg-gradient-to-t from-[#090C0A]/40 via-transparent to-transparent"></div>

                    <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-white/5"></div>
                </a>

                {{-- Left Banner --}}
                <div class="lg:col-span-7 relative w-full min-h-[220px] lg:h-full flex max-sm:flex-col items-center overflow-hidden rounded-2xl bg-[#191D1B] border border-[#2A302C]">

                    {{-- Image --}}
                    <div class="relative w-full sm:w-1/2 h-44 sm:h-full overflow-hidden">
                        <img src="{{ asset('storage/' . $setting['leftBanner']) }}"
                            alt=""
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                        <div class="absolute inset-0 bg-gradient-to-r from-transparent to-[#191D1B]/30"></div>
                    </div>

                    {{-- Content --}}
                    <div class="relative w-full sm:w-1/2 flex flex-col items-start justify-center gap-3 p-5 sm:p-6 lg:p-7">

                        {{-- <span class="inline-flex items-center gap-2 text-[11px] font-bold text-[#00F477]">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#00F477] shadow-[0_0_10px_#00F477]"></span>
                            CIRCUITFLY
                        </span> --}}

                        <h3 class="text-base lg:text-xl font-extrabold leading-8 text-[#F4F7F5]">
                            {{ $setting['leftBannerTitle'] }}
                        </h3>

                        <p class="text-xs lg:text-sm leading-6 text-[#929B95]">
                            {{ $setting['leftBannerSubtitle'] }}
                        </p>

                        <a href="{{ $setting['leftBannerButtonLink'] }}"
                            class="group/btn inline-flex items-center justify-center gap-3 mt-2 px-5 py-2.5 rounded-xl bg-[#00F477] hover:bg-[#39FF98] text-[#06140B] text-xs lg:text-sm font-extrabold transition-all duration-300 shadow-[0_4px_18px_rgba(0,244,119,0.12)] hover:shadow-[0_5px_24px_rgba(0,244,119,0.25)] hover:-translate-y-0.5">

                            <span>{{ $setting['leftBannerButton'] }}</span>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512"
                                class="w-3.5 h-3.5 fill-current transition-transform duration-300 group-hover/btn:-translate-x-1">
                                <path d="M7.4 273.4C2.7 268.8 0 262.6 0 256s2.7-12.8 7.4-17.4l176-168c9.6-9.2 24.8-8.8 33.9 .8s8.8 24.8-.8 33.9L83.9 232 424 232c13.3 0 24 10.7 24 24s-10.7 24-24 24L83.9 280 216.6 406.6c9.2 9.2 9.9 24.3 .8 33.9s-24.3 9.9-33.9 .8l-176-168z"/>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </section>




        {{-- ========================= TWO PROMO CARDS ========================= --}}
        <section class="w-full flex justify-center gap-5">
            <div class="max-w-[1800px] w-11/12 mx-auto flex flex-col gap-5">

                <div class="w-full flex justify-between items-center">
                    <span class="lg:text-2xl text-xl font-bold text-(--primary-text-color)">
                        {{ $setting['twoCardsSectionTitle'] }}
                    </span>

                    <a href="{{ $setting['twoCardsSectionLinkUrl'] }}" class="diar-section-link text-sm">
                        {{ $setting['twoCardsSectionLinkText'] }}
                    </a>
                </div>

                <div class="flex items-center flex-col lg:flex-row gap-5">

                    <div
                        class="diar-promo-card lg:w-6/12 w-full flex max-lg:flex-col gap-2 justify-between py-5 px-7 rounded-xl">

                        <div class="lg:w-1/2 w-full flex flex-col max-lg:items-center justify-center gap-3 max-lg:order-2">

                            <span class="text-xl max-lg:text-lg font-bold text-(--primary-text-color)">
                                {{ $setting['twoCardsRightTitle'] }}
                            </span>

                            <span class="max-lg:text-sm text-(--secondary-text-color) max-lg:text-center">
                                {{ $setting['twoCardsRightSubtitle'] }}
                            </span>

                            <a href="{{ $setting['twoCardsRightButtonLink'] }}"
                                class="diar-outline-button flex justify-center items-center w-9/12 py-2 rounded-xl">
                                <span>
                                    {{ $setting['twoCardsRightButton'] }}
                                </span>
                            </a>
                        </div>

                        <img class="w-1/2 mx-auto max-h-60 rounded-l-xl max-lg:order-1 object-contain"
                            src="{{ asset('storage/' . $setting['twoCardsRightImage']) }}" alt="">
                    </div>


                    <div
                        class="diar-promo-card diar-promo-card-alt lg:w-6/12 w-full flex max-lg:flex-col gap-2 justify-between p-5 px-7 rounded-xl">

                        <div class="lg:w-1/2 w-full flex flex-col max-lg:items-center justify-center gap-3 max-lg:order-2">

                            <span class="text-2xl font-bold text-(--primary-text-color)">
                                {{ $setting['twoCardsLeftTitle'] }}
                            </span>

                            <span class="max-lg:text-sm max-lg:text-center text-(--secondary-text-color)">
                                {{ $setting['twoCardsLeftSubtitle'] }}
                            </span>

                            <a href="{{ $setting['twoCardsLeftButtonLink'] }}"
                                class="diar-outline-button flex justify-center items-center w-9/12 py-2 rounded-xl">
                                <span>
                                    {{ $setting['twoCardsLeftButton'] }}
                                </span>
                            </a>
                        </div>

                        <img class="w-1/2 mx-auto max-h-60 rounded-l-xl max-lg:order-1 object-contain"
                            src="{{ asset('storage/' . $setting['twoCardsLeftImage']) }}" alt="">
                    </div>

                </div>
            </div>
        </section>


        {{-- ========================= SERVICES ========================= --}}
        <section
            class="diar-services max-w-[1800px] w-11/12 mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-center lg:py-6 sm:py-4 rounded-xl">

            @for ($i = 1; $i <= 5; $i++)
                <div class="w-full flex items-center justify-center px-3 py-4">
                    <div class="group w-full flex flex-col gap-3 justify-center items-center">

                        <div class="diar-service-icon">
                            <img src="{{ asset('storage/' . $setting['serviceImage' . $i]) }}"
                                class="lg:w-8 w-6 object-contain" alt="">
                        </div>

                        <div class="flex flex-col sm:gap-2 gap-1 items-center justify-center">
                            <h5 class="xl:text-lg text-md font-bold text-(--primary-text-color) text-center">
                                {{ $setting['serviceTitle' . $i] }}
                            </h5>

                            <div
                                class="flex flex-col items-center justify-center xl:text-[11px] sm:text-[10px] text-[11px]">
                                <span class="font-bold text-center text-(--secondary-text-color)">
                                    {{ $setting['serviceSubTitle' . $i] }}
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            @endfor

        </section>


        {{-- ========================= PAGE STYLES ========================= --}}
        <style>
            .diar-home {
                --primary-text-color:#f4f7f5; --secondary-text-color:#929b95;
                --secondary-text:#929b95; --green-btn:#00f477; --light-green-btn:#173b28;
                --bg-dark-green:#090c0a; --cream-color:#191d1b; --second-cream-color:#202522;
                --purple-btn:#00f477; --pastel-pink:#00f477; --discount-color:#00f477;
                --diar-navy:#090c0a; --diar-red:#00f477; --diar-blue:#13c96d; --diar-light:#191d1b;
                width:100%; color:#f4f7f5; background:#090c0a; direction:rtl; padding-bottom:34px;
            }
            .diar-home *{box-sizing:border-box}
            .diar-home .diar-section{padding-top:42px;padding-bottom:42px;border-bottom:1px solid #1d2420}
            .diar-home .diar-section h3{color:#f5f7f6!important;font-size:22px;font-weight:850}
            .diar-home .diar-section-link{color:#87918a;transition:.2s}
            .diar-home .diar-section-link:hover{color:#00f477}
            /* HERO */
            .diar-home .diar-hero{display:grid;grid-template-columns:1fr 1.08fr;align-items:center;gap:36px;min-height:470px;margin:18px auto 0;padding:42px 4%;border:1px solid #1c2b21;border-radius:17px;background:radial-gradient(ellipse at 75% 50%,rgba(0,244,119,.12),transparent 48%),linear-gradient(110deg,#090c0a,#0d1711 65%,#090c0a);isolation:isolate}
            .diar-home .diar-hero-copy{display:flex;flex-direction:column;align-items:flex-start;gap:19px;position:relative;z-index:2}
            .diar-home .diar-hero-eyebrow{display:inline-flex;align-items:center;gap:9px;padding:7px 13px;border:1px solid rgba(0,244,119,.2);border-radius:50px;background:rgba(0,244,119,.07);color:#00f477;font-size:10px;font-weight:800;letter-spacing:1px}
            .diar-home .diar-hero-eyebrow i{width:7px;height:7px;border-radius:50%;background:#00f477;box-shadow:0 0 12px #00f477}
            .diar-home .diar-hero-copy h1{margin:0;color:#fff!important;font-size:clamp(34px,4.6vw,66px);line-height:1.35;font-weight:950}
            .diar-home .diar-hero-copy p{max-width:540px;margin:0;color:#aab5ae!important;font-size:14px;line-height:2.1}
            .diar-home .diar-hero-points{display:flex;flex-wrap:wrap;gap:8px}
            .diar-home .diar-hero-points span{padding:8px 11px;border:1px solid #29332d;border-radius:7px;background:#171d19;color:#cbd5ce;font-size:10px}
            .diar-home .diar-hero-actions{display:flex;flex-wrap:wrap;gap:11px;width:100%;margin-top:4px}
            .diar-home .diar-hero-primary,.diar-home .diar-hero-secondary{display:inline-flex;align-items:center;justify-content:center;gap:10px;min-width:145px;min-height:46px;padding:11px 22px;border-radius:8px;color:#fff!important;font-size:12px;font-weight:800;transition:.25s}
            .diar-home .diar-hero-primary{background:#00f477!important;color:#06140b!important;box-shadow:0 0 22px rgba(0,244,119,.17)}
            .diar-home .diar-hero-primary:hover{background:#39ff98!important;transform:translateY(-3px)}
            .diar-home .diar-hero-secondary{background:transparent!important;border:1px solid #3a443e}
            .diar-home .diar-hero-secondary:hover{border-color:#00f477;color:#00f477!important}
            .diar-home .diar-hero-visual{position:relative;display:flex;align-items:center;justify-content:center;min-width:0;min-height:330px}
            .diar-home .diar-hero-glow{position:absolute;width:65%;height:65%;border-radius:50%;background:#00f477;filter:blur(95px);opacity:.14}
            .diar-home .diar-hero-visual img{position:relative;z-index:1;width:100%;max-width:590px;height:340px;object-fit:cover;border:1px solid #303b33;border-radius:5px;box-shadow:0 20px 60px rgba(0,0,0,.42)}
            .diar-home .diar-hero-image-caption{position:absolute;z-index:2;bottom:13px;right:13px;padding:7px 10px;border-radius:4px;background:rgba(0,0,0,.72);color:#00f477;font-size:9px;letter-spacing:1px}
            .diar-home .diar-hero-pagination{position:absolute;bottom:18px;left:4%;display:flex;gap:7px;align-items:center}
            .diar-home .diar-hero-pagination i,.diar-home .diar-hero-pagination span{width:6px;height:4px;border-radius:5px;background:#465049}
            .diar-home .diar-hero-pagination span{width:28px;background:#00f477}
            /* PACKS */
            .diar-home .diar-pack-card{background:#191e1b;border:1px solid #2a332d;box-shadow:none;transition:.25s}
            .diar-home .diar-pack-card:hover{transform:translateY(-4px);border-color:#00f477}
            .diar-home .diar-pack-shape{background:#191e1b}
            .diar-home .diar-pack-title{color:#f4f7f5}.diar-home .diar-pack-summary{color:#a0aaa3}
            .diar-home .diar-pack-button{background:#00f477;color:#06140b;transition:.2s;font-weight:800}
            .diar-home .diar-pack-button:hover{background:#39ff98;transform:translateY(-2px)}
            /* PRODUCTS */
            .diar-home .diar-product-card{min-width:0;min-height:100%;padding:11px!important;background:#191d1b;border:1px solid #2a302c;box-shadow:none;transition:.25s}
            .diar-home .diar-product-card:hover{transform:translateY(-4px);border-color:rgba(0,244,119,.48);box-shadow:0 12px 28px rgba(0,0,0,.25)}
            .diar-home .diar-product-image{min-height:155px;padding:12px!important;border-radius:9px;background:#101412;overflow:hidden}
            .diar-home .diar-product-image img{transition:transform .3s}
            .diar-home .diar-product-card:hover .diar-product-image img{transform:scale(1.05)}
            .diar-home .diar-product-title{color:#f3f6f4!important;font-size:13px!important;font-weight:800;line-height:1.8;white-space:normal;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
            .diar-home .diar-product-title:hover{color:#00f477!important}
            .diar-home .diar-product-summary{color:#929c95!important;font-size:11px;line-height:1.8}
            .diar-home .diar-product-price{color:#00f477!important;font-size:14px!important;font-weight:900}
            .diar-home .diar-discount{background:#00f477!important;color:#06140b!important;font-weight:900}
            .diar-home .diar-product-card .line-through{color:#78827b!important}
            .diar-home .diar-product-card .text-\[\#71717a\]{color:#89938c!important}
            .diar-home .diar-cart-button{min-height:38px;background:#00f477!important;color:#06140b!important;border:1px solid #00f477;box-shadow:0 4px 15px rgba(0,244,119,.12)}
            .diar-home .diar-cart-button svg,.diar-home .diar-cart-button span{color:#06140b!important;fill:currentColor!important}
            .diar-home .diar-cart-button:hover{background:#39ff98!important;border-color:#39ff98;transform:translateY(-2px)}
            .diar-home .diar-unavailable-button{min-height:38px;background:#2b1c1b!important;border:1px solid #49302f;color:#ff7770!important}
            .diar-home .diar-unavailable-button span{color:#ff7770!important}
            /* BANNERS */
            .diar-home .diar-feature-banner{background:radial-gradient(circle at 15% 50%,rgba(0,244,119,.13),transparent 45%),#101612!important;border:1px solid #29372e;box-shadow:none}
            .diar-home .diar-feature-label{display:inline-flex;width:fit-content;padding:7px 13px;border-radius:999px;background:rgba(0,244,119,.08);border:1px solid rgba(0,244,119,.2);color:#00f477;font-size:11px;font-weight:800}
            .diar-home .diar-feature-title{color:#fff!important;line-height:1.6}.diar-home .diar-feature-description{color:#aab5ae!important;line-height:2}
            .diar-home .diar-feature-button,.diar-home .diar-side-button{color:#06140b!important;background:#00f477!important;font-weight:800;transition:.2s}
            .diar-home .diar-feature-button:hover,.diar-home .diar-side-button:hover{background:#39ff98!important;transform:translateY(-2px)}
            .diar-home .diar-side-banner{background:#101612;min-height:180px}.diar-home .diar-side-content{background:#191e1b;border:1px solid #2a332d}
            .diar-home .diar-side-content span{color:#f3f6f4!important}
            /* PROMO */
            .diar-home .diar-promo-card,.diar-home .diar-promo-card-alt{background:#191e1b!important;border:1px solid #2a332d;transition:.25s}
            .diar-home .diar-promo-card:hover{transform:translateY(-3px);border-color:rgba(0,244,119,.4);box-shadow:0 10px 24px rgba(0,0,0,.2)}
            .diar-home .diar-outline-button{color:#00f477!important;border:1px solid #3c4941;background:transparent;transition:.2s}
            .diar-home .diar-outline-button:hover{color:#06140b!important;background:#00f477;border-color:#00f477}
            /* SERVICES */
            .diar-home .diar-services{border-top:1px solid #242c27;border-bottom:1px solid #242c27}
            .diar-home .diar-service-icon{width:54px;height:54px;display:flex;align-items:center;justify-content:center;border-radius:50%;background:rgba(0,244,119,.08);box-shadow:0 0 22px rgba(0,244,119,.08);transition:.2s}
            .diar-home .diar-service-icon img{max-height:28px;filter:brightness(0) saturate(100%) invert(72%) sepia(91%) saturate(1500%) hue-rotate(85deg) brightness(105%)}
            .diar-home .diar-services>div:hover .diar-service-icon{transform:translateY(-3px);background:rgba(0,244,119,.15)}
            .diar-home .diar-services h5{color:#f3f6f4!important;font-size:13px!important}.diar-home .diar-services span{color:#929c95!important}
            @media(max-width:1023px){.diar-home .diar-hero{grid-template-columns:1fr 1fr;min-height:390px;gap:20px;padding:30px}.diar-home .diar-hero-visual img{height:280px}.diar-home .diar-product-image{min-height:130px}.diar-home .diar-feature-banner>div:first-child img{min-height:220px;max-height:260px}}
            @media(max-width:640px){.diar-home{gap:1.7rem;padding-bottom:25px}.diar-home .diar-hero{width:100%;grid-template-columns:1fr;gap:18px;min-height:auto;margin-top:0;padding:25px 17px 42px;border-radius:0;border-right:0;border-left:0}.diar-home .diar-hero-copy{align-items:center;text-align:center;gap:14px;order:1}.diar-home .diar-hero-copy h1{font-size:clamp(27px,8vw,38px);line-height:1.5}.diar-home .diar-hero-copy p{font-size:12px;line-height:2}.diar-home .diar-hero-points{justify-content:center;gap:6px}.diar-home .diar-hero-points span{padding:6px 8px;font-size:9px}.diar-home .diar-hero-actions{gap:8px}.diar-home .diar-hero-primary,.diar-home .diar-hero-secondary{flex:1;min-width:0;min-height:43px;padding:9px 10px;font-size:10px}.diar-home .diar-hero-visual{order:2;min-height:210px}.diar-home .diar-hero-visual img{height:220px;object-fit:cover}.diar-home .diar-hero-pagination{bottom:14px;left:50%;transform:translateX(-50%)}.diar-home .diar-section{padding-top:29px;padding-bottom:29px}.diar-home .diar-section h3{font-size:17px}.diar-home .diar-section-link{font-size:10px}.diar-home .diar-product-card{padding:8px!important;border-radius:11px}.diar-home .diar-product-image{min-height:112px;padding:8px!important}.diar-home .diar-product-image img{max-height:105px!important}.diar-home .diar-product-title{font-size:11px!important}.diar-home .diar-product-price{font-size:12px!important}.diar-home .diar-cart-button,.diar-home .diar-unavailable-button{min-height:34px}.diar-home .diar-cart-button span{font-size:10px!important}.diar-home .diar-feature-banner{width:91.6667%;margin-top:15px;margin-bottom:15px}.diar-home .diar-services{margin-top:10px;padding:18px 0;grid-template-columns:repeat(2,minmax(0,1fr))}}
            @media(prefers-reduced-motion:reduce){.diar-home *,.diar-home *:before,.diar-home *:after{transition-duration:.01ms!important;animation-duration:.01ms!important}}
        </style>

    </main>

@endsection
