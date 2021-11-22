#starting the containers in detached mode (run in the background)
docker-compose up -d --build

#open the shell console inside the nginx container
# docker exec -it php-tpeweb2-c bash