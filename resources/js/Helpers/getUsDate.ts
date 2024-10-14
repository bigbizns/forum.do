export const getUsDate = (time: string): string => {
    const date: Date = new Date(time);

    const year: number = date.getFullYear();
    const month: number = date.getMonth() + 1;
    const day: number = date.getDate();

    return `${day}-${month}-${year}`;
};
