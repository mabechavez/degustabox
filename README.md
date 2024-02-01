These Docker files allows you to run a PHP Symfony Framework project.



## Extra
The container has MYSQL dependencies loaded.

## Usage

You can execute the container using this command:

First time
```bash
docker-compose up -d --build
```

If you shutdown your computer or you down the container and if you don't make any changes to the Dockerfile or docker-compose.yml settings, you can run the container again using this command:
```bash
docker-compose up -d
```

## Adjust Docker volume permissions
If you are using Docker Engine in a Linux Virtual Machine, you need put the following permissions to Docker volume

```bash
chown -R [user]:www-data volumes/project
chmod 775 -R  volumes/project
```

If you add new files remember to fix the permissions again.

This is necessary to modify the volume files outside the Docker container.

## Run the project

```bash
cd degustabox/
symfony server:start

 [OK] Web server listening
      The Web server is using PHP FPM 7.4.14       
      http://127.0.0.1:8000      
```

## Use MySQL container.
This repository includes a MySQL's Docker image. If the container is running, you can access via any MySQL client, for example Squirrel SQL or MySQL Workbench via 127.0.0.1 ip and 3306 port.

The communication between containers is through the "mysql" alias, the name of the service in docker-compose.yaml

## License
[MIT](https://choosealicense.com/licenses/mit/)
