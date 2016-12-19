//Required
var gulp = require('gulp'),
    uglify = require('gulp-uglify'),
    sass = require('gulp-sass'),
    rename = require('gulp-rename'),
    browserSync = require('browser-sync'),
    reload = browserSync.reload,
    plumber = require('gulp-plumber');

//Html task
gulp.task('html', function () {
    gulp.src('app/**/*.html')
        .pipe(reload({
            stream: true
        }));
});

gulp.task('css', function () {
    gulp.src('app/**/*.css')
        .pipe(reload({
            stream: true
        }));
});

//BrowserSync task
gulp.task('browser-sync', function () {
    browserSync({
        server: {
            baseDir: "./app/"
        }
    });
});

//Watch tasks
gulp.task('watch', function () {
    gulp.watch('app/**/*.html', ['html']);
    gulp.watch('app/**/*.css', ['css']);
});

//Default task
gulp.task('default', ['html', 'browser-sync', 'watch']);
