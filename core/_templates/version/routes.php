<?php

global $CORE_VERSION;

Router::route('method', 'route', "Controller@method");

Router::route('method', 'route/(\d+)', "Controller@method");

Router::execute( $CORE_VERSION );