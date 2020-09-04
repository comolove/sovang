DIST_FOLDER=dist
PHP_FOLDER=php

if [ -d "$DIST_FOLDER" -a -d "$PHP_FOLDER" ]; then
    echo "Copy php files to ${DIST_FOLDER}"
    cp -r php/. dist
fi