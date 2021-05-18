#This is premier league simulator





## Installation
use docker to build up environments
```bash
docker-compose build --no-cache
```
Use the package manager [composer](https://getcomposer.org/) to install.

```bash
docker-compose exec php composer install
```


## Usage

Run this to make project ready to lunch: 
```python
docker-compose up -d
```
After that you just simply need open [localhost:8081](http://localhost:8081) on your browser.

##Project Details
# Directory Structure

- [Root Directory](#the-root-directory)
    - [`app` Directory](#the-root-app-directory)
        - [`Action` Directory](#the-bootstrap-directory)
            - [`Controllers` Directory](#the-bootstrap-directory)
            - [`Models` Directory](#the-bootstrap-directory)
            - [`policies` Directory](#the-bootstrap-directory)
            - [`Repositories` Directory](#the-bootstrap-directory)
            - [`Services` Directory](#the-bootstrap-directory)
        - [`Components` Directory](#the-config-directory)
        - [`Config` Directory](#the-database-directory)
        - [`Contracts` Directory](#the-public-directory)
        - [`Exceptions` Directory](#the-resources-directory)
        - [`Helpers` Directory](#the-routes-directory)
        - [`Resource` Directory](#the-storage-directory)
        - [`Templates` Directory](#the-tests-directory)
  - [`vendor` Directory](#the-vendor-directory)
  - [`docker` Directory](#the-vendor-directory)


<a name="the-root-directory"></a>
## The Root Directory
