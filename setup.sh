#!/bin/bash
################################################################################
#@                                   Functions
################################################################################

askyesno () {
    local answer="";

    echo -e -n "\033[0;31m"; echo -n "$1 [y/n] ?"; echo -e -n "\033[0m";
    while [ "${answer,,}" != "y" ] && [ "${answer,,}" != "n" ]; do
        read -n1 -s answer;
    done
    echo "";

    if [ "${answer,,}" = "y" ]; then
        return 0;  # It's true
    fi

    return 1;  # It's false
}

################################################################################
#@                                     Main
################################################################################

echo -e "\033[1;35m\n* Starting project setup...\033[0m";

# If exists remove ci4 demo app directory
if [ -d "./www/codeigniter4" ]; then
    echo -e "\033[0;33m\n* Remove ci4 demo app directory...\033[0m";
    rm -rf ./www/codeigniter4;
fi

echo -e "\033[1;34m\n* Change writable directory permissions...\033[0m";
chmod -R 777 ./www/pedale_douce/writable;

echo -e "\033[1;34m\n* Change public/maps directory permissions...\033[0m";
chmod -R 777 ./www/pedale_douce/public/maps;

echo -e "\033[1;34m\n* Install project dependencies...\n\033[0m";
docker exec -w /var/www/html/pedale_douce pedale_douce bash -c "composer install";

echo -e "\033[1;32m\n* Project setup completed !!!\033[0m";

# ------------------------------------------------------------

echo -e "\033[1;35m\n* Database initialisation...\033[0m";
echo -e "\033[0;31m\n* !!! WARNING if you choose yes [y], all current data will be lost !!!\n\033[0m";

if askyesno "  Are you sure you want to initialise database" ; then

    echo -e "\033[1;34m\n* Copy pedale_douce.sql to pedale_douce_mysql container...\033[0m";
    docker cp ./pedale_douce.sql pedale_douce_mysql:/tmp;

    echo -e "\033[1;34m\n* Import pedale_douce.sql file in database...\033[0m";
    docker exec -w /tmp pedale_douce_mysql bash -c "mysql -upedale_douce -ppedale_douce < pedale_douce.sql";

    echo -e "\033[1;34m\n* Remove pedale_douce.sql from pedale_douce_mysql container...\033[0m";
    docker exec -w /tmp pedale_douce_mysql bash -c "rm -f pedale_douce.sql";

    echo -e "\033[1;32m\n* Database initialisation completed !!!\033[0m";

else

    echo -e "\033[1;35m\n* Database initialisation canceled !!!\033[0m";

fi

# ------------------------------------------------------------

echo -e -n "\033[0;33m\n";

echo -e "* Database access with PhpMyAdmin";
echo -e "------------------------------------------------------------\n";

echo -e "  - PhpMyAdmin url: http://localhost:81\n";

echo -e "  - Log-in informations";
echo -e "      Username: pedale_douce";
echo -e "      Password: pedale_douce\n";

echo -e "------------------------------------------------------------\n";

echo -e -n "\033[0m";

################################################################################
exit 0
