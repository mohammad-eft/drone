@extends('app.document')

@section('title', 'پهپاد استور | فروشگاه پهپاد')

@section('content')
@session('clearStorage')
<script>localStorage.clear();</script>
@endsession

<main class="bg-bg text-white font-ui antialiased overflow-x-clip" dir="rtl">
<svg width="0" height="0" class="absolute"><defs>
<symbol id="chip" viewBox="0 0 24 24"><rect x="6" y="6" width="12" height="12" rx="1"/><rect x="9.5" y="9.5" width="5" height="5"/><path d="M9 2v4M15 2v4M9 18v4M15 18v4M2 9h4M2 15h4M18 9h4M18 15h4"/></symbol>
<symbol id="cart" viewBox="0 0 24 24"><circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/><path d="M2 3h3l2.6 12.4h11.2L21 7H6"/></symbol>
<symbol id="plus" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></symbol>
<symbol id="heart" viewBox="0 0 24 24"><path d="M12 21s-8-5.3-8-11a4.6 4.6 0 0 1 8-3 4.6 4.6 0 0 1 8 3c0 5.7-8 11-8 11z"/></symbol>
<symbol id="srch" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></symbol>
<symbol id="user" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7"/></symbol>
<symbol id="arr" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></symbol>
<symbol id="send" viewBox="0 0 24 24"><path d="M2 21l21-9L2 3v7l15 2-15 2z"/></symbol>
</defs></svg>
<section class="relative mx-auto max-w-[1440px] px-[18px] md:px-10">
 <div class="pointer-events-none absolute right-0 top-[10%] hidden h-4/5 w-[55%] bg-[radial-gradient(closest-side,rgba(0,255,102,.16),transparent)] md:block"></div>
 <div class="relative flex flex-col items-center py-10 text-center md:grid md:grid-cols-2 md:content-center md:items-start md:gap-x-12 md:pb-24 md:pt-10 md:text-right">
  <span class="inline-flex items-center gap-2 rounded-full border border-g/25 bg-g/10 px-3 py-1.5 text-[11px] font-bold tracking-wider text-g before:h-1.5 before:w-1.5 before:rounded-full before:bg-g md:col-start-1 md:justify-self-start">تجهیزات حرفه‌ای پهپاد و FPV</span>
  <h1 class="my-6 font-dis text-[30px] font-black uppercase leading-[1.35] md:col-start-1 md:text-[60px] md:tracking-tight">{{ $setting['heroTitle'] }}</h1>
  <div class="mb-7 h-[216px] w-[216px] overflow-hidden rounded bg-[#0d0d0d] shadow-[0_0_50px_rgba(0,255,102,.25)] md:col-start-2 md:row-span-7 md:row-start-1 md:mb-0 md:aspect-square md:h-auto md:max-h-[460px] md:w-full md:self-center">
    <img src="{{ asset('storage/' . $setting['heroBanner']) }}" alt="{{ $setting['heroTitle'] }}" class="h-full w-full object-contain">
  </div>
  <p class="mb-7 max-w-[300px] text-[12.5px] leading-relaxed text-neutral-300 md:col-start-1 md:max-w-[430px] md:text-[17px] md:leading-[1.8]">{{ $setting['heroSubtitle'] }}</p>
  <div class="flex w-full flex-col gap-3.5 md:col-start-1 md:w-auto md:flex-row">
   <a href="{{ $setting['heroPrimaryButtonLink'] }}" class="inline-flex h-[50px] items-center justify-center gap-2.5 rounded-[5px] bg-g px-7 font-dis text-[15px] font-bold text-black shadow-[0_0_22px_rgba(0,255,102,.25)] md:h-12 md:text-sm">{{ $setting['heroPrimaryButton'] }} <svg class="h-4 w-4 fill-none stroke-current stroke-[2.4]" viewBox="0 0 24 24"><use href="#arr"/></svg></a>
   <a href="{{ $setting['heroSecondaryButtonLink'] }}" class="inline-flex h-[50px] items-center justify-center rounded-[5px] border border-neutral-700 bg-white/[.02] px-7 font-dis text-[15px] font-bold md:h-12 md:text-sm">{{ $setting['heroSecondaryButton'] }}</a>
  </div>
  <div class="mt-[70px] hidden gap-2 md:col-start-1 md:flex"><i class="h-[3px] w-8 rounded bg-g"></i><i class="h-[3px] w-[7px] rounded bg-neutral-700"></i><i class="h-[3px] w-[7px] rounded bg-neutral-700"></i><i class="h-[3px] w-[7px] rounded bg-neutral-700"></i></div>
 </div>
</section>
<section class="border-t border-line pb-[50px] pt-[30px] md:pb-[60px] md:pt-[50px]">
 <div class="mx-auto max-w-[1440px] px-[18px] md:px-10">
  <div class="mb-4 flex justify-between text-[10px] font-bold tracking-widest text-neutral-500 md:hidden"><span>دسته‌بندی محصولات</span><a href="#" class="text-g">ورق بزنید ←</a></div>
  <div class="noscroll flex max-w-full gap-3 overflow-x-auto md:grid md:grid-cols-7 md:gap-5 md:overflow-visible"><a href="#" class="flex h-[88px] w-[86px] shrink-0 flex-col items-center justify-center gap-2.5 rounded-[10px] border border-line bg-panel text-[9px] font-bold tracking-widest md:h-[130px] md:w-auto md:gap-4 md:rounded-xl md:text-[11px] mb-3">
        <span class="grid h-[38px] w-[38px] place-items-center rounded-[10px] bg-panel2 md:h-[50px] md:w-[50px]"><svg class="h-5 w-5 fill-none stroke-neutral-500 stroke-[1.8] md:h-6 md:w-6" viewBox="0 0 24 24"><use href="#chip"/></svg></span>
        <span class="md:hidden">چیپ‌ها</span><span class="hidden md:inline">کنترلرها</span>
    </a>
<a href="#" class="flex h-[88px] w-[86px] shrink-0 flex-col items-center justify-center gap-2.5 rounded-[10px] border border-line bg-panel text-[9px] font-bold tracking-widest md:h-[130px] md:w-auto md:gap-4 md:rounded-xl md:text-[11px] mb-3">
        <span class="grid h-[38px] w-[38px] place-items-center rounded-[10px] bg-panel2 md:h-[50px] md:w-[50px]"></span>
        <span class="md:hidden">سنسورها</span><span class="hidden md:inline">سنسورها</span>
    </a>
<a href="#" class="flex h-[88px] w-[86px] shrink-0 flex-col items-center justify-center gap-2.5 rounded-[10px] border border-line bg-panel text-[9px] font-bold tracking-widest md:h-[130px] md:w-auto md:gap-4 md:rounded-xl md:text-[11px] mb-3">
        <span class="grid h-[38px] w-[38px] place-items-center rounded-[10px] bg-panel2 md:h-[50px] md:w-[50px]"><svg class="h-5 w-5 fill-none stroke-neutral-500 stroke-[1.8] md:h-6 md:w-6" viewBox="0 0 24 24"><path d="M12 3l8 4.5v9L12 21l-8-4.5v-9zM4 7.5l8 4.5 8-4.5M12 12v9"/></svg></span>
        <span class="md:hidden">فریم‌ها</span><span class="hidden md:inline">فریم‌ها</span>
    </a>
<a href="#" class="flex h-[88px] w-[86px] shrink-0 flex-col items-center justify-center gap-2.5 rounded-[10px] border border-line bg-panel text-[9px] font-bold tracking-widest md:h-[130px] md:w-auto md:gap-4 md:rounded-xl md:text-[11px] mb-3">
        <span class="grid h-[38px] w-[38px] place-items-center rounded-[10px] bg-panel2 md:h-[50px] md:w-[50px]"><svg class="h-5 w-5 fill-none stroke-neutral-500 stroke-[1.8] md:h-6 md:w-6" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/><path d="M12 10C12 5 15 3 17 5s0 5-5 5zM14 12c5 0 7 3 5 5s-5 0-5-5zM12 14c0 5-3 7-5 5s0-5 5-5zM10 12C5 12 3 9 5 7s5 0 5 5z"/></svg></span>
        <span class="md:hidden">موتورها</span><span class="hidden md:inline">موتورها</span>
    </a>
<a href="#" class="flex h-[88px] w-[86px] shrink-0 flex-col items-center justify-center gap-2.5 rounded-[10px] border border-line bg-panel text-[9px] font-bold tracking-widest md:h-[130px] md:w-auto md:gap-4 md:rounded-xl md:text-[11px] mb-3">
        <span class="grid h-[38px] w-[38px] place-items-center rounded-[10px] bg-panel2 md:h-[50px] md:w-[50px]"><svg class="h-5 w-5 fill-none stroke-neutral-500 stroke-[1.8] md:h-6 md:w-6" viewBox="0 0 24 24"><path d="M14 6l4 4M4 20l9-9M15 3l6 6-3 3-6-6zM3 9l5-5 3 3-5 5z"/></svg></span>
        <span class="md:hidden">ابزارها</span><span class="hidden md:inline">ابزارها</span>
    </a>
<a href="#" class="flex h-[88px] w-[86px] shrink-0 flex-col items-center justify-center gap-2.5 rounded-[10px] border border-line bg-panel text-[9px] font-bold tracking-widest md:h-[130px] md:w-auto md:gap-4 md:rounded-xl md:text-[11px] mb-3">
        <span class="grid h-[38px] w-[38px] place-items-center rounded-[10px] bg-panel2 md:h-[50px] md:w-[50px]"><svg class="h-5 w-5 fill-none stroke-neutral-500 stroke-[1.8] md:h-6 md:w-6" viewBox="0 0 24 24"><path d="M3 8l9-5 9 5v9l-9 5-9-5zM3 8l9 5 9-5M12 13v9"/></svg></span>
        <span class="md:hidden">کیت‌ها</span><span class="hidden md:inline">کیت‌ها</span>
    </a>
<a href="#" class="flex h-[88px] w-[86px] shrink-0 flex-col items-center justify-center gap-2.5 rounded-[10px] border border-line bg-panel text-[9px] font-bold tracking-widest md:h-[130px] md:w-auto md:gap-4 md:rounded-xl md:text-[11px] mb-3">
        <span class="grid h-[38px] w-[38px] place-items-center rounded-[10px] bg-panel2 md:h-[50px] md:w-[50px]"><svg class="h-5 w-5 fill-none stroke-neutral-500 stroke-[1.8] md:h-6 md:w-6" viewBox="0 0 24 24"><circle cx="5" cy="12" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="19" cy="12" r="1.5"/></svg></span>
        <span class="md:hidden">بیشتر</span><span class="hidden md:inline">بیشتر</span>
    </a></div>
 </div>
</section>
<section class="mx-auto max-w-[1440px] px-[18px] pt-[34px] md:px-10 md:pt-[60px]">
 <div class="mb-5 flex items-center justify-between md:mb-[34px]"><h2 class="border-r-[3px] border-g pr-3.5 font-dis text-[21px] font-black uppercase leading-none md:text-[28px]">پیشنهادهای <span class="text-g">ویژه</span></h2><a href="{{ route('product.index') }}" class="text-[10px] font-semibold uppercase text-neutral-400 md:text-xs">مشاهده همه ←</a></div>
 <div class="grid grid-cols-2 gap-3 md:grid-cols-4 md:gap-5">
 @if(isset($products) && count($products) > 0)
  @foreach($products as $product)
    <article class="flex flex-col rounded-xl border border-line bg-panel p-2.5 md:rounded-[14px] md:p-3 products" data-product-id="{{ $product->id }}">
    <div class="relative grid aspect-[1.05] place-items-center overflow-hidden rounded-[10px] bg-[#0b0b0b] md:aspect-[1.1]">
        <a href="{{ route('product.show', [$product->id]) }}" class="grid h-full w-full place-items-center">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="h-full w-[85%] object-contain" loading="lazy">
        </a>
        @if ($product->percent)
            <span class="absolute right-2 top-2 rounded-[3px] bg-g px-[7px] py-[3px] text-[10px] font-bold text-black">-{{ $product->percent }}%</span>
        @endif
        <button type="button" aria-label="افزودن به علاقه‌مندی‌ها" class="absolute left-2 top-2 hidden h-6 w-6 place-items-center rounded-full bg-black/60 md:grid">
            <svg class="h-3 w-3 fill-none stroke-white stroke-2" viewBox="0 0 24 24"><use href="#heart"/></svg>
        </button>
    </div>
    <div class="flex flex-1 flex-col px-1 pb-0.5 pt-3 md:px-1.5 md:pb-1.5 md:pt-4">
        @if (!empty($product->summary))<span class="hidden text-[10px] font-bold uppercase tracking-wider text-neutral-500 md:block">{{ $product->summary }}</span>@endif
        <a href="{{ route('product.show', [$product->id]) }}" class="mb-2 mt-3 text-[12.5px] font-semibold leading-snug md:mb-3.5 md:mt-2 md:text-base md:leading-[1.3]">{{ $product->title }}</a>
        <div class="mt-auto flex items-end justify-between gap-2">
            <div>
                @if ($product->secondary_price)
                    <span class="block text-[10px] text-neutral-600 line-through">{{ number_format($product->primary_price) }} تومان</span>
                    <span class="font-dis text-[17px] font-bold text-g md:text-xl">{{ number_format($product->secondary_price) }} <small class="font-ui text-[10px]">تومان</small></span>
                @elseif ($product->primary_price)
                    <span class="font-dis text-[17px] font-bold text-g md:text-xl">{{ number_format($product->primary_price) }} <small class="font-ui text-[10px]">تومان</small></span>
                @else
                    <span class="text-[10px] text-neutral-400">جهت استعلام قیمت</span>
                @endif
            </div>
            <div class="addToCartBtns" data-product-id="{{ $product->id }}" data-count="{{ $product->count }}">
                @if ($product->count > 0)
                    <button type="button" onclick="addToCart(this)" aria-label="افزودن به سبد خرید" title="افزودن به سبد خرید" class="grid h-[30px] w-[30px] shrink-0 place-items-center rounded-[7px] bg-g text-black transition-all duration-200 hover:brightness-110 active:scale-95 disabled:cursor-wait disabled:opacity-70 md:h-8 md:w-8">
                        <span class="text-xl leading-none md:hidden">+</span>
                        <svg class="hidden h-4 w-4 fill-none stroke-current stroke-[2.2] md:block" viewBox="0 0 24 24" aria-hidden="true"><use href="#cart"/></svg>
                    </button>
                @else
                    <button type="button" disabled aria-label="ناموجود" class="grid h-[30px] w-[30px] place-items-center rounded-[7px] bg-neutral-700 md:h-8 md:w-8">×</button>
                @endif
            </div>
        </div>
    </div>
</article>
  @endforeach
 @endif
 </div>
</section>
<section class="mx-auto max-w-[1440px] px-[18px] pt-[34px] md:px-10 md:pt-[60px]">
 <div class="mb-5 flex items-center justify-between md:mb-[34px]"><h2 class="border-r-[3px] border-g pr-3.5 font-dis text-[21px] font-black uppercase leading-none md:text-[28px]">تازه‌<span class="text-g">رسیده‌ها</span></h2><a href="{{ route('product.index') }}" class="text-[10px] font-semibold uppercase text-neutral-400 md:text-xs">مشاهده مجموعه ←</a></div>
 <div class="grid grid-cols-2 gap-3 md:grid-cols-4 md:gap-5">
 @if(isset($newProducts) && count($newProducts) > 0)
  @foreach($newProducts as $product)
    <article class="flex flex-col rounded-xl border border-line bg-panel p-2.5 md:rounded-[14px] md:p-3 products" data-product-id="{{ $product->id }}">
    <div class="relative grid aspect-[1.05] place-items-center overflow-hidden rounded-[10px] bg-[#0b0b0b] md:aspect-[1.1]">
        <a href="{{ route('product.show', [$product->id]) }}" class="grid h-full w-full place-items-center">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="h-full w-[85%] object-contain" loading="lazy">
        </a>
        @if ($product->percent)
            <span class="absolute right-2 top-2 rounded-[3px] bg-g px-[7px] py-[3px] text-[10px] font-bold text-black">-{{ $product->percent }}%</span>
        @endif
        <button type="button" aria-label="افزودن به علاقه‌مندی‌ها" class="absolute left-2 top-2 hidden h-6 w-6 place-items-center rounded-full bg-black/60 md:grid">
            <svg class="h-3 w-3 fill-none stroke-white stroke-2" viewBox="0 0 24 24"><use href="#heart"/></svg>
        </button>
    </div>
    <div class="flex flex-1 flex-col px-1 pb-0.5 pt-3 md:px-1.5 md:pb-1.5 md:pt-4">
        @if (!empty($product->summary))<span class="hidden text-[10px] font-bold uppercase tracking-wider text-neutral-500 md:block">{{ $product->summary }}</span>@endif
        <a href="{{ route('product.show', [$product->id]) }}" class="mb-2 mt-3 text-[12.5px] font-semibold leading-snug md:mb-3.5 md:mt-2 md:text-base md:leading-[1.3]">{{ $product->title }}</a>
        <div class="mt-auto flex items-end justify-between gap-2">
            <div>
                @if ($product->secondary_price)
                    <span class="block text-[10px] text-neutral-600 line-through">{{ number_format($product->primary_price) }} تومان</span>
                    <span class="font-dis text-[17px] font-bold text-g md:text-xl">{{ number_format($product->secondary_price) }} <small class="font-ui text-[10px]">تومان</small></span>
                @elseif ($product->primary_price)
                    <span class="font-dis text-[17px] font-bold text-g md:text-xl">{{ number_format($product->primary_price) }} <small class="font-ui text-[10px]">تومان</small></span>
                @else
                    <span class="text-[10px] text-neutral-400">جهت استعلام قیمت</span>
                @endif
            </div>
            <div class="addToCartBtns" data-product-id="{{ $product->id }}" data-count="{{ $product->count }}">
                @if ($product->count > 0)
                    <button type="button" onclick="addToCart(this)" aria-label="افزودن به سبد خرید" title="افزودن به سبد خرید" class="grid h-[30px] w-[30px] shrink-0 place-items-center rounded-[7px] bg-g text-black transition-all duration-200 hover:brightness-110 active:scale-95 disabled:cursor-wait disabled:opacity-70 md:h-8 md:w-8">
                        <span class="text-xl leading-none md:hidden">+</span>
                        <svg class="hidden h-4 w-4 fill-none stroke-current stroke-[2.2] md:block" viewBox="0 0 24 24" aria-hidden="true"><use href="#cart"/></svg>
                    </button>
                @else
                    <button type="button" disabled aria-label="ناموجود" class="grid h-[30px] w-[30px] place-items-center rounded-[7px] bg-neutral-700 md:h-8 md:w-8">×</button>
                @endif
            </div>
        </div>
    </div>
</article>
  @endforeach
 @endif
 </div>
</section>
<!-- TRUST -->
<section class="mt-[50px] border-t border-line md:mt-20">
 <div class="mx-auto grid max-w-[1440px] grid-cols-2 gap-x-2.5 gap-y-[34px] px-[18px] py-[54px] md:grid-cols-4 md:gap-5 md:px-10 md:py-[50px]"><div class="flex flex-col items-center gap-2.5 text-center md:flex-row md:gap-3.5 md:text-right">
        <i class="grid h-[46px] w-[46px] shrink-0 place-items-center rounded-full bg-g/10 md:h-[42px] md:w-[42px]">
            <svg class="h-5 w-5 fill-none stroke-g stroke-2" viewBox="0 0 24 24"><path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6z"/></svg>
        </i>
        <div><b class="block text-[11px] uppercase tracking-wider md:text-sm md:normal-case md:tracking-normal">پرداخت امن</b><small class="text-[9px] text-neutral-500 md:text-[11px]">رمزنگاری ۱۲۸ بیتی</small></div>
    </div>
<div class="flex flex-col items-center gap-2.5 text-center md:flex-row md:gap-3.5 md:text-right">
        <i class="grid h-[46px] w-[46px] shrink-0 place-items-center rounded-full bg-g/10 md:h-[42px] md:w-[42px]">
            <svg class="h-5 w-5 fill-none stroke-g stroke-2" viewBox="0 0 24 24"><path d="M2 6h12v10H2zM14 9h4l4 4v3h-8z"/><circle cx="7" cy="18" r="2"/><circle cx="17" cy="18" r="2"/></svg>
        </i>
        <div><b class="block text-[11px] uppercase tracking-wider md:text-sm md:normal-case md:tracking-normal">ارسال سریع</b><small class="text-[9px] text-neutral-500 md:text-[11px]">ارسال سریع به سراسر کشور</small></div>
    </div>
<div class="flex flex-col items-center gap-2.5 text-center md:flex-row md:gap-3.5 md:text-right">
        <i class="grid h-[46px] w-[46px] shrink-0 place-items-center rounded-full bg-g/10 md:h-[42px] md:w-[42px]">
            <svg class="h-5 w-5 fill-none stroke-g stroke-2" viewBox="0 0 24 24"><path d="M4 12a8 8 0 1 0 3-6.2M4 4v4h4"/></svg>
        </i>
        <div><b class="block text-[11px] uppercase tracking-wider md:text-sm md:normal-case md:tracking-normal">۷ روز ضمانت بازگشت</b><small class="text-[9px] text-neutral-500 md:text-[11px]">بدون دردسر و پرسش اضافه</small></div>
    </div>
<div class="flex flex-col items-center gap-2.5 text-center md:flex-row md:gap-3.5 md:text-right">
        <i class="grid h-[46px] w-[46px] shrink-0 place-items-center rounded-full bg-g/10 md:h-[42px] md:w-[42px]">
            <svg class="h-5 w-5 fill-none stroke-g stroke-2" viewBox="0 0 24 24"><path d="M4 14v-2a8 8 0 0 1 16 0v2M4 14h3v5H4zM17 14h3v5h-3z"/></svg>
        </i>
        <div><b class="block text-[11px] uppercase tracking-wider md:text-sm md:normal-case md:tracking-normal">پشتیبانی فنی</b><small class="text-[9px] text-neutral-500 md:text-[11px]">پشتیبانی تخصصی مهندسان</small></div>
    </div></div>
</section>
</main>
@endsection
