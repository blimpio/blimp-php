# blimp-php
This library allows you to interact with the Blimp API using PHP. You can find more information
about Blimp's Public API documentation at [http://dev.getblimp.com/](http://dev.getblimp.com/).
If you have any problems or requests please contact [support](mailto:support@getblimp.com?subject=Blimp API PHP library).

## License
Licensed under the MIT License.

## Install

Using Github:

```
git clone git@github.com:getblimp/blimp-php
````

Using [Composer](http://getcomposer.org/):

```
{
	"require": {
		"blimp/client": "dev-master"
	}
}
```

Then run:

```
composer install
```

## Pre-Usage

Before we begin using the library you need to signup to [Blimp](http://app.getblimp.com/) and generate a new API Key if you don't have one in your [settings](https://app.getblimp.com/user/settings/api/) as well as an Application ID and Secret in your [applications](https://app.getblimp.com/user/settings/api/developers/).

## Usage

```php

# load the client using Composer's autoloader
require_once 'vendor/autoload.php';

$client = new Blimp\Client($username, $api_key, $app_id, $app_secret);

# or load the client without an autoloader
require_once 'src/BlimpClient.php';

$client = new BlimpClient($username, $api_key, $app_id, $app_secret);

# get all companies that I'm part of
$companies = $client->get('company');

# get one company by id
$companies = $client->get('company', 1);

# get all projects for one company
$projects = $client->get('project', null, array('company' => 1));

# get count of total projects
$total_projects = $projects->meta->total_count;

# Loop through all projects and print their name
foreach($projects->objects as $project) {
    echo $project->name;
}

# Get all goals for a project
$goals = $client.get('goal', null, array('project' => 1));

# Get all tasks for a goal
$tasks = $client.get('task', null, array('goal' => 1));

# Get all comments for a task
$comments = $client.get('comment', null, array('content_type' => 'todo', 'object_pk': 1));

# Get schema for all available endpoints
print_r($client->schema('company'));
print_r($client->schema('project'));
print_r($client->schema('goal'));
print_r($client->schema('task'));
print_r($client->schema('comment'));
print_r($client->schema('file'));
print_r($client->schema('user'));

# All available methods per endpoint
# $client.get($resource_name);
# $client.get($resource_name, $id);
# $client.create($resource_name, $data);
# $client.update($resource_name, $id, $data);
# $client.delete($resource_name, $id);
# $client.schema($resource_name);
```

### Example response of all companies I'm part of
```JSON
{
    "meta": {
        "limit": 20,
        "next": null,
        "offset": 0,
        "previous": null,
        "total_count": 1
    },
    "objects": [
        {
            "company_users": [
                {
                    "accepted_invitation": true,
                    "date_created": "2012-11-01T00:00:00",
                    "date_modified": "2012-11-27T02:22:09.817265",
                    "id": 38,
                    "is_active": true,
                    "role": "admin",
                    "user": "/api/v2/user/3/"
                },
                {
                    "accepted_invitation": true,
                    "date_created": "2012-11-01T00:00:00",
                    "date_modified": "2012-11-27T02:22:09.705959",
                    "id": 37,
                    "is_active": true,
                    "role": "admin",
                    "user": "/api/v2/user/2/"
                },
                {
                    "accepted_invitation": true,
                    "date_created": "2012-11-01T00:00:00",
                    "date_modified": "2012-11-27T02:22:09.380851",
                    "id": 39,
                    "is_active": true,
                    "role": "owner",
                    "user": "/api/v2/user/1/"
                }
            ],
            "date_created": "2012-11-01T00:00:00",
            "date_modified": "2012-12-21T21:57:09.965247",
            "id": 1,
            "image_url": "",
            "name": "Blimp",
            "resource_uri": "/api/v2/company/1/",
            "slug": "blimp",
            "used_projects": 0,
            "used_storage": "4929882"
        }
    ]
}
```

## Improvements
What else would you like this library to do? Let me know. Feel free to send pull requests for any improvements you make.

### Todo
* Tests
