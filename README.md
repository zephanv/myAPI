# API Name

Name of Your API

## API Description

This API provides CRUD (Create, Read, Update, Delete) operations for managing name records in a database. It allows you to add, retrieve, update, and delete names with associated information.

## API Endpoints

- `POST /postName`: Create a new name record.
- `GET /getName`: Retrieve a list of all name records.
- `DELETE /delName/{id}`: Delete a name record by ID.
- `PUT /updateName/{id}`: Update an existing name record by ID.

## Request Payload

The payload for the `POST /postName` and `PUT /updateName/{id}` endpoints should be a JSON object with the following structure:

```json
{
  "fname": "First Name",
  "lname": "Last Name"
}
fname (string): First name of the person.
lname (string): Last name of the person.

Response
The API responds with JSON objects. Possible response structures include:
Successful Response (200 OK):
{
  "status": "success",
  "data": { /* Name record data */ }
}
Error Response (4xx or 5xx):
{
  "status": "error",
  "message": "Error message"
}
Usage

Create a Name Record (POST)
1. Open Postman.
2. Create a new request and set the request type to POST.
3. Set the request URL to http://your-api-url/postName.
4. In the "Headers" section, add a header with the key Content-Type and the value application/json.
5. In the "Body" section, select the "raw" option and enter the JSON payload:

{
  "fname": "John",
  "lname": "Doe"
}

6.Click the "Send" button to make the POST request.

Retrieve Name Records (GET)
1. Open Postman.
2. Create a new request and set the request type to GET.
3. Set the request URL to http://your-api-url/getName.
4. Click the "Send" button to make the GET request.

Update a Name Record (PUT)
1.Open Postman.
2.Create a new request and set the request type to PUT.
3. Set the request URL to http://your-api-url/updateName/1 (replace 1 with the ID of the record you want to update).
4. In the "Headers" section, add a header with the key Content-Type and the value application/json.
5. In the "Body" section, select the "raw" option and enter the JSON payload with the updated data:

{
  "fname": "Updated",
  "lname": "Name"
}

6.Click the "Send" button to make the PUT request.

1. Delete a Name Record (DELETE)
2. Open Postman.
3. Create a new request and set the request type to DELETE.
4. Set the request URL to http://your-api-url/delName/1 (replace 1 with the ID of the record you want to delete).
5. Click the "Send" button to make the DELETE request.
6. Make sure to replace http://your-api-url with the actual URL where your API is hosted.

## License
This API is distributed under the MIT License. See LICENSE.md for details.

## Contributors
Enrico Zephan Valdez - Creator and maintainer

## Contact Information
For inquiries or support, please contact enricozephanvaldez@gmail.com
