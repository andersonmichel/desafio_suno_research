const gulp = require('gulp');
const sass = require('gulp-sass');
const imagemin = require('gulp-imagemin');
const concat = require('gulp-concat');
//const terser = require('gulp-terser');
const minify = require('gulp-minify');
const cleanCss = require('gulp-clean-css');
const cssnano = require('gulp-cssnano');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');

function jsTask () {	
	return gulp.src('./assets/js/**/*.js')
    .pipe(concat('bundle.js'))
    .pipe(minify())
	.pipe(gulp.dest('./dist/js'));
};

function cssTask () {
    return gulp.src('./assets/sass/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(cssnano())
    .pipe(concat('stylesheet.css'))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('./dist/css/'));
};

function imgTask () {	
	return gulp.src("./assets/img/*")
    .pipe(imagemin())
    .pipe(gulp.dest("./dist/img"));
};

function watchTask(){
    gulp.watch(['./assets/js/**/*.js'], { interval: 1000 }, jsTask);
    gulp.watch(['./assets/sass/**/*.scss'], { interval: 1000 }, cssTask);
    gulp.watch(['./assets/img/*'], { interval: 1000 }, imgTask);
}

exports.js = jsTask;
exports.css = cssTask;
exports.img = imgTask;
exports.watch = watchTask;
exports.default = gulp.parallel(jsTask, cssTask, imgTask);