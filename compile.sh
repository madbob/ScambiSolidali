#!/bin/sh

sass resources/assets/sass/torino.scss public/css/torino.css
sass resources/assets/sass/milano.scss public/css/milano.css
sass resources/assets/sass/valsusa.scss public/css/valsusa.css
sass resources/assets/sass/trentino.scss public/css/trentino.css
rm -f public/css/builds/*
