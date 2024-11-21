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
