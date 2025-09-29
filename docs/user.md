# User API Spec

# Register User

Endpoint: POST /api/users

Request Body :
```json
{
    "username": "pbe",
    "password": "pbe",
    "name": "PBE"
}
```

Response Body (Success) :
```json
{
    "data": "OK"
}
```

Response Body (Failed) :
```json
{
    "errors": "username must not black, ??"
}
```

## Login User

Endpoint : POST /api/auth/login

Request Body :
```json
{
    "username": "pbe",
    "password": "pbe"
}
```

Response Body (Success) :
```json
{
    "data": {
        "token": "TOKEN",
        "expiredAt": 2342342423423 
    }
}
```

Response Body (Failed, 401) :
```json
{
    "errors": "username dan password wrong"
}
```

## Get User

Endpoint : GET /api/users/current

Request Header :
- Authorization : Token (Mandatori)

Request Body (Success)
```json
{
    "data":  {
        "username" : "pbe",
        "name" :"PBE"
    }
}
```

Response Body (Failed, 401) :
```json
{
    "errors": "Unauthorized"
}
```

## Logout User

Endpoint : DELETE /api/auth/logout

Request Header :

- Authorization : Token (Mandatori)

Response Body (Success) :
```json
{
    "data": "OK"
}
```

## Update User
Endpoint : PUT /api/users/{id}

Request Body :
```json
{
    "username": "pbe",
    "password": "pbe",
    "name": "PBE"
}
```

Response Body (Success) :
```json
{
    "data": "OK"
}
```

Response Body (Failed) :
```json
{
    "errors": "user not found"
}
```
