<?php
/*
  Copyright 2005-2007 Redshift Software, Inc.
  Distributed under the Boost Software License, Version 1.0.
  (See accompanying file LICENSE_1_0.txt or http://www.boost.org/LICENSE_1_0.txt)
*/

/*

BOOST_CONFIG_FILE
  Path to local configuration, as a PHP source file.

BOOST_WEBSITE_SHARED_DIR
  The root directory for some of these constants, not needed if you
  set them explicitly.

BOOST_RSS_DIR
  Path to directory with RSS feeds from Gmane.
  - Currently not really used.

BOOST_DATA_DIR
  Path to directory containing data files and repos from cron jobs.
  - Defaults to BOOST_WEBSITE_SHARED_DIR/data

UNZIP
  Unzip program to use to extract files from ZIPs.

ARCHIVE_FILE_PREFIX
  Prefix for the root directory in the Boost ZIP archives.

STATIC_DIR
  Path to static copies of boost.
  - Defaults to BOOST_WEBSITE_SHARED_DIR/archives/live

BOOST_REPOS_DIR
  Loction of local copies for develop and master super projects.
  Set them up using:
  git clone https://github.com/boostorg/boost.git -b master --depth=1 boost-master
  git clone https://github.com/boostorg/boost.git -b develop --depth=1 boost-develop
  And then git pull regularly.
  - Defaults to BOOST_WEBSITE_SHARED_DIR/repos

BOOST_TASKS_DIR
  Location of 'boost-tasks', a repo containing scripts for various things
  that the server needs to do. For the website user, the webhook
  implementation is the only thing of interest.
  - Defaults to BOOST_WEBSITE_SHARED_DIR/tasks
*/

switch (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '')
{
  case 'boost.org':
  case 'www.boost.org':
  case 'live.boost.org':
  case 'beta.boost.org':
  {
    define('BOOST_CONFIG_FILE','/home/www/shared/config.php');
  }
  break;

  default:
  {
    if (is_file(__DIR__.'/boost_config_local.php')) {
      define('BOOST_CONFIG_FILE',dirname(__FILE__) . '/boost_config_local.php');
    }
    else if (is_file('/home/www/shared/config.php')) {
      define('BOOST_CONFIG_FILE','/home/www/shared/config.php');
    }
    else {
      define('BOOST_CONFIG_FILE',false);
    }
  }
}

define('ARCHIVE_FILE_PREFIX', '');

if (BOOST_CONFIG_FILE) { require_once(BOOST_CONFIG_FILE); }

if(!function_exists('virtual'))
{
    function virtual($location) {
        echo '<!--#include virtual="', $location, '" -->';
    }
}

if (defined('BOOST_WEBSITE_SHARED_DIR')) {
    if (!defined('STATIC_DIR')) {
        define('STATIC_DIR', BOOST_WEBSITE_SHARED_DIR.'/archives/live');
    }

    if (!defined('BOOST_DATA_DIR')) {
        define('BOOST_DATA_DIR', BOOST_WEBSITE_SHARED_DIR.'/data');
    }

    if (!defined('BOOST_REPOS_DIR')) {
        define('BOOST_REPOS_DIR', BOOST_WEBSITE_SHARED_DIR.'/repos');
    }

    if (!defined('BOOST_TASKS_DIR')) {
        define('BOOST_TASKS_DIR', BOOST_WEBSITE_SHARED_DIR.'/tasks');
    }
}
