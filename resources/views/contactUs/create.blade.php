@extends('app.document')

@section('title', 'دیار ابزار | تماس با ما')

@section('content')

<style>
    html {
        scroll-behavior: smooth;
    }

    :root {
        --primary: #00F477;
        --primary-hover: #39FF98;
        --primary-dark: #13C96D;

        --bg-main: #090C0A;
        --bg-footer: #101312;
        --bg-card: #191D1B;
        --bg-surface: #202522;

        --text-primary: #F4F7F5;
        --text-secondary: #929B95;

        --border-color: #2A302C;
    }

    .container-x {
        width: min(1180px, calc(100% - 32px));
        margin-inline: auto;
    }

    .contact-page {
        background: var(--bg-main);
        color: var(--text-primary);
    }

    .diar-navy {
        background: var(--bg-main);
    }

    .diar-red {
        color: var(--primary);
    }

    .diar-bg {
        background: var(--bg-footer);
    }

    .diar-accent {
        background: var(--primary);
    }

    /* Hero */
    .diar-hero {
        background:
            radial-gradient(
                circle at 85% 20%,
                rgba(0, 244, 119, .12),
                transparent 35%
            ),
            radial-gradient(
                circle at 10% 90%,
                rgba(19, 201, 109, .08),
                transparent 35%
            ),
            linear-gradient(120deg, #090C0A, #191D1B);
    }

    /* Cards */
    .diar-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-primary);
        transition: all .25s ease;
    }

    .diar-card:hover {
        transform: translateY(-5px);
        border-color: rgba(0, 244, 119, .35);
        box-shadow: 0 18px 40px rgba(0, 0, 0, .25);
    }

    .diar-icon {
        background: rgba(0, 244, 119, .09);
        color: var(--primary);
        border: 1px solid rgba(0, 244, 119, .12);
    }

    /* Inputs */
    .diar-input {
        background: var(--bg-surface);
        color: var(--text-primary);
        border: 1px solid var(--border-color);
        transition: all .2s ease;
    }

    .diar-input::placeholder {
        color: #737D76;
    }

    .diar-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0, 244, 119, .09);
        outline: none;
    }

    .diar-input option {
        background: var(--bg-card);
        color: var(--text-primary);
    }

    /* Section title */
    .diar-line::after {
        content: "";
        display: block;
        width: 45px;
        height: 3px;
        background: var(--primary);
        border-radius: 20px;
        margin: 12px auto 0;
    }

    /* CTA */
    .diar-cta {
        background:
            radial-gradient(
                circle at 90% 10%,
                rgba(0, 244, 119, .12),
                transparent 35%
            ),
            linear-gradient(120deg, #191D1B, #101312);
        border: 1px solid var(--border-color);
    }

    /* Contact info */
    .contact-info {
        background:
            radial-gradient(
                circle at 100% 0%,
                rgba(0, 244, 119, .10),
                transparent 35%
            ),
            linear-gradient(145deg, #191D1B, #101312);
        border: 1px solid var(--border-color);
    }

    /* FAQ */
    .contact-faq {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        transition: all .25s ease;
    }

    .contact-faq:hover,
    .contact-faq[open] {
        border-color: rgba(0, 244, 119, .4);
        background: #1c211e;
    }

    .contact-faq summary {
        color: var(--text-primary);
    }

    .contact-faq summary::-webkit-details-marker {
        display: none;
    }

    .contact-faq summary span {
        color: var(--primary);
    }

    /* Submit button */
    .contact-submit {
        background: var(--primary);
        color: #090C0A;
        transition: all .25s ease;
    }

    .contact-submit:hover {
        background: var(--primary-hover);
        box-shadow: 0 8px 25px rgba(0, 244, 119, .15);
        transform: translateY(-2px);
    }

    /* Buttons */
    .contact-primary-btn {
        background: var(--primary);
        color: #090C0A;
        transition: all .25s ease;
    }

    .contact-primary-btn:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
    }

    .contact-secondary-btn {
        border: 1px solid rgba(244, 247, 245, .2);
        color: var(--text-primary);
        transition: all .25s ease;
    }

    .contact-secondary-btn:hover {
        background: rgba(0, 244, 119, .07);
        border-color: var(--primary);
        color: var(--primary);
    }

    /* Contact image */
    .contact-image {
        border: 1px solid var(--border-color);
    }

    /* Scrollbar */
    .contact-page {
        scrollbar-width: thin;
        scrollbar-color: var(--border-color) var(--bg-main);
    }

    .contact-page ::-webkit-scrollbar {
        width: 6px;
    }

    .contact-page ::-webkit-scrollbar-track {
        background: var(--bg-main);
    }

    .contact-page ::-webkit-scrollbar-thumb {
        background: var(--border-color);
        border-radius: 20px;
    }

    .contact-page ::-webkit-scrollbar-thumb:hover {
        background: var(--primary-dark);
    }

    @media(max-width: 768px) {
        .contact-image {
            min-height: 220px;
        }
    }
</style>

<div class="contact-page">

    <main id="contact">

        {{-- Hero --}}
        <section class="diar-hero overflow-hidden">

            <div class="container-x grid lg:grid-cols-2 items-center gap-10 py-14 sm:py-20">

                <div class="order-2 lg:order-1">

                    <div class="flex items-center gap-3 mb-5">
                        <span class="w-12 h-[3px] rounded-full"
                              style="background:var(--primary)"></span>

                        <span class="font-bold" style="color:var(--primary)">
                            ارتباط با دیار ابزار
                        </span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black leading-[1.6] text-[#F4F7F5]">
                        ما اینجا هستیم تا
                        <span style="color:var(--primary)">به شما کمک کنیم.</span>
                    </h1>

                    <p class="text-base sm:text-lg font-medium mt-5 leading-9"
                       style="color:var(--text-secondary)">
                        انتخاب ابزار مناسب، گاهی به یک راهنمایی ساده نیاز دارد.
                        اگر درباره محصولات، سفارش‌ها یا نحوه خرید سؤالی دارید،
                        خوشحال می‌شویم با شما در ارتباط باشیم.
                    </p>

                    <p class="text-sm sm:text-base leading-8 mt-4"
                       style="color:var(--text-secondary)">
                        از مشاوره انتخاب ابزار گرفته تا پیگیری سفارش و ثبت پیشنهادها،
                        می‌توانید از طریق راه‌های ارتباطی دیار ابزار با ما در تماس باشید.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">

                        <a href="#contact-form"
                           class="contact-primary-btn px-7 py-3.5 rounded-xl font-bold">
                            ارسال پیام
                        </a>

                        <a href="#contact-info"
                           class="contact-secondary-btn px-7 py-3.5 rounded-xl font-bold">
                            راه‌های ارتباطی
                        </a>

                    </div>

                </div>

                <div class="order-1 lg:order-2 relative">

                    <div class="absolute inset-0 blur-3xl rounded-full"
                         style="background:rgba(0,244,119,.08)"></div>

                    <img
                        src="{{ asset('img/contact.png') }}"
                        alt="ارتباط با دیار ابزار"
                        class="contact-image relative w-full h-full max-h-[430px] object-cover rounded-3xl shadow-2xl"
                    >

                    <div class="absolute bottom-5 right-5 left-5 backdrop-blur rounded-2xl p-4 sm:p-5 shadow-xl"
                         style="background:rgba(25,29,27,.95);border:1px solid var(--border-color)">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 shrink-0 rounded-xl flex items-center justify-center text-2xl"
                                 style="background:rgba(0,244,119,.1)">
                                🛠️
                            </div>

                            <div>
                                <h3 class="font-extrabold text-[#F4F7F5]">
                                    همراه شما در انتخاب ابزار
                                </h3>

                                <p class="text-xs sm:text-sm mt-1"
                                   style="color:var(--text-secondary)">
                                    پاسخ‌گویی به سؤالات و راهنمایی خرید
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- Contact Information + Form --}}
        <section class="py-14 sm:py-20">

            <div class="container-x grid lg:grid-cols-5 gap-6">

                {{-- Contact Info --}}
                <aside id="contact-info"
                       class="contact-info lg:col-span-2 rounded-3xl text-[#F4F7F5] p-7 sm:p-9 overflow-hidden relative">

                    <div class="absolute -left-16 -top-16 w-48 h-48 rounded-full blur-2xl"
                         style="background:rgba(0,244,119,.08)"></div>

                    <div class="relative z-10">

                        <span class="font-bold text-sm"
                              style="color:var(--primary)">
                            در کنار شما هستیم
                        </span>

                        <h2 class="text-2xl font-black mt-3">
                            راه‌های ارتباطی
                        </h2>

                        <p class="text-sm leading-8 mt-4"
                           style="color:var(--text-secondary)">
                            برای دریافت اطلاعات بیشتر، پیگیری سفارش‌ها و
                            مطرح کردن سؤالات خود می‌توانید از راه‌های ارتباطی
                            فروشگاه با ما در تماس باشید.
                        </p>

                        <div class="mt-9 grid gap-7">

                            {{-- Phone --}}
                            <div class="flex items-start gap-4">

                                <div class="w-12 h-12 shrink-0 rounded-xl grid place-items-center text-xl"
                                     style="background:rgba(0,244,119,.09);color:var(--primary)">
                                    ☎
                                </div>

                                <div>
                                    <h3 class="font-bold">
                                        شماره تماس
                                    </h3>

                                    <p class="text-sm mt-2"
                                       style="color:var(--text-secondary)">
                                        شماره تماس فروشگاه
                                    </p>

                                    <small style="color:var(--text-secondary)">
                                        پاسخ‌گویی به سؤالات شما
                                    </small>
                                </div>

                            </div>


                            {{-- Email --}}
                            <div class="flex items-start gap-4">

                                <div class="w-12 h-12 shrink-0 rounded-xl grid place-items-center text-xl"
                                     style="background:rgba(0,244,119,.09);color:var(--primary)">
                                    ✉
                                </div>

                                <div>
                                    <h3 class="font-bold">
                                        پست الکترونیکی
                                    </h3>

                                    <p class="text-sm mt-2"
                                       style="color:var(--text-secondary)">
                                        ایمیل فروشگاه
                                    </p>

                                    <small style="color:var(--text-secondary)">
                                        ارسال درخواست و پیشنهاد
                                    </small>
                                </div>

                            </div>


                            {{-- Address --}}
                            <div class="flex items-start gap-4">

                                <div class="w-12 h-12 shrink-0 rounded-xl grid place-items-center text-xl"
                                     style="background:rgba(0,244,119,.09);color:var(--primary)">
                                    📍
                                </div>

                                <div>
                                    <h3 class="font-bold">
                                        آدرس فروشگاه
                                    </h3>

                                    <p class="text-sm mt-2 leading-7"
                                       style="color:var(--text-secondary)">
                                        آدرس فروشگاه دیار ابزار
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="mt-10 pt-6"
                             style="border-top:1px solid var(--border-color)">

                            <p class="text-sm leading-8"
                               style="color:var(--text-secondary)">
                                نظرات و پیشنهادهای شما به ما کمک می‌کند
                                خدمات بهتری ارائه دهیم.
                            </p>

                            <div class="mt-5 flex items-center gap-2 font-bold text-sm"
                                 style="color:var(--primary)">
                                <span>🔧</span>
                                <span>دیار ابزار، همراه پروژه‌های شما</span>
                            </div>

                        </div>

                    </div>

                </aside>


                {{-- Contact Form --}}
                <section id="contact-form"
                         class="lg:col-span-3 rounded-3xl p-7 sm:p-9 shadow-sm"
                         style="background:var(--bg-card);border:1px solid var(--border-color)">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl"
                             style="background:rgba(0,244,119,.09);color:var(--primary)">
                            ✉
                        </div>

                        <div>
                            <h2 class="text-2xl font-black text-[#F4F7F5]">
                                ارسال پیام به ما
                            </h2>

                            <p class="text-sm mt-2"
                               style="color:var(--text-secondary)">
                                پیام خود را ثبت کنید تا بتوانیم بهتر راهنمایی‌تان کنیم.
                            </p>
                        </div>

                    </div>


                    <form class="mt-9 grid sm:grid-cols-2 gap-5"
                          onsubmit="event.preventDefault(); document.getElementById('success').classList.remove('hidden');">

                        {{-- Name --}}
                        <label class="block">

                            <span class="text-sm font-bold text-[#F4F7F5]">
                                نام و نام خانوادگی
                                <b style="color:#ff6464">*</b>
                            </span>

                            <input
                                required
                                type="text"
                                name="name"
                                class="diar-input mt-2 w-full h-14 rounded-xl px-4"
                                placeholder="نام خود را وارد کنید"
                            >

                        </label>


                        {{-- Phone --}}
                        <label class="block">

                            <span class="text-sm font-bold text-[#F4F7F5]">
                                شماره موبایل
                                <b style="color:#ff6464">*</b>
                            </span>

                            <input
                                required
                                type="tel"
                                name="phone"
                                dir="ltr"
                                class="diar-input mt-2 w-full h-14 rounded-xl px-4 text-right"
                                placeholder="09123456789"
                            >

                        </label>


                        {{-- Email --}}
                        <label class="block sm:col-span-2">

                            <span class="text-sm font-bold text-[#F4F7F5]">
                                ایمیل
                                <span class="font-normal"
                                      style="color:var(--text-secondary)">(اختیاری)</span>
                            </span>

                            <input
                                type="email"
                                name="email"
                                dir="ltr"
                                class="diar-input mt-2 w-full h-14 rounded-xl px-4"
                                placeholder="example@email.com"
                            >

                        </label>


                        {{-- Subject --}}
                        <label class="block sm:col-span-2">

                            <span class="text-sm font-bold text-[#F4F7F5]">
                                موضوع پیام
                                <b style="color:#ff6464">*</b>
                            </span>

                            <select
                                required
                                name="subject"
                                class="diar-input mt-2 w-full h-14 rounded-xl px-4">

                                <option value="">موضوع موردنظر را انتخاب کنید</option>
                                <option value="مشاوره خرید ابزار">مشاوره خرید ابزار</option>
                                <option value="پیگیری سفارش">پیگیری سفارش</option>
                                <option value="اطلاعات محصولات">اطلاعات محصولات</option>
                                <option value="شرایط ارسال">شرایط ارسال</option>
                                <option value="همکاری">همکاری</option>
                                <option value="پیشنهاد و انتقاد">پیشنهاد و انتقاد</option>
                                <option value="سایر">سایر موارد</option>

                            </select>

                        </label>


                        {{-- Message --}}
                        <label class="block sm:col-span-2">

                            <span class="text-sm font-bold text-[#F4F7F5]">
                                متن پیام
                                <b style="color:#ff6464">*</b>
                            </span>

                            <textarea
                                required
                                name="message"
                                rows="6"
                                class="diar-input mt-2 w-full rounded-xl p-4 resize-y"
                                placeholder="سؤال یا درخواست خود را اینجا بنویسید..."
                            ></textarea>

                        </label>


                        {{-- Submit --}}
                        <button
                            type="submit"
                            class="contact-submit sm:col-span-2 h-14 rounded-xl font-bold transition flex items-center justify-center gap-3">

                            <span>ارسال پیام</span>
                            <span>➤</span>

                        </button>


                        {{-- Demo Success --}}
                        <div id="success"
                             class="hidden sm:col-span-2 rounded-xl p-4 text-sm leading-7"
                             style="background:rgba(0,244,119,.08);border:1px solid rgba(0,244,119,.2);color:var(--primary)">

                            پیام شما ثبت شد. این فرم در حال حاضر نمایشی است
                            و برای ارسال واقعی باید به مسیر پردازش فرم در لاراول متصل شود.

                        </div>

                    </form>

                </section>

            </div>

        </section>


        {{-- Support Section --}}
        <section class="diar-bg py-14 sm:py-20">

            <div class="container-x">

                <div class="text-center mb-12">

                    <h2 class="diar-line text-2xl sm:text-3xl font-black text-[#F4F7F5]">
                        برای چه موضوعاتی با ما تماس بگیرید؟
                    </h2>

                    <p class="text-sm sm:text-base mt-6 leading-8"
                       style="color:var(--text-secondary)">
                        تیم دیار ابزار آماده دریافت سؤالات و درخواست‌های شماست.
                    </p>

                </div>


                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">

                    <article class="diar-card rounded-2xl p-7">

                        <div class="diar-icon w-14 h-14 rounded-2xl grid place-items-center text-2xl">
                            🛠️
                        </div>

                        <h3 class="font-extrabold mt-5">
                            مشاوره خرید ابزار
                        </h3>

                        <p class="text-sm leading-8 mt-3"
                           style="color:var(--text-secondary)">
                            برای انتخاب ابزار مناسب با نوع کار و نیاز پروژه خود راهنمایی بگیرید.
                        </p>

                    </article>


                    <article class="diar-card rounded-2xl p-7">

                        <div class="diar-icon w-14 h-14 rounded-2xl grid place-items-center text-2xl">
                            📦
                        </div>

                        <h3 class="font-extrabold mt-5">
                            پیگیری سفارش
                        </h3>

                        <p class="text-sm leading-8 mt-3"
                           style="color:var(--text-secondary)">
                            سؤالات خود را درباره وضعیت سفارش و فرایند تحویل مطرح کنید.
                        </p>

                    </article>


                    <article class="diar-card rounded-2xl p-7">

                        <div class="diar-icon w-14 h-14 rounded-2xl grid place-items-center text-2xl">
                            ⚙️
                        </div>

                        <h3 class="font-extrabold mt-5">
                            مشخصات محصولات
                        </h3>

                        <p class="text-sm leading-8 mt-3"
                           style="color:var(--text-secondary)">
                            درباره ویژگی‌ها، کاربردها و مشخصات فنی ابزارها سؤال کنید.
                        </p>

                    </article>


                    <article class="diar-card rounded-2xl p-7">

                        <div class="diar-icon w-14 h-14 rounded-2xl grid place-items-center text-2xl">
                            🤝
                        </div>

                        <h3 class="font-extrabold mt-5">
                            پیشنهاد و همکاری
                        </h3>

                        <p class="text-sm leading-8 mt-3"
                           style="color:var(--text-secondary)">
                            پیشنهادها و درخواست‌های همکاری خود را با ما در میان بگذارید.
                        </p>

                    </article>

                </div>

            </div>

        </section>


        {{-- FAQ --}}
        <section class="py-16 sm:py-20">

            <div class="container-x">

                <div class="text-center mb-12">

                    <h2 class="diar-line text-2xl sm:text-3xl font-black text-[#F4F7F5]">
                        سؤالات متداول
                    </h2>

                    <p class="text-sm mt-4"
                       style="color:var(--text-secondary)">
                        پاسخ برخی از سؤالات رایج مشتریان دیار ابزار
                    </p>

                </div>


                <div class="grid sm:grid-cols-2 gap-5">

                    <details class="contact-faq group rounded-2xl p-6">

                        <summary class="cursor-pointer font-bold text-sm sm:text-base flex items-center justify-between gap-4 list-none">

                            چگونه سفارش خود را پیگیری کنم؟

                            <span class="text-xl group-open:rotate-45 transition">+</span>

                        </summary>

                        <p class="text-sm leading-8 mt-4"
                           style="color:var(--text-secondary)">
                            برای اطلاع از وضعیت سفارش خود می‌توانید از طریق فرم تماس
                            با ما موضوع «پیگیری سفارش» را انتخاب کرده و درخواستتان را ارسال کنید.
                        </p>

                    </details>


                    <details class="contact-faq group rounded-2xl p-6">

                        <summary class="cursor-pointer font-bold text-sm sm:text-base flex items-center justify-between gap-4 list-none">

                            چطور ابزار مناسب کارم را انتخاب کنم؟

                            <span class="text-xl group-open:rotate-45 transition">+</span>

                        </summary>

                        <p class="text-sm leading-8 mt-4"
                           style="color:var(--text-secondary)">
                            نوع فعالیت، میزان استفاده و مشخصات فنی ابزار از عوامل مهم
                            در انتخاب هستند. می‌توانید برای دریافت راهنمایی با ما تماس بگیرید.
                        </p>

                    </details>


                    <details class="contact-faq group rounded-2xl p-6">

                        <summary class="cursor-pointer font-bold text-sm sm:text-base flex items-center justify-between gap-4 list-none">

                            آیا امکان دریافت اطلاعات فنی محصولات وجود دارد؟

                            <span class="text-xl group-open:rotate-45 transition">+</span>

                        </summary>

                        <p class="text-sm leading-8 mt-4"
                           style="color:var(--text-secondary)">
                            بله، برای دریافت اطلاعات بیشتر درباره مشخصات و کاربرد محصولات
                            می‌توانید درخواست خود را از طریق فرم تماس ارسال کنید.
                        </p>

                    </details>


                    <details class="contact-faq group rounded-2xl p-6">

                        <summary class="cursor-pointer font-bold text-sm sm:text-base flex items-center justify-between gap-4 list-none">

                            چگونه از شرایط ارسال سفارش مطلع شوم؟

                            <span class="text-xl group-open:rotate-45 transition">+</span>

                        </summary>

                        <p class="text-sm leading-8 mt-4"
                           style="color:var(--text-secondary)">
                            شرایط و زمان ارسال با توجه به مقصد و روش ارسال متفاوت است.
                            برای اطلاع از جزئیات سفارش خود با فروشگاه در ارتباط باشید.
                        </p>

                    </details>


                    <details class="contact-faq group rounded-2xl p-6">

                        <summary class="cursor-pointer font-bold text-sm sm:text-base flex items-center justify-between gap-4 list-none">

                            آیا امکان ثبت پیشنهاد و انتقاد وجود دارد؟

                            <span class="text-xl group-open:rotate-45 transition">+</span>

                        </summary>

                        <p class="text-sm leading-8 mt-4"
                           style="color:var(--text-secondary)">
                            بله، نظرات و پیشنهادهای شما برای بهبود خدمات دیار ابزار
                            ارزشمند است. می‌توانید از طریق فرم تماس آن‌ها را ارسال کنید.
                        </p>

                    </details>


                    <details class="contact-faq group rounded-2xl p-6">

                        <summary class="cursor-pointer font-bold text-sm sm:text-base flex items-center justify-between gap-4 list-none">

                            چطور درباره موجودی یک محصول سؤال کنم؟

                            <span class="text-xl group-open:rotate-45 transition">+</span>

                        </summary>

                        <p class="text-sm leading-8 mt-4"
                           style="color:var(--text-secondary)">
                            نام محصول موردنظر را در پیام خود بنویسید تا درخواست شما
                            برای بررسی و پاسخ‌گویی به فروشگاه ارسال شود.
                        </p>

                    </details>

                </div>

            </div>

        </section>


        {{-- CTA --}}
        <section class="pb-16 sm:pb-20">

            <div class="container-x">

                <div class="diar-cta rounded-[30px] p-8 sm:p-14 text-center relative overflow-hidden">

                    <div class="absolute -right-20 -top-20 w-64 h-64 rounded-full blur-3xl"
                         style="background:rgba(0,244,119,.08)"></div>

                    <div class="relative">

                        <div class="text-4xl mb-5">🔧</div>

                        <h2 class="text-2xl sm:text-3xl font-black text-[#F4F7F5] leading-relaxed">
                            برای انتخاب ابزار مناسب آماده‌اید؟
                        </h2>

                        <p class="mt-4 text-sm sm:text-base leading-8 max-w-2xl mx-auto"
                           style="color:var(--text-secondary)">
                            محصولات دیار ابزار را بررسی کنید و ابزار موردنیاز
                            پروژه و فعالیت خود را پیدا کنید.
                        </p>

                        <div class="mt-8 flex flex-wrap justify-center gap-3">

                            <a href="{{ url('/') }}"
                               class="contact-primary-btn px-8 py-3.5 rounded-xl font-bold">
                                مشاهده فروشگاه
                            </a>

                            <a href="#contact-form"
                               class="contact-secondary-btn px-8 py-3.5 rounded-xl font-bold">
                                ارسال پیام
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>

</div>

@endsection