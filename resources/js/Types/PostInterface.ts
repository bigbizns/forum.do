interface PostInterface {
    title: string,
    description: string,
    id: number,
    user_id: number,
    avatar: string,
    createdAt: string,
    author: {
        avatar: string,
        email: string
        id: number
        username: string
    }
}

interface PaginationInterface {
    current_page: number,
    last_page: number,
    next_page_url: string | null,
    prev_page_url: string | null,
    per_page: number,
    total: number
}
