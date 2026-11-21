
@extends('app.document')

@section('title', 'پهپاد استور | تماس با ما')

@section('content')

<style>
    html {
        scroll-behavior: smooth;
    }

    .container-x {
        width: min(1180px, calc(100% - 32px));
        margin-inline: auto;
    }

    /* ================= CONTACT PAGE THEME ================= */

    .contact-page {
        background: #090C0A;
        color: #F4F7F5;
    }

    .contact-hero {
        background:
            radial-gradient(circle at 10% 20%, rgba(0, 244, 119, .08), transparent 35%),
            linear-gradient(135deg, #090C0A 0%, #191D1B 100%);
    }

    .contact-card {
        background: #191D1B;
        border: 1px solid #2A302C;
        border-radius: 24px;
    }

    .contact-muted {
        color: #929B95;
    }

    .contact-accent {
        color: #00F477;
    }

    .contact-surface {
        background: #202522;
        border: 1px solid #2A302C;
    }

    /* ================= FORM INPUTS ================= */

    .contact-input {
        width: 100%;
        background: #202522;
        border: 1px solid #2A302C;
        color: #F4F7F5;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .contact-input::placeholder {
        color: #929B95;
    }

    .contact-input:focus {
        border-color: #00F477;
        box-shadow: 0 0 0 3px rgba(0, 244, 119, .10);
        outline: none;
    }

    .contact-input option {
        background: #191D1B;
        color: #F4F7F5;
    }

    .contact-input:disabled {
        opacity: .6;
        cursor: not-allowed;
    }

    /* ================= BUTTON ================= */

    .contact-btn {
        background: #00F477;
        color: #090C0A;
        transition: all .2s ease;
    }

    .contact-btn:hover {
        background: #13C96D;
        box-shadow: 0 8px 25px rgba(0, 244, 119, .12);
    }

    /* ================= FAQ ================= */

    .contact-faq {
        background: #191D1B;
        border: 1px solid #2A302C;
        transition: all .25s ease;
    }

    .contact-faq:hover {
        border-color: #13C96D;
        transform: translateY(-3px);
    }

    .contact-faq summary::marker {
        color: #00F477;
    }

    .contact-faq[open] {
        border-color: #13C96D;
        background: #202522;
    }

    .contact-faq summary {
        color: #F4F7F5;
    }

    /* ================= SUCCESS MESSAGE ================= */

    .contact-success {
        background: rgba(0, 244, 119, .07);
        border: 1px solid rgba(0, 244, 119, .25);
        color: #00F477;
    }

    /* ================= SELECTION ================= */

    .contact-page ::selection {
        background: #00F477;
        color: #090C0A;
    }

    /* ================= SCROLLBAR ================= */

    .contact-page {
        scrollbar-width: thin;
        scrollbar-color: #2A302C #090C0A;
    }

    .contact-page::-webkit-scrollbar {
        width: 7px;
    }

    .contact-page::-webkit-scrollbar-track {
        background: #090C0A;
    }

    .contact-page::-webkit-scrollbar-thumb {
        background: #2A302C;
        border-radius: 20px;
    }

    .contact-page::-webkit-scrollbar-thumb:hover {
        background: #13C96D;
    }

    @media(max-width: 768px) {
        .contact-card {
            border-radius: 20px;
        }
    }
</style>

<div class="contact-page">

    <main id="contact">

        <!-- Hero -->
        <section class="contact-hero overflow-hidden">

            <div class="container-x grid lg:grid-cols-2 items-center gap-8 py-10 sm:py-14">

                <div class="order-2 lg:order-1">

                    <div class="flex items-center gap-3 mb-4">
                        <span class="w-12 h-[3px] rounded bg-[#00F477]"></span>

                        <span class="text-[#00F477] font-bold">
                            ارتباط با پهپاد استور
                        </span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-[1.5] text-[#F4F7F5]">
                        تماس با ما
                    </h1>

                    <p class="text-base sm:text-lg font-medium mt-4 leading-8 text-[#F4F7F5]">
                        ما همیشه آماده پاسخگویی به سوالات و نظرات شما هستیم.
                    </p>

                    <p class="text-sm sm:text-base text-[#929B95] leading-8 mt-3 max-w-xl">
                        برای ارتباط با ما می‌توانید از طریق فرم زیر اطلاعات خود را ارسال کنید یا با یکی از راه‌های ارتباطی دیگر در تماس باشید.
                    </p>

                </div>

                <img
                    src="{{ asset('img/contact-hero.svg') }}"
                    alt="ابزارآلات پهپاد استور"
                    class="order-1 lg:order-2 w-full rounded-3xl border border-[#2A302C] shadow-[0_15px_45px_rgba(0,0,0,.25)]"
                >

            </div>

        </section>


        <!-- Contact + Form -->
        <section class="py-12 sm:py-16">

            <div class="container-x grid lg:grid-cols-5 gap-6">

                <!-- Contact Information -->
                <aside class="lg:col-span-2 contact-card p-7 sm:p-9">

                    <h2 class="text-2xl font-extrabold text-[#F4F7F5]">
                        راه‌های ارتباطی ما
                    </h2>

                    <div class="w-12 h-[3px] bg-[#00F477] rounded-full mt-3"></div>

                    <p class="text-sm contact-muted leading-7 mt-4">
                        شما می‌توانید از راه‌های زیر با ما در ارتباط باشید.
                    </p>

                    <div class="mt-8 grid gap-7">

                        <!-- Phone -->
                        <div class="flex items-start gap-4">

                            <div class="w-12 h-12 shrink-0 rounded-xl contact-surface grid place-items-center text-xl text-[#00F477]">
                                ☎
                            </div>

                            <div>
                                <h3 class="font-bold text-[#F4F7F5]">
                                    شماره تماس
                                </h3>

                                <p class="text-sm contact-muted mt-2">
                                    ۰۲۱-۱۲۳۴۵۶۷۸
                                </p>

                                <small class="text-xs text-[#929B95]">
                                    (پاسخگویی از ۸ صبح تا ۸ شب)
                                </small>
                            </div>

                        </div>

                        <!-- Email -->
                        <div class="flex items-start gap-4">

                            <div class="w-12 h-12 shrink-0 rounded-xl contact-surface grid place-items-center text-xl text-[#00F477]">
                                ✉
                            </div>

                            <div>
                                <h3 class="font-bold text-[#F4F7F5]">
                                    ایمیل
                                </h3>

                                <p class="text-sm contact-muted mt-2" dir="ltr">
                                    info@diarabzar.ir
                                </p>

                                <small class="text-xs text-[#929B95]">
                                    در سریع‌ترین زمان ممکن پاسخ می‌دهیم.
                                </small>
                            </div>

                        </div>

                        <!-- Address -->
                        <div class="flex items-start gap-4">

                            <div class="w-12 h-12 shrink-0 rounded-xl contact-surface grid place-items-center text-xl text-[#00F477]">
                                ⌖
                            </div>

                            <div>
                                <h3 class="font-bold text-[#F4F7F5]">
                                    آدرس
                                </h3>

                                <p class="text-sm contact-muted mt-2 leading-7">
                                    تهران، خیابان ولیعصر، پلاک ۱۲۳
                                </p>

                                <small class="text-xs text-[#929B95]">
                                    (مراجعه حضوری با هماهنگی قبلی)
                                </small>
                            </div>

                        </div>

                    </div>

                    <div class="mt-8">

                        <p class="text-[#00F477] font-bold text-sm">
                            منتظر شنیدن نظرات و پیشنهادات شما هستیم ♡
                        </p>

                        <img
                            src="{{ asset('img/contact-books.svg') }}"
                            alt=""
                            class="mt-4 w-full"
                        >

                    </div>

                </aside>


                <!-- Contact Form -->
                <section class="lg:col-span-3 contact-card p-7 sm:p-9 shadow-[0_15px_45px_rgba(0,0,0,.12)]">

                    <div class="flex items-center gap-3">

                        <div class="w-12 h-12 rounded-xl contact-surface grid place-items-center text-xl text-[#00F477]">
                            ➤
                        </div>

                        <div>
                            <h2 class="text-2xl font-extrabold text-[#F4F7F5]">
                                ارسال پیام
                            </h2>

                            <p class="text-sm contact-muted mt-1">
                                پیام خود را برای ما ارسال کنید؛ در اسرع وقت پاسخ خواهیم داد.
                            </p>
                        </div>

                    </div>


                    <form
                        class="mt-8 grid sm:grid-cols-2 gap-4"
                        onsubmit="event.preventDefault(); document.getElementById('success').classList.remove('hidden');"
                    >

                        <label class="block">

                            <span class="text-sm font-medium text-[#F4F7F5]">
                                نام و نام خانوادگی
                                <b class="text-red-400">*</b>
                            </span>

                            <input
                                required
                                type="text"
                                class="contact-input mt-2 h-14 rounded-xl px-4"
                                placeholder="مثال: محمد علی"
                            >

                        </label>


                        <label class="block">

                            <span class="text-sm font-medium text-[#F4F7F5]">
                                ایمیل
                                <b class="text-red-400">*</b>
                            </span>

                            <input
                                required
                                type="email"
                                dir="ltr"
                                class="contact-input mt-2 h-14 rounded-xl px-4"
                                placeholder="example@mail.com"
                            >

                        </label>


                        <label class="sm:col-span-2 block">

                            <span class="text-sm font-medium text-[#F4F7F5]">
                                موضوع
                                <b class="text-red-400">*</b>
                            </span>

                            <select
                                required
                                class="contact-input mt-2 h-14 rounded-xl px-4"
                            >
                                <option value="">انتخاب کنید</option>
                                <option>پیگیری سفارش</option>
                                <option>مشاوره خرید ابزار</option>
                                <option>پیشنهاد و انتقاد</option>
                                <option>سایر</option>
                            </select>

                        </label>


                        <label class="sm:col-span-2 block">

                            <span class="text-sm font-medium text-[#F4F7F5]">
                                متن پیام
                                <b class="text-red-400">*</b>
                            </span>

                            <textarea
                                required
                                rows="6"
                                class="contact-input mt-2 rounded-xl p-4 resize-y"
                                placeholder="پیام خود را اینجا بنویسید..."
                            ></textarea>

                        </label>


                        <button class="contact-btn sm:col-span-2 h-14 rounded-xl font-bold">
                            ارسال پیام　➤
                        </button>


                        <div
                            id="success"
                            class="contact-success hidden sm:col-span-2 rounded-xl p-4 text-sm"
                        >
                            پیام شما با موفقیت ثبت شد. این پیام نمونه است و به سرور ارسال نمی‌شود.
                        </div>

                    </form>

                </section>

            </div>

        </section>


        <!-- Map -->
        <section class="pb-12 sm:pb-16">

            <div class="container-x grid lg:grid-cols-5 rounded-3xl overflow-hidden border border-[#2A302C] shadow-[0_15px_45px_rgba(0,0,0,.15)]">

                <div class="lg:col-span-3 min-h-[300px]">

                    <img
                        src="{{ asset('img/contact-map.svg') }}"
                        class="w-full h-full object-cover"
                        alt="نقشه موقعیت پهپاد استور"
                    >

                </div>

                <div class="lg:col-span-2 bg-[#191D1B] p-8 sm:p-12 flex flex-col justify-center">

                    <div class="w-14 h-14 rounded-xl contact-surface grid place-items-center text-2xl text-[#00F477]">
                        ⌖
                    </div>

                    <h2 class="text-2xl font-extrabold text-[#F4F7F5] mt-5">
                        همیشه در دسترس شما هستیم
                    </h2>

                    <p class="text-sm contact-muted leading-8 mt-4">
                        چه سوالی داشته باشید، چه پیشنهادی، با کمال میل منتظر پیام شما هستیم.
                    </p>

                    <a
                        href="#"
                        class="mt-6 self-start px-6 py-3 rounded-xl border border-[#00F477] text-[#00F477] font-bold hover:bg-[#00F477] hover:text-[#090C0A] transition"
                    >
                        مشاهده روی نقشه
                    </a>

                </div>

            </div>

        </section>


        <!-- FAQ -->
        <section class="pb-16">

            <div class="container-x">

                <div class="text-center mb-9">

                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#F4F7F5]">
                        سوالات متداول
                    </h2>

                    <div class="w-12 h-[3px] bg-[#00F477] rounded-full mx-auto mt-4"></div>

                    <p class="text-sm text-[#929B95] mt-4">
                        شاید پاسخ سوال شما در این بخش باشد.
                    </p>

                </div>


                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    <details class="contact-faq rounded-2xl p-5">

                        <summary class="cursor-pointer font-bold text-sm list-none">
                            چطور سفارش خود را پیگیری کنم؟
                        </summary>

                        <p class="text-xs text-[#929B95] leading-6 mt-3">
                            از بخش پیگیری سفارش با کد سفارش می‌توانید وضعیت را مشاهده کنید.
                        </p>

                    </details>


                    <details class="contact-faq rounded-2xl p-5">

                        <summary class="cursor-pointer font-bold text-sm list-none">
                            آیا امکان تعویض کالا وجود دارد؟
                        </summary>

                        <p class="text-xs text-[#929B95] leading-6 mt-3">
                            شرایط تعویض مطابق قوانین فروشگاه در صفحه قوانین درج شده است.
                        </p>

                    </details>


                    <details class="contact-faq rounded-2xl p-5">

                        <summary class="cursor-pointer font-bold text-sm list-none">
                            مدت زمان ارسال چقدر است؟
                        </summary>

                        <p class="text-xs text-[#929B95] leading-6 mt-3">
                            بسته به شهر و روش ارسال، زمان تحویل متفاوت است.
                        </p>

                    </details>


                    <details class="contact-faq rounded-2xl p-5">

                        <summary class="cursor-pointer font-bold text-sm list-none">
                            چطور ابزار مناسب انتخاب کنم؟
                        </summary>

                        <p class="text-xs text-[#929B95] leading-6 mt-3">
                            می‌توانید از طریق فرم تماس برای دریافت راهنمایی پیام بفرستید.
                        </p>

                    </details>

                </div>

            </div>

        </section>

    </main>

    <script>
        const btn = document.getElementById('menuBtn');
        const menu = document.getElementById('mobileMenu');

        if (btn && menu) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }
    </script>

</div>

@endsection
