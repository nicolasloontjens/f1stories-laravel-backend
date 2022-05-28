# F1 Stories: Laravel

Laravel backend for my F1 Stories app.

This version is running online, <a href="http://f1stories.herokuapp.com/api/">this</a> is the endpoint. 

The version running online is using an AWS S3 Bucket to store the images that users can upload.  
The non-S3 version is on a separate branch in this project called non-s3.

## Details

- The multilingual route is /races 
- You can query English(default), Dutch and French
- Example: /stories?lang=en or nl or fr

## Run locally:

- Copy the .env.example file, name it .env and fill in the necessary fields for the database
- Run artisan migrate and then artisan db:seed to create the necessary tables for the api.

## Endpoints:

NOTE: all endpoints with POST, PUT and DELETE require a JWT token in the
Authorization header of the request, this token is given when registering as a user, and updated when logging in as a user

- POST /users/register
- POST /users/login  
=> body required for these:
```
{
    "username":"your username",
    "password":"your password"
}
```

- GET /stories
- GET /stories/{storyid}/comments
- GET /users/{uid}
- GET /races
- GET /users/{uid}/likes  
=> get endpoints for basic information the app needs

- POST /stories  
Body => 
```
{
    "title":"a title",
    "content":"your story",
    "country":"Belgium",
    "raceid":1,
    "image1": file,
    "image2": file, 
    "image3": file
}
```
In the app the body is a form data object so the files can be sent to the api, these 3 "images" are optional.

- PUT /stories/{storyid}  
Body => 
```
{
    "content":"your updated post"
}
```
- DELETE /stories/{storyid}  


- POST /stories/{storyid}/comments  
Body =>
- PUT /comments/{commentid}  
Body =>
```
{
    "content":"your comment"
}
```


- DEL /comments/{commentid}


- POST /stories/{storyid}/interact  
Body => 
```
{
    "interact":0 or 1
}
```
like or un-like a post

- POST /users/{uid}/race  
Body =>
```
    "race":"Bahrain GP"
```
accepted race values are the titles of races found in the /races endpoint
