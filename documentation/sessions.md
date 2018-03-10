## ======= [/sessions]

### Get all items [GET]
Available includes: [notes, ratings, doctor, patient]
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Session, Session])

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->
### Create item [POST]
Available includes: [notes, ratings, doctor, patient]
+ Request Rules:
    {
        "doctor_id": 'required',
        "patient_id": 'required',
        "price": 'required',
        "start": 'required',
        "end": 'required',
        "status": 'required|in:'.SessionStatuses::stringify(),

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "doctor_id": 17 (number),
            "patient_id": 9 (number),
            "price": 1 (string),
            "start": 2018-01-10 12:53:17 (string),
            "end": 2017-12-27 12:53:17 (string),
            "status": enum1 (string),

    }
+ Response 201 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Session successfully created (string)
        + data: (Session)

<!-- include(response/401.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->

## ======= [/sessions/{id}]
### Update item [PUT]
Available includes: [notes, ratings, doctor, patient]
<!-- include(parameters/id.md) -->
+ Request Rules:
    {
        "price": 'required',
        "start": 'required',
        "end": 'required',
        "status": 'required|in:'.SessionStatuses::stringify(),

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "price": 0.5 (string),
            "start": 2018-02-04 12:53:18 (string),
            "end": 2018-02-07 12:53:18 (string),
            "status": enum1 (string),

    }
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Session successfully updated (string)
        + data: (Session)

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->
### Get single item [GET]
Available includes: [notes, ratings, doctor, patient]
<!-- include(parameters/id.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (Session)

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
        + message: Session successfully deleted (string)
        + data: null

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->

## ======= [/sessions/paginate?page={page}&pagination={pagination}]
### Paginated items [GET]
Available includes: [notes, ratings, doctor, patient]
<!-- include(parameters/pagination.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Session, Session])
        + meta
            + pagination (Pagination)

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->


