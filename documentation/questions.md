## ======= [/questions]

### Get all items [GET]
Available includes: [ratings]
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Question, Question])

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->
### Create item [POST]
Available includes: [ratings]
+ Request Rules:
    {
        "text": 'required',
        "type": 'required|in:'.QuestionTypes::stringify(),

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "text": illo (string),
            "type": enum1 (string),

    }
+ Response 201 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Question successfully created (string)
        + data: (Question)

<!-- include(response/401.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->

## ======= [/questions/{id}]
### Update item [PUT]
Available includes: [ratings]
<!-- include(parameters/id.md) -->
+ Request Rules:
    {
        "text": 'required',
        "type": 'required|in:'.QuestionTypes::stringify(),

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "text": deserunt (string),
            "type": enum1 (string),

    }
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Question successfully updated (string)
        + data: (Question)

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->
### Get single item [GET]
Available includes: [ratings]
<!-- include(parameters/id.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (Question)

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
        + message: Question successfully deleted (string)
        + data: null

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->

## ======= [/questions/paginate?page={page}&pagination={pagination}]
### Paginated items [GET]
Available includes: [ratings]
<!-- include(parameters/pagination.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Question, Question])
        + meta
            + pagination (Pagination)

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->


