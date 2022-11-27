import { Ref, ref, unref, watchEffect } from "vue";

export const useFetch = <T>(
    url: string | Ref<string>,
    options?: RequestInit
) => {
    const unrefUrl = unref(url);
    const data = ref<T | null>(null);
    const loading = ref(true);
    const error = ref<unknown | null>(null);

    const fetchData = async () => {
        loading.value = true;
        error.value = null;
        try {
            const res = await fetch(unrefUrl, options);
            data.value = await res.json();
        } catch (e) {
            error.value = e;
        } finally {
            loading.value = false;
        }
    };

    watchEffect(() => {
        fetchData();
    });

    return {
        data,
        loading,
        error,
    };
};
