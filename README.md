# **PedaleDouce v0.1.0**

### *CodeIgniter4/MySQL (Full-stack educational project)*

Bike self-service app project for Los Entepes city

See ***Docs/Projet_pedaleDouce.pdf*** file for subject details

`Unfortunaly unfinish project at this time...`

## **Available functionalities**

- Home
- Sign-up
- Log-in (authentication)
- Log-out
- Profile
- Bike/Born reservation
- Map user positioning for nearest available station
- Administrator management at 60%

## **Project setup** *(Development only)*

Going in to cloned folder root and run the following commands

*Create project containers*
```sh
docker-compose up -d
```

*Change www directory owner*
```sh
sudo chown -R $(whoami):$(whoami) ./www
```

*Run setup script file*
```sh
./setup.sh
```
**When prompted choose yes to initialise database**

## **Url & Info**

Open [**http://localhost**](http://localhost) to view project in the browser

Database access with PhpMyAdmin at [**http://localhost:81**](http://localhost:81)
 
Some admin users are already created
- peter
- egon
- raymond
- winston

Their default password is "***password***"
