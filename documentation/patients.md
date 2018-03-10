## ======= [/patients]

### Get all items [GET]
Available includes: [sessions, user]
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Patient, Patient])

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->
### Create item [POST]
Available includes: [sessions, user]
+ Request Rules:
    {

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {

    }
+ Response 201 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Patient successfully created (string)
        + data: (Patient)

<!-- include(response/401.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->

## ======= [/patients/{id}]
### Update item [PUT]
Available includes: [sessions, user]
<!-- include(parameters/id.md) -->
+ Request Rules:
    {

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {

    }
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Patient successfully updated (string)
        + data: (Patient)

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->
### Get single item [GET]
Available includes: [sessions, user]
<!-- include(parameters/id.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (Patient)

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
        + message: Patient successfully deleted (string)
        + data: null

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->

## ======= [/patients/paginate?page={page}&pagination={pagination}]
### Paginated items [GET]
Available includes: [sessions, user]
<!-- include(parameters/pagination.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Patient, Patient])
        + meta
            + pagination (Pagination)

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->


