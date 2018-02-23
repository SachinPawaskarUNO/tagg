## Instructions in progress 

Clone the repo at any place 
```bash
git clone --recursive https://Github.com/SachinPawaskarUNO/tagg.git
cd tagg
docker-compose build
docker-compose up -d
```
The Docker-Compose command will create few docker containers with all of the requisite installed dependencies to run the development environment. 

You need not to run any other commands, [Dockerfile](Dockerfile) & [docker-compose.yml](docker-compose.yml) contains settings and other commands to build dev environment for you.
If you wish to play around php artisan or composer within docker, you need to start a docker shell by running below command in other terminal - 

for accessing the docker shell - 

```bash
docker-compose run app bash
```

In side this shell you can run other php artisan or composer commands.

Note `The docker container is created to use pgsql, so .env file must be changed for same.`