export interface AdminDashUsersInterface {
    id: number,
    username: string,
    avatar: string | object,
    email: string,
    points: number,
    created_at: string,
}

export interface EditRequestInterface {
    user_id: number,
    post_id: number,
    action: string,
    title: string,
    originalTitle: string,
    description: string,
    originalDescription: string,
}

export interface EditRequestPostInterface {
    post_id?: number | null,
    action?: string | null,
    title?: string | null,
    originalTitle?: string | null,
    description?: string | null,
    originalDescription?: string | null,
}

export interface DeleteRequestInterface {
    user_id: number,
    post_id: number,
    action: string,
    title: string,
    originalTitle: string,
    description: string,
    originalDescription: string,
}

export interface ReportsInterface {
    id: string,
    postId: string,
    commentId: string,
    reason: string,
    userId: string,
    message: string,
    userName: string,
    avatar: string,
    reportedUserId: string,
    type: string,
}

export interface MessagesInterface {
    id: string,
    user_id: string,
    email: string,
    topic: string,
    message: string,
}
