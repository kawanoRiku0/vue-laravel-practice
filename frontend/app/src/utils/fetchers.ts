export const remoteFetch = async (
    url: string,
    method: "POST" | "PUT" | "DELETE",
    body?: unknown
) => {
    const response = await fetch(url, {
        method: method,
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(body),
    });

    return await response.json();
};
