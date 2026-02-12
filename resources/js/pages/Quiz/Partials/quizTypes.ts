export interface Answer {
    id: number;
    text: string;
    is_correct: boolean;
}

export interface Question {
    id: number;
    text: string;
    answers: Answer[];
}
