Instruction:

1. Clone the repository into your project. Use this link https://github.com/fareedkuliev/fby-api-test.git .It is the back part. Here you can fint frond part   . 
2. After you successfully insatlled API project: 
- use command  'composer install' into your terminal
- open an env file in the root of your project and update DATABASE_URL="mysql://root@127.0.0.1:3306/FYB-API" 
- create a DB using command 'php bin/console doctrine:database:create'
- use command 'symfony console doctrine:migrations:migrate' to create tables(entities) in your DB.
- open the DB
- open src/DataFixtures and 
