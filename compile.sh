#!/bin/sh

sassc resources/assets/sass/torino.scss public/css/torino.css
sassc resources/assets/sass/milano.scss public/css/milano.css
sassc resources/assets/sass/valsusa.scss public/css/valsusa.css
rm -f public/css/builds/*
