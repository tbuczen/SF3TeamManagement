'use strict';

var gulp = require('gulp'),
    folders = require('gulp-folders'),
    merge = require('merge-stream'),
    sass = require('gulp-sass'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    watch = require('gulp-watch'),
    hash_src = require("gulp-hash-src");


var pathToFolder = 'src';
var urlGulpPublic = '/Resources/public/gulp_files/';
var urlPublic = '/Resources/public/';

gulp.task('run-sass', folders(pathToFolder, function(folder){

    var sassV = gulp.src(pathToFolder+'/'+folder+'/'+urlGulpPublic+ 'sass/style.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(rename('style.css'))
        .pipe(gulp.dest(pathToFolder+'/'+folder+'/'+urlPublic+'css'))
        .pipe(hash_src({
            build_dir: pathToFolder+'/'+folder+'/'+urlPublic+'css/',
            src_path: pathToFolder + '/'+folder+'/'+urlPublic+'css/',
            query_name: 'v',
            exts: [".jpg", ".jpeg", ".png"]
        }))
        .pipe(gulp.dest(pathToFolder+'/'+folder+'/'+urlPublic+'css'));
    return merge(sassV);

}));

gulp.task('run-js', folders(pathToFolder, function(folder){
        var scriptsV = gulp.src([pathToFolder + '/' + folder + '/' + urlGulpPublic + 'js/script.js'])
            .pipe(concat('script.js'))
            .pipe(gulp.dest(pathToFolder + '/' + folder + '/' + urlPublic + 'js'))
            .pipe(rename('script.js'))
            .pipe(uglify())
            .pipe(gulp.dest(pathToFolder + '/' + folder + '/' + urlPublic + 'js'));
    return merge(scriptsV);

}));

var bundlesArray = ['/AppBundle', '/UserBundle'];

gulp.task('run-watch', function() {
    for(var i = 0; i < bundlesArray.length; i++){
        console.log(pathToFolder+bundlesArray[i]+urlGulpPublic);
        gulp.watch(pathToFolder+bundlesArray[i]+urlGulpPublic+'**/*.scss', ['run-sass']);
        gulp.watch(pathToFolder+bundlesArray[i]+urlGulpPublic+'**/*.js', ['run-js']);
    }
});

gulp.task('default', ['run-sass', 'run-js', 'run-watch']);