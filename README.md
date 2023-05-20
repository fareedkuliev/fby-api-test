Instruction:

1. Clone the repository into your project. Use this link https://github.com/fareedkuliev/fby-api-test.git .It is the back part. Here you can fint frond part https://github.com/fareedkuliev/fby-front-for-api.git  . 
2. After you successfully insatlled API project: 
- use command  'composer install' into your terminal
- open an env file in the root of your project and update DATABASE_URL="mysql://root@127.0.0.1:3306/FYB-API" 
- create a DB using command 'php bin/console doctrine:database:create'
- use command 'symfony console doctrine:migrations:migrate' to create tables(entities) in your DB.
- open the DB
- open src/DataFixtures and UserFixtures.php. In the bottom uncomment $manager->flush(); . After that use command 'php bin/console doctrine:fixtures:load' in your terminal. This allow to add fixtures in the User table. If it success - comment back $manager->flush(); in the UserFixtures.php
- open src/DataFixtures and ProjectFixtures.php. In the bottom uncomment $manager->flush(); . After that use command 'php bin/console doctrine:fixtures:load --append' in your terminal. This allow to add fixtures in the Project table. If it success - comment back $manager->flush(); in the ProjectFixtures.php
- open src/DataFixtures and ProjectMilestonesFixtures.php. In the bottom uncomment $manager->flush(); . After that use command 'php bin/console doctrine:fixtures:load --append' in your terminal. This allow to add fixtures in the ProjectMilestones table. If it success - comment back $manager->flush(); in the ProjectMilestonesFixtures.php
- now you have fixtures in the DB
3. Run command 'symfony server:start' and check the localhost and the port. You'll need both of them in the second front repository.
4. Open second repository and change the localhost variable on the main.js and user.js if it needs. Check localhost and port. They should be the same like in symfony.
5. Open the index.html and run browser. So you can test the functonality both part of the project.
