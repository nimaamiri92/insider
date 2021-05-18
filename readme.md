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


# Directory Structure

- [Root Directory](#the-root-directory)
    - [`app` Directory](#the-app-directory)
        - [`Action` Directory](#the-action-directory)
            - [`Controllers` Directory](#the-controllers-directory)
            - [`Models` Directory](#the-models-directory)
            - [`policies` Directory](#the-policies-directory)
            - [`Repositories` Directory](#the-repositories-directory)
            - [`Services` Directory](#the-services-directory)
        - [`Components` Directory](#the-Components-directory)
        - [`Config` Directory](#the-config-directory)
        - [`Contracts` Directory](#the-contracts-directory)
        - [`Exceptions` Directory](#the-exceptions-directory)
        - [`Helpers` Directory](#the-helpers-directory)
        - [`Resource` Directory](#the-resource-directory)
        - [`Templates` Directory](#the-templates-directory)
  - [`docker` Directory](#the-docker-directory)


<a name="the-root-directory"></a>
## The Root Directory
The `root` directory contains the project logic and all dependency that need to run. 


<a name="the-app-directory"></a>
## The app Directory
The `app` directory contains the project logic.

<a name="the-action-directory"></a>
## The action Directory
The `action` directory contains the core code of your application.

This folder contains Controllers,Models,Polices,Repositories and Services. Almost all the logic to handle requests entering your application will be placed in this directory.

<a name="the-controllers-directory"></a>
## The controllers Directory
The `controllers` directory contains your controllers.


<a name="the-models-directory"></a>
## The models Directory
The `models` directory contains all of your model classes.

We use `session` as DB in this project.

Each model(table) has a corresponding "session object" which is used to interact with that model.


<a name="the-policies-directory"></a>
## The policies Directory
The `policies` directory contains all of your policies classes.

Policies are used to determine if a user can perform a given action against a resource.


<a name="the-repositories-directory"></a>
## The repositories Directory
The `repositories` directory contains all of your repositories classes.

We use repository as middle layer between models(DB) and Controllers,
and method that retrieve data define here.


<a name="the-services-directory"></a>
## The services Directory
The `services` directory contains all of your services classes.

We use services as connection between repositories and also all logic that need to calculate and save data to DB layer define here.


<a name="the-Components-directory"></a>
## The components Directory
The `components` directory contains all of php base classes like `Reponse,Request` . . .


<a name="the-config-directory"></a>
## The config Directory
The `config` directory contains all system config data like `database connection data,session data`.

<a name="the-contracts-directory"></a>
## The contracts Directory
The `contracts` directory contains all `interfaces` that use in our project.

<a name="the-exceptions-directory"></a>
## The exceptions Directory
The `exceptions` directory contains all system exceptions.

<a name="the-helpers-directory"></a>
## The helpers Directory
The `helpers` directory contains some php Helper functions that is used frequency.


<a name="the-resource-directory"></a>
## The resource Directory
The `resource` directory contains all `image,css,javascript` files.


<a name="the-templates-directory"></a>
## The templates Directory
The `templates` directory contains all `Html` files.

<a name="the-docker-directory"></a>
## The docker Directory
The `docker` directory contains config that docker need to run project.



#Project Logic:

##How a league create?
In our `LeagueServices` class we have `createNewLeague`, this method by using policies checks no existed league in progress
if a league in progress we return all data of current league otherwise we start to build up a league:

- First get random team form `team model` by using `TeamRepository`,each team has pre-assigned strengthness rate
- Then attach all this random teams to current league and init all team details in league
- Set current week as first week of league
- Create league(explain it below) matches as `Home/Away` match, and assign all matches to league
- Init prediction result
- And finally save this data in `League` model

##How create league matches? 
For handle the league matches we use `createHomeAndAwayMatches` method in `LeagueService` class.

This method is recursive method that calculate unique permutation of all teams and when
the permutation calculation is finished,create another match for each calculated permutation as `Home/Away match`.

After that the service layer has responsibility to save all matches league.


##How simulate a match?
In `SimulateGamePlay` class we have `play` method.
This class get current week match as input, start calculating of `strength rate` of both teams,
after considering each team strength rate get random match result base on teams strengthness.


##How calculate prediction?
When league start we call `setUpList` method from `PredictionService` class to build up a new empty prediction list.

After each match we call `updateList` method from `PredictionService` class and send current league result and input to it,it calculates predication base on new result and return it.