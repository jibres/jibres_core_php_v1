const gulp          = require('gulp');
const gp_concat     = require('gulp-concat');
const gp_rename     = require('gulp-rename');
const gp_uglify     = require('gulp-uglify');
const gp_sourcemaps = require('gulp-sourcemaps');


gulp.task('js-do', function()
{
  return gulp.src('src/*.js')
    .pipe(gp_sourcemaps.init())
    .pipe(gp_concat('concat.js'))
    .pipe(gulp.dest('dist'))
    .pipe(gp_rename('uglify.js'))
    .pipe(gp_uglify())
    .pipe(gp_sourcemaps.write('./'))
    .pipe(gulp.dest('dist'));
});

gulp.task('default', ['js-do'], function(){});
