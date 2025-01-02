export interface PaginationInterface {
    current_page: number,
    last_page: number,
    next_page_url: string,
    prev_page_url: string,
    per_page: number,
    total: number,
}

export interface PageNumbersInterface {
    page: number,
    currentPage: number,
    lastPage: number,
}
