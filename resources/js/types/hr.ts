    export interface PaginationLink {
            url: string | null;
            lebal:string;
            active:boolean;
    }

export interface Paginated<T> {
    data: T[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    from: number | null;
    to: number | null;
    links: PaginationLink[];
}
    export interface SearchFilters {
     search?: string;
    }

    export interface Department{
       id: number;
       name: string;
       code: string|null;
       description: string|null;
       positions_count?:number;
       employees_count?:number;
       created_at:string;
       updated_at:string;
    }

    export interface Position {
    id: number;
    department_id: number;
    title: string;
    description: string | null;
    department?: Department;
    employees_count?: number;
    created_at: string;
    updated_at: string;
}