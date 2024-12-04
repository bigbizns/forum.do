export interface UserInterface {
    username: string,
    email: string,
    created_at: string,
    description?: string,
    points: number,
    avatar: string,
    email_verified_at: string,
}

export interface UsersPostsInterface {
    id: number,
    user_id: number,
    title: string,
    category_id: number,
    description: string,
    pinned: boolean,
    created_at: string,
}

export interface UserStatsInterface {
    postCount: number,
    commentCount: number,
    likes: number,
}

export interface UserRecentActivityInterface {
    post_id: string,
    action: string,
    subTitle?: string,
    catTitle?: string,
    postTitle?: string,
    postDescription: string,
    created_at: string,
    comment?: string,
}
