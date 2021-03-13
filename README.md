### Requirements

Create and document a small web service exposing URL shortening functions.
One should be able to create, read, and delete shortened URLs.
The API functions will be exposed under the '/api' path while accessing a shortened URL at the
root level will cause redirection to the shortened URL.

Rules of the game:
- Code in PHP, ideally using the Symfony framework
- It's ok to forget about permissions (everyone can do anything) for the sake of the exercise.
- Code will be tested to a reasonable extent
- Your API will be documented
- You're free to choose any storage mechanism you wish
  We expect to be able to run the application locally just running docker-compose, with no
  external dependencies required to run it.

Bonus
- Implement a counter of the shortened URL redirections
- Add an API endpoint to read shortened URL redirections count

### Installation
1. git clone git@github.com:lubo13/jobtome.git
2. cd jobtome
3. docker-compose up -d
4. Go to https://localhost in browser or click <a href='https://localhost'>here</a>
5. Go to OAS Docs in the browser https://localhost/docs in browser or click <a href='https://localhost/docs'>here</a>
6. Additionally, there are some tests and you can run it with the following command
    - Create test database: `docker-compose exec php bin/console doctrine:database:create -e test`
    - Run database migrations: `docker-compose exec php bin/console doctrine:mig:mig -e test -n`
    - Run tests `docker-compose exec php bin/phpunit` 
    - Run tests `docker-compose exec php bin/phpunit --testdox`
