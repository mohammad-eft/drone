@extends('app.document')

@section('title')
    دیارابزار | {{ $product->title }}
@endsection

@section('content')

    @php
        $mainMedia = $product->media->firstWhere('is_main', true) ?? $product->media->first();
        $galleryMedia = $product->media->where('id', '!=', $mainMedia?->id);
        $category = $product->categories->first();
        $isInCart = Auth::check() && in_array($product->id, $cartProIds ?? []);
        $cartQuantity = $product->carts->first()?->quantity ?? 1;

        $hasPrice = $product->primary_price !== null && $product->primary_price > 0;
        $hasDiscount =
            $hasPrice &&
            $product->secondary_price &&
            $product->secondary_price > 0 &&
            $product->secondary_price < $product->primary_price;

        $discountPercent = $hasDiscount
            ? round((($product->primary_price - $product->secondary_price) / $product->primary_price) * 100)
            : 0;
    @endphp

    <style>
        :root {
            --cf-bg: #090C0A;
            --cf-surface: #191D1B;
            --cf-surface-dark: #101412;
            --cf-surface-hover: #202522;
            --cf-green: #00F477;
            --cf-green-hover: #39FF98;
            --cf-text: #F4F7F5;
            --cf-muted: #929B95;
            --cf-border: #2A302C;
            --cf-dark-text: #06140B;
        }

        .product-page {
            color: var(--cf-text);
            background: var(--cf-bg) !important;
        }

        .product-shadow {
            box-shadow: 0 12px 35px rgba(0, 0, 0, .25);
        }

        .product-card {
            background: var(--cf-surface);
            border: 1px solid var(--cf-border);
            border-radius: 18px;
        }

        .product-gallery-main {
            background: linear-gradient(145deg, #191D1B 0%, #101412 100%);
            border: 1px solid var(--cf-border);
            border-radius: 20px;
        }

        .product-thumb {
            background: var(--cf-surface);
            border: 1px solid var(--cf-border);
            border-radius: 12px;
            transition: .2s ease;
        }

        .product-thumb:hover,
        .product-thumb:focus-within {
            border-color: var(--cf-green);
            box-shadow: 0 0 0 3px rgba(0, 244, 119, .08);
        }

        .product-feature {
            background: var(--cf-surface-dark);
            border: 1px solid var(--cf-border);
            border-radius: 12px;
        }

        .product-primary-btn {
            background: var(--cf-green) !important;
            color: var(--cf-dark-text) !important;
            box-shadow: 0 0 0 rgba(0, 244, 119, 0);
            transition: background .2s ease, box-shadow .2s ease, transform .2s ease;
        }

        .product-primary-btn:hover {
            background: var(--cf-green-hover) !important;
            color: var(--cf-dark-text) !important;
            box-shadow: 0 5px 18px rgba(0, 244, 119, .22);
            transform: translateY(-1px);
        }

        .product-primary-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(0, 244, 119, .15);
        }

        .product-inquiry-btn {
            background: var(--cf-surface-hover);
            border: 1px solid rgba(0, 244, 119, .35);
            color: var(--cf-green);
            transition: .2s ease;
        }

        .product-inquiry-btn:hover {
            background: rgba(0, 244, 119, .08);
            border-color: var(--cf-green);
        }

        .product-section-title {
            position: relative;
            padding-right: 14px;
            color: var(--cf-text);
        }

        .product-section-title::before {
            content: "";
            position: absolute;
            right: 0;
            top: 5px;
            width: 4px;
            height: 22px;
            border-radius: 5px;
            background: var(--cf-green);
        }

        .product-table-row:nth-child(odd) {
            background: var(--cf-surface-dark);
        }

        .product-table-row {
            border-radius: 8px;
        }

        .product-page img {
            max-width: 100%;
        }

        .product-description {
            color: #C1CAC4;
        }

        .product-description img {
            max-width: 100%;
            height: auto;
        }

        .product-mobile-buy {
            background: rgba(16, 20, 18, .96);
            border-color: var(--cf-border);
            backdrop-filter: blur(16px);
        }

        @media (max-width: 1023px) {
            .product-mobile-buy {
                padding-bottom: max(12px, env(safe-area-inset-bottom));
            }
        }
    </style>

    <div class="product-page pb-28 lg:pb-12">

        {{-- Breadcrumb --}}
        <section class="w-11/12 mx-auto pt-5 pb-4">
            <nav class="flex items-center flex-wrap gap-2 text-xs text-[#929B95]">

                <a href="{{ route('home') }}" class="hover:text-[#00F477] transition">
                    صفحه اصلی
                </a>

                <span>/</span>

                @if ($category)
                    <form action="{{ route('search.page') }}" method="POST" class="inline-flex items-center gap-2">
                        @csrf
                        <input type="hidden" name="categoryId" value="{{ $category->id }}">
                        <button type="submit" class="hover:text-[#00F477] transition">
                            {{ $category->title }}
                        </button>
                    </form>
                    <span>/</span>
                @endif

                <span class="text-[#F4F7F5] font-bold line-clamp-1">
                    {{ $product->title }}
                </span>

            </nav>
        </section>

        {{-- Product main --}}
        <section class="w-11/12 mx-auto">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 xl:gap-9 items-start">

                {{-- Gallery --}}
                <div class="lg:col-span-5 xl:col-span-5">

                    <div class="product-gallery-main relative p-4 sm:p-6">

                        @if ($hasDiscount)
                            <div
                                class="absolute top-4 right-4 z-10 flex items-center gap-1 bg-[#00F477] text-[#06140B] text-xs font-bold px-3 py-1.5 rounded-full">
                                {{ $discountPercent }}٪ تخفیف
                            </div>
                        @endif

                        <div class="flex items-center justify-center h-[280px] sm:h-[380px] lg:h-[420px]">

                            @if ($mainMedia && $mainMedia->media_path)
                                <img class="gallery_pack_single_primary_img w-full h-full object-contain"
                                    src="{{ asset('storage/' . $mainMedia->media_path) }}" alt="{{ $product->title }}"
                                    fetchpriority="high">
                            @else
                                <img class="w-3/5 h-3/5 object-contain opacity-50"
                                    src="{{ asset('storage/images/noImage.png') }}" alt="{{ $product->title }}">
                            @endif

                        </div>
                    </div>

                    {{-- Thumbnails --}}
                    @if ($galleryMedia->count())
                        <div class="flex items-center gap-3 mt-4 overflow-x-auto pb-2" style="scrollbar-width:none;">

                            @if ($mainMedia && $mainMedia->media_path)
                                <div class="product-thumb shrink-0 p-1.5 cursor-pointer">
                                    <div class="gallery_pack_single w-[68px] h-[68px]">
                                        <img src="{{ asset('storage/' . $mainMedia->media_path) }}"
                                            alt="{{ $product->title }}" class="w-full h-full object-contain">
                                    </div>
                                </div>
                            @endif

                            @foreach ($galleryMedia as $media)
                                @if ($media->media_path)
                                    <div class="product-thumb shrink-0 p-1.5 cursor-pointer">
                                        <div class="gallery_pack_single w-[68px] h-[68px]">
                                            <img src="{{ asset('storage/' . $media->media_path) }}"
                                                alt="{{ $product->title }}" class="w-full h-full object-contain">
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    @endif

                    {{-- Trust items --}}
                    <div class="hidden lg:grid grid-cols-3 gap-3 mt-5">

                        <div class="flex flex-col items-center gap-2 text-center p-3 rounded-xl bg-[#191D1B]">
                            <span class="size-9 rounded-full bg-[#202522] flex items-center justify-center text-[#00F477]">
                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.7">
                                    <path d="M12 3 4.5 6v5.5c0 4.5 3.2 7.8 7.5 9.5 4.3-1.7 7.5-5 7.5-9.5V6L12 3Z" />
                                    <path d="m9 12 2 2 4-4" />
                                </svg>
                            </span>
                            <span class="text-xs font-medium">خرید مطمئن</span>
                        </div>

                        <div class="flex flex-col items-center gap-2 text-center p-3 rounded-xl bg-[#191D1B]">
                            <span class="size-9 rounded-full bg-[#202522] flex items-center justify-center text-[#00F477]">
                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.7">
                                    <path d="M3 7h11v11H3zM14 11h4l3 3v4h-7z" />
                                    <circle cx="7.5" cy="18" r="1.5" />
                                    <circle cx="17.5" cy="18" r="1.5" />
                                </svg>
                            </span>
                            <span class="text-xs font-medium">ارسال سفارش</span>
                        </div>

                        <div class="flex flex-col items-center gap-2 text-center p-3 rounded-xl bg-[#191D1B]">
                            <span class="size-9 rounded-full bg-[#202522] flex items-center justify-center text-[#00F477]">
                                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.7">
                                    <path d="M12 8v4l2.5 2.5" />
                                    <circle cx="12" cy="12" r="9" />
                                </svg>
                            </span>
                            <span class="text-xs font-medium">پشتیبانی خرید</span>
                        </div>

                    </div>

                </div>

                {{-- Product information --}}
                <div class="lg:col-span-7 xl:col-span-7 min-w-0">

                    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                        {{-- Title, features and description --}}
                        <div class="xl:col-span-7">

                            <div class="mb-5">

                                @if ($product->brand)
                                    <div
                                        class="inline-flex items-center gap-2 text-xs text-[#929B95] bg-[#191D1B] border border-[#2A302C] rounded-full px-3 py-1.5 mb-3">
                                        <span class="size-1.5 rounded-full bg-[#00F477]"></span>
                                        {{ $product->brand }}
                                    </div>
                                @endif

                                <h1 class="text-xl xl:text-[18px] font-bold leading-[1.9] text-[#F4F7F5]">
                                    {{ $product->title }}
                                </h1>

                                @if ($product->summary)
                                    <p class="text-sm text-[#929B95] leading-8 mt-3 text-justify">
                                        {{ $product->summary }}
                                    </p>
                                @endif

                            </div>

                            {{-- Key features --}}
                            @if ($product->attributes->count())
                                <div class="border-t border-[#2A302C] pt-5 mt-5">

                                    <div class="flex items-center justify-between mb-4">
                                        <h2 class="font-bold text-base text-[#F4F7F5]">
                                            ویژگی‌های محصول
                                        </h2>

                                        <a href="#product-specifications" class="text-xs text-[#00F477] hover:underline">
                                            مشاهده همه
                                        </a>
                                    </div>

                                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                                        @foreach ($product->attributes->take(6) as $attr)
                                            <div class="product-feature p-3 min-w-0">
                                                <p class="text-[11px] text-[#929B95] mb-1.5 truncate">
                                                    {{ $attr->attribute_key }}
                                                </p>
                                                <p
                                                    class="text-sm font-bold text-[#F4F7F5] leading-6 break-words line-clamp-2">
                                                    {{ $attr->attribute_value }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            @endif

                            {{-- Desktop short description --}}
                            <div class="hidden xl:block border-t border-[#2A302C] mt-6 pt-5">
                                <h2 class="font-bold text-base mb-3 text-[#F4F7F5]">
                                    درباره محصول
                                </h2>

                                <p class="text-sm text-[#929B95] leading-8 text-justify line-clamp-4">
                                    {{ $product->summary ?: 'برای مشاهده اطلاعات کامل این محصول، بخش توضیحات و مشخصات را بررسی کنید.' }}
                                </p>

                                <a href="#product-description"
                                    class="inline-flex items-center gap-2 mt-3 text-xs text-[#00F477] font-bold hover:underline">
                                    مطالعه توضیحات کامل
                                    <span>←</span>
                                </a>
                            </div>

                        </div>

                        {{-- Purchase card --}}
                        <div class="xl:col-span-5">

                            <div class="product-card product-shadow p-4 sm:p-5 xl:sticky xl:top-6">

                                {{-- Seller --}}
                                <div class="flex items-center justify-between pb-4 border-b border-[#2A302C]">

                                    <div>
                                        <p class="text-xs text-[#929B95] mb-1">فروشنده</p>

                                        <div class="flex items-center gap-2">
                                            <span
                                                class="size-8 rounded-xl bg-[#202522] flex items-center justify-center text-[#00F477]">
                                                <svg class="size-4" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.8">
                                                    <path d="M3 10h18l-1.5-6h-15L3 10Z" />
                                                    <path d="M5 10v10h14V10M9 20v-6h6v6" />
                                                </svg>
                                            </span>
                                            <span class="font-bold text-sm text-[#F4F7F5]">دیارابزار</span>
                                        </div>
                                    </div>

                                    <span class="text-[10px] text-[#00F477] bg-[#202522] px-2.5 py-1.5 rounded-full">
                                        فروشگاه دیارابزار
                                    </span>

                                </div>

                                {{-- Price --}}
                                <div class="py-5">

                                    @if ($hasPrice)
                                        @if ($hasDiscount)
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="text-xs text-[#929B95] line-through in-fa">
                                                    {{ number_format($product->primary_price) }}
                                                </span>
                                                <span
                                                    class="text-[11px] font-bold text-[#06140B] bg-[#00F477] px-2 py-1 rounded-md">
                                                    {{ $discountPercent }}٪ تخفیف
                                                </span>
                                            </div>
                                        @endif

                                        <div class="flex items-end justify-between gap-2">
                                            <div>
                                                <p class="text-xs text-[#929B95] mb-2">قیمت محصول</p>
                                                <div class="flex items-baseline gap-2">
                                                    <span class="text-2xl sm:text-3xl font-extrabold text-[#F4F7F5] in-fa">
                                                        {{ number_format($hasDiscount ? $product->secondary_price : $product->primary_price) }}
                                                    </span>
                                                    <span class="text-xs text-[#929B95]">تومان</span>
                                                </div>
                                            </div>

                                            <span
                                                class="text-[10px] text-[#00F477] bg-[#202522] rounded-full px-2.5 py-1.5">
                                                قیمت درج‌شده
                                            </span>
                                        </div>
                                    @else
                                        <div class="rounded-xl bg-[#101412] border border-[#2A302C] p-4">

                                            <div class="flex items-center gap-2 mb-2">
                                                <span
                                                    class="size-8 rounded-lg bg-[#202522] flex items-center justify-center text-[#00F477]">
                                                    <svg class="size-4" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.8">
                                                        <circle cx="12" cy="12" r="9" />
                                                        <path d="M12 11v5M12 8h.01" />
                                                    </svg>
                                                </span>
                                                <span class="font-bold text-sm text-[#F4F7F5]">استعلام قیمت محصول</span>
                                            </div>

                                            <p class="text-xs text-[#929B95] leading-6">
                                                برای اطلاع از قیمت و شرایط خرید این محصول، با کارشناسان دیارابزار تماس
                                                بگیرید.
                                            </p>

                                        </div>
                                    @endif

                                </div>

                                {{-- Add to cart + Price inquiry --}}
                                <div class="flex flex-col gap-2">


                                    {{-- Add to cart --}}
                                    <div class="products addToCartBtns min-w-0" data-product-id="{{ $product->id }}"
                                        data-count="{{ $product->count }}">

                                        @if ($isInCart)
                                            <div
                                                class="w-full p-1.5 h-12 flex gap-2 justify-center items-center
                    rounded-xl bg-[#101412] border border-[#2A302C]">

                                                <button type="button" onclick="setCount(this)" data-state="+"
                                                    class="w-1/3 h-9 rounded-lg flex justify-center items-center
                       text-[#00F477] hover:bg-[#00F477] hover:text-[#06140B]
                       transition-all duration-200 text-lg font-bold
                       {{ $cartQuantity >= $product->count ? 'opacity-40 cursor-not-allowed' : 'cursor-pointer' }}"
                                                    {{ $cartQuantity >= $product->count ? 'disabled' : '' }}>
                                                    +
                                                </button>

                                                <input type="number" readonly value="{{ $cartQuantity }}"
                                                    class="w-1/3 h-9 text-center text-sm font-bold
                       text-[#F4F7F5] bg-transparent outline-none in-fa">

                                                <button type="button" onclick="setCount(this)" data-state="-"
                                                    class="w-1/3 h-9 rounded-lg flex justify-center items-center
                       text-[#00F477] hover:bg-[#00F477] hover:text-[#06140B]
                       transition-all duration-200 text-lg font-bold cursor-pointer">
                                                    -
                                                </button>

                                            </div>
                                        @else
                                            @if ($product->count > 0)
                                                <button type="button" onclick="addToCart(this)"
                                                    class="product-primary-btn w-full h-12 rounded-xl !bg-(--green-btn)
                       flex items-center justify-center gap-1.5 font-bold text-xs">

                                                    <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.8">
                                                        <path
                                                            d="M3 3h2l2.2 11.5a2 2 0 0 0 2 1.6h8.9a2 2 0 0 0 2-1.6L22 7H6" />
                                                        <circle cx="10" cy="20" r="1" />
                                                        <circle cx="18" cy="20" r="1" />
                                                        <path d="M14 9v5M11.5 11.5h5" />
                                                    </svg>

                                                    <span>افزودن به سبد خرید خرید</span>

                                                </button>
                                            @else
                                                <button type="button" disabled
                                                    class="w-full h-12 rounded-xl flex items-center justify-center
                       bg-[#202522] border border-[#2A302C]
                       text-[#929B95] text-xs font-bold cursor-not-allowed">
                                                    عدم موجودی
                                                </button>
                                            @endif
                                        @endif

                                    </div>


                                    {{-- Price inquiry --}}
                                    <a href="tel:09142302912"
                                        class="product-inquiry-btn w-full h-12 rounded-xl flex items-center justify-center gap-1.5 text-xs font-bold">

                                        <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.8">
                                            <path
                                                d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.2-1.3a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.8 2.1Z" />
                                        </svg>

                                        <span>استعلام قیمت</span>
                                    </a>

                                </div>

                                {{-- Purchase notes --}}
                                <div class="border-t border-[#2A302C] mt-5 pt-4 space-y-3">

                                    <div class="flex items-center gap-2.5 text-xs text-[#929B95]">
                                        <svg class="size-4 text-[#00F477] shrink-0" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.8">
                                            <path d="M12 3 4.5 6v5.5c0 4.5 3.2 7.8 7.5 9.5 4.3-1.7 7.5-5 7.5-9.5V6L12 3Z" />
                                            <path d="m9 12 2 2 4-4" />
                                        </svg>
                                        خرید از فروشگاه دیارابزار
                                    </div>

                                    <div class="flex items-center gap-2.5 text-xs text-[#929B95]">
                                        <svg class="size-4 text-[#00F477] shrink-0" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.8">
                                            <path d="M3 7h11v11H3zM14 11h4l3 3v4h-7z" />
                                            <circle cx="7.5" cy="18" r="1.5" />
                                            <circle cx="17.5" cy="18" r="1.5" />
                                        </svg>
                                        هماهنگی ارسال پس از ثبت سفارش
                                    </div>

                                    <div class="flex items-center gap-2.5 text-xs text-[#929B95]">
                                        <svg class="size-4 text-[#00F477] shrink-0" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.8">
                                            <path d="M12 8v4l2.5 2.5" />
                                            <circle cx="12" cy="12" r="9" />
                                        </svg>
                                        پاسخ‌گویی و پشتیبانی خرید
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        {{-- Product description --}}
        <section id="product-description" class="w-11/12 mx-auto mt-10 lg:mt-14">

            <div class="product-card p-5 sm:p-7">

                <div class="mb-5">
                    <h2 class="product-section-title text-lg font-extrabold">
                        معرفی محصول
                    </h2>
                    <p class="text-xs text-[#929B95] mt-2 mr-3.5">
                        توضیحات و اطلاعات تکمیلی درباره {{ $product->title }}
                    </p>
                </div>

                <div class="product-description text-sm leading-9 text-justify overflow-hidden">
                    {!! $product->description !!}
                </div>

            </div>

        </section>

        {{-- Product specifications --}}
        @if ($product->attributes->count())
            <section id="product-specifications" class="w-11/12 mx-auto mt-6 lg:mt-8">

                <div class="product-card p-5 sm:p-7">

                    <div class="mb-6">
                        <h2 class="product-section-title text-lg font-extrabold">
                            مشخصات فنی محصول
                        </h2>
                        <p class="text-xs text-[#929B95] mt-2 mr-3.5">
                            جزئیات و ویژگی‌های فنی محصول
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-1">

                        @foreach ($product->attributes as $attribute)
                            <div class="product-table-row flex items-center gap-4 px-3 py-3.5 min-w-0">

                                <div class="w-2/5 shrink-0 text-xs sm:text-sm text-[#929B95]">
                                    {{ $attribute->attribute_key }}
                                </div>

                                <div class="w-3/5 text-xs sm:text-sm font-bold text-[#F4F7F5] break-words">
                                    {{ $attribute->attribute_value }}
                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>

            </section>
        @endif

    </div>

    {{-- Mobile fixed purchase bar --}}
    <div class="product-mobile-buy fixed bottom-0 right-0 z-[1000] w-full border-t border-[#2A302C] px-3 py-3 lg:hidden">

        <div class="flex items-center gap-3">

            {{-- Price --}}
            <div class="flex-1 min-w-0">

                @if ($hasPrice)
                    @if ($hasDiscount)
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[10px] text-[#929B95] line-through in-fa">
                                {{ number_format($product->primary_price) }}
                            </span>
                            <span class="text-[10px] text-[#00F477] font-bold">
                                {{ $discountPercent }}٪ تخفیف
                            </span>
                        </div>
                    @endif

                    <div class="flex items-baseline gap-1.5">
                        <span class="text-lg font-extrabold text-[#F4F7F5] in-fa">
                            {{ number_format($hasDiscount ? $product->secondary_price : $product->primary_price) }}
                        </span>
                        <span class="text-[10px] text-[#929B95]">تومان</span>
                    </div>
                @else
                    <p class="text-xs font-bold text-[#F4F7F5]">
                        نیاز به استعلام قیمت
                    </p>
                    <a href="tel:09142302912" dir="ltr" class="text-xs text-[#00F477] font-bold">
                        09142302912
                    </a>
                @endif

            </div>

            {{-- Buttons --}}
            <div class="flex flex-col gap-2 w-[55%]">


                {{-- Add to cart --}}
                <div class="products addToCartBtns w-full min-w-0" data-product-id="{{ $product->id }}"
                    data-count="{{ $product->count }}">

                    @if ($isInCart)
                        <div
                            class="w-full p-1 h-11 flex gap-2 justify-center items-center
                    rounded-xl bg-[#101412] border border-[#2A302C]">

                            <button type="button" onclick="setCount(this)" data-state="+"
                                class="w-1/3 h-9 flex justify-center items-center
                       text-lg font-bold text-[#00F477]
                       {{ $cartQuantity >= $product->count ? 'opacity-40 cursor-not-allowed' : 'cursor-pointer' }}"
                                {{ $cartQuantity >= $product->count ? 'disabled' : '' }}>
                                +
                            </button>

                            <input type="number" readonly value="{{ $cartQuantity }}"
                                class="w-1/3 text-center text-sm font-bold
                       text-[#F4F7F5] bg-transparent outline-none in-fa">

                            <button type="button" onclick="setCount(this)" data-state="-"
                                class="w-1/3 h-9 flex justify-center items-center
                       text-lg font-bold text-[#00F477]">
                                -
                            </button>

                        </div>
                    @else
                        @if ($product->count > 0)
                            <button type="button" onclick="addToCart(this)"
                                class="product-primary-btn w-full h-11 rounded-xl !bg-(--green-btn)
                       flex items-center justify-center gap-1 text-[10px] font-bold">

                                <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">
                                    <path d="M3 3h2l2.2 11.5a2 2 0 0 0 2 1.6h8.9a2 2 0 0 0 2-1.6L22 7H6" />
                                    <circle cx="10" cy="20" r="1" />
                                    <circle cx="18" cy="20" r="1" />
                                    <path d="M14 9v5M11.5 11.5h5" />
                                </svg>

                                افزودن به سبد خرید

                            </button>
                        @else
                            <button type="button" disabled
                                class="w-full h-11 rounded-xl flex items-center justify-center
                       bg-[#202522] border border-[#2A302C]
                       text-[#929B95] text-[10px] font-bold cursor-not-allowed">
                                عدم موجودی
                            </button>
                        @endif
                    @endif

                </div>


                {{-- Price inquiry --}}
                <a href="tel:09142302912"
                    class="product-inquiry-btn w-full h-11 rounded-xl flex items-center justify-center gap-1 text-[10px] font-bold">

                    <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">
                        <path
                            d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.2-1.3a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.8 2.1Z" />
                    </svg>

                    استعلام قیمت
                </a>

            </div>

        </div>

    </div>

    <script>
        let productId = "{{ $product->id }}";
    </script>

    <script src="{{ asset('js/singleProduct.js') }}"></script>

@endsection
