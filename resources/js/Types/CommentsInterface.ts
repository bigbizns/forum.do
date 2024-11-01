export interface CommentsInterface {
    id: string,
    comment: string,
    author: string,
    author_avatar: string,
    authorId: string,
    commentVotes: commentVotes,
}

interface commentVotes {
    upVote: number,
    downVote: number
}
