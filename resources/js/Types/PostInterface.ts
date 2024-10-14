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
