<?php

/*

---------------------------------------
License Setup
---------------------------------------

Please add your license key, which you've received
via email after purchasing Kirby on http://getkirby.com/buy

It is not permitted to run a public website without a
valid license key. Please read the End User License Agreement
for more information: http://getkirby.com/license

*/

c::set('license', 'K2-PERSONAL-d00f753545eef21bf8ca091bac9354ee');

/*

---------------------------------------
Kirby Configuration
---------------------------------------

By default you don't have to configure anything to
make Kirby work. For more fine-grained configuration
of the system, please check out http://getkirby.com/docs/advanced/options

*/

/*
---------------------------------------
Locale Setup
---------------------------------------

Sets the global locale setting for PHP
*/

c::set('locale', 'de_DE.UTF8');

/*
---------------------------------------
Routing Setup
---------------------------------------

Define Routes for Handling
*/

c::set('routes', array(
    array(
        'pattern' => 'logout',
        'action'  => function() {
            if ($user = site()->user()) {
                $user->logout();
            }
            go('/');
        }
    )
));