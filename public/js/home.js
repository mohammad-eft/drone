
/* =========================================================
   DIAR ABZAR — HOME CART
========================================================= */

let addToCartBtns = document.querySelectorAll('.addToCartBtns');

localProducts = [];
localPacks = [];

orderBasket = document.getElementById('orderBasket');

let totalCartQuantity = 0;

/* =========================================================
   LOCAL STORAGE
========================================================= */

function getCartStorage(key) {
    try {
        const data = JSON.parse(localStorage.getItem(key));
        return Array.isArray(data) ? data : [];
    } catch (error) {
        return [];
    }
}

function refreshCartStorage() {
    localProducts = getCartStorage('products');
    localPacks = getCartStorage('packs');

    totalCartQuantity = 0;

    localProducts.forEach(item => {
        totalCartQuantity += Number(item.quantity) || 0;
    });

    localPacks.forEach(item => {
        totalCartQuantity += Number(item.quantity) || 0;
    });

    updateCartBadge();
}

/* =========================================================
   CART COLORS
========================================================= */

const cfColors = {
    bg: '#090C0A',
    surface: '#191D1B',
    surfaceDark: '#101412',
    surfaceHover: '#202522',
    green: '#00F477',
    greenHover: '#39FF98',
    text: '#F4F7F5',
    muted: '#929B95',
    border: '#2A302C',
    darkText: '#06140B'
};

/* =========================================================
   QUANTITY CONTROL
========================================================= */

function getCartQuantityHTML(cart, type) {

    const isPack = type === 'pack';

    const setFunction = isPack ? 'setPackCount' : 'setCount';

    const quantity = Number(cart.quantity) || 1;
    const maxCount = Number(cart.count) || 0;

    const isMaxQuantity = quantity >= maxCount;

    return `
        <div class="w-full p-1.5 h-full flex gap-2 justify-center items-center
                    rounded-xl bg-[#101412] border border-[#2A302C]
                    transition-all duration-300">

            <button
                type="button"
                onclick="${setFunction}(this)"
                class="w-1/3 h-9 rounded-lg flex justify-center items-center
                       text-[#00F477] hover:bg-[#00F477] hover:text-[#06140B]
                       transition-all duration-200 text-lg font-bold
                       ${isMaxQuantity ? 'opacity-40 cursor-not-allowed' : 'cursor-pointer'}"
                ${isMaxQuantity ? 'disabled' : ''}
                data-state="+">
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
                onclick="${setFunction}(this)"
                class="w-1/3 h-9 rounded-lg flex justify-center items-center
                       text-[#00F477] hover:bg-[#00F477] hover:text-[#06140B]
                       transition-all duration-200 text-lg font-bold cursor-pointer"
                data-state="-">
                -
            </button>

        </div>
    `;
}

/* =========================================================
   ADD BUTTON
========================================================= */

function getAddButtonHTML(type, count) {

    const isPack = type === 'pack';
    const functionName = isPack ? 'addPackToCart' : 'addToCart';

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
        <button
            type="button"
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
   INITIALIZE PRODUCT BUTTONS
========================================================= */

function initializeCartButtons() {

    document.querySelectorAll('.addToCartBtns').forEach(container => {

        const productId = container.dataset.productId;
        const packId = container.dataset.packId;

        if (productId) {

            const product = localProducts.find(item =>
                String(item.id) === String(productId)
            );

            if (product) {
                container.innerHTML = getCartQuantityHTML(product, 'product');
            }
        }

        if (packId) {

            const pack = localPacks.find(item =>
                String(item.id) === String(packId)
            );

            if (pack) {
                container.innerHTML = getCartQuantityHTML(pack, 'pack');
            }
        }
    });
}

/* =========================================================
   CART BADGE
========================================================= */

function updateCartBadge() {

    if (!orderBasket || !orderBasket.children[1]) return;

    orderBasket.children[1].innerText = totalCartQuantity;

    orderBasket.children[1].classList.add(
        'bg-[#00F477]',
        'text-[#06140B]',
        'font-extrabold'
    );

    const hasItems = totalCartQuantity > 0;

    const cartLink = document.getElementById('cartLink');

    if (cartLink) {
        cartLink.classList.toggle('hidden', !hasItems);
    }
}

/* =========================================================
   INITIALIZATION
========================================================= */

refreshCartStorage();

initializeCartButtons();