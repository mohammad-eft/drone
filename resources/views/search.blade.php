
@extends('app.document')

@section('title', 'دیارابزار | جستجوی محصولات')

@section('content')

@php
    $searchTitle = trim($title ?? '');
@endphp

<style>
    .search-page {
        color: #F4F7F5;
        font-size: 12px;
    }

    .search-page button,
    .search-page input {
        font-family: inherit;
    }

    .search-page button:focus-visible,
    .search-page input:focus-visible {
        outline: 2px solid rgba(0, 244, 119, .35);
        outline-offset: 2px;
    }

    .search-page .soft-card {
        background: #191D1B;
        border: 1px solid #2A302C;
        border-radius: 14px;
    }

    .search-page .filter-section + .filter-section {
        border-top: 1px solid #2A302C;
    }

    .search-page .product-card {
        background: #191D1B;
        border-color: #2A302C;
        transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
    }

    .search-page .product-card:hover {
        border-color: rgba(0, 244, 119, .5);
        box-shadow: 0 8px 24px rgba(0, 244, 119, .06);
        transform: translateY(-3px);
    }

    .search-page .sort-btn {
        white-space: nowrap;
        color: #929B95;
        transition: all .2s ease;
    }

    .search-page .sort-btn:hover {
        color: #00F477;
        background: #202522;
    }

    .search-page .sort-btn.active {
        color: #00F477;
        background: #202522;
        font-weight: 800;
    }

    .search-page .filter-check {
        accent-color: #00F477;
        width: 14px;
        height: 14px;
        cursor: pointer;
    }

    .search-page .search-input {
        font-size: 12px;
        color: #F4F7F5;
    }

    .search-page .search-input::placeholder {
        color: #929B95;
    }

    .search-page .search-input:focus {
        outline: none;
    }

    .search-page .product-image {
        background: #101412;
    }

    

    @media (max-width: 767px) {
        .search-page #filterSection {
            visibility: hidden;
            transform: translateX(100%);
        }

        .search-page #filterSection.active {
            visibility: visible;
            transform: translateX(0);
        }

        .search-page #filterBg.active {
            opacity: 1;
            visibility: visible;
        }

        body.filters-open {
            overflow: hidden;
        }
    }

    /* ================= CATEGORY SCROLLBAR ================= */

.search-page .category-list {
    max-height: 280px;
    overflow-y: auto;
    overflow-x: hidden;
    scrollbar-width: thin;
    scrollbar-color: #00F477 #101412;
    padding-left: 6px;
}

/* Chrome, Edge, Safari */
.search-page .category-list::-webkit-scrollbar {
    width: 6px;
}

.search-page .category-list::-webkit-scrollbar-track {
    background: #101412;
    border-radius: 20px;
    margin-block: 5px;
}

.search-page .category-list::-webkit-scrollbar-thumb {
    background: linear-gradient(
        180deg,
        #39FF98 0%,
        #00F477 100%
    );
    border-radius: 20px;
    border: 1px solid #191D1B;
}

.search-page .category-list::-webkit-scrollbar-thumb:hover {
    background: #39FF98;
    box-shadow: 0 0 8px rgba(0, 244, 119, 0.35);
}

/* Category Scrollbar */
.category-scroll {
    scrollbar-width: thin;
    scrollbar-color: #3A443E #191D1B;
    overscroll-behavior: contain;
}

.category-scroll::-webkit-scrollbar {
    width: 5px;
}

.category-scroll::-webkit-scrollbar-track {
    background: #191D1B;
    border-radius: 20px;
}

.category-scroll::-webkit-scrollbar-thumb {
    background: #3A443E;
    border-radius: 20px;
    border: 1px solid #191D1B;
    transition: background 0.2s ease;
}

.category-scroll::-webkit-scrollbar-thumb:hover {
    background: #00F477;
}
</style>

<main class="search-page max-w-[1380px] mx-auto px-3 sm:px-5 lg:px-7 py-6 md:py-9">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-[#929B95] mb-6">
        <a href="/" class="hover:text-[#00F477] transition">خانه</a>
        <span class="text-[#2A302C]">/</span>
        <span class="font-semibold text-[#00F477]">جستجوی محصولات</span>
    </div>

    {{-- Heading --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <span class="w-5 h-[2px] rounded-full bg-[#00F477]"></span>
            <span class="text-sm font-extrabold tracking-[1.5px] text-[#00F477]">
                DIAARABZAR SEARCH
            </span>
        </div>

        <h1 id="title" class="text-base md:text-xl font-black text-[#F4F7F5] leading-8">
            @if($searchTitle !== '')
                نتایج جستجو برای «{{ $searchTitle }}»
            @else
                جستجوی محصولات
            @endif
        </h1>

        <p id="resultCount" class="text-sm text-[#929B95] mt-1">
            @if($searchTitle !== '')
                محصولات مرتبط با جستجوی شما
            @else
                محصول مورد نظرت را جستجو کن.
            @endif
        </p>
    </div>

    {{-- Main layout --}}
    <div class="grid grid-cols-1 md:grid-cols-[225px_minmax(0,1fr)] lg:grid-cols-[245px_minmax(0,1fr)] gap-4 lg:gap-5">

        {{-- Mobile overlay --}}
        <div id="filterBg"
             class="fixed inset-0 z-[60] bg-black/70 backdrop-blur-[2px] opacity-0 invisible transition-all duration-300 md:hidden">
        </div>

        {{-- Sidebar --}}
        <aside id="filterSection"
               class="fixed top-0 right-0 bottom-0 z-[70] w-[min(86vw,330px)] overflow-y-auto shadow-2xl transition-all duration-300 md:visible md:translate-x-0 md:static md:z-auto md:w-auto md:shadow-none md:overflow-visible md:transform-none">
            <div class="bg-[#191D1B] md:rounded-[14px] md:border md:border-[#2A302C]">
                {{-- Sidebar header --}}
                <div class="sticky top-0 z-10 bg-[#191D1B] flex items-center justify-between px-4 py-4 border-b border-[#2A302C] md:rounded-t-[14px]">

                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-[10px] bg-[#202522] text-[#00F477] flex items-center justify-center">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.7">
                                <path d="M4 7h16M7 12h10m-7 5h4"/>
                                <circle cx="8" cy="7" r="1.3" fill="currentColor"/>
                                <circle cx="15" cy="12" r="1.3" fill="currentColor"/>
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-[11px] font-extrabold text-[#F4F7F5]">فیلتر محصولات</h2>
                            <p class="text-sm text-[#929B95] mt-0.5">دقیق‌تر جستجو کن</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button id="resetFilters" type="button"
                                class="text-sm font-bold text-[#00F477] hover:text-[#39FF98] transition">
                            پاک کردن
                        </button>

                        <button id="closeFilters" type="button"
                                class="md:hidden w-7 h-7 rounded-lg bg-[#202522] text-[#929B95] hover:text-[#F4F7F5] flex items-center justify-center transition">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="m18 6-12 12M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Categories --}}
                <section class="filter-section px-4 py-4">
                    <h3 class="text-sm font-extrabold text-[#F4F7F5] mb-3">
                        دسته‌بندی محصولات
                    </h3>

                    <div class="category-scroll space-y-3 max-h-[260px] overflow-y-auto pl-1">
                        @foreach ($categories as $category)
                            <label class="flex items-center gap-2.5 cursor-pointer group">
                                <input
                                    class="categories filter-check rounded"
                                    type="checkbox"
                                    data-filter="{{ $category->id }}">

                                <span class="text-sm text-[#929B95] group-hover:text-[#00F477] transition">
                                    {{ $category->title }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </section>

                {{-- Price --}}
                <section class="filter-section px-4 py-4">
                    <h3 class="text-sm font-extrabold text-[#F4F7F5] mb-3">
                        محدوده قیمت
                    </h3>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label for="minPrice" class="block text-sm text-[#929B95] mb-1.5">
                                حداقل قیمت
                            </label>
                            <input id="minPrice"
                                type="number"
                                min="0"
                                placeholder="از"
                                class="w-full min-w-0 bg-[#101412] border border-[#2A302C] rounded-[9px] px-2.5 py-2.5 text-sm text-[#F4F7F5] outline-none focus:border-[#00F477] transition">
                        </div>

                        <div>
                            <label for="maxPrice" class="block text-sm text-[#929B95] mb-1.5">
                                حداکثر قیمت
                            </label>
                            <input id="maxPrice"
                                type="number"
                                min="0"
                                placeholder="تا"
                                class="w-full min-w-0 bg-[#101412] border border-[#2A302C] rounded-[9px] px-2.5 py-2.5 text-sm text-[#F4F7F5] outline-none focus:border-[#00F477] transition">
                        </div>
                    </div>

                    <p class="text-sm text-[#929B95] mt-2">
                        قیمت‌ها به تومان هستند.
                    </p>
                </section>

                {{-- Other filters --}}
                <section class="filter-section px-4 py-4 space-y-4">

                    <label class="flex items-center justify-between gap-2 cursor-pointer">
                        <div>
                            <span class="block text-sm font-bold text-[#F4F7F5]">
                                محصولات تخفیف‌دار
                            </span>
                            <span class="block text-sm text-[#929B95] mt-1">
                                فقط کالاهای دارای تخفیف
                            </span>
                        </div>

                        <input id="hasDescount" class="filter-check" type="checkbox">
                    </label>

                    <div class="h-px bg-[#2A302C]"></div>

                    <label class="flex items-center justify-between gap-2 cursor-pointer">
                        <div>
                            <span class="block text-sm font-bold text-[#F4F7F5]">
                                کالاهای موجود
                            </span>
                            <span class="block text-sm text-[#929B95] mt-1">
                                محصولات آماده ارسال
                            </span>
                        </div>

                        <input id="exists" class="filter-check" type="checkbox">
                    </label>

                </section>

                {{-- Mobile apply --}}
                <div class="px-4 pb-4 md:hidden">
                    <button id="applyFilters" type="button"
                            class="w-full bg-[#00F477] hover:bg-[#39FF98] text-[#06140B] rounded-[10px] py-3 text-sm font-black transition">
                        نمایش نتایج
                    </button>
                </div>

            </div>

        </aside>

        {{-- Results --}}
        <section class="min-w-0">

            {{-- Search box --}}
            <div class="soft-card p-2 flex items-center gap-2.5 mb-4 shadow-[0_2px_10px_rgba(0,0,0,0.12)] focus-within:border-[#00F477] transition">

                <div class="w-9 h-9 shrink-0 rounded-[10px] bg-[#202522] text-[#00F477] flex items-center justify-center">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.7">
                        <circle cx="10.5" cy="10.5" r="6.5"/>
                        <path d="m16 16 5 5"/>
                    </svg>
                </div>

                <input
                    type="text"
                    id="searchInp"
                    value="{{ $searchTitle }}"
                    placeholder="نام محصول یا ابزار مورد نظر..."
                    autocomplete="off"
                    class="search-input w-full min-w-0 py-2.5 bg-transparent outline-none text-[#F4F7F5] placeholder:text-[#929B95]">

                <button type="button" id="searchButton"
                        class="shrink-0 bg-[#00F477] hover:bg-[#39FF98] text-[#06140B] rounded-[9px] px-4 py-2.5 text-sm font-black transition">
                    جستجو
                </button>
            </div>

            {{-- Toolbar --}}
            <div class="soft-card px-3 py-3 md:px-4 mb-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">

                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-[9px] bg-[#202522] text-[#00F477] flex items-center justify-center">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.7">
                                <path d="M4 6h16M7 12h10m-7 6h4"/>
                            </svg>
                        </div>

                        <span class="text-sm font-bold text-[#F4F7F5]">
                            مرتب‌سازی:
                        </span>
                    </div>

                    <div class="flex items-center gap-1.5 overflow-x-auto max-w-full">
                        <button type="button"
                                class="sort-btn active text-sm px-3 py-2 rounded-lg"
                                data-sort-by="created_at"
                                data-sort-type="desc">
                            جدیدترین
                        </button>

                        <button type="button"
                                class="sort-btn text-sm px-3 py-2 rounded-lg"
                                data-sort-by="primary_price"
                                data-sort-type="asc">
                            ارزان‌ترین
                        </button>

                        <button type="button"
                                class="sort-btn text-sm px-3 py-2 rounded-lg"
                                data-sort-by="primary_price"
                                data-sort-type="desc">
                            گران‌ترین
                        </button>
                    </div>
                </div>
            </div>

            {{-- Mobile filter button --}}
            <div id="chips" class="mb-4 md:hidden">
                <button id="openFilters" type="button"
                        class="w-full flex items-center justify-center gap-2 bg-[#191D1B] border border-[#2A302C] rounded-[10px] px-4 py-3 text-sm font-bold text-[#F4F7F5] hover:border-[#00F477] transition">

                    <svg class="w-3.5 h-3.5 text-[#00F477]" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.8">
                        <path d="M4 7h16M7 12h10m-7 5h4"/>
                    </svg>

                    فیلتر و محدود کردن نتایج
                </button>
            </div>

            {{-- Products --}}
            <div id="products"
                 class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-2.5 md:gap-3">

                @foreach ($products as $product)

                    <a href="{{ route('product.show', [$product->id]) }}"
                       class="product-card group relative min-w-0 border rounded-[13px] p-2.5 md:p-3">

                        {{-- Discount --}}
                        @if ($product->percent)
                            <span class="absolute top-3 right-3 z-10 bg-[#00F477] text-[#06140B] rounded-md text-sm font-black px-1.5 py-1">
                                {{ $product->percent }}٪ تخفیف
                            </span>
                        @endif

                        {{-- Image --}}
                        <div class="product-image relative rounded-[10px] overflow-hidden mb-3">
                            <img src="{{ asset('storage/'.$product->image) }}"
                                 alt="{{ $product->title }}"
                                 loading="lazy"
                                 class="w-full aspect-square object-contain p-3 transition-transform duration-500 group-hover:scale-105">

                            <div class="absolute bottom-2 left-2 w-6 h-6 rounded-md bg-[#202522] text-[#00F477] flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="1.8">
                                    <path d="M7 17 17 7M7 7h10v10"/>
                                </svg>
                            </div>
                        </div>

                        {{-- Title --}}
                        <h3 class="text-sm md:text-[11px] font-bold text-[#F4F7F5] leading-6 h-12 overflow-hidden line-clamp-2 group-hover:text-[#00F477] transition">
                            {{ $product->title }}
                        </h3>

                        {{-- Price --}}
                        @if ($product->primary_price || $product->secondary_price)
                            <div class="mt-2.5 pt-2.5 border-t border-dashed border-[#2A302C] min-h-[62px]">

                                @if ($product->secondary_price)
                                    <div class="flex items-center justify-between gap-1 mb-1">
                                        <span class="text-sm text-[#929B95]">قیمت فروش</span>
                                        <span class="text-sm text-[#929B95] line-through">
                                            {{ number_format($product->primary_price) }}
                                        </span>
                                    </div>

                                    <div class="flex items-end justify-between gap-1">
                                        <strong class="text-[12px] md:text-[13px] font-black text-[#00F477]">
                                            {{ number_format($product->secondary_price) }}
                                        </strong>
                                        <span class="text-sm text-[#929B95]">تومان</span>
                                    </div>
                                @else
                                    <div class="flex items-center justify-between gap-1 mb-1">
                                        <span class="text-sm text-[#929B95]">قیمت محصول</span>
                                    </div>

                                    <div class="flex items-end justify-between gap-1">
                                        <strong class="text-[12px] md:text-[13px] font-black text-[#00F477]">
                                            {{ number_format($product->primary_price) }}
                                        </strong>
                                        <span class="text-sm text-[#929B95]">تومان</span>
                                    </div>
                                @endif

                            </div>
                        @else
                            <div class="mt-2.5 pt-2.5 border-t border-dashed border-[#2A302C] min-h-[62px]">
                                <div class="flex flex-col justify-between gap-1">
                                    <span class="text-xs text-[#929B95]">قیمت محصول</span>
                                    <strong class="text-[12px] md:text-base font-black text-[#00F477]">
                                        تماس بگیرید
                                    </strong>
                                </div>
                            </div>
                        @endif

                        {{-- Stock --}}
                        <div class="flex items-center justify-between gap-1 mt-2.5 pt-2.5 border-t border-[#2A302C]">

                            @if ($product->count > 0)
                                <span class="flex items-center gap-1 text-sm text-[#00F477] font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#00F477]"></span>
                                    موجود
                                </span>
                            @else
                                <span class="flex items-center gap-1 text-sm text-red-400 font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                                    ناموجود
                                </span>
                            @endif

                            <span class="text-sm text-[#00F477] font-bold">
                                مشاهده
                                <span class="text-xs">←</span>
                            </span>
                        </div>

                    </a>

                @endforeach

            </div>

            {{-- Empty state --}}
            <div id="empty"
                 class="hidden bg-[#191D1B] border border-[#2A302C] rounded-[14px] text-center px-4 py-16">

                <div class="w-12 h-12 mx-auto mb-4 rounded-xl bg-[#202522] text-[#00F477] flex items-center justify-center">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5">
                        <circle cx="10.5" cy="10.5" r="6.5"/>
                        <path d="m16 16 5 5M8 10.5h5"/>
                    </svg>
                </div>

                <h2 class="text-sm font-black text-[#F4F7F5]">
                    محصولی پیدا نشد
                </h2>

                <p class="text-sm text-[#929B95] mt-2 leading-6">
                    محصولی با این عبارت یا فیلترها پیدا نکردیم.
                    عبارت جستجو یا فیلترها را تغییر بده.
                </p>

                <button type="button"
                        onclick="document.getElementById('resetFilters').click()"
                        class="mt-4 bg-[#00F477] hover:bg-[#39FF98] text-[#06140B] text-sm font-black rounded-[9px] px-5 py-2.5 transition">
                    پاک کردن فیلترها
                </button>
            </div>

        </section>
    </div>
</main>

{{-- Scripts --}}
<script src="{{ asset('js/filters.js') }}"></script>

<script>
    window.filters = window.filters || {};
    window.filters.keyword = @json($searchTitle);

    (function () {
        const searchInput = document.getElementById('searchInp');
        const searchButton = document.getElementById('searchButton');
        const title = document.getElementById('title');
        const resultCount = document.getElementById('resultCount');

        const filterSection = document.getElementById('filterSection');
        const filterBg = document.getElementById('filterBg');
        const openFilters = document.getElementById('openFilters');
        const closeFilters = document.getElementById('closeFilters');
        const applyFilters = document.getElementById('applyFilters');

        if (!searchInput) return;

        function updateTitle() {
            const keyword = searchInput.value.trim();

            if (title) {
                title.textContent = keyword
                    ? `نتایج جستجو برای «${keyword}»`
                    : 'جستجوی محصولات';
            }

            if (resultCount) {
                resultCount.textContent = keyword
                    ? 'محصولات مرتبط با جستجوی شما'
                    : 'محصول مورد نظرت را جستجو کن.';
            }
        }

        function performSearch() {
            const keyword = searchInput.value.trim();

            window.filters = window.filters || {};
            window.filters.keyword = keyword;

            updateTitle();

            searchInput.dispatchEvent(new Event('input', { bubbles: true }));
        }

        searchInput.addEventListener('input', updateTitle);

        searchInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                performSearch();
                searchInput.blur();
            }
        });

        if (searchButton) {
            searchButton.addEventListener('click', performSearch);
        }

        function openFilterPanel() {
            if (!filterSection || !filterBg) return;

            filterSection.classList.add('active');
            filterBg.classList.add('active');
            document.body.classList.add('filters-open');
        }

        function closeFilterPanel() {
            if (!filterSection || !filterBg) return;

            filterSection.classList.remove('active');
            filterBg.classList.remove('active');
            document.body.classList.remove('filters-open');
        }

        if (openFilters) {
            openFilters.addEventListener('click', openFilterPanel);
        }

        if (closeFilters) {
            closeFilters.addEventListener('click', closeFilterPanel);
        }

        if (filterBg) {
            filterBg.addEventListener('click', closeFilterPanel);
        }

        if (applyFilters) {
            applyFilters.addEventListener('click', closeFilterPanel);
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeFilterPanel();
            }
        });

        updateTitle();
    })();
</script>

<script src="{{ asset('js/filterStore.js') }}"></script>

@endsection
