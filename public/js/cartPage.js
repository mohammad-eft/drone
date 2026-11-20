
let totalBlock = document.getElementById('totalBlock');
cartItemsBlock = document.getElementById('cartItemsBlock');
let emptyCartBlock = document.getElementById('emptyCartBlock');
let continueShoppingLink = document.getElementById('continueShoppingLink');

let priceSum = 0;

orderBasket = document.getElementById('orderBasket');

localProducts = JSON.parse(localStorage.getItem('products') || '[]');
localPacks = JSON.parse(localStorage.getItem('packs') || '[]');

let cartPage = true;

/* =========================
   CIRCUITFLY CART STYLES
========================= */

const cartCardStyle = `
    bg-[#191D1B] rounded-2xl p-4 flex gap-4 items-center
    border border-[#2A302C] shadow-[0_4px_14px_rgba(0,0,0,0.2)]
    transition-all duration-300 hover:border-[#00F477]/30
`;

const cartImageStyle = `
    w-16 h-20 sm:w-20 sm:h-24 bg-[#101412]
    rounded-xl flex items-center justify-center shrink-0
    overflow-hidden border border-[#2A302C]
`;

const cartTitleStyle = `
    font-bold text-[#F4F7F5] text-sm sm:text-base truncate
`;

const cartSummaryStyle = `
    text-xs text-[#929B95] mt-1 mb-5 line-clamp-2
`;

const cartPriceStyle = `
    font-extrabold text-[#00F477] text-sm sm:text-base in-fa price
`;

const cartCurrencyStyle = `
    text-xs text-[#929B95] mt-1
`;


/* =========================
   EMPTY CART STATE
========================= */

function updateCartEmptyState() {

    if (!cartItemsBlock) return;

    const hasItems = cartItemsBlock.querySelector('.products.cartPages') !== null;

    if (emptyCartBlock) {
        emptyCartBlock.classList.toggle('hidden', hasItems);
    }

    if (totalBlock) {
        totalBlock.classList.toggle('hidden', !hasItems);
    }

    if (continueShoppingLink) {
        continueShoppingLink.classList.toggle('hidden', !hasItems);
    }

    if (!hasItems && totalBlock) {
        priceSum = 0;

        const totalPriceEl = totalBlock.querySelector('#totalPriceEl');
        const discountEl = totalBlock.querySelector('#discountEl');
        const discountBlock = totalBlock.querySelector('.discountBlock');

        if (totalPriceEl) {
            totalPriceEl.innerText = '0';
        }

        if (discountEl) {
            discountEl.innerText = '0';
        }

        if (discountBlock) {
            discountBlock.classList.add('hidden');
        }
    }
}


/* =========================
   CLOSE CART POPUP
========================= */

function closeCartPopup(e) {

    if (!orderBasket || !orderBasket.parentElement) return

    const popup = orderBasket.parentElement.children[1]

    if (!popup) return

    if (
        !orderBasket.contains(e.target) &&
        !popup.contains(e.target)
    ) {
        popupFlag = false

        popup.classList.add('invisible', 'opacity-0');
    }
}


/* =========================
   INITIALIZE CART
========================= */

function initializeCartPage() {

    if (!window.cartPopupListenerAdded) {
        document.addEventListener('click', closeCartPopup);
        window.cartPopupListenerAdded = true;
    }
}


/* =========================
   QUANTITY CONTROL HTML
========================= */

function getQuantityControl(cart, type) {

    const isPack = type === 'pack';
    const setFunction = isPack ? 'setPackCount' : 'setCount';
    const dataAttribute = isPack ? 'data-pack-id' : 'data-product-id';
    const className = isPack ? 'addPackToCartBtn' : 'addToCartBtns';

    const stock = Number(cart.count);
    const quantity = Number(cart.quantity);

    const isUnavailable = !Number.isFinite(stock) || stock <= 0;
    const isMaxQuantity = quantity >= stock;

    const wrapperClass = `
        w-full lg:w-1/2 h-full flex gap-1 justify-center items-center
        ${className}
    `;

    if (isUnavailable) {
        return `
            <div class="${wrapperClass}" ${dataAttribute}="${cart.id}" style="padding: 0 !important;">
                <span class="text-[10px] font-medium text-[#929B95]">
                    ناموجود
                </span>
            </div>
        `;
    }

    return `
        <div class="${wrapperClass}" ${dataAttribute}="${cart.id}" style="padding: 0 !important;">

            <button type="button"
                onclick="${setFunction}(this)"
                class="w-6 h-6 shrink-0 rounded-md flex justify-center items-center
                text-[#00F477] hover:bg-[#00F477] hover:text-[#06140B]
                transition-all duration-200 text-sm font-bold
                ${isMaxQuantity ? 'cursor-not-allowed opacity-40' : 'cursor-pointer'}"
                ${isMaxQuantity ? 'disabled' : ''}
                data-state="+">
                +
            </button>

            <input type="number"
                class="w-7 h-6 bg-transparent text-[#F4F7F5]
                text-[11px] text-center outline-none in-fa font-bold"
                readonly
                value="${Number.isFinite(quantity) ? quantity : 0}">

            <button type="button"
                onclick="${setFunction}(this)"
                class="w-6 h-6 shrink-0 rounded-md flex justify-center items-center
                text-[#00F477] hover:bg-[#00F477] hover:text-[#06140B]
                transition-all duration-200 text-sm font-bold cursor-pointer"
                data-state="-">
                -
            </button>

        </div>
    `;
}


/* =========================
   UPDATE TOTAL PRICE
========================= */

function updateCartTotal(cart) {

    if (!totalBlock) return;

    const primaryPrice = Number(cart.primary_price) || 0;
    const secondaryPrice = Number(cart.secondary_price) || 0;
    const quantity = Number(cart.quantity) || 0;

    const finalPrice = secondaryPrice || primaryPrice;

    if (secondaryPrice && primaryPrice > secondaryPrice) {

        const discountBlock = totalBlock.querySelector('.discountBlock');
        const discountEl = totalBlock.querySelector('#discountEl');

        if (discountBlock && discountEl) {

            discountBlock.classList.remove('hidden');
            discountBlock.classList.add('flex');

            const currentDiscount =
                Number(discountEl.innerText.replace(/[^\d]/g, '')) || 0;

            discountEl.innerText =
                (currentDiscount + (primaryPrice - secondaryPrice) * quantity) + ' تومان';
        }
    }

    priceSum += finalPrice * quantity;

    const totalPriceEl = totalBlock.querySelector('#totalPriceEl');

    if (totalPriceEl) {
        totalPriceEl.innerText = priceSum;
    }
}


/* =========================
   PRODUCTS
========================= */

if (localProducts.length && cartItemsBlock) {

    localProducts.forEach(cart => {

        const parentDiv = document.createElement('div');

        parentDiv.className =
            'lg:col-span-2 space-y-3 products cartPages parentItem';

        parentDiv.dataset.productId = cart.id;

        const html = `
            <div class="${cartCardStyle}">

                <div class="${cartImageStyle}">
                    <img
                        src="${imgPath + cart.mainImg}"
                        class="w-full h-full object-cover"
                        alt="${cart.title}">
                </div>

                <div class="flex-1 min-w-0">

                    <h3 class="${cartTitleStyle}">
                        ${cart.title}
                    </h3>

                    <p class="${cartSummaryStyle}">
                        ${cart.summary || ''}
                    </p>

                    ${getQuantityControl(cart, 'product')}

                </div>

                ${cart.primary_price || cart.secondary_price
                ? `
                        <div class="text-left shrink-0">
                            <p class="${cartPriceStyle}">
                                ${cart.secondary_price || cart.primary_price}
                            </p>
                            <p class="${cartCurrencyStyle}">تومان</p>
                        </div>
                    `
                : `
                        <div class="text-xs sm:text-sm text-[#929B95] text-center shrink-0">
                            جهت استعلام قیمت تماس بگیرید
                        </div>
                    `
            }

            </div>
        `;

        parentDiv.innerHTML = html;

        cartItemsBlock.append(parentDiv);

        if (cart.primary_price || cart.secondary_price) {
            updateCartTotal(cart);
        }
    });
}


/* =========================
   PACKS
========================= */

if (localPacks.length && cartItemsBlock) {

    localPacks.forEach(cart => {

        const parentDiv = document.createElement('div');

        parentDiv.className =
            'lg:col-span-2 space-y-3 products cartPages';

        parentDiv.dataset.packId = cart.id;

        const html = `
            <div class="${cartCardStyle} parentItem">

                <div class="${cartImageStyle}">
                    <img
                        src="${imgPath + cart.image}"
                        class="w-full h-full object-cover"
                        alt="${cart.title}">
                </div>

                <div class="flex-1 min-w-0">

                    <h3 class="${cartTitleStyle}">
                        ${cart.title}
                    </h3>

                    <p class="${cartSummaryStyle}">
                        ${cart.summary || ''}
                    </p>

                    ${getQuantityControl(cart, 'pack')}

                </div>

                <div class="text-left shrink-0">
                    <p class="${cartPriceStyle}">
                        ${cart.secondary_price || cart.primary_price}
                    </p>
                    <p class="${cartCurrencyStyle}">تومان</p>
                </div>

            </div>
        `;

        parentDiv.innerHTML = html;

        cartItemsBlock.append(parentDiv);

        updateCartTotal(cart);
    });
}


/* =========================
   CART EMPTY STATE OBSERVER
========================= */

initializeCartPage();

updateCartEmptyState();

if (cartItemsBlock) {

    const cartObserver = new MutationObserver(() => {
        updateCartEmptyState();
    });

    cartObserver.observe(cartItemsBlock, {
        childList: true,
        subtree: true
    });
}