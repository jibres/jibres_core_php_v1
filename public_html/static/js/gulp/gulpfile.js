const { src, dest, parallel } = require('gulp');

const gulp          = require('gulp');
const gp_concat     = require('gulp-concat');
const gp_rename     = require('gulp-rename');
const gp_uglify     = require('gulp-uglify');
const gp_sourcemaps = require('gulp-sourcemaps');


function storePanelJS()
{
  return src('src/storePanel/*.js')
    // create uncompressed file
    .pipe(gp_sourcemaps.init())
    .pipe(gp_concat('storePanel.uncompressed.js'))
    .pipe(dest('dist'))

    // compress it
    .pipe(gp_rename('storePanel.js'))
    .pipe(gp_uglify())
    .pipe(gp_sourcemaps.write('./'))
    .pipe(dest('dist'))

    // copy to js folder
    .pipe(dest('../'))

    // .pipe(gp_sourcemaps.init())
    // .pipe(gp_concat('concat.js'))
    // .pipe(gulp.dest('dist'))
    // .pipe(gp_rename('uglify.js'))
    // .pipe(gp_uglify())
    // .pipe(gp_sourcemaps.write('./'))
    // .pipe(gulp.dest('dist'));
}


exports.js = storePanelJS;
// exports.default = parallel(storePanelJS);

exports.default = storePanelJS;
