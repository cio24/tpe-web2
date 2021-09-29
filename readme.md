# TPE Web 2: Careers path
    This project was created for the tpe of the subject Web 2 of TUDAI - UNICEN.

## Setup enviroment
    The following steps are required to run the development enviroment.
### Enviroment variables
    The docker-compose file uses enviroments variables to set up ports and other configurations, copy the env-example into a new .env file and change the values as need it.

### Docker
    1. run `docker-compose build` to build the customPhp.Dockerfile
    2. run `docker-compose up -d` to run all containers associated to the services defined in the docker-compose.yml file
    3. in order to access to the site though the domain name tpeweb2careerspath.loc, the folliwing line should be added to the file /etc/hosts: `127.0.0.1 tpeweb2careerspath.loc`

## Access to the sites
    1. to access the site go to http://tpeweb2careerspath.loc or localhost
    2. to access to the phpmyadming go to  http://tpeweb2careerspath.loc:8080 if the value of the PHPMYADMIN_PORT enviroment variable of the .env has the same value as the one in the env-example, otherwise use the value you set.