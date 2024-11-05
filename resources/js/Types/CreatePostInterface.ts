export interface CreatePostInterface {
    title: string | null;
    category: Category | null;
    subCategory: null,
    tradeAction: string | null;
    description: string | null;
    pinned: boolean;
}

interface Category {
    id: string,
    title: string,
    marketplace: number,
}
