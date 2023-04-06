# Test project junior php devloper position

This project is a test assignment for a summer internship at Farpost

## Task statement
There is a list of directories with unlimited nesting. Each directory may contain a count file. You need to write a console application that will go through all the directories and return the sum of all the numbers from the count files.

## Realization
This project was implemented on the symfony framework. Standard project generation using the command:
```bash
symfony new name_project
```
## Project opportunities
To start the project it is necessary to assemble a container:
```bash
docker-compose up -d --build
docker-compose exec app /bin/bash
```
There are two ways of working with the application. 
The first way:
```bash
php bin/console app:summator
```
This command will search for all count files regardless of their extension in the project directive.
The second way to work with the application, is this:

```bash
php bin/console app:summator  path[full path of the search directive]
```
This option will search for files with the name count in the specified directive.
