
@extends('app.document')

@section('title', 'پهپاد استور | درباره ما')

@section('content')

<style>
    :root {
        --primary: #00F477;
        --primary-hover: #39FF98;
        --primary-dark: #13C96D;

        --bg-main: #090C0A;
        --bg-section: #101412;
        --bg-card: #191D1B;
        --bg-surface: #202522;

        --text-primary: #F4F7F5;
        --text-secondary: #929B95;

        --border-color: #2A302C;
    }

    html {
        scroll-behavior: smooth;
    }

    .container-x {
        width: min(1180px, calc(100% - 32px));
        margin-inline: auto;
    }

    .about-page {
        background: var(--bg-main);
        color: var(--text-primary);
    }

    /* Hero */
    .diar-hero {
        background:
            radial-gradient(circle at 10% 20%, rgba(0, 244, 119, .12), transparent 35%),
            radial-gradient(circle at 90% 85%, rgba(19, 201, 109, .08), transparent 35%),
            linear-gradient(135deg, #090C0A 0%, #191D1B 65%, #101412 100%);
    }

    .diar-image {
        min-height: 440px;
    }

    .diar-glass {
        background: rgba(25, 29, 27, .94);
        backdrop-filter: blur(12px);
        border: 1px solid var(--border-color);
    }

    .diar-line::after {
        content: "";
        display: block;
        width: 48px;
        height: 3px;
        background: var(--primary);
        border-radius: 20px;
        margin: 12px auto 0;
    }

    /* Cards */
    .diar-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-primary);
        transition: all .3s ease;
    }

    .diar-card:hover {
        transform: translateY(-6px);
        border-color: rgba(0, 244, 119, .4);
        box-shadow: 0 18px 35px rgba(0, 0, 0, .25);
    }

    .diar-icon {
        background: rgba(0, 244, 119, .09);
        color: var(--primary);
        border: 1px solid rgba(0, 244, 119, .12);
    }

    .diar-orange {
        color: var(--primary);
    }

    .diar-bg {
        background: var(--bg-section);
    }

    /* CTA */
    .diar-cta {
        background:
            radial-gradient(circle at 90% 10%, rgba(0, 244, 119, .12), transparent 35%),
            linear-gradient(120deg, #191D1B, #101412);
        border: 1px solid var(--border-color);
    }

    /* Buttons */
    .about-primary-btn {
        background: var(--primary);
        color: #090C0A;
        transition: all .25s ease;
    }

    .about-primary-btn:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 244, 119, .12);
    }

    .about-secondary-btn {
        border: 1px solid rgba(244, 247, 245, .2);
        color: var(--text-primary);
        transition: all .25s ease;
    }

    .about-secondary-btn:hover {
        background: rgba(0, 244, 119, .07);
        border-color: var(--primary);
        color: var(--primary);
    }

    /* Image */
    .about-image-overlay {
        background: linear-gradient(
            to top,
            rgba(9, 12, 10, .85),
            transparent 75%
        );
    }

    /* Top bar */
    .about-topbar {
        background: var(--primary);
        color: #090C0A;
    }

    /* Approach section */
    .about-approach {
        background:
            radial-gradient(circle at 0% 100%, rgba(0, 244, 119, .08), transparent 40%),
            linear-gradient(120deg, #191D1B, #101412);
        border: 1px solid var(--border-color);
    }

    /* Values */
    .about-value-icon {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--primary);
        transition: all .25s ease;
    }

    .about-value:hover .about-value-icon {
        border-color: var(--primary);
        transform: translateY(-4px);
    }

    @media(max-width: 768px) {
        .diar-image {
            min-height: 290px;
        }
    }
</style>

<div class="about-page mt-3">

    {{-- Top Bar --}}
    <div class="about-topbar text-center text-xs sm:text-sm py-2 px-4 font-bold">
        پهپاد استور؛ همراه مطمئن شما در انتخاب ابزار مناسب
    </div>

    <main>

        {{-- Hero --}}
        <section class="diar-hero overflow-hidden">

            <div class="container-x grid lg:grid-cols-2 items-center gap-10">

                <div class="py-16 sm:py-20 lg:py-24">

                    <div class="flex items-center gap-3 mb-6">

                        <span class="w-10 h-[3px] rounded-full"
                              style="background:var(--primary)"></span>

                        <span class="font-bold text-sm"
                              style="color:var(--primary)">
                            آشنایی با پهپاد استور
                        </span>

                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-[1.5] text-[#F4F7F5]">
                        ابزار درست،
                        <span style="color:var(--primary)">شروع یک کار حرفه‌ای</span>
                    </h1>

                    <p class="mt-6 text-sm sm:text-base leading-9 max-w-xl"
                       style="color:var(--text-secondary)">
                        پهپاد استور با هدف فراهم کردن دسترسی آسان به ابزارآلات
                        ساختمانی و صنعتی فعالیت می‌کند. ما باور داریم انتخاب
                        ابزار مناسب، فقط خرید یک محصول نیست؛ بلکه قدمی مهم
                        برای افزایش کیفیت، سرعت و دقت در انجام کارهاست.
                    </p>

                    <p class="mt-3 text-sm sm:text-base leading-9 max-w-xl"
                       style="color:var(--text-secondary)">
                        تلاش ما این است که تجربه‌ای ساده و مطمئن از جست‌وجو،
                        انتخاب و خرید ابزار را برای فعالان حوزه ساختمان،
                        صنعت و تمام علاقه‌مندان به کارهای فنی فراهم کنیم.
                    </p>

                    <div class="mt-9 flex flex-wrap gap-3">

                        <a href="{{ url('/') }}"
                           class="about-primary-btn px-7 py-3.5 rounded-xl font-bold">
                            مشاهده فروشگاه
                        </a>

                        <a href="#why-diar"
                           class="about-secondary-btn px-7 py-3.5 rounded-xl font-bold">
                            چرا پهپاد استور؟
                        </a>

                    </div>

                </div>

                <div class="diar-image relative overflow-hidden rounded-t-[30px] lg:rounded-t-none lg:rounded-l-[30px]">

                    <img
                        src="{{ asset('img/about.png') }}"
                        alt="ابزارآلات ساختمانی و صنعتی پهپاد استور"
                        class="absolute inset-0 w-full h-full object-cover"
                    >

                    <div class="about-image-overlay absolute inset-0"></div>

                    <div class="absolute bottom-6 right-6 left-6 diar-glass rounded-2xl p-5 shadow-xl">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl"
                                 style="background:rgba(0,244,119,.1)">
                                🔧
                            </div>

                            <div>
                                <p class="font-extrabold text-[#F4F7F5]">
                                    ابزار مناسب برای هر پروژه
                                </p>

                                <p class="text-xs sm:text-sm mt-1"
                                   style="color:var(--text-secondary)">
                                    انتخابی آگاهانه برای کاری باکیفیت‌تر
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- Introduction --}}
        <section class="py-16 sm:py-20">

            <div class="container-x grid lg:grid-cols-2 gap-12 items-center">

                <div>

                    <span class="font-bold text-sm"
                          style="color:var(--primary)">
                        ما چه کاری انجام می‌دهیم؟
                    </span>

                    <h2 class="text-2xl sm:text-3xl font-bold text-[#F4F7F5] mt-4 leading-relaxed">
                        فقط فروش ابزار نیست؛
                        <span style="color:var(--primary)">کمک به انتخاب بهتر است.</span>
                    </h2>

                    <p class="mt-5 text-sm sm:text-base leading-9"
                       style="color:var(--text-secondary)">
                        در پهپاد استور تلاش می‌کنیم مجموعه‌ای کاربردی از
                        ابزارآلات موردنیاز پروژه‌های ساختمانی، صنعتی و فنی
                        در اختیار شما قرار دهیم.
                    </p>

                    <p class="mt-4 text-sm sm:text-base leading-9"
                       style="color:var(--text-secondary)">
                        از ابزارهای برقی و دستی گرفته تا تجهیزات موردنیاز
                        کارگاه‌ها و پروژه‌های ساختمانی، هدف ما این است که
                        بتوانید متناسب با نیاز و نوع فعالیت خود، محصول
                        مناسبی انتخاب کنید.
                    </p>

                </div>

                <div class="grid grid-cols-2 gap-4">

                    <div class="rounded-3xl p-6"
                         style="background:var(--bg-card);border:1px solid var(--border-color)">

                        <div class="text-3xl mb-5">⚙️</div>

                        <h3 class="font-extrabold text-[#F4F7F5]">
                            ابزارهای برقی
                        </h3>

                        <p class="text-xs sm:text-sm leading-7 mt-3"
                           style="color:var(--text-secondary)">
                            تجهیزات کاربردی برای انجام کارهای فنی و ساختمانی
                        </p>

                    </div>

                    <div class="rounded-3xl p-6 mt-8"
                         style="background:var(--bg-surface);border:1px solid var(--border-color)">

                        <div class="text-3xl mb-5">🔨</div>

                        <h3 class="font-extrabold text-[#F4F7F5]">
                            ابزارهای دستی
                        </h3>

                        <p class="text-xs sm:text-sm leading-7 mt-3"
                           style="color:var(--text-secondary)">
                            ابزارهای موردنیاز برای کارهای روزمره و تخصصی
                        </p>

                    </div>

                    <div class="rounded-3xl p-6"
                         style="background:var(--bg-surface);border:1px solid var(--border-color)">

                        <div class="text-3xl mb-5">📐</div>

                        <h3 class="font-extrabold text-[#F4F7F5]">
                            ابزار اندازه‌گیری
                        </h3>

                        <p class="text-xs sm:text-sm leading-7 mt-3"
                           style="color:var(--text-secondary)">
                            تجهیزات لازم برای اندازه‌گیری دقیق‌تر
                        </p>

                    </div>

                    <div class="rounded-3xl p-6 mt-8"
                         style="background:var(--bg-card);border:1px solid var(--border-color)">

                        <div class="text-3xl mb-5">🏗️</div>

                        <h3 class="font-extrabold text-[#F4F7F5]">
                            تجهیزات ساختمانی
                        </h3>

                        <p class="text-xs sm:text-sm leading-7 mt-3"
                           style="color:var(--text-secondary)">
                            محصولات کاربردی برای پروژه‌های ساختمانی
                        </p>

                    </div>

                </div>

            </div>

        </section>


        {{-- Why Diar Abzar --}}
        <section id="why-diar" class="diar-bg py-16 sm:py-20">

            <div class="container-x">

                <div class="text-center mb-12">

                    <h2 class="diar-line text-2xl sm:text-3xl font-bold text-[#F4F7F5]">
                        چرا پهپاد استور؟
                    </h2>

                    <p class="mt-6 text-sm sm:text-base leading-8"
                       style="color:var(--text-secondary)">
                        تجربه خرید خوب از انتخاب درست شروع می‌شود.
                        ما در تلاشیم این مسیر را برای شما ساده‌تر کنیم.
                    </p>

                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">

                    <article class="diar-card rounded-2xl p-7">

                        <div class="diar-icon w-14 h-14 rounded-2xl flex items-center justify-center text-2xl">
                            🛡️
                        </div>

                        <h3 class="font-extrabold mt-5">
                            خرید مطمئن
                        </h3>

                        <p class="text-sm leading-8 mt-3"
                           style="color:var(--text-secondary)">
                            تلاش می‌کنیم اطلاعات محصولات را به شکلی شفاف
                            ارائه کنیم تا با اطمینان بیشتری خرید کنید.
                        </p>

                    </article>

                    <article class="diar-card rounded-2xl p-7">

                        <div class="diar-icon w-14 h-14 rounded-2xl flex items-center justify-center text-2xl">
                            🧰
                        </div>

                        <h3 class="font-extrabold mt-5">
                            تنوع ابزار
                        </h3>

                        <p class="text-sm leading-8 mt-3"
                           style="color:var(--text-secondary)">
                            مجموعه‌ای از ابزارهای موردنیاز برای فعالیت‌های
                            ساختمانی، صنعتی و فنی.
                        </p>

                    </article>

                    <article class="diar-card rounded-2xl p-7">

                        <div class="diar-icon w-14 h-14 rounded-2xl flex items-center justify-center text-2xl">
                            💬
                        </div>

                        <h3 class="font-extrabold mt-5">
                            راهنمایی مشتری
                        </h3>

                        <p class="text-sm leading-8 mt-3"
                           style="color:var(--text-secondary)">
                            انتخاب ابزار مناسب اهمیت زیادی دارد؛
                            برای پیدا کردن گزینه مناسب، همراه شما هستیم.
                        </p>

                    </article>

                    <article class="diar-card rounded-2xl p-7">

                        <div class="diar-icon w-14 h-14 rounded-2xl flex items-center justify-center text-2xl">
                            🛒
                        </div>

                        <h3 class="font-extrabold mt-5">
                            خرید آسان
                        </h3>

                        <p class="text-sm leading-8 mt-3"
                           style="color:var(--text-secondary)">
                            می‌خواهیم فرایند بررسی محصولات و ثبت سفارش
                            برای شما ساده و قابل‌دسترس باشد.
                        </p>

                    </article>

                </div>

            </div>

        </section>


        {{-- Our Approach --}}
        <section class="py-16 sm:py-20">

            <div class="container-x">

                <div class="about-approach rounded-[30px] overflow-hidden grid lg:grid-cols-2">

                    <div class="p-8 sm:p-12 lg:p-14 flex flex-col justify-center">

                        <span class="font-bold text-sm"
                              style="color:var(--primary)">
                            نگاه ما به آینده
                        </span>

                        <h2 class="text-2xl sm:text-3xl font-bold leading-relaxed mt-4 text-[#F4F7F5]">
                            ساختن تجربه‌ای بهتر برای خرید ابزار
                        </h2>

                        <p class="mt-5 text-sm sm:text-base leading-9"
                           style="color:var(--text-secondary)">
                            باور داریم یک فروشگاه تخصصی ابزار باید بیشتر
                            از نمایش چند محصول باشد. مشتری باید بتواند
                            محصول موردنیاز خود را پیدا کند، مشخصات آن را
                            بررسی کند و با آگاهی تصمیم بگیرد.
                        </p>

                        <p class="mt-4 text-sm sm:text-base leading-9"
                           style="color:var(--text-secondary)">
                            به همین دلیل، در پهپاد استور به دنبال ایجاد
                            تجربه‌ای ساده، شفاف و قابل اعتماد هستیم؛
                            تجربه‌ای که در آن نیاز مشتری در اولویت قرار دارد.
                        </p>

                        <a href="{{ url('/') }}"
                           class="about-primary-btn mt-7 self-start rounded-xl px-6 py-3 font-bold">
                            همراه ما باشید
                        </a>

                    </div>

                    <div class="relative min-h-[300px] lg:min-h-[460px]">

                        <img
                            src="{{ asset('img/about.png') }}"
                            alt="تجهیزات و ابزارآلات فنی"
                            class="absolute inset-0 w-full h-full object-cover"
                        >

                        <div class="absolute inset-0"
                             style="background:linear-gradient(to left,transparent,rgba(9,12,10,.4))"></div>

                    </div>

                </div>

            </div>

        </section>


        {{-- Values --}}
        <section class="diar-bg py-16 sm:py-20">

            <div class="container-x">

                <div class="text-center mb-12">

                    <h2 class="diar-line text-2xl sm:text-3xl font-bold text-[#F4F7F5]">
                        ارزش‌هایی که به آن‌ها پایبندیم
                    </h2>

                    <p class="mt-6 text-sm"
                       style="color:var(--text-secondary)">
                        اصولی که مسیر فعالیت پهپاد استور را شکل می‌دهند.
                    </p>

                </div>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">

                    <div class="about-value text-center">

                        <div class="about-value-icon mx-auto w-16 h-16 rounded-2xl flex items-center justify-center text-3xl">
                            🤝
                        </div>

                        <h3 class="font-extrabold mt-5 text-[#F4F7F5]">
                            اعتماد
                        </h3>

                        <p class="text-sm mt-3 leading-7"
                           style="color:var(--text-secondary)">
                            اعتماد مشتری، سرمایه اصلی یک کسب‌وکار است.
                        </p>

                    </div>

                    <div class="about-value text-center">

                        <div class="about-value-icon mx-auto w-16 h-16 rounded-2xl flex items-center justify-center text-3xl">
                            🎯
                        </div>

                        <h3 class="font-extrabold mt-5 text-[#F4F7F5]">
                            دقت
                        </h3>

                        <p class="text-sm mt-3 leading-7"
                           style="color:var(--text-secondary)">
                            توجه به نیاز مشتری و انتخاب درست محصولات.
                        </p>

                    </div>

                    <div class="about-value text-center">

                        <div class="about-value-icon mx-auto w-16 h-16 rounded-2xl flex items-center justify-center text-3xl">
                            💡
                        </div>

                        <h3 class="font-extrabold mt-5 text-[#F4F7F5]">
                            یادگیری و پیشرفت
                        </h3>

                        <p class="text-sm mt-3 leading-7"
                           style="color:var(--text-secondary)">
                            تلاش مستمر برای ارائه تجربه‌ای بهتر.
                        </p>

                    </div>

                    <div class="about-value text-center">

                        <div class="about-value-icon mx-auto w-16 h-16 rounded-2xl flex items-center justify-center text-3xl">
                            ❤️
                        </div>

                        <h3 class="font-extrabold mt-5 text-[#F4F7F5]">
                            مشتری‌مداری
                        </h3>

                        <p class="text-sm mt-3 leading-7"
                           style="color:var(--text-secondary)">
                            توجه به رضایت و نیاز واقعی خریداران.
                        </p>

                    </div>

                </div>

            </div>

        </section>


        {{-- CTA --}}
        <section id="about" class="py-16 sm:py-20">

            <div class="container-x">

                <div class="diar-cta rounded-[30px] p-8 sm:p-14 text-center relative overflow-hidden">

                    <div class="absolute -top-20 -right-20 w-64 h-64 rounded-full blur-3xl"
                         style="background:rgba(0,244,119,.1)"></div>

                    <div class="relative">

                        <div class="text-4xl mb-5">🔧</div>

                        <h2 class="text-2xl sm:text-3xl font-bold text-[#F4F7F5] leading-relaxed">
                            برای شروع یک کار حرفه‌ای آماده‌اید؟
                        </h2>

                        <p class="mt-4 text-sm sm:text-base leading-8 max-w-2xl mx-auto"
                           style="color:var(--text-secondary)">
                            ابزار مناسب خود را پیدا کنید و با انتخابی آگاهانه،
                            کیفیت و دقت کارتان را افزایش دهید.
                        </p>

                        <div class="mt-8 flex flex-wrap justify-center gap-3">

                            <a href="{{ url('/') }}"
                               class="about-primary-btn px-8 py-3.5 rounded-xl font-bold">
                                ورود به فروشگاه
                            </a>

                            <a href="#about"
                               class="about-secondary-btn px-8 py-3.5 rounded-xl font-bold">
                                بازگشت به بالا
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>

</div>

@endsection
