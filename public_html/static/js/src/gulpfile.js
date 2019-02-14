const { src, dest, parallel } = require('gulp');

// const less = require('gulp-less');
// const minifyCSS = require('gulp-csso');
const concat = require('gulp-concat');

// function css() {
//   return src('client/templates/*.less')
//     .pipe(less())
//     .pipe(minifyCSS())
//     .pipe(dest('build/css'))
// }

function js() {
  return src('client/javascript/*.js', { sourcemaps: true })
    .pipe(concat('app.min.js'))
    .pipe(dest('build/js', { sourcemaps: true }))
}

exports.js = js;
// exports.css = css;

exports.default = parallel(js);