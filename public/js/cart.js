
/* =========================================================
   DIAR ABZAR — CART SYSTEM
========================================================= */

let popupFlag = false;

let cartLink = document.getElementById('cartLink');
orderBasket = document.getElementById('orderBasket');

let totalPriceEl = document.getElementById('totalPriceEl');
let discountEl = document.getElementById('discountEl');

let cartItemsBlock = document.getElementById('cartItemsBlock');

let addPackToCartBtn = document.getElementById('addPackToCartBtn');

/* =========================================================
   STORAGE HELPERS
========================================================= */

function readCart(key) {
    try {
        const data = JSON.parse(localStorage.getItem(key));
        return Array.isArray(data) ? data : [];
    } catch (error) {
        return [];
    }
}

function saveCart(key, items) {
    localStorage.setItem(key, JSON.stringify(items));
}

function getItemPrice(item) {
    return Number(item.secondary_price || item.primary_price) || 0;
}

function getItemCount(item) {
    return Number(item.count) || 0;
}

function updateCartState() {

    localProducts = readCart('products');
    localPacks = readCart('packs');

    totalCartQuantity = 0;

    localProducts.forEach(item => {
        totalCartQuantity += Number(item.quantity) || 0;
    });

    localPacks.forEach(item => {
        totalCartQuantity += Number(item.quantity) || 0;
    });

    if (typeof updateCartBadge === 'function') {
        updateCartBadge();
    }


}

/* =========================================================
   QUANTITY HTML
========================================================= */
function getQuantityControl(cart, type) {

    const isPack = type === 'pack';

    const functionName = isPack ? 'setPackCount' : 'setCount';

    const quantity = Number(cart.quantity) || 1;
    const maxCount = getItemCount(cart);

    const isMax = quantity >= maxCount;

    return `
        <div class="w-full p-1.5 h-full flex gap-2 justify-center items-center
                    rounded-xl bg-[#101412] border border-[#2A302C]
                    transition-all duration-300">

            <button
                type="button"
                onclick="event.stopPropagation(); ${functionName}(this)"
                data-state="+"
                class="w-1/3 h-5 rounded-lg flex justify-center items-center
                       text-[#00F477] hover:bg-[#00F477] hover:text-[#06140B]
                       transition-all duration-200 text-lg font-bold
                       ${isMax ? 'opacity-40 cursor-not-allowed' : 'cursor-pointer'}"
                ${isMax ? 'disabled' : ''}>
                +
            </button>

            <input
                type="number"
                class="w-1/3 h-9 rounded-lg bg-transparent text-[#F4F7F5]
                       text-sm text-center outline-none in-fa font-bold"
                readonly
                value="${quantity}">

            <button
                type="button"
                onclick="event.stopPropagation(); ${functionName}(this)"
                data-state="-"
                class="w-1/3 h-5 rounded-lg flex justify-center items-center
                       text-[#00F477] hover:bg-[#00F477] hover:text-[#06140B]
                       transition-all duration-200 text-lg font-bold cursor-pointer">
                -
            </button>

        </div>
    `;
}

/* =========================================================
   ADD TO CART HTML
   SAME DESIGN AS SINGLE PRODUCT PAGE
========================================================= */

function getAddToCartHTML(type, count) {

    const functionName = type === 'pack'
        ? 'addPackToCart'
        : 'addToCart';

    if (Number(count) <= 0) {
        return `
            <button type="button" disabled
                aria-label="ناموجود"
                title="ناموجود"
                class="grid h-[30px] w-[30px] shrink-0 place-items-center
                       rounded-[7px] bg-neutral-700 text-neutral-400
                       cursor-not-allowed md:h-8 md:w-8">
                <span class="text-base leading-none">×</span>
            </button>
        `;
    }

    return `
        <button type="button"
            onclick="${functionName}(this)"
            aria-label="افزودن به سبد خرید"
            title="افزودن به سبد خرید"
            class="grid h-[30px] w-[30px] shrink-0 place-items-center
                   rounded-[7px] bg-g text-black
                   transition-all duration-200 hover:brightness-110
                   active:scale-95 disabled:cursor-wait disabled:opacity-70
                   md:h-8 md:w-8">

            <span class="text-xl leading-none md:hidden">+</span>

            <svg class="hidden h-4 w-4 fill-none stroke-current
                        stroke-[2.2] md:block"
                 viewBox="0 0 24 24" aria-hidden="true">
                <use href="#cart"/>
            </svg>

        </button>
    `;
}

/* =========================================================
   RENDER PRODUCT CONTROLS
========================================================= */

function renderProductControls(productId) {

    const products = readCart('products');

    const product = products.find(item =>
        String(item.id) === String(productId)
    );

    document.querySelectorAll('.addToCartBtns[data-product-id]').forEach(container => {

        if (String(container.dataset.productId) !== String(productId)) {
            return;
        }

        if (product) {
            container.innerHTML = getQuantityControl(product, 'product');
        } else {
            container.innerHTML = getAddToCartHTML(
                'product',
                container.dataset.count
            );
        }
    });
}

/* =========================================================
   RENDER PACK CONTROLS
========================================================= */

function renderPackControls(packId) {

    const packs = readCart('packs');

    const pack = packs.find(item =>
        String(item.id) === String(packId)
    );

    document.querySelectorAll('.addPackToCartBtn[data-pack-id]').forEach(container => {

        if (String(container.dataset.packId) !== String(packId)) {
            return;
        }

        if (pack) {
            container.innerHTML = getQuantityControl(pack, 'pack');
        } else {
            container.innerHTML = getAddToCartHTML(
                'pack',
                container.dataset.count
            );
        }
    });
}

/* =========================================================
   ADD PRODUCT TO CART
========================================================= */

function addToCart(btn) {

    const container = btn.closest('.addToCartBtns');

    if (!container) return;

    if (btn.dataset.loading === 'true') return;

    const productId = container.dataset.productId;

    if (!productId) return;

    btn.dataset.loading = 'true';
    btn.disabled = true;

    const originalHTML = btn.innerHTML;

    btn.innerHTML = `
        <span class="h-4 w-4 rounded-full border-2 border-black/25
                     border-t-black animate-spin" aria-label="در حال افزودن"></span>`
    $.ajax({

        url: api + 'findProduct/' + productId,
        type: 'GET',
        dataType: 'json',

        success: function (response) {

            if (!response || !response.id) {
                restoreButton();
                return;
            }

            const products = readCart('products');

            const existing = products.find(item =>
                String(item.id) === String(response.id)
            );

            if (existing) {

                existing.quantity = Number(existing.quantity || 0) + 1;

            } else {

                response.quantity = 1;
                products.push(response);

            }

            const product = products.find(item =>
                String(item.id) === String(response.id)
            );

            const maxCount = getItemCount(product);

            if (product.quantity > maxCount) {
                product.quantity = maxCount;
            }

            saveCart('products', products);

            updateCartState();

            renderProductControls(productId);

        },

        error: function () {

            restoreButton();

            console.error('Product request failed.');

        }

    });

    function restoreButton() {

        btn.dataset.loading = 'false';
        btn.disabled = false;
        btn.innerHTML = originalHTML;

    }
}

function closeCartPopup(e = null) {

    if (!orderBasket || !orderBasket.parentElement) return;

    const popup = orderBasket.parentElement.children[1];

    if (!popup) return;

    // اگر کلیک از بیرون اتفاق افتاده باشد
    if (
        e &&
        (
            orderBasket.contains(e.target) ||
            popup.contains(e.target)
        )
    ) {
        return;
    }

    popupFlag = false;

    popup.classList.add('invisible', 'opacity-0');
}

/* =========================================================
   CHANGE PRODUCT QUANTITY
========================================================= */

function setCount(btn) {

    const container = btn.closest('.addToCartBtns');

    if (!container) return;

    const productId = container.dataset.productId;

    if (!productId) return;

    const products = readCart('products');

    const product = products.find(item =>
        String(item.id) === String(productId)
    );

    if (!product) return;

    const currentQuantity = Number(product.quantity) || 0;
    const maxCount = getItemCount(product);

    let newQuantity = currentQuantity;

    if (btn.dataset.state === '+') {

        if (currentQuantity >= maxCount) return;

        newQuantity++;

    } else if (btn.dataset.state === '-') {

        if (currentQuantity <= 0) return;

        newQuantity--;

    } else {

        return;

    }

    const difference = newQuantity - currentQuantity;

    /* Update price */

    if (totalPriceEl) {

        const currentPrice =
            Number(totalPriceEl.innerText.replace(/[^\d]/g, '')) || 0;

        const finalPrice = getItemPrice(product);

        totalPriceEl.innerText = Math.max(
            0,
            currentPrice + (difference * finalPrice)
        ).toLocaleString('en-US');

    }

    /* Update quantity */

    if (newQuantity <= 0) {

        const updatedProducts = products.filter(item =>
            String(item.id) !== String(productId)
        );

        saveCart('products', updatedProducts);

        if (window.currentPage === 'cart') {

            document.querySelectorAll('.cartPages').forEach(item => {

                if (String(item.dataset.productId) === String(productId)) {
                    item.remove();
                }

            });

        }

        if (popupFlag) {

            const parentItem = btn.closest('.parentItem');

            if (parentItem) parentItem.remove();

        }

    } else {

        product.quantity = newQuantity;

        saveCart('products', products);

    }

    updateCartState();

    renderProductControls(productId);

    /* Close popup when cart is empty */
    if (totalCartQuantity <= 0) {
        closeCartPopup();
    }

}

/* =========================================================
   ADD PACK TO CART
========================================================= */

function addPackToCart(btn) {

    const container = btn.closest('.addPackToCartBtn');

    if (!container) return;

    if (btn.dataset.loading === 'true') return;

    const packId = container.dataset.packId;

    if (!packId) return;

    btn.dataset.loading = 'true';
    btn.disabled = true;

    const originalHTML = btn.innerHTML;

    btn.innerHTML = `
        <span class="h-4 w-4 rounded-full border-2 border-black/25
                     border-t-black animate-spin" aria-label="در حال افزودن"></span>
    `;

    $.ajax({

        url: api + 'findPack/' + packId,
        type: 'GET',
        dataType: 'json',

        success: function (response) {

            if (!response || !response.id) {
                restoreButton();
                return;
            }

            const packs = readCart('packs');

            const existing = packs.find(item =>
                String(item.id) === String(response.id)
            );

            if (existing) {

                existing.quantity = Number(existing.quantity || 0) + 1;

            } else {

                response.quantity = 1;
                packs.push(response);

            }

            const pack = packs.find(item =>
                String(item.id) === String(response.id)
            );

            const maxCount = getItemCount(pack);

            if (pack.quantity > maxCount) {
                pack.quantity = maxCount;
            }

            saveCart('packs', packs);

            updateCartState();

            renderPackControls(packId);

        },

        error: function () {

            restoreButton();

            console.error('Pack request failed.');

        }

    });

    function restoreButton() {

        btn.dataset.loading = 'false';
        btn.disabled = false;
        btn.innerHTML = originalHTML;

    }
}

/* =========================================================
   CHANGE PACK QUANTITY
========================================================= */

function setPackCount(btn) {

    const container = btn.closest('.addPackToCartBtn');

    if (!container) return;

    const packId = container.dataset.packId;

    if (!packId) return;

    const packs = readCart('packs');

    const pack = packs.find(item =>
        String(item.id) === String(packId)
    );

    if (!pack) return;

    const currentQuantity = Number(pack.quantity) || 0;
    const maxCount = getItemCount(pack);

    let newQuantity = currentQuantity;

    if (btn.dataset.state === '+') {

        if (currentQuantity >= maxCount) return;

        newQuantity++;

    } else if (btn.dataset.state === '-') {

        if (currentQuantity <= 0) return;

        newQuantity--;

    } else {

        return;

    }

    const difference = newQuantity - currentQuantity;

    /* Update price */

    if (totalPriceEl) {

        const currentPrice =
            Number(totalPriceEl.innerText.replace(/[^\d]/g, '')) || 0;

        const finalPrice = getItemPrice(pack);

        totalPriceEl.innerText = Math.max(
            0,
            currentPrice + (difference * finalPrice)
        ).toLocaleString('en-US');

    }

    /* Update pack */

    if (newQuantity <= 0) {

        const updatedPacks = packs.filter(item =>
            String(item.id) !== String(packId)
        );

        saveCart('packs', updatedPacks);

        if (window.currentPage === 'cart') {

            document.querySelectorAll('.cartPages').forEach(item => {

                if (String(item.dataset.packId) === String(packId)) {
                    item.remove();
                }

            });

        }

        if (popupFlag) {

            const parentItem = btn.closest('.parentItem');

            if (parentItem) parentItem.remove();

        }

    } else {

        pack.quantity = newQuantity;

        saveCart('packs', packs);

    }

    updateCartState();

    renderPackControls(packId);

    /* Close popup when cart is empty */
    if (totalCartQuantity <= 0) {
        closeCartPopup();
    }

}

/* =========================================================
   CART POPUP
========================================================= */

function renderPopupCart() {

    const popup = orderBasket?.parentElement?.children[1];

    const parentCart = orderBasket?.parentElement
        ?.querySelector('.parentHeaderCarts');

    if (!popup || !parentCart) return;

    const products = readCart('products');
    const packs = readCart('packs');

    parentCart.innerHTML = '';

    if (!products.length && !packs.length) {

        parentCart.innerHTML = `
            <div class="w-full flex flex-col items-center justify-center gap-3
                        p-7 bg-[#101412] border border-[#2A302C] rounded-2xl">

                <div class="w-14 h-14 rounded-2xl bg-[#191D1B]
                            border border-[#2A302C] flex items-center justify-center">

                    <svg class="w-7 h-7 text-[#929B95]"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24">

                        <path stroke="currentColor" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="1.5"
                              d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                    </svg>

                </div>

                <h2 class="text-center text-sm font-bold text-[#F4F7F5]">
                    سبد خرید خالی است
                </h2>

                <p class="text-xs text-[#929B95]">
                    هنوز محصولی به سبد خریدت اضافه نکردی
                </p>

            </div>
        `;

        return;
    }

    products.forEach(product => {

        const element = document.createElement('div');

        element.className = `
            parentItem flex items-center gap-3 p-3
            bg-[#191D1B] rounded-2xl border border-[#2A302C]
        `;

        const price = getItemPrice(product);

        element.innerHTML = `
            <div class="w-[68px] h-[76px] sm:w-20 sm:h-20
                        shrink-0 overflow-hidden rounded-xl bg-white">

                <img src="${imgPath + product.mainImg}"
                     class="w-full h-full object-cover" alt="">

            </div>

            <div class="flex-1 min-w-0">

                <h3 class="font-bold text-sm text-[#F4F7F5] truncate">
                    ${product.title || ''}
                </h3>

                <p class="text-[11px] text-[#929B95] mt-1 mb-3 line-clamp-2">
                    ${product.summary || ''}
                </p>

                <div class="addToCartBtns w-[110px] h-9" style="padding: 0 !important;"
                     data-product-id="${product.id}"
                     data-count="${product.count}">

                    ${getQuantityControl(product, 'product')}

                </div>

            </div>

            <div class="shrink-0 text-left">

                <p class="font-extrabold text-sm text-[#F4F7F5] in-fa">
                    ${price ? price.toLocaleString('en-US') : 'تماس بگیرید'}
                </p>

                <span class="text-[10px] text-[#929B95]">تومان</span>

            </div>
        `;

        parentCart.append(element);

    });

    packs.forEach(pack => {

        const element = document.createElement('div');

        element.className = `
            parentItem flex items-center gap-3 p-3
            bg-[#191D1B] rounded-2xl border border-[#2A302C]
        `;

        const price = getItemPrice(pack);

        element.innerHTML = `
            <div class="w-[68px] h-[76px] sm:w-20 sm:h-20
                        shrink-0 overflow-hidden rounded-xl bg-white">

                <img src="${imgPath + pack.image}"
                     class="w-full h-full object-cover" alt="">

            </div>

            <div class="flex-1 min-w-0">

                <h3 class="font-bold text-sm text-[#F4F7F5] truncate">
                    ${pack.title || ''}
                </h3>

                <p class="text-[11px] text-[#929B95] mt-1 mb-3 line-clamp-2">
                    ${pack.summary || ''}
                </p>

                <div class="addPackToCartBtn w-[110px] h-9"
                     data-pack-id="${pack.id}"
                     data-count="${pack.count}">

                    ${getQuantityControl(pack, 'pack')}

                </div>

            </div>

            <div class="shrink-0 text-left">

                <p class="font-extrabold text-sm text-[#F4F7F5] in-fa">
                    ${price ? price.toLocaleString('en-US') : 'تماس بگیرید'}
                </p>

                <span class="text-[10px] text-[#929B95]">تومان</span>

            </div>
        `;

        parentCart.append(element);

    });

}

/* =========================================================
   CART POPUP EVENTS
========================================================= */

if (orderBasket) {

    const popup = orderBasket.parentElement?.children[1];

    // باز و بسته شدن با کلیک روی آیکون سبد خرید
    orderBasket.addEventListener('click', function (event) {

        event.stopPropagation();

        if (!popup) return;

        if (popup.classList.contains('invisible')) {

            popupFlag = true;

            popup.classList.remove('invisible', 'opacity-0');

            renderPopupCart();

        } else {

            popupFlag = false;

            popup.classList.add('invisible', 'opacity-0');

        }

    });

    // جلوگیری از بسته شدن هنگام کلیک داخل پاپ‌آپ
    if (popup) {

        popup.addEventListener('click', function (event) {
            event.stopPropagation();
        });

    }

    // بستن پاپ‌آپ با کلیک خارج از آن
    document.addEventListener('click', function (event) {
        closeCartPopup(event);
    });

}

/* =========================================================
   INITIALIZE
========================================================= */

updateCartState();