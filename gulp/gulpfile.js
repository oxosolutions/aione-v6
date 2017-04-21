var gulp = require('gulp');
var useref = require('gulp-useref');
var uglify = require('gulp-uglify');
var inject = require('gulp-inject');
var concat = require('gulp-concat'); 
var rename = require("gulp-rename");
var sass = require('gulp-sass');
/*gulp.task('inject', function(){
	var target = gulp.src('index.html');
	var sources = gulp.src(['../assets/js/*.js'], {read: false});
	 
	return target.pipe(inject(sources)).pipe(gulp.dest('./dist'));
});*/


gulp.task('minify', function() {  
    return gulp.src('./../assets/js/*.js')
        .pipe(concat('scripts.js'))
        .pipe(gulp.dest('./dist'))
        .pipe(rename('scripts.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./dist'));
});

gulp.task('sass', function(){
		return gulp.src('./../assets/scss/**/*.scss')
			.pipe(sass()) // Using gulp-sass
    		.pipe(gulp.dest('./dist/css'));
});