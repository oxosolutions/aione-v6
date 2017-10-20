var gulp = require('gulp');
var useref = require('gulp-useref');
var uglify = require('gulp-uglify');
var inject = require('gulp-inject');
var concat = require('gulp-concat'); 
var rename = require("gulp-rename");
var sass = require('gulp-sass');
var order = require('gulp-order');
/*gulp.task('inject', function(){
	var target = gulp.src('index.html');
	var sources = gulp.src(['../assets/js/*.js'], {read: false});
	 
	return target.pipe(inject(sources)).pipe(gulp.dest('./dist'));
});*/

//var mainjs = './../assets/js/main.js';
//var mainjsmin = './../assets/js/main.min.js';



gulp.task('build', function() {  
    return gulp.src(['./../assets/js/*.js','!./../assets/js/main.js','!./../assets/js/main.min.js'])
		.pipe(order([
			"../assets/js/bootstrap.js",
			"../assets/js/cssua.js",
			"../assets/js/jquery.easyPieChart.js",
			"../assets/js/excanvas.js",
			"../assets/js/Froogaloop.js",
			"../assets/js/imagesLoaded.js",
			"../assets/js/jquery.infinitescroll.js",
			"../assets/js/isotope.js",
			"../assets/js/jquery.appear.js",
			"../assets/js/jquery.touchSwipe.js",
			"../assets/js/jquery.carouFredSel.js",
			"../assets/js/jquery.countTo.js",
			"../assets/js/jquery.countdown.js",
			"../assets/js/jquery.cycle.js",
			"../assets/js/jquery.easing.js", 
			
			
			
			
			"../assets/js/modernizr.js",
			"../assets/js/aione-bbpress.js",
			"../assets/js/aione-events.js",
			"../assets/js/aione-header.js",
			"../assets/js/aione-lightbox.js",
			"../assets/js/aione-nicescroll.js",
			"../assets/js/aione-parallax.js",
			"../assets/js/aione-select.js",
			"../assets/js/aione-video-bg.js",
			"../assets/js/aione-woocommerce.js",
			
			
			"../assets/js/external_plugins.js",
			
			"../assets/js/html5shiv.js",
			"../assets/js/ilightbox.js",
			
			
			
			
			"../assets/js/jquery.elasticslider.js",
			"../assets/js/jquery.fitvids.js",
			"../assets/js/jquery.flexslider.js",
			"../assets/js/jquery.hoverflow.js",
			"../assets/js/jquery.hoverIntent.js",
			
			"../assets/js/jquery.mousewheel.js",
			"../assets/js/jquery.nicescroll.js",
			"../assets/js/jquery.oxo_maps.js",
			"../assets/js/jquery.placeholder.js",
			"../assets/js/jquery.requestAnimationFrame.js",
			"../assets/js/jquery.toTop.js",
			
			"../assets/js/jquery.waypoints.js",
			"../assets/js/respond.js",
			"../assets/js/typed.js",
			"../assets/js/bigSlide.js",
			"../assets/js/theme.js",
			"../assets/js/wc-cart-fragments.js"
		],{ base: './' }))
        .pipe(concat('main.js'))
        .pipe(gulp.dest('./../assets/js/'))
        .pipe(rename('main.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./../assets/js/'));
});

gulp.task('sass', function(){
		return gulp.src('./../assets/scss/**/*.scss')
			.pipe(sass()) // Using gulp-sass
    		.pipe(gulp.dest('./dist/css'));
});


gulp.task('makejs', function() {  
    return gulp.src('dist/*.js')
		.pipe(order([
			"dist/b.js",
			"dist/a.js"
		],{ base: './' }))
        .pipe(concat('main.js'))
        .pipe(gulp.dest('dist/'))
        .pipe(rename('main.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('dist/'));
});

// Default Task
gulp.task('default', ['build']);