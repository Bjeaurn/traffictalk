#!/bin/bash
echo " "
echo " "
echo -e "\033[32m Deploying to Heroku"
echo " "
echo " "

heroku container:login

heroku container:push --recursive --app filerijden

echo " "
echo " "  
echo -e "\033[32m Pushed to Heroku!"
echo " "

exit
