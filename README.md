# school-erp-backend

Setup Guide:
1. Docker Env setup,
    Create a copy of the .env file from .env.template:
   
    ```shell
   cp .env.template .env
    ```
    
2. Laravel Env setup,
    inside src/
    create a copy of the .env from .env.example

    ```shell
    cd src
    cp .env.example .env
    ```
    
3. Generate keys
    Create JWKS key pair
    go to key-generator folder, run command to generate keys

    ```shell
    cd key-generator
    npm run start
    ```
     copy keys to .env
   

4. Run below command to start services for the first time
   ```shell
   make setup
   ```
