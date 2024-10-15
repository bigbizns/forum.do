export interface CreatePostInterface {
    title: string | null;
    category: Category | null;
    tradeAction: string | null;
    description: string | null;
    pinned: boolean;
}

interface Category {
    id: number,
    title: string,
    marketplace: number,
}
