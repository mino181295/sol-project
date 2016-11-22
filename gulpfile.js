//Required
var gulp 	= require('gulp'),
	uglify 	= require('gulp-uglify'),
	sass 	= require('gulp-sass'),
	rename 	= require('gulp-rename'),
	browserSync = require('browser-sync'),
	reload 	= browserSync.reload,
	plumber = require('gulp-plumber');

//Script task
gulp.task('scripts', function(){
	gulp.src(['app/js/**/*.js', '!app/js/**/*min.js'])
		.pipe(plumber())
		.pipe(rename({suffix:'.min'}))
		.pipe(uglify())
		.pipe(gulp.dest('app/js'));
});

//Sass tasks

//Html task
gulp.task('html', function(){
	gulp.src('app/**/*.html')
		.pipe(reload({stream:true}));
});

gulp.task('sass', function () {
  	 gulp.src('app/scss/**/*.scss')
  	 	 .pipe(plumber())
    	 .pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError))
    	 .pipe(gulp.dest('app/css'))
    	 .pipe(reload({stream:true}));
});


//BrowserSync task
gulp.task('browser-sync', function(){
	browserSync({
		server:{
			baseDir: "./app/"
		}
	});
});

//Watch tasks
gulp.task('watch', function(){
	gulp.watch('app/js/**/*.js', ['scripts']);
	gulp.watch('app/**/*.html', ['html']);
	gulp.watch('app/**/*.scss', ['sass']);
});

//Default task
gulp.task('default', ['scripts','html','sass', 'browser-sync', 'watch']);
