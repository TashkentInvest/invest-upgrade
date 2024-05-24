<template>
    <div v-if="cartBox && cart.length > 0" class="Cart_wrapper__OL8uM">
        <div class="HeaderBack_header__6quRP">
            <div class="HeaderBack_back__KxsQV" @click="closeCartBox">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z">
                    </path>
                </svg>
            </div>
            <div class="HeaderBack_title__UTSYP">{{ translate('cart') }}</div>
        </div>
        <div class="Cart_container__Jfoi1">
            <div v-for="item in cart" :key="item.id" class="CartProductItem_container__dbC7f">
                <div class="CartProductItem_info__ntpXu">
                    <div class="CartProductItem_image__VD+4D" style="height: 80px; position: relative; width: 80px;">
                        <img :src="`${PHOTO_URL}${item.photo}`" :alt="item.name_ru"
                            style="height: 100%; object-fit: contain; width: 100%;">
                    </div>
                    <div class="CartProductItem_details__ODvXk">
                        <h3 class="CartProductItem_title__YMA2B">
                            {{ item[`name_${lang}`] }} {{ item.is_pizza == 1 ? translatedPizzaSize(item) : '' }}
                        </h3>
                    </div>
                </div>
                <div class="CartProductItem_counter__nTy1R">
                    <div class="ProductCounter_wrapper__ogJTR">
                        <div class="ProductCounter_decrementBlock__cYVoy" @click="decrementItem(item)">
                            <span></span>
                        </div>
                        <span class="ProductCounter_amount__m2YBA">{{ item.sell_type === 'kg' ? item.count * 50 +
                            `${translate('type_1')}` : item.count}}</span>
                        <div class="ProductCounter_incrementBlock__Hg0+X" @click="incrementItem(item)">
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div class="CartProductItem_prices__DBHME">
                        <div></div>
                        <div class="CartProductItem_price__Ccgzl">{{ getCalculatePrice(item) }} {{ translate('summ') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="Cart_bottomInfo__1m0M6">
            <div class="Cart_totalInfo__fCshr">
                <div class="Cart_item__kV+fU">
                    <div class="Cart_title__KcKou">{{ translate('delivery') }}</div>
                    <div class="Cart_value__6kKVX">-</div>
                </div>
                <div class="Cart_item__kV+fU Cart_totalPrice__DXiMy">
                    <div class="Cart_title__KcKou">{{ translate('total_price') }}</div>
                    <div class="Cart_value__6kKVX">{{ currentTotalPrice }} {{ translate('summ') }}</div>
                </div>
            </div>
        </div>
        <div class="Cart_actions__gZcHT">
            <button @click="onSendData" class="Button_button__Zk130 Button_primary__v3pFA">
                <div class="btn-loader" v-if="loadingBtn">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
                <div class="Cart_button__r+aGG" v-else>
                    <div class="Cart_left__OoueI">{{ translate("make_order") }}</div>
                    <div class="Cart_right__QMSgz">{{ currentTotalPrice }} {{ translate('summ') }}</div>
                </div>
            </button>
        </div>
    </div>
    <div v-else-if="cartBox && cart.length === 0" class="EmptyPage_container__ie7U8">
        <div class="EmptyPage_header__dr-2F">
            <div @click="closeCartBox" class="EmptyPage_back__lMKfY">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em"
                    width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z">
                    </path>
                </svg>
            </div>
            <div class="EmptyPage_title__0I3rQ">{{ translate('cart') }}</div>
        </div>
        <img src="https://intermenu.bellissimo.uz/static/media/empty-cart.d0b60c2da0f4ea5c6e8614d769021c8e.svg"
            alt="Hozircha sizning savatchangiz boʻsh 😕">
        <div class="EmptyPage_text__QW4iK">{{ translate('cart_empty_message') }}</div>
    </div>
</template>


<script>
import { useI18n } from 'vue-i18n';
import { useTelegram } from '../helpers/useTelegram';
import { formattedPrice } from '../helpers/formattedPrice';
import { base_url } from '../config';
import { useToast } from "vue-toastification";
export default {
    props: {
        cartBox: {
            type: Boolean,
        },
        cart: {
            type: Array,
            required: true
        },
        PHOTO_URL: {
            type: String
        },
        lang: {
            type: String
        },
        totalPrice: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            currentTotalPrice: 0,
            loadingBtn: false,
        }
    },
    mounted() {
        // Set the initial value of currentTotalPrice based on the prop
        this.currentTotalPrice = formattedPrice(this.totalPrice);
        this.calculateTotalPrice();
    },
    setup() {
        const toast = useToast();
        const { t: translate } = useI18n();
        const { tg,
            onclose,
            user: username,
            queryId } = useTelegram();

        const options = {
            position: "top-right",
            timeout: 2000,
            closeOnClick: true,
            pauseOnFocusLoss: true,
            pauseOnHover: true,
            draggable: true,
            draggablePercent: 0.6,
            showCloseButtonOnHover: false,
            hideProgressBar: true,
            closeButton: false,
            icon: true,
            rtl: false,
        }
        const handleClose = () => {
            onclose();
        };

        return {
            toast,
            options,
            handleClose,
            translate,
            tg,
            username,
            queryId,
        };
    },
    methods: {
        getPrice(item) {
            let price = item.price;
            if (item.sell_type === 'dona') {
                // If sell_type is 'dona', no division
                return formattedPrice(price);
            } else {
                // If sell_type is not 'dona', divide by 2
                return formattedPrice(price / 2);
            }
        },
        showToast() {
            this.toast.error(`${this.$t('error_message')}`, this.options);
        },
        onSendData() {
            const requestData = {
                userId: this.username,
                products: this.cart,
                totalPrice: this.totalPrice
            };
            this.loadingBtn = true;
            this.axios.post(`${base_url}/api/cart`, requestData, {
                headers: {
                    'Content-Type': 'application/json',
                }
            })
                .then(response => {
                    this.loadingBtn = false;
                    if (response.status === 200) {
                        this.handleClose();
                    }
                    // Handle success response here
                })
                .catch(error => {
                    console.error(error);
                    this.showToast();
                    this.loadingBtn = false;
                    setTimeout(() => {
                        this.handleClose();
                    }, 1500);
                    // Handle error here, e.g., display an error message to the user
                });
        },
        incrementItem(item) {
            item.count += 1;
            this.calculateTotalPrice();
        },
        decrementItem(item) {
            if (item.count > 1) {
                item.count -= 1;
                this.calculateTotalPrice();
            } else {
                // Remove item from cart_items array
                const index = this.cart.findIndex((cartItem) => cartItem.id === item.id);
                if (index > -1) {
                    this.cart.splice(index, 1);
                    this.calculateTotalPrice();
                }
            }
        },
        closeCartBox() {
            this.$emit("close-cart-box", false);
        },
        translatedPizzaSize(item) {
            const { translate } = this;
            const pizzaSize = item.pizza_size;

            switch (pizzaSize) {
                case 'small':
                    return translate('pizze_size.small').toLowerCase();
                case 'medium':
                    return translate('pizze_size.medium').toLowerCase();
                case 'big':
                    return translate('pizze_size.large').toLowerCase();
                default:
                    return '';
            }
        },
        translatedPizzaDoughSize(item) {
            const { translate } = this;
            const pizzaSize = item.pizza_dough_size;

            switch (pizzaSize) {
                case 'thin':
                    return translate('pizza_dough_size.thin');
                case 'thick':
                    return translate('pizza_dough_size.thick');
                default:
                    return '';
            }
        },
        // formattedPrice(price) {
        //     return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
        // },
        getCalculatePrice(item) {
            // Assuming 'item' contains properties like 'quantity', 'price', and 'sell_type'
            const { count, price, sell_type } = item;
            // Perform the calculation
            const calculatedPrice = (count * price) / (sell_type === 'kg' ? 2 : 1);
            return formattedPrice(calculatedPrice);
        },
        getPizzaPrice(item) {
            let price = 0;
            if (item.is_pizza == 1) {
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
                return formattedPrice(price * item.count);
            }
            else {
                price = item.price_medium;
                return formattedPrice(price * item.count);
            }
        },
        calculateTotalPrice() {
            let totalPrice = 0;
            for (const item of this.cart) {
                const { count, price, sell_type } = item;
                // let price = item.price;
                totalPrice += count * (sell_type === 'kg' ? price / 2 : price);
            }
            this.currentTotalPrice = formattedPrice(totalPrice); // Update the data property
            this.$emit('update-cart', this.cart, totalPrice);
        },
        emitUpdatedCart() {
            this.$emit('update-cart', this.cart, this.currentTotalPrice);
        },
    },
    computed: {

    },
}
</script>

<style></style>