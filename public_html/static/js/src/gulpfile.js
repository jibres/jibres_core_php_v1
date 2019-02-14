const { src, dest, parallel } = require('gulp');

const gulp          = require('gulp');
const gp_concat     = require('gulp-concat');
const gp_rename     = require('gulp-rename');
const gp_uglify     = require('gulp-uglify');
const gp_sourcemaps = require('gulp-sourcemaps');


function js()
{
  return src('src/*.js', { sourcemaps: true })
    .pipe(gp_concat('app.min.js'))
    .pipe(dest('build/js', { sourcemaps: true }))
    .pipe(gp_rename('uglify.js'))
    .pipe(gp_uglify())
    .pipe(dest('dist'))

    // .pipe(gp_sourcemaps.init())
    // .pipe(gp_concat('concat.js'))
    // .pipe(gulp.dest('dist'))
    // .pipe(gp_rename('uglify.js'))
    // .pipe(gp_uglify())
    // .pipe(gp_sourcemaps.write('./'))
    // .pipe(gulp.dest('dist'));
}


exports.js = js;

exports.default = parallel(js);

