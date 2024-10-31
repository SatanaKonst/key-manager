#!/bin/bash

# chmod +x ./autobuild.sh && ./autobuild.sh [-s] -l login -p password

while getopts [s]:l:p: flag; do
  case "${flag}" in
  s) SEND='Y' ;;
  l) if [ ! -z "${OPTARG}" ]; then
    LOGIN=${OPTARG}
  fi ;;
  p) if [ ! -z "${OPTARG}" ]; then
    PASSWORD=${OPTARG}
  fi ;;

  esac
done

VERSION=$(grep "ARG PHP_VERSION" Dockerfile | cut -d '=' -f 2)
REVISION=$(grep "ARG REVISION" Dockerfile | cut -d '=' -f 2)

docker build -t kkorobicin/apache-php:${VERSION}_r${REVISION} -t kkorobicin/apache-php:latest .

if [ ! -z "$LOGIN" ] && [ ! -z "$PASSWORD" ]; then
  echo 'Login in hub'
  echo $PASSWORD | docker login -u ${LOGIN} --password-stdin
fi

if [[ "${SEND}" == 'Y' ]]; then
  echo 'Send image to Hub'
  docker push kkorobicin/apache-php:latest && docker push kkorobicin/apache-php:${VERSION}_r${REVISION}
fi

if [ ! -z "$LOGIN" ] && [ ! -z "$PASSWORD" ]; then
  echo 'Logout from hub'
  docker logout
fi
