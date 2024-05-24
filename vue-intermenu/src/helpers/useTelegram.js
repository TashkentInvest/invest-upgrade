const tg = window.Telegram.WebApp;
export function useTelegram(){

    const onclose = () => {
        tg.close();
    };

    return {
        onclose,
        tg,
        user: tg.initDataUnsafe?.user?.id,
        lang: tg.initDataUnsafe?.user?.language_code,
        queryId: tg.initDataUnsafe?.query_id,
    }
}