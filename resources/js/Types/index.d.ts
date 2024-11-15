export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
    avatar: string;
    is_admin: number;
}

export interface FlashMessages {
    profile_message?: string;
    avatar_message?: string;
    message?: string;
    updatedPassword_message?: string;
    email_message: string;
    warning_message: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
    flash: FlashMessages;
};
