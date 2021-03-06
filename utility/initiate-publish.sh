#!/bin/bash

if [ "$TRAVIS_REPO_SLUG" == "chdemko/php-bitarray" ] && [ "$TRAVIS_PHP_VERSION" == "7.1" ] && [ "$TRAVIS_PULL_REQUEST" == "false" ] && [ "$TRAVIS_BRANCH" == "master" ]; then

  echo -e "Publishing code coverage to coveralls.io ...\n"

  php vendor/bin/coveralls -v

  echo -e "Published code coverage to coveralls.io\n"
  
  echo -e "Publishing doc...\n"

  cp -R build/api $HOME/api-latest

  cd $HOME
  git config --global user.email "travis@travis-ci.org"
  git config --global user.name "travis-ci"
  git clone --quiet --branch=gh-pages https://${GH_TOKEN}@github.com/chdemko/php-bitarray gh-pages > /dev/null

  cd gh-pages
  git rm -rf ./api
  cp -Rf $HOME/api-latest ./api

  git add -f .
  git commit -m "Latest doc on successful travis build $TRAVIS_BUILD_NUMBER auto-pushed to gh-pages"
  git push -fq origin gh-pages > /dev/null

  echo -e "Published doc to gh-pages.\n"

fi
