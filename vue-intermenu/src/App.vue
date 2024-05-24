<template>
    <div v-if="loading" class="lodar_box">
        <div class="loader"></div>
    </div>

    <div v-else>
        <div v-if="errorMessage" class="error_box">
            <p>{{ translate('error_message') }}</p>
            <button @click="refreshPage" class="error_box_btn">{{ translate('error_message_btn') }}</button>
        </div>
        
        <CartProd v-else-if="cartBox" 
        :cartBox="cartBox" 
        :PHOTO_URL="PHOTO_URL"
        :lang="lang"
        :totalPrice="totalPrice"
        v-model:cart="cart_items" 
        @close-cart-box="handleCartChange"
        @update-cart="handleCartUpdate"/>

        <InterMenu v-else 
        :categories="categories"
        :topProducts="topProducts"
        :products="products"
        :selectedCategory="selectedCategory" 
        :PHOTO_URL="PHOTO_URL"
        :cart_items_count="cart_items_count"
        :cart_items="cart_items"
        :lang="lang"
        @category-change="handleCategoryChange"
        @open-cart-box="handleCartChange"
        @redirect-home="handleRedirectHome"
        @update-cart="handleCartProds"/>
        <!-- <p>
            {{ decodedData  }}
        </p>
        <button @click="handleClose">Close Web App {{ username }}</button> -->
    </div>
</template>

<script>
import InterMenu from './components/InterMenu.vue'
import CartProd from './components/CartProduct.vue'
import { useI18n } from 'vue-i18n';
import { useTelegram   } from './helpers/useTelegram';
import { base_url } from './config';
import { useToast } from "vue-toastification";
export default{
    components: {
        InterMenu,
        CartProd
    },
    data() {
        return {
            loading: false,
            cartBox: false,
            cart_items_count: 0,
            cart_items: [],
            categories: [],
            topProducts: [],
            allProducts: [],
            searchingProducts: [],
            products: [],
            selectedCategory: 0,
            PHOTO_URL: 'https://xolodilnikgo.texnobot.uz/public/images/',
            lang: "",
            totalPrice: 0,
            errorMessage: "",
            decodedData: null,
        }
    },
    setup() {
        // Get toast interface
        const toast = useToast();
        const { t: translate } = useI18n();
        const { onclose, user: username } = useTelegram();

        const handleClose = () => {
            onclose();
        };
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
        return { 
            toast,
            options,
            translate,
            handleClose,
            username,
        };
    },
    mounted() {
        this.getDataFromURL();
    },
    methods: {
        showToast() {
            this.toast.error(`${this.$t('error_message')}`, this.options);
        },
        getAllData(){
            this.loading = true;
            this.axios.get(`${base_url}/api/categorywithproducts`, {
                headers: {
                        'Content-Type': 'application/json'
                    }
            })
            .then(response => {
                this.loading = false;
                this.categories = response.data.result;
                this.topProducts = response.data.top_products;
                this.searchingProducts = response.data.all_products;
            })
            .catch(error => {
                console.error(error);
                this.loading = false;
                // Handle the error
                this.errorMessage = 'An error occurred while fetching data. Please try again.';
            });
        },
        getCategoryProducts(id){
            this.loading = true;
            this.axios.get(`${base_url}/api/${id}/products`, {
                headers: {
                        'Content-Type': 'application/json'
                    }
            })
            .then(response => {
                this.loading = false;
                this.products = response.data.result;
                this.topProducts = response.data.top_products;
            })
            .catch(error => {
                console.error(error);
                this.loading = false;
                // Handle the error
                this.errorMessage = 'An error occurred while fetching data. Please try again.';
            });
        },
        handleCategoryChange(item) {
            if(item.all_children.length) 
            {
                this.allProducts = [];
                this.getAllProducts(item.all_children)
                const categoryObject = {
                    id: 99999,
                    emoji: "🔷",
                    name_uz: "Top mahsulot",
                    name_ru: "ТОП продукты",
                    products_count: this.allProducts.length,
                    all_children: [],
                    products: this.allProducts,
                };

                this.selectedCategory = 99999;
                this.products = this.allProducts;
                this.categories = [categoryObject, ...item.all_children];
            }
            else 
            {
                if(item.products.length > 0){
                    // this.products = item.products;
                    this.getCategoryProducts(item.id);
                }else{
                    this.getCategoryProducts(item.id);
                    // this.showToast();
                }
                this.selectedCategory = item.id;
            }
            //this.categories = 
            
        },
        handleCartChange(value){
            this.cartBox = value;
        },
        handleRedirectHome(value){
            if(value === true){
                this.getAllData();
                this.products = [];
                this.selectedCategory = 0;
            }
        },
        handleCartProds(cartItems, price) {
            this.cart_items = cartItems; // Update the cart_items array with the new cartItems value
            this.cart_items_count = this.calculateCartItemsCount(); // Update cart_items_count
            this.totalPrice = price;
        },
        calculateCartItemsCount() {
            let count = 0;
            for (const item of this.cart_items) {
                count += item.count;
            }
            return count;
        },
        handleCartUpdate(updatedCartItems, totalPrice) {
            this.cart_items = updatedCartItems;
            this.cart_items_count = this.calculateCartItemsCount();
            this.totalPrice = totalPrice;
        },
        refreshPage() {
            window.location.reload();
        },
        getDataFromURL() {
            const urlParams = new URLSearchParams(window.location.search);
            const encodedData = urlParams.get('data');
            if (encodedData) {
                const decodedData = JSON.parse(atob(encodedData));
                this.decodedData = decodedData;
            }
        },
        getAllProducts(categories) {
            for (const category of categories) 
            {
                // Add products of the current category
                this.allProducts = [...this.allProducts, ...category.products];

                // Recursively add products of subcategories
                if (category.all_children && category.all_children.length > 0) 
                {
                    this.getAllProducts(category.all_children);
                }
            }
        },
    },
    created() {
        this.getAllData();
        this.lang = this.$i18n.locale;
    },
    
}

</script>

<style scoped>
.error_box{
    width: 100%;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.error_box_btn{
    padding: 11px 20px;
    background-color: var(--warning-color);
    background-image: var(--warning-gradient);
    border: 0;
    border-radius: 10px;
    color: var(--tg-theme-button-text-color);
    font-size: var(--font-size-sm);
    font-weight: 700;
}
</style>
