## ======= [/transactions]

### Get all items [GET]
Available includes: [wallet, session]
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Transaction, Transaction])

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->
### Create item [POST]
Available includes: [wallet, session]
+ Request Rules:
    {
        "wallet_id": 'required',
        "session_id": 'required',
        "amount": 'required',
        "comment": 'required',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "wallet_id": 5 (number),
            "session_id": 6 (number),
            "amount": 0.9 (string),
            "comment": dolor (string),

    }
+ Response 201 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Transaction successfully created (string)
        + data: (Transaction)

<!-- include(response/401.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->

## ======= [/transactions/{id}]
### Update item [PUT]
Available includes: [wallet, session]
<!-- include(parameters/id.md) -->
+ Request Rules:
    {
        "amount": 'required',
        "comment": 'required',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "amount": 0.4 (string),
            "comment": nostrum (string),

    }
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Transaction successfully updated (string)
        + data: (Transaction)

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->
### Get single item [GET]
Available includes: [wallet, session]
<!-- include(parameters/id.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (Transaction)

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->
### Delete item [DELETE]
<!-- include(parameters/id.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->    
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Transaction successfully deleted (string)
        + data: null

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->

## ======= [/transactions/paginate?page={page}&pagination={pagination}]
### Paginated items [GET]
Available includes: [wallet, session]
<!-- include(parameters/pagination.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Transaction, Transaction])
        + meta
            + pagination (Pagination)

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->


