
/* =========================================================
   DIAR ABZAR — SINGLE PRODUCT
========================================================= */

/* =========================================================
   STORAGE
========================================================= */

function getSingleProductCart() {

    try {

        const products = JSON.parse(
            localStorage.getItem('products')
        );

        return Array.isArray(products) ? products : [];

    } catch (error) {

        return [];

    }

}

/* =========================================================
   CART INITIALIZATION
========================================================= */

function initializeSingleProductCart() {

    const containers = document.querySelectorAll(
        '.addToCartBtns[data-product-id]'
    );

    const products = getSingleProductCart();

    containers.forEach(container => {

        const productId = String(container.dataset.productId);

        const product = products.find(item =>
            String(item.id) === productId
        );

        const maxCount = Number(container.dataset.count) || 0;

        if (product && Number(product.quantity) > 0) {

            container.innerHTML = `
                <div class="w-full p-1.5 h-12 flex gap-2
                            justify-center items-center rounded-xl
                            bg-[#101412] border border-[#2A302C]">

                    <button
                        type="button"
                        onclick="setCount(this)"
                        data-state="+"
                        class="w-1/3 h-9 rounded-lg flex justify-center items-center
                               text-[#00F477] hover:bg-[#00F477] hover:text-[#06140B]
                               transition-all duration-200 text-lg font-bold
                               ${Number(product.quantity) >= maxCount
                    ? 'opacity-40 cursor-not-allowed'
                    : 'cursor-pointer'}"
                        ${Number(product.quantity) >= maxCount ? 'disabled' : ''}>
                        +
                    </button>

                    <input
                        type="number"
                        readonly
                        value="${Number(product.quantity)}"
                        class="w-1/3 h-9 text-center text-sm font-bold
                               text-[#F4F7F5] bg-transparent outline-none in-fa">

                    <button
                        type="button"
                        onclick="setCount(this)"
                        data-state="-"
                        class="w-1/3 h-9 rounded-lg flex justify-center items-center
                               text-[#00F477] hover:bg-[#00F477] hover:text-[#06140B]
                               transition-all duration-200 text-lg font-bold cursor-pointer">
                        -
                    </button>

                </div>
            `;

        } else if (maxCount <= 0) {

            container.innerHTML = `
                <button type="button" disabled
                    class="w-full h-12 rounded-xl flex items-center justify-center
                           bg-[#202522] border border-[#2A302C]
                           text-[#929B95] text-xs font-bold cursor-not-allowed">
                    عدم موجودی
                </button>
            `;

        } else {

            container.innerHTML = `
                <button
                    type="button"
                    onclick="addToCart(this)"
                    class="product-primary-btn w-full h-12 rounded-xl
                           flex items-center justify-center gap-1.5 font-bold text-xs">

                    <svg class="size-4 shrink-0" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M3 3h2l2.2 11.5a2 2 0 0 0 2 1.6h8.9a2 2 0 0 0 2-1.6L22 7H6"/>
                        <circle cx="10" cy="20" r="1"/>
                        <circle cx="18" cy="20" r="1"/>
                        <path d="M14 9v5M11.5 11.5h5"/>
                    </svg>

                    <span>افزودن به سبد خرید</span>

                </button>
            `;

        }

    });

}

/* =========================================================
   PRODUCT GALLERY & LIGHTBOX
========================================================= */

function initializeProductGallery() {

    const mainImages = document.querySelectorAll(
        '.gallery_pack_single_primary_img'
    );

    const galleryItems = document.querySelectorAll(
        '.gallery_pack_single'
    );

    if (!mainImages.length) return;

    /* Create lightbox */

    const lightbox = document.createElement('div');

    lightbox.className = `
        fixed inset-0 z-[99999] bg-[#010348]/95
        flex items-center justify-center p-4
        opacity-0 invisible transition-all duration-300
    `;

    lightbox.innerHTML = `
        <button type="button"
            class="absolute top-5 left-5 size-11 rounded-full
                   bg-white/10 text-white flex items-center
                   justify-center hover:bg-white/20 transition"
            aria-label="بستن تصویر">

            <svg class="size-6" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2">
                <path d="m18 6-12 12M6 6l12 12"/>
            </svg>

        </button>

        <img src="" alt="تصویر محصول"
            class="max-w-full max-h-[85vh] object-contain
                   rounded-xl scale-95 transition-transform duration-300">
    `;

    document.body.appendChild(lightbox);

    const lightboxImage = lightbox.querySelector('img');
    const closeButton = lightbox.querySelector('button');

    /* Change main image */

    galleryItems.forEach(item => {

        item.addEventListener('click', function () {

            const image = this.querySelector('img');

            if (!image) return;

            mainImages.forEach(mainImage => {
                mainImage.src = image.src;
            });

        });

    });

    /* Open lightbox */

    mainImages.forEach(image => {

        image.style.cursor = 'zoom-in';

        image.addEventListener('click', function () {

            lightboxImage.src = this.src;

            lightbox.classList.remove('invisible', 'opacity-0');

            lightbox.classList.add('opacity-100');

            lightboxImage.classList.remove('scale-95');

            lightboxImage.classList.add('scale-100');

            document.body.style.overflow = 'hidden';

        });

    });

    /* Close lightbox */

    function closeLightbox() {

        if (lightbox.classList.contains('invisible')) return;

        lightbox.classList.remove('opacity-100');

        lightbox.classList.add('opacity-0');

        lightboxImage.classList.remove('scale-100');

        lightboxImage.classList.add('scale-95');

        setTimeout(() => {

            lightbox.classList.add('invisible');

            document.body.style.overflow = '';

        }, 300);

    }

    closeButton.addEventListener('click', closeLightbox);

    lightbox.addEventListener('click', function (event) {

        if (event.target === lightbox) {
            closeLightbox();
        }

    });

    document.addEventListener('keydown', function (event) {

        if (
            event.key === 'Escape' &&
            !lightbox.classList.contains('invisible')
        ) {
            closeLightbox();
        }

    });

}

/* =========================================================
   INITIALIZE
========================================================= */

function initializeSingleProductPage() {

    initializeSingleProductCart();

    initializeProductGallery();

}

if (document.readyState === 'loading') {

    document.addEventListener(
        'DOMContentLoaded',
        initializeSingleProductPage
    );

} else {

    initializeSingleProductPage();

}
