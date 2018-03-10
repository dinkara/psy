## ======= [/wallets]

### Get all items [GET]
Available includes: [transactions, user]
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Wallet, Wallet])

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->
### Create item [POST]
Available includes: [transactions, user]
+ Request Rules:
    {
        "total": 'required',
        "last_calculated_tansaction": 'required',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "total": 0.7 (string),
            "last_calculated_tansaction": 2018-03-07 12:53:18 (string),

    }
+ Response 201 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Wallet successfully created (string)
        + data: (Wallet)

<!-- include(response/401.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->

## ======= [/wallets/{id}]
### Update item [PUT]
Available includes: [transactions, user]
<!-- include(parameters/id.md) -->
+ Request Rules:
    {
        "total": 'required',
        "last_calculated_tansaction": 'required',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "total": 0.9 (string),
            "last_calculated_tansaction": 2018-02-14 12:53:18 (string),

    }
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Wallet successfully updated (string)
        + data: (Wallet)

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->
### Get single item [GET]
Available includes: [transactions, user]
<!-- include(parameters/id.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (Wallet)

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
        + message: Wallet successfully deleted (string)
        + data: null

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->

## ======= [/wallets/paginate?page={page}&pagination={pagination}]
### Paginated items [GET]
Available includes: [transactions, user]
<!-- include(parameters/pagination.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Wallet, Wallet])
        + meta
            + pagination (Pagination)

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->


