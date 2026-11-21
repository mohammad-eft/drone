
<!doctype html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('icon/faveicon.png') }}">

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/tailwind.js') }}"></script>

    <title>ورود | پهپاد استور</title>

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

        * {
            box-sizing: border-box;
        }

        body {
            background: var(--cf-bg);
            color: var(--cf-text);
        }

        input {
            transition: all .25s ease;
            color: var(--cf-text) !important;
        }

        input::placeholder {
            color: #737D76 !important;
            opacity: 1;
        }

        input:focus {
            border-color: var(--cf-green) !important;
            box-shadow: 0 0 0 3px rgba(0, 244, 119, .10) !important;
            color: var(--cf-text) !important;
            outline: none !important;
        }

        input:focus::placeholder {
            color: #929B95 !important;
        }

        input:focus + span svg,
        .group:focus-within span svg {
            color: var(--cf-green) !important;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-background-clip: text;
            -webkit-text-fill-color: #F4F7F5 !important;
            transition: background-color 5000s ease-in-out 0s;
            box-shadow: inset 0 0 20px 20px #191D1B !important;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn .8s ease-out;
        }

        /* Brand Panel */
        .brand-panel {
            background:
                    radial-gradient(circle at 18% 18%, rgba(0, 244, 119, .16), transparent 32%),
                    radial-gradient(circle at 82% 78%, rgba(57, 255, 152, .10), transparent 30%),
                    linear-gradient(135deg, #090C0A 0%, #101C14 52%, #10281B 100%);
        }

        .brand-panel::before,
        .brand-panel::after {
            content: "";
            position: absolute;
            border-radius: 9999px;
            pointer-events: none;
        }

        .brand-panel::before {
            width: 310px;
            height: 310px;
            top: -150px;
            right: -90px;
            border: 1px solid rgba(0, 244, 119, .25);
            box-shadow:
                    0 0 0 24px rgba(0, 244, 119, .025),
                    0 0 0 52px rgba(0, 244, 119, .015);
        }

        .brand-panel::after {
            width: 240px;
            height: 240px;
            bottom: -145px;
            left: -75px;
            border: 1px solid rgba(57, 255, 152, .2);
            box-shadow:
                    0 0 0 22px rgba(57, 255, 152, .025),
                    0 0 0 46px rgba(57, 255, 152, .015);
        }

        .brand-mark-line {
            width: 74px;
            height: 4px;
            margin: 14px auto 0;
            border-radius: 99px;
            background: linear-gradient(90deg, #00F477, #39FF98);
        }

        /* Buttons */
        .brand-button {
            background: linear-gradient(105deg, #00D968 0%, #00F477 65%, #39FF98 100%);
            color: #06140B;
            transition: all .25s ease;
        }

        .brand-button:hover {
            background: linear-gradient(105deg, #00C85F 0%, #00E875 65%, #39FF98 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -8px rgba(0, 244, 119, .25);
        }

        .brand-send-button {
            background: #202522;
            border: 1px solid #354139;
            color: var(--cf-green);
            transition: all .2s ease;
        }

        .brand-send-button:hover {
            background: #29332C;
            border-color: var(--cf-green);
        }

        .brand-send-button.is-counting {
            opacity: .55;
            cursor: not-allowed;
        }

        .brand-link {
            color: var(--cf-green);
        }

        .brand-link:hover {
            color: var(--cf-green-hover);
        }

        .brand-footer {
            background: linear-gradient(90deg, #101412, #191D1B);
            border-top: 1px solid #2A302C;
        }

        .brand-loader {
            border-color: var(--cf-green);
            border-top-color: transparent;
        }

        .brand-loader-text {
            color: var(--cf-green);
        }

        .login-input {
            background: #101412 !important;
            border-color: #2A302C !important;
            color: #F4F7F5 !important;
        }

        .login-input:hover {
            border-color: #46534A !important;
        }

        .login-icon {
            color: #929B95;
        }

        .login-option {
            color: #929B95;
        }

        @media (max-width: 767px) {
            .brand-panel {
                min-height: 118px;
            }

            .brand-panel::before {
                width: 180px;
                height: 180px;
                top: -100px;
            }

            .brand-panel::after {
                width: 150px;
                height: 150px;
                bottom: -100px;
            }
        }
    </style>
</head>

<body class="bg-[#090C0A]">

<div class="absolute -top-5 invisible opacity-0 right-1/2 translate-x-1/2 w-2/3 z-[999999] transition-all duration-500 ease-in-out"
     id="message"></div>

<div class="w-full min-h-dvh flex flex-col justify-start items-center md:flex-row-reverse">

    {{-- Brand Panel --}}
    <div
            class="flex justify-center max-sm:h-30 max-md:h-35 md:h-dvh brand-panel relative overflow-hidden w-full lg:w-1/2">

        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-40 h-40 bg-[#00F477] rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-60 h-60 bg-[#39FF98] rounded-full blur-3xl"></div>
        </div>

        <div class="flex flex-col my-12 items-center justify-center relative z-10 w-full">
            <div class="w-full flex flex-row justify-center items-center animate-fadeIn">

                <div class="text-center">
                    <h2 class="text-center font-black text-white text-4xl md:text-5xl mb-2 drop-shadow-lg tracking-wide">
                        پهپاد استور
                    </h2>

                    <div class="brand-mark-line"></div>

                    <p class="text-[#929B95] text-sm mt-3">
                        فروشگاه تخصصی پهپاد و تجهیزات پروازی
                    </p>
                </div>

            </div>
        </div>
    </div>

    {{-- Login Form --}}
    <div
            class="w-full md:w-8/12 bg-[#090C0A] min-h-dvh flex flex-col max-md:justify-start justify-center mt-5 md:mt-0 items-center px-4 lg:w-1/2">

        <div
                class="w-full flex flex-col items-center justify-center md:justify-center lg:w-115 md:w-10/12 px-4 animate-fadeIn">

            <div class="w-full text-center mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-[#F4F7F5] mb-3">
                    ورود به حساب کاربری
                </h1>

                <p class="text-[#929B95] text-sm">
                    برای ورود اطلاعات خود را وارد کنید
                </p>
            </div>

            <div class="flex flex-col w-full">

                <form action="{{ route('user.check') }}"
                      class="flex flex-col items-center my-2 gap-4 w-full"
                      id="loginForm"
                      method="post">

                    @csrf

                    {{-- Phone Number --}}
                    <div class="relative w-full group @error('phoneNumber') mb-5 @enderror">

                            <span
                                    class="absolute right-3 top-1/2 -translate-y-1/2 login-icon group-focus-within:text-[#00F477] transition-colors">

                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 5a2 2 0 012-2h3.28a2 2 0 01.948.684l1.498 4.493a2 2 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a2 2 0 011.21-.502l4.493 1.498A2 2 0 0119 19v1a2 2 0 01-2 2h-1C9.716 22 3 15.284 3 7V5z">
                                    </path>
                                </svg>

                            </span>

                        <input type="number"
                               class="login-input w-full pr-10 pl-4 py-3 rounded-xl border-2 @error('phoneNumber') border-red-500 @enderror focus:border-[#00F477] focus:ring-0 focus:outline-none transition-all duration-300"
                               name="phoneNumber"
                               id="phoneNumber"
                               placeholder="شماره تلفن"
                               value="{{ old('phoneNumber') }}"
                               required>

                        @error('phoneNumber')
                        <span
                                class="text-red-400 text-sm absolute right-3 -bottom-6">
                                    {{ $message }}
                                </span>
                        @enderror

                    </div>

                    {{-- Login Way --}}
                    <div class="w-full" id="loginWay">

                        <div class="relative w-full group @error('code') mb-5 @enderror flex gap-3">

                            <div class="w-3/4">

                                    <span
                                            class="absolute right-3 top-1/2 -translate-y-1/2 login-icon group-focus-within:text-[#00F477] transition-colors">

                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                            </path>
                                        </svg>

                                    </span>

                                <input type="number"
                                       class="login-input w-full pr-10 pl-4 py-3 rounded-xl border-2 @error('code') border-red-500 @enderror focus:border-[#00F477] focus:ring-0 focus:outline-none transition-all duration-300"
                                       name="code"
                                       id="code"
                                       placeholder="کد ارسال شده">

                                @error('code')
                                <span
                                        class="text-red-400 text-sm absolute right-3 -bottom-6">
                                            {{ $message }}
                                        </span>
                                @enderror

                            </div>

                            <button type="button"
                                    id="countDown"
                                    class="brand-send-button w-1/4 text-sm rounded-xl cursor-pointer"
                                    onclick="sendCode(this)">
                                ارسال کد
                            </button>

                        </div>

                    </div>

                    {{-- Additional Options --}}
                    <div class="w-full flex items-center justify-between mt-2">

                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox"
                                   class="w-4 h-4 rounded border-[#2A302C] bg-[#191D1B] text-[#00F477] focus:ring-[#00F477]">

                            <span class="text-sm login-option">
                                    مرا به خاطر بسپار
                                </span>
                        </label>

                        <button type="button"
                                class="text-sm brand-link transition-colors font-medium cursor-pointer"
                                onclick="loginWithPassKey(this)">
                            ورود با رمز عبور
                        </button>

                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            id="submitBtn"
                            class="brand-button w-full text-center p-3.5 rounded-xl font-bold text-lg mt-4 cursor-pointer shadow-lg shadow-[#00F477]/10"
                            onclick="loginToAccount(event, 'code')">

                        ورود به حساب

                    </button>

                    {{-- Signup --}}
                    <div class="w-full text-center mt-4 mb-8">
                            <span class="text-[#929B95]">
                                حساب کاربری ندارید؟

                                <a href="{{ route('signup') }}"
                                   class="brand-link font-semibold transition-colors mr-1">
                                    ثبت نام کنید!
                                </a>
                            </span>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

{{-- Loader --}}
<div class="fixed w-full h-dvh top-0 right-0 bg-black/70 backdrop-blur-sm transition-all duration-300 flex justify-center items-center invisible opacity-0 z-[99999]"
     id="loader">

    <div class="w-11/12 lg:w-1/3 p-7 rounded-2xl bg-[#191D1B] border border-[#2A302C] flex flex-col items-center justify-center gap-4 lg:gap-8">

        <div class="size-16 rounded-full border-4 brand-loader border-t-4 border-t-transparent animate-spin"></div>

        <span class="lg:text-lg font-bold brand-loader-text">
                لطفا شکیبا باشید ...
            </span>

    </div>

</div>

{{-- Mobile Footer --}}
<footer class="md:hidden">

    <div class="brand-footer w-full h-12 fixed bottom-0 flex flex-row gap-4 justify-center items-center text-[#F4F7F5]">

        <div class="flex items-center gap-2">
                <span class="text-sm font-bold">
                    پهپاد استور
                </span>
        </div>

        <a href="tel:09147794595"
           class="text-sm hover:text-[#00F477] transition-colors flex items-center gap-1">

            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 5a2 2 0 012-2h3.28a2 2 0 01.948.684l1.498 4.493a2 2 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a2 2 0 011.21-.502l4.493 1.498A2 2 0 0119 19v1a2 2 0 01-2 2h-1C9.716 22 3 15.284 3 7V5z">
                </path>
            </svg>

            <b>09147794595</b>

        </a>

    </div>

</footer>

<script>
    let message = document.getElementById('message')
    let submitBtn = document.getElementById('submitBtn')
    let loginForm = document.getElementById('loginForm')
    let phoneNumber = document.getElementById('phoneNumber')
    let password = document.getElementById('password')
    let loginWay = document.getElementById('loginWay')
    let code = document.getElementById('code')
    let link = "{{ url('/') }}/"

    function loader(status) {
        if (status === 'open') {
            document.getElementById('loader').classList.remove('invisible', 'opacity-0')
        }

        if (status === 'close') {
            document.getElementById('loader').classList.add('invisible', 'opacity-0')
        }
    }

    function loginToAccount(e, way) {
        password = document.getElementById('password')
        code = document.getElementById('code')

        e.preventDefault()

        if (phoneNumber.value == '' || (password && password.value == '') || (code && code.value == '')) {
            openMessage('پر کردن همه فیلد ها الزامی است')

            setTimeout(function() {
                closeMessage()
            }, 2000)

        } else {

            loader('open')

            if (way == 'code') {
                console.log('code')

                $.ajax({
                    url: link + 'api/checkCode',
                    type: "POST",
                    dataType: "json",
                    data: {
                        'phoneNumber': phoneNumber.value,
                        'code': code.value
                    },

                    success: function(response) {
                        loader('close')
                        console.log(response)

                        if (response) {
                            loginForm.submit()
                        } else {
                            openMessage('کد وارد شده نامعتبر')

                            setTimeout(function() {
                                closeMessage()
                            }, 2000)
                        }
                    },

                    error: function() {
                        loader('close')
                        openMessage('خطا در بارگیری اطلاعات')

                        setTimeout(function() {
                            closeMessage()
                        }, 2000)
                    }
                })
            }

            if (way == 'password') {

                $.ajax({
                    url: link + "api/checkPassKey",
                    type: "POST",
                    dataType: "json",
                    data: {
                        'phoneNumber': phoneNumber.value,
                        'password': password.value
                    },

                    success: function(response) {
                        loader('close')

                        if (response) {
                            loginForm.submit()
                        } else {
                            openMessage('لطفا اطلاعات خودرا مجددا بررسی نمایید')

                            setTimeout(function() {
                                closeMessage()
                            }, 2000)
                        }
                    },

                    error: function() {
                        loader('close')
                        openMessage('خطا در دریافت داده')

                        setTimeout(function() {
                            closeMessage()
                        }, 2000)
                    }
                })
            }
        }
    }

    function loginWithActivationCode(el) {
        loginWay.innerHTML = ''

        submitBtn.setAttribute('onclick', 'loginToAccount(event, "code")')

        el.setAttribute('onclick', 'loginWithPassKey(this)')
        el.innerText = "ورود با رمز عبور"

        let element = document.createElement('div')

        element.classList = 'relative w-full group flex gap-3'

        element.innerHTML = `
                <div class="w-3/4">
                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-[#929B95] group-focus-within:text-[#00F477] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </span>

                    <input type="number"
                        class="login-input w-full pr-10 pl-4 py-3 rounded-xl border-2 border-[#2A302C] focus:border-[#00F477] focus:ring-0 focus:outline-none transition-all duration-300"
                        name="code"
                        id="code"
                        placeholder="کد ارسال شده">
                </div>

                <button type="button"
                    id="countDown"
                    class="brand-send-button w-1/4 text-sm rounded-xl cursor-pointer"
                    onclick="sendCode(this)">
                    ارسال کد
                </button>
            `

        loginWay.appendChild(element)
    }

    function loginWithPassKey(el) {
        loginWay.innerHTML = ''

        submitBtn.setAttribute('onclick', 'loginToAccount(event, "password")')

        el.setAttribute('onclick', 'loginWithActivationCode(this)')
        el.innerText = 'ورود با رمز یکبار مصرف'

        let element = document.createElement('div')

        element.classList = 'relative w-full group'

        element.innerHTML = `
                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-[#929B95] group-focus-within:text-[#00F477] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </span>

                <input type="password"
                    class="login-input w-full pr-10 pl-4 py-3 rounded-xl border-2 border-[#2A302C] focus:border-[#00F477] focus:ring-0 focus:outline-none transition-all duration-300"
                    name="password"
                    id="password"
                    placeholder="کلمه عبور">
            `

        loginWay.appendChild(element)
    }

    function sendCode(el) {
        countDown.classList.add('is-counting')
        countDown.classList.remove('cursor-pointer')

        el.innerHTML =
            "<div class='size-8 mx-auto border-2 border-[#00F477] border-t-transparent rounded-full animate-spin'></div>"

        if (phoneNumber.value == '') {

            el.innerHTML = 'ارسال کد'

            openMessage('پر کردن همه فیلد ها الزامیه')

            setTimeout(function() {
                closeMessage()
            }, 2000)

        } else {

            $.ajax({
                url: link + "api/sendActivationCode",
                type: "POST",
                dataType: "json",
                data: {
                    'phoneNumber': phoneNumber.value
                },

                success: function(response) {

                    if (!response) {

                        el.innerHTML = 'ارسال کد'

                        openMessage('کاربر قبلا با این شماره ثبت نام نکرده است')

                        setTimeout(function() {
                            closeMessage()
                        }, 2000)

                        countDown.classList.remove('is-counting')
                        countDown.classList.add('cursor-pointer')

                    } else {
                        counter()
                    }
                },

                error: function() {

                    el.innerHTML = 'ارسال کد'

                    countDown.classList.remove('is-counting')
                    countDown.classList.add('cursor-pointer')

                    openMessage('خطا در دریافت داده!')

                    setTimeout(function() {
                        closeMessage()
                    }, 2000)
                }
            })
        }
    }

    function counter() {
        let phoneNumber = document.getElementById('phoneNumber')

        countDown.classList.add('is-counting')
        countDown.classList.remove('cursor-pointer')

        countDown.setAttribute('disabled', true)
        countDown.setAttribute('dir', 'ltr')

        let count = 120

        let result = setInterval(() => {

            let minute = Math.floor(count / 60)
            let seconds = count % 60

            count -= 1

            if (count < 0) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                })

                $.ajax({
                    url: link + 'api/removeActivationCode',
                    type: "POST",
                    dataType: "json",
                    data: {
                        'phoneNumber': phoneNumber.value
                    },

                    success: function(data) {
                        console.log(data)

                        countDown.classList.remove('is-counting')

                        countDown.removeAttribute('disabled')
                        countDown.removeAttribute('dir')

                        countDown.innerText = "ارسال مجدد"
                    },

                    error: function() {
                        openMessage('خطا در دریافت اطلاعات!')

                        setTimeout(() => {
                            closeMessage()
                        }, 2500)
                    }
                })

                clearInterval(result)
            }

            countDown.innerText =
                minute.toString().padStart(2, "0") + " : " +
                seconds.toString().padStart(2, "0");

        }, 1000)
    }

    function openMessage(content) {
        message.innerHTML = ''

        let element = document.createElement('div')

        element.classList = 'bg-[#191D1B] border border-[#2A302C] rounded-xl flex items-center justify-center shadow-xl'

        element.innerHTML = `
                <div class="p-3">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="size-4 fill-[#929B95] cursor-pointer"
                        onclick="closeMessage()"
                        viewBox="0 0 384 512">
                        <path d="M345 137c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-119 119L73 103c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l119 119L39 375c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l119-119L311 409c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-119-119L345 137z"/>
                    </svg>
                </div>

                <span class="text-sm text-red-400 py-3 pl-3 pr-0 inline-block">
                    ${content}
                </span>
            `

        message.appendChild(element)

        message.classList.remove('-top-5')
        message.classList.remove('invisible')
        message.classList.remove('opacity-0')

        message.classList.add('top-10')
    }

    function closeMessage() {
        message.classList.remove('top-10')

        message.classList.add('-top-5')
        message.classList.add('invisible')
        message.classList.add('opacity-0')
    }
</script>

</body>

</html>
