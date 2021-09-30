# TPE Web 2: Careers path
    This project was created for the tpe of the subject Web 2 of TUDAI - UNICEN.

## Setup enviroment
    The following steps are required to run the development enviroment.
### 1. Enviroment variables
    The docker-compose file uses enviroments variables to set up ports and other configurations, copy the env-example into a new .env file and change the values as need it.

### 2. Docker
    1. run `docker-compose build` to build the customPhp.Dockerfile
    2. run `docker-compose up -d` to run all containers asociated to the services defined in the docker-compose.yml file
