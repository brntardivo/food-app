## Entidades

### Branch

    1. name: string
    2. trading_name: string
    3. company_name: string
    4. document: number|unique
    5. address: object
        1. address: string
        3. complement?: string
        4. district: string
        5. zip_code: number
        6. city: string
        7. state: string
    6. opening_hours: array
        1. item: object
            1. opens_at: time
            2. closes_at: time
            3. weekday: number

### Role

    1. name: string
    2. branch: Branch
    3. areas: array
        1. area: string

### User

    1. name: string
    2. email: string|unique
    3. password: string
    4. branches: array
        1. item: object
            1. branch: Branch
            2. role: Role

### Customer

    1. name: string
    2. phone: string|unique
    3. email: string|unique
    4. addresses: array
        1. item: object
            1. address: string
            2. number?: string
            3. complement?: string
            4. district: string
            5. zip_code: number
            6. city: string
            7. state: string
            8. default: boolean
    5. payment_methods: array
        1. item: object
            1. tokenized_card: string
            2. type: enum(DEBIT|CREDIT|BOTH)
            3. reference: string
            4. name: string
            5. owner_document: string
            6. expiration: string
            7. default: boolean

### Category

    1. name: string

### Product

    1. name: string
    2. slug: string|unique
    3. description: string
    4. galery: array
        1. item: object
            1. slug: string|unique
            2. sequence: number
            3. path: string|unique
            4. type: enum(IMAGE|VIDEO)
    5. price: number
    6. promotional_price?: number
    7. parameters?: array
        1. item: object
            1. name: string
            2. required: boolean
            3. min?: number
            4. max?: number
            5. items: array
                1. item: object
                    1. name: string
                    2. slug: string|unique
                    3. description: string
                    4. galery: array
                        1. item: object
                            1. slug: string|unique
                            2. sequence: number
                            3. path: string|unique
                    5. price: number
                    6. promotional_price?: number
    8. category: Category
    9. type: enum(PRODUCT|PARAMETER)

## Coupom

    1. slug: string|unique
    2. status: boolean
    3. quantity: number
    4. type: enum(PERCENTAGE|VALUE)
    5. discount: number
    6. available_in: Date
    7. expires_in: Date
    8. user: User

## Order

    1. customer: Customer
    2. overall_status: enum(WAITING_ACCEPT|PREPARING|READY_FOR_DELIVERY|DELIVERED|CANCELLED)
    3. paid: boolean
    4. payment_type: enum(MANUAL|ONLINE)
    5. delivery_type: enum(TAKE_AWAY|DELIVERY)
    6. coupon?: Coupon
    7. total_price: number
    8. payment_attempts?: array
        1. item: object
            1. payment_method: Customer.payment_method
            2. paid_at: Date
            3. attempt: number
            4. meta: json
    9. products: array
        1. item: object
            1. product: Product
            2. unit_price: number
            3. quantity: number
            4. parameters: array
                1. unit_price: number
                2. quantity: number
    10. accepted_by: User
    11. history: array
        1. item: object
            1. status: enum(WAITING_ACCEPT|PREPARING|READY_FOR_DELIVERY|DELIVERED|CANCELLED)
            2. created_at: Date
            3. meta: json
    12. delivery_attempts?: array
        1. item: object
            1. user: User
            2. status: enum(DELIVERED|NO_RECEIVED|ADDRESS_NOT_FOUND)
            3. observation: string
            4. meta: json
