interface PostInterface {
    title: string,
    description: string,
    tradeAction: string,
    id: number,
    user_id: number,
    avatar: string,
    created_at: Date,
    author: {
        avatar: string,
        email: string
        id: number
        username: string
    }
}

interface PostVotesInterface {
    upVote: number,
    downVote: number
}
