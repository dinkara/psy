## ======= [/certificates]

### Get all items [GET]
Available includes: [doctor]
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Certificate, Certificate])

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->
### Create item [POST]
Available includes: [doctor]
+ Request Rules:
    {
        "doctor_id": 'required',
        "name": 'required',
        "description": 'required',
        "url": 'required|image|dimensions:min_width=300,min_height=300',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "doctor_id": 19 (number),
            "name": ipsum (string),
            "description": quod (string),
            "url": magni (string),

    }
+ Response 201 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Certificate successfully created (string)
        + data: (Certificate)

<!-- include(response/401.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->

## ======= [/certificates/{id}]
### Update item [PUT]
Available includes: [doctor]
<!-- include(parameters/id.md) -->
+ Request Rules:
    {
        "name": 'required',
        "description": 'required',
        "url": 'required|image|dimensions:min_width=300,min_height=300',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "name": iusto (string),
            "description": voluptas (string),
            "url": ut (string),

    }
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Certificate successfully updated (string)
        + data: (Certificate)

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->
### Get single item [GET]
Available includes: [doctor]
<!-- include(parameters/id.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (Certificate)

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
        + message: Certificate successfully deleted (string)
        + data: null

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->

## ======= [/certificates/paginate?page={page}&pagination={pagination}]
### Paginated items [GET]
Available includes: [doctor]
<!-- include(parameters/pagination.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Certificate, Certificate])
        + meta
            + pagination (Pagination)

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->


