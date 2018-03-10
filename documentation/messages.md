## ======= [/messages]

### Get all items [GET]
Available includes: [sender]
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Message, Message])

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->
### Create item [POST]
Available includes: [sender]
+ Request Rules:
    {
        "text": 'required',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "text": dolorum (string),

    }
+ Response 201 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Message successfully created (string)
        + data: (Message)

<!-- include(response/401.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->

## ======= [/messages/{id}]
### Update item [PUT]
Available includes: [sender]
<!-- include(parameters/id.md) -->
+ Request Rules:
    {
        "text": 'required',

    }
+ Request (application/json)
    <!-- include(request/header.md) -->
    + Body
    {
            "text": est (string),

    }
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Message successfully updated (string)
        + data: (Message)

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/422.md) -->
<!-- include(response/500.md) -->
### Get single item [GET]
Available includes: [sender]
<!-- include(parameters/id.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (Message)

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
        + message: Message successfully deleted (string)
        + data: null

<!-- include(response/401.md) -->
<!-- include(response/404.md) -->
<!-- include(response/500.md) -->

## ======= [/messages/paginate?page={page}&pagination={pagination}]
### Paginated items [GET]
Available includes: [sender]
<!-- include(parameters/pagination.md) -->
+ Request (application/json)
    <!-- include(request/header.md) -->
+ Response 200 (application/json)
    + Attributes         
        + success: true (boolean)
        + message: Ok (string)
        + data: (array[Message, Message])
        + meta
            + pagination (Pagination)

<!-- include(response/401.md) -->
<!-- include(response/500.md) -->


