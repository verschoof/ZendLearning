# ZendLearning

A simple page of all the topics for the Zend PHP5 Certification, including links to documentation.

**Warning**: This is not code meant for production, just a quick setup to have a list of what to learn for your PHP5 certification.

# How to start

Clone the project:

    git clone git@github.com:verschoof/ZendLearning.git zend-learning 

Copy `data/config.yml.dist` to `data/config.yml`.

Do Composer install `composer install`

Run `php -S localhost:8080` in the `public` directory and browse to `http://localhost:8080`.

# ToDo

- In `data/questions.yml` there are still a lot of questions that don't have a link.
- The links only support the PHP manual website, but some links point to other websites (which don't function at the moment).
