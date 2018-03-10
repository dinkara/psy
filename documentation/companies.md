## ======= [/companies]

### Get all items [GET]
Available includes: [doctors]
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Company, Company])

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->
### Create item [POST]
Available includes: [doctors]
+ Request Rules:
    {
        "name": 'required',
        "address": 'required',
        "city": 'required',
        "country": 'required',
        "zip": 'required',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "name": saepe (string),
            "address": consectetur (string),
            "city": inventore (string),
            "country": dolorem (string),
            "zip": ad (string),

    }
+ Response 201 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Company successfully created (string)
        + data: (Company)

<!-- include(response/401.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->

## ======= [/companies/{id}]
### Update item [PUT]
Available includes: [doctors]
<!-- include(parameters/id.md) -->
+ Request Rules:
    {
        "name": 'required',
        "address": 'required',
        "city": 'required',
        "country": 'required',
        "zip": 'required',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "name": dignissimos (string),
            "address": itaque (string),
            "city": quia (string),
            "country": asperiores (string),
            "zip": nulla (string),

    }
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Company successfully updated (string)
        + data: (Company)

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->
### Get single item [GET]
Available includes: [doctors]
<!-- include(parameters/id.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (Company)

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
        + message: Company successfully deleted (string)
        + data: null

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->

## ======= [/companies/paginate?page={page}&pagination={pagination}]
### Paginated items [GET]
Available includes: [doctors]
<!-- include(parameters/pagination.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Company, Company])
        + meta
            + pagination (Pagination)

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->


