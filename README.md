<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel CRUD-API

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:


##  Development Resources

-Database(database/migrations)
Contains the tables for the database structure: 'drivers', 'details', 'vehicles'

-Models(app/Models)
Contains the models for each table attribute: 'drivers', 'details', 'vehicles'

-Controllers(app/Http/Controllers)
Contains the methods used to interact with the database for each table: 'driversController', 'detailsController', 'vehiclesController'

-Routes(routes/api.php)
The structure for routing to the specific request, is structured within the api.php file

## **Endpoints**

The following endpoints are available for use:
Driver Endpoints
CREATE /driver/

    Creates a new driver record.
    Request Body:
        id_number: integer
        phone_number: integer
        home_address: text
        first_name: text
        last_name: text
        licence_type: char('A','B','C','D')

GET /drivers/

    Retrieves a list of all drivers.

GET /driver/{id}

    Retrieves a specific driver record by id.

GET /driver/{id}/vehicle/

    Retrieves the vehicle assigned to a specific driver.

UPDATE /drivers/{id}

    Updates a specific driver record by id.
    Request Body:
        id_number: integer
        phone_number: integer

UPDATE /drivers/{id}/details/

    Updates the details of a specific driver record by id.
    Request Body:
        home_address: string
        fist_name: string
        last_name: string
        license_type: enum("A", "B", "C", "D") -> One of the four

DELETE /drivers/{id}

    Deletes a specific driver record by id.

DELETE /drivers/{id}/details/

    Deletes the details of a specific driver record by id.

Vehicle Endpoints
CREATE /vehicle/

    Creates a new vehicle record.
    Request Body:
        id: integer
        lisence_plate: string
        vehicle_make: string
        vehicle_model: string
        model_year: date(Y-m-d)
        insured: boolean/ 0, 1
        last_service: date(Y-m-d)

GET /vehicles/

    Retrieves a list of all vehicles.

UPDATE /vehicle/{id}/

    Updates a specific vehicle record by id.
    Request Body:
        id: integer
        lisence_plate: string
        vehicle_make: string
        vehicle_model: string
        model_year: date(Y-m-d)
        insured: boolean/ 0, 1

DELETE /vehicle/{id}/

    Deletes a specific vehicle record by id.
