import { createI18n } from 'vue-i18n';
import ru from '../locales/ru.json';
import uz from '../locales/uz.json';

const urlParams = new URLSearchParams(window.location.search);
const encodedData = urlParams.get('data');
let lang = 'uz'; // Default lang

if (encodedData) {
    const decodedData = JSON.parse(atob(encodedData));
    lang = decodedData.lang || lang;
}

const i18n = createI18n({
    locale: lang, // Default locale
    fallbackLocale: 'uz',
    legacy: false,
    globalInjection: true,
    messages: {
        uz,
        ru
    }
});

export default i18n;
