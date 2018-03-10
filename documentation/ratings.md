## ======= [/ratings]

### Get all items [GET]
Available includes: [questions, session]
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Rating, Rating])

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->
### Create item [POST]
Available includes: [questions, session]
+ Request Rules:
    {
        "session_id": 'required',
        "comment": 'required',
        "owner": 'required|in:'.RatingOwners::stringify(),
        "avg_rate": 'required',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "session_id": 17 (number),
            "comment": eius (string),
            "owner": enum1 (string),
            "avg_rate": 0.6 (string),

    }
+ Response 201 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Rating successfully created (string)
        + data: (Rating)

<!-- include(response/401.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->

## ======= [/ratings/{id}]
### Update item [PUT]
Available includes: [questions, session]
<!-- include(parameters/id.md) -->
+ Request Rules:
    {
        "comment": 'required',
        "owner": 'required|in:'.RatingOwners::stringify(),
        "avg_rate": 'required',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "comment": distinctio (string),
            "owner": enum1 (string),
            "avg_rate": 1 (string),

    }
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Rating successfully updated (string)
        + data: (Rating)

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->
### Get single item [GET]
Available includes: [questions, session]
<!-- include(parameters/id.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (Rating)

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
        + message: Rating successfully deleted (string)
        + data: null

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->

## ======= [/ratings/paginate?page={page}&pagination={pagination}]
### Paginated items [GET]
Available includes: [questions, session]
<!-- include(parameters/pagination.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Rating, Rating])
        + meta
            + pagination (Pagination)

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->


