var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');
});


/*
	Lavorum Project
*/
var gulp = require('gulp');
var sass = require('gulp-sass');
var minify = require('gulp-minify');
var minifyCss = require('gulp-minify-css');
var rename = require('gulp-rename');
var autoprefix = require('gulp-autoprefixer');

gulp.task('styles', function(){
	gulp.src('./resources/assets/sass/style.scss', ['styles'])
	.pipe(sass().on('error', sass.logError))
	.pipe(gulp.dest('./public/css'))
	.pipe(minifyCss())
	.pipe(rename({suffix: '-min'}))
	.pipe(gulp.dest('./public/css'));
});

gulp.task('scripts', function(){
	gulp.src('./lib/**/*.js', ['scripts'])
	.pipe(minify())
	.pipe(gulp.dest('./js'));
});

gulp.task('default', function(){
	gulp.watch('./resources/assets/sass/style.scss', ['styles']);
	//gulp.watch('./lib/**/*.js', ['scripts']);
});
