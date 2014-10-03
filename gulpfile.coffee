'use strict'

gulp = require 'gulp'
fixmyjs = require 'gulp-fixmyjs'

gulp.task 'fixmyjs', ->
  gulp.src 'public/assets/js/*.js'
    .pipe fixmyjs()
    .pipe gulp.dest 'public/assets/js/'

gulp.task 'default', ->
  gulp.watch 'public/assets/js/*.js', ['fixmyjs']
