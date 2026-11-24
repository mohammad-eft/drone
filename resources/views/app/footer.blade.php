<footer class="border-t border-line bg-[#0c0c0c] pb-7 pt-[50px] text-white">
 <div class="mx-auto max-w-[1440px] px-[18px] md:px-10">
  <div class="flex flex-col items-center text-center md:grid md:grid-cols-[2fr_1fr_1fr_1.2fr] md:items-start md:gap-10 md:text-right">
   <div class="flex flex-col items-center md:items-start">
    <a href="{{ route('home') }}" class="flex items-center gap-2 font-dis text-[19px] font-black tracking-tight">
      <i class="grid h-[30px] w-[30px] place-items-center rounded-lg bg-g shadow-[0_0_16px_rgba(0,255,102,.4)]"><img src="{{ asset('storage/' . $setting['logo']) }}" alt="" class="h-6 w-6 object-contain"></i>
      <span>{{ $setting['footerBrandName'] ?? 'پهپاد استور' }}</span>
    </a>
    <p class="mx-auto my-4 max-w-[240px] text-[11px] leading-[1.7] text-neutral-500 md:mx-0 md:my-[18px] md:max-w-[300px] md:text-[13px]">{{ $setting['footerBrandDescription'] }}</p>
    <div class="flex gap-2.5">
      <a href="{{ $setting['footerInstagram'] }}" aria-label="Instagram" class="grid h-[34px] w-[34px] place-items-center rounded-lg bg-panel2">◎</a>
      <a href="{{ $setting['footerTelegram'] }}" aria-label="Telegram" class="grid h-[34px] w-[34px] place-items-center rounded-lg bg-panel2">➤</a>
      <a href="{{ $setting['footerEmailSocial'] }}" aria-label="Email" class="grid h-[34px] w-[34px] place-items-center rounded-lg bg-panel2">✉</a>
    </div>
   </div>
   <div class="hidden md:block">
    <h4 class="mb-[22px] font-dis text-[13px] tracking-widest">{{ $setting['footerServicesTitle'] }}</h4>
    <ul class="grid gap-3.5 text-[13px] text-neutral-500">
      @if(isset($setting['footerServices'])) @foreach($setting['footerServices'] as $service)<li><a href="{{ $service->url }}" class="hover:text-g">{{ $service->title }}</a></li>@endforeach @endif
    </ul>
   </div>
   <div class="hidden md:block">
    <h4 class="mb-[22px] font-dis text-[13px] tracking-widest">{{ $setting['footerCategoriesTitle'] }}</h4>
    <ul class="grid gap-3.5 text-[13px] text-neutral-500">
      @if(isset($setting['footerCategories'])) @foreach($setting['footerCategories'] as $category)<li><a href="{{ $category->url }}" class="hover:text-g">{{ $category->title }}</a></li>@endforeach @endif
    </ul>
   </div>
   <div class="mt-[34px] w-full rounded-2xl border border-line bg-panel px-[18px] py-7 md:mt-0 md:border-0 md:bg-transparent md:p-0">
    <h4 class="mb-[18px] font-dis text-[13px] tracking-widest md:mb-[22px]"><span class="md:hidden">{{ $setting['footerAboutTitle'] }}</span><span class="hidden md:inline">{{ $setting['footerAboutTitle'] }}</span></h4>
    <div class="grid gap-3 text-[12px] leading-7 text-neutral-400 text-right">
      @if(!empty($setting['footerPhone']))<a href="tel:{{ $setting['footerPhone'] }}">{{ $setting['footerPhone'] }}</a>@endif
      @if(!empty($setting['footerEmail']))<a href="mailto:{{ $setting['footerEmail'] }}">{{ $setting['footerEmail'] }}</a>@endif
      @if(!empty($setting['footerAddress']))<span>{{ $setting['footerAddress'] }}</span>@endif
    </div>
   </div>
  </div>
  <div class="mt-10 flex flex-col items-center justify-between gap-[18px] border-t border-line pt-[26px] text-[10px] tracking-wider text-neutral-600 md:mt-[50px] md:flex-row">
   <span>{{ $setting['footerCopyright'] }}</span>
   <span>{{ $setting['footerDesignerText'] }} {{ $setting['footerDesignerPhone'] }}</span>
  </div>
 </div>
</footer>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/home.js') }}"></script>
<script src="{{ asset('js/cart.js') }}"></script>
</body>
</html>
