DIST_FOLDER=dist
DOCKER_FOLDER=docker
DOCKER_APP_FOLDER=docker/app

if [ -d "$DIST_FOLDER" -a -d "$DOCKER_FOLDER" -a -d "$DOCKER_APP_FOLDER" ]; then
    echo "Copy build files to ${DOCKER_APP_FOLDER}"
    # rm -rf docker/app/*
    cp -rf dist/. docker/app
fi