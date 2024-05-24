<template>
    <div class="MenuList_container__HkELY">
        <div class="category_box rounded-3 bg-telegram-white p-2">
            <div class="header-title d-flex justify-content-between mb-3">
                <h2 class="title mb-0">{{ $t('category') }}</h2>
            </div>
            <div class="HeaderMenu_list__nbnkb">
                <div v-for="item in categories" :key="item.id"
                    :class="['HeaderMenu_card__4rcMP', { 'HeaderMenu_active__akwUT': selectedCategory == item.id }]"
                    @click="$emit('category-change', item)">
                    <span class="HeaderMenu_icon__fXXMd">{{ cleanCategoryEmoji(item['emoji'] + item[`name_${lang}`])
                        }}</span>
                    <div class="HeaderMenu_title__fBI15">{{ cleanCategoryName(item[`name_${lang}`]) }}</div>
                </div>
            </div>
        </div>
        <div class="HeaderMenu_extra__O5335 category_box my-3 rounded-3 p-2">
            <div @click="redirectHome" class="HeaderMenu_promotions__F4eld">
                <span class="HeaderMenu_icon__fXXMd">🏠</span>
                <div>
                    <div class="HeaderMenu_title__fBI15">{{ $t('main') }}</div>
                    <div class="HeaderMenu_count__tL4pU">{{ $t('home') }}</div>
                </div>
            </div>
            <div @click="openCartBox" class="HeaderMenu_cart__v6cuB"
                :style="cart_items_count > 0 ? 'background-position: 72.2222% 50%' : 'background-position: 0% 50%;'"
                id="total_cart">
                <div>
                    <div class="HeaderMenu_title__fBI15">{{ $t('cart') }}</div>
                    <div class="HeaderMenu_count__tL4pU">{{ cart_items_count }} {{ $t('things') }}</div>
                </div>
                <div class="HeaderMenu_icon__fXXMd">🛒</div>
            </div>
        </div>
        <!-- search div -->
        <div v-if="searchBox" class="HeaderMenu_extra__O5335 category_box my-3 rounded-3 p-2">
            <div class="flex items-center bg-gray-100 p-2 w-80 space-x-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-30 search-icon" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input class="bg-gray-100 outline-none" type="text" placeholder="Article name or keyword..." />
            </div>
            <div
                class="bg-gray-800 p-2 flex items-center justify-center text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                <svg width="20" height="20" class="text-grey-dark" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
                </svg>
            </div>
        </div>
        <!-- search div -->
        <div v-if="products.length > 0" class="MenuList_content__wGqq6 undefined" id="results">
            <div class="PizzaList_container__vwoNH">
                <div v-for="item in products" :key="item.id" class="PizzaCard_card__5+6jg"
                    @click="openBottomSheet(item)">
                    <div class="ProductCard_image__LO1wQ w-full h-[150px] overflow-hidden relative rounded-xl">
                        <img :src="`${PHOTO_URL}${item.photo}`" :alt="item.name_ru"
                            style="position: absolute;height: 100%;width: 100%;inset: 0px;color: transparent;"
                            class="object-cover object-center">
                        <div v-if="itemCount(item) > 0"
                            class="ProductCard_count__9KBYQ animate__animated animate__bounceIn">{{ itemCount(item) }}
                        </div>
                    </div>
                    <div class="PizzaCard_details__6oqyj">
                        <!-- <div class="PizzaCard_title__R5LAm">
                            categoryID:{{ this.selectedCategory }}
                        </div> -->
                        <div class="PizzaCard_title__R5LAm">
                            {{ item[`name_${lang}`] }}
                        </div>
                        <div class="PizzaCard_desc__PCSEo">
                            {{ item[`description_${lang}`] }}
                        </div>
                        <div class="PizzaCard_priceAndButton__4ZXx3">
                            <div class="PizzaCard_price__4fvUe">
                                <span v-if="item.sell_type === 'kg'">{{ $t('price_type_kg') }}</span>
                                <span v-else>{{ $t('price_type_dn') }}</span>
                                <span>{{ getPrice(item) }}</span>{{ $t('summ') }}
                            </div>
                            <button @click="openBottomSheet(item)" class="PizzaCard_action__jJtZf"
                                style="opacity: 1;">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="category_box rounded-3 p-2">
            <div class="header-title d-flex justify-content-between mb-3">
                <h2 class="title mb-0">{{ $t('top_products') }}</h2>
            </div>
            <div class="PizzaList_container__vwoNH">
                <div v-for="item in topProducts" :key="item.id" class="PizzaCard_card__5+6jg"
                    @click="openBottomSheet(item)">
                    <div class="ProductCard_image__LO1wQ w-full h-[150px] overflow-hidden relative rounded-xl">
                        <img :src="`${PHOTO_URL}${item.photo}`" :alt="item.name_ru"
                            style="position: absolute;height: 100%;width: 100%;inset: 0px;color: transparent;"
                            class="object-cover object-center">
                        <div v-if="itemCount(item) > 0"
                            class="ProductCard_count__9KBYQ animate__animated animate__bounceIn">{{ itemCount(item) }}
                        </div>
                    </div>
                    <div class="PizzaCard_details__6oqyj">
                        <div class="PizzaCard_title__R5LAm">
                            {{ item[`name_${lang}`] }}
                        </div>
                        <div class="PizzaCard_desc__PCSEo">
                            {{ item[`description_${lang}`] }}
                        </div>
                        <div class="PizzaCard_priceAndButton__4ZXx3">
                            <div class="PizzaCard_price__4fvUe">
                                <span v-if="item.sell_type === 'kg'">{{ $t('price_type_kg') }}</span>
                                <span v-else>{{ $t('price_type_dn') }}</span>
                                <span>{{ getPrice(item) }}</span>{{ $t('summ') }}
                            </div>
                            <button @click="openBottomSheet(item)" class="PizzaCard_action__jJtZf"
                                style="opacity: 1;">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bottom sheet -->
        <Sheet v-model:visible="visible" :onlyHeaderSwipe="true" :noHeader="true">
            <div class="ProductMore_content__ry8ph">
                <div class="ProductMore_imageContainer__Uza8Q position-relative">
                    <button @click="visible = !visible" type="button" class="route-back">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <a href="#!" class="zoom_image" :data-src="`${PHOTO_URL}${currentItem.photo}`"
                        data-fancybox="gallery">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </a>
                    <img :src="`${PHOTO_URL}${currentItem.photo}`" :alt="currentItem.name_ru"
                        class="ProductMore_image__bDcaO h-100">
                </div>
                <div class="ProductMore_details__J-4cf">
                    <h2 class="ProductMore_title__3eQAL">{{ currentItem[`name_${lang}`] }}</h2>
                    <p class="ProductMore_description__hEAar">{{ currentItem[`description_${lang}`] }}</p>
                </div>
            </div>
            <div class="ProductMore_actions__T+O3B">
                <div class="d-flex flex-column mb-3">
                    <div class="ProductMore_price__SjH-B">
                        <span v-if="currentItem.sell_type === 'kg'">{{ $t('price_type_kg') }}</span>
                        <span v-else>{{ $t('price_type_dn') }}</span>
                        {{ getPrice(currentItem) }} {{ $t('summ') }}
                    </div>
                    <div class="in_stock_product">
                        <span v-if="currentItem.in_stock === 0" class="text-red-600">
                            <i class="fa-solid fa-cart-shopping"></i>
                            {{ $t('in_stock') }}
                        </span>
                    </div>
                </div>
                <div class="ProductMore_priceAndAction__3KEjV">
                    <button class="ProductMore_action__n1eDf" @click="addToCart(currentItem)"
                        :disabled="currentItem.in_stock === 0">{{ $t('add_cart') }}</button>
                </div>
            </div>
        </Sheet>

        <!-- Scroll to top -->
        <transition name="fade">
            <div id="pagetop" class="fixed right-3 bottom-3" v-show="scY > 300" @click="toTop"
                style="background: linear-gradient(160deg, #1ad86b, #10b260); border-radius: 50%;">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                    stroke="#fff" stroke-width="1" stroke-linecap="square" stroke-linejoin="arcs">
                    <path d="M18 15l-6-6-6 6" />
                </svg>
            </div>
        </transition>
    </div>
</template>

<script>
import { Sheet } from 'bottom-sheet-vue3'
import { useToast } from "vue-toastification";
import { useI18n } from 'vue-i18n';
import CustomToast from "./CustomToast.vue";
export default {
    props: {
        categories: {
            type: Array,
            required: true,
        },
        topProducts: {
            type: Array,
            required: true,
        },
        products: {
            type: Array,
        },
        selectedCategory: {
            type: Number,
        },
        PHOTO_URL: {
            type: String
        },
        cart_items_count: {
            type: Number,
        },
        cart_items: {
            type: Array,
        },
        lang: {
            type: String
        }
    },
    components: {
        Sheet,
        CustomToast
    },
    data() {
        return {
            filteredProducts: [],
            totalProduct: 0,
            visible: false,
            searchBox: false,
            currentItem: null,
            pizza_size: 'small',
            pizza_dough_size: 'thick',
            totalPrice: 0,
            isInitialized: false,
            scTimer: 0,
            scY: 0,
        }
    },
    setup() {
        // Get toast interface
        const toast = useToast();
        const options = {
            position: "top-center",
            timeout: 2000,
            closeOnClick: true,
            pauseOnFocusLoss: true,
            pauseOnHover: true,
            draggable: true,
            draggablePercent: 0.6,
            showCloseButtonOnHover: false,
            hideProgressBar: true,
            closeButton: false,
            icon: false,
            rtl: false,
        }
        const { t } = useI18n();
        return { toast, options, $t: t }
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
    },
    methods: {
        setSelectedCategory(item) {
            this.$emit('category-change', item);
            // this.filterAllProducts(categoryId);
        },
        openCartBox() {
            this.$emit("open-cart-box", true);
        },
        redirectHome() {
            this.$emit("redirect-home", true);
        },
        filterAllProducts(categoryId) {
            if (categoryId === 0) {
                // If the selected category is 0, show all products
                this.filteredProducts = this.categories.flatMap((category) => category.products);
            } else {
                // Filter products based on the selected category ID
                const selectedCategory = this.categories.find((category) => category.id === categoryId);
                this.filteredProducts = selectedCategory ? selectedCategory.products : [];
            }
        },
        getClassForProduct() {
            return this.filteredProducts.some(product => product.is_pizza == 1) ?
                'PizzaList_container__vwoNH' :
                'ProductList_container__G4b8C';
        },
        openBottomSheet(item) {
            this.currentItem = item;
            this.pizza_size = 'small';
            this.pizza_dough_size = 'thick';
            this.visible = true;
        },
        getPizzaPrice(item) {
            switch (this.pizza_size) {
                case 'small':
                    return this.formattedPrice(item.price_small);
                case 'medium':
                    return this.formattedPrice(item.price_medium);
                case 'big':
                    return this.formattedPrice(item.price_big);
                default:
                    return this.formattedPrice(item.price_medium);
            }
        },
        showToast(item) {
            this.toast({
                component: CustomToast,
                props: {
                    name: item[`name_${this.lang}`],
                    description: this.$t('added_cart'),
                },
            }, this.options);
        },
        translatedPizzaSize(size) {
            const { $t } = this;
            const pizzaSize = size;
            switch (pizzaSize) {
                case 'small':
                    return $t('pizze_size.small').toLowerCase();
                case 'medium':
                    return $t('pizze_size.medium').toLowerCase();
                case 'big':
                    return $t('pizze_size.large').toLowerCase();
                default:
                    return '';
            }
        },
        calculateTotalPrice() {
            let totalPrice = 0;
            for (const item of this.cart_items) {
                let price = 0;
                if (item.is_pizza === 1) {
                    switch (item.pizza_size) {
                        case 'small':
                            price = item.price_small;
                            break;
                        case 'medium':
                            price = item.price_medium;
                            break;
                        case 'big':
                            price = item.price_big;
                            break;
                        default:
                            price = item.price_medium;
                    }
                } else {
                    price = item.price_medium;
                }
                totalPrice += price * item.count;
            }
            this.totalPrice = totalPrice;
        },
        incrementItem(item) {
            item.count += 1;
            this.calculateTotalPrice();
            this.$emit("update-cart", this.cart_items, this.totalPrice);
        },
        decrementItem(item) {
            const index = this.cart_items.findIndex((cartItem) => cartItem.id === item.id);
            if (index > -1) {
                if (this.cart_items[index].count > 1) {
                    this.cart_items[index].count -= 1;
                } else {
                    this.cart_items.splice(index, 1);
                }
            }
            this.calculateTotalPrice();
            this.$emit("update-cart", this.cart_items, this.totalPrice);
        },
        addToCart(item) {
            const totalCart = document.getElementById("total_cart");
            // Find the existing item with the same ID and pizza_size
            const existingItem = this.cart_items.find((cartItem) => cartItem.id === item.id && cartItem.pizza_size === this.pizza_size && cartItem.pizza_dough_size === this.pizza_dough_size);

            if (existingItem) {
                existingItem.count += 1; // Increment the count
            } else {
                // Add the item to the cart with a count of 1 and the current pizza_size
                this.cart_items.push({ ...item, count: 1, pizza_size: this.pizza_size, pizza_dough_size: this.pizza_dough_size });
            }
            this.showToast(item, this.pizza_size);
            this.calculateTotalPrice();
            this.$emit("update-cart", this.cart_items, this.totalPrice);
            totalCart.style.backgroundPosition = "72.2222% 50%";
            // Display a success message or perform any other actions
            this.visible = false;
            //console.log("Item added to cart:", item);
        },
        getPrice(item) {
            let price = item.price;
            if (item.sell_type === 'dona') {
                // If sell_type is 'dona', no division
                return this.formattedPrice(price);
            } else {
                // If sell_type is not 'dona', divide by 2
                return this.formattedPrice(price / 2);
            }
        },
        formattedPrice(price) {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
        },
        calculateCartItemsCount() {
            let count = 0;
            for (const item of this.cart_items) {
                count += item.count;
            }
            return count;
        },
        itemCount(product) {
            const cartItem = this.cart_items.find((item) => item.id === product.id);
            if (cartItem) {
                return cartItem.count;
                // return cartItem.sell_type === 'kg'
                // ? cartItem.count * 50 + 'kg' : cartItem.count;
            }
            return 0;
        },
        filteredProductsss() {
            if (this.selectedCategory) {
                return this.filteredProducts.filter((product) => product.category_id === this.selectedCategory);
            }
            return this.filteredProducts;
        },
        handleScroll: function () {
            if (this.scTimer) return;
            this.scTimer = setTimeout(() => {
                this.scY = window.scrollY;
                clearTimeout(this.scTimer);
                this.scTimer = 0;
            }, 100);
        },
        toTop: function () {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        },
    },
    computed: {
        cleanCategoryEmoji() {
            return function (name) {
                const regex = /[\p{Emoji_Presentation}\p{Emoji}\u{FE0F}]/gu;
                const emojis = name.match(regex);
                return emojis ? emojis.join('') : '🔹';
            };
        },
        cleanCategoryName() {
            return function (name) {
                console.log(name);
                // return name.replace(/[^A-Za-zА-Яа-яЁё]/g, "");
                return name.replace(/[^A-Za-zА-Яа-яЁё\s]/g, "");
            };
        },
    },
    created() {
        this.filterAllProducts(this.selectedCategory);
    },
}
</script>

<style>
.ProductMore_content__ry8ph .ProductMore_imageContainer__Uza8Q .zoom_image {
    position: absolute;
    width: 30px;
    height: 30px;
    background: #0000009c;
    bottom: 1rem;
    right: 1rem;
    display: flex;
    color: #fff;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    font-size: 14px;
}

.ProductMore_content__ry8ph .ProductMore_imageContainer__Uza8Q .route-back {
    background: var(--back-btn);
    position: absolute;
    width: 40px;
    height: 40px;
    border: none;
    top: 1rem;
    right: 1rem;
    display: flex;
    color: #fff;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    font-size: 27px;
}

.bottom-sheet-header-bar {
    background: #e3e3e3 !important;
    border-radius: 10px !important;
    height: 5px !important;
    width: 70px !important;
}

.bottom-sheet {
    border-radius: 28px 28px 0 0 !important;
    max-height: 100vh !important;
    height: 100%;
    max-width: 500px !important;
    background: var(--tg-theme-bg-color) !important;
    display: block !important;
    overflow: hidden !important;
}

.bottom-sheet-backdrop[data-sheet-active] {
    backdrop-filter: blur(2px) !important;
    background: rgba(0, 0, 0, .1) !important;
    z-index: 1000;
}

.bottom-sheet-body {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.Vue-Toastification__toast {
    padding: .75rem 1rem;
    border-radius: var(--border-radius);
    box-shadow: 5px 2px 30px rgb(0 0 0 / 11%);
    max-width: 100%;
    min-width: 100%;
    align-items: center;
}

.Vue-Toastification__toast--default {
    background-color: var(--tg-theme-bg-color);
    color: var(--tg-theme-text-color);
}

.Vue-Toastification__toast-component-body div {
    display: flex;
    align-items: center;
}

@media only screen and (min-width: 600px) {

    .Vue-Toastification__container.top-center,
    .Vue-Toastification__container.bottom-center {
        left: 0;
        right: 0;
        width: 100%;
        margin-left: 0;
    }
}
</style>