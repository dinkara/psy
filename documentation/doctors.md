## ======= [/doctors]

### Get all items [GET]
Available includes: [certificates, sessions, user, company]
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Doctor, Doctor])

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->
### Create item [POST]
Available includes: [certificates, sessions, user, company]
+ Request Rules:
    {
        "company_id": 'required',
        "price": 'required',
        "duration": 'required',
        "available": 'required',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "company_id": 8 (number),
            "price": 1 (string),
            "duration": 11 (number),
            "available": 0 (boolean),

    }
+ Response 201 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Doctor successfully created (string)
        + data: (Doctor)

<!-- include(response/401.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->

## ======= [/doctors/{id}]
### Update item [PUT]
Available includes: [certificates, sessions, user, company]
<!-- include(parameters/id.md) -->
+ Request Rules:
    {
        "price": 'required',
        "duration": 'required',
        "available": 'required',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "price": 0.6 (string),
            "duration": 5 (number),
            "available": 0 (boolean),

    }
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Doctor successfully updated (string)
        + data: (Doctor)

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->
### Get single item [GET]
Available includes: [certificates, sessions, user, company]
<!-- include(parameters/id.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (Doctor)

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
        + message: Doctor successfully deleted (string)
        + data: null

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->

## ======= [/doctors/paginate?page={page}&pagination={pagination}]
### Paginated items [GET]
Available includes: [certificates, sessions, user, company]
<!-- include(parameters/pagination.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Doctor, Doctor])
        + meta
            + pagination (Pagination)

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->


