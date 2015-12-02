var gulp      = require('gulp'),
    rename    = require('gulp-rename'),     // Renommage des fichiers
    sass      = require('gulp-sass'),       // Conversion des SCSS en CSS
    minifyCss = require('gulp-minify-css'), // Minification des CSS
    uglify    = require('gulp-uglify'),     // Minification/Obfuscation des JS
  	notify = require("gulp-notify"),
    concat = require('gulp-concat'),
    pngquant = require('imagemin-pngquant'),
    imagemin = require('gulp-imagemin'),
    jshint = require('gulp-jshint'),
    map = require('map-stream'),
    csslint = require('gulp-csslint'),
    plumber = require('gulp-plumber'),
    ngmin = require('gulp-ngmin');


gulp.task('angular', function()
{
  return gulp.src('web/js/angular.js')    // Prend en entrée les fichiers *.src.js
      .pipe(concat('angular.min.js'))
      .pipe(ngmin({dynamic: true}))
  .pipe(gulp.dest('web/dist/js/'))
    .pipe(notify("Finish GENERAL ANGULAR!"));
});


gulp.task('generaljs', function()
{
  return gulp.src('web/js/general.js')    // Prend en entrée les fichiers *.src.js
    .pipe(rename(function(path){
      // Il y a différentes méthodes pour renommer les fichiers
      // Voir ici pour plus d'infos : https://www.npmjs.org/package/gulp-rename
      path.basename = path.basename.replace(".src", ".min");
    }))
      .pipe(plumber())
      .pipe(jshint())
    .pipe(jshint.reporter('default', { verbose: true }))
    .pipe(concat('general.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('web/dist/js/'))
    .pipe(notify("Finish GENERAL JS!"));
});


gulp.task('js', function()
{
  return gulp.src('web/js/main.js')    // Prend en entrée les fichiers *.src.js
    .pipe(rename(function(path){
      // Il y a différentes méthodes pour renommer les fichiers
      // Voir ici pour plus d'infos : https://www.npmjs.org/package/gulp-rename
      path.basename = path.basename.replace(".src", ".min");
    }))
      .pipe(plumber())
      .pipe(jshint())
    .pipe(jshint.reporter('default', { verbose: true }))
    .pipe(concat('main.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('web/dist/js/'))
    .pipe(notify("Finish JS!"));
});


gulp.task('sass', function() {
return gulp.src('web/sass/*.sass')    // Prend en entrée les fichiers *.scss
    .pipe(plumber())
    .pipe(sass())
    .pipe(concat('mainsass.min.css'))
    .pipe(minifyCss())                 // Minifie le CSS qui a été généré
    .pipe(gulp.dest('web/dist/css'))  // Sauvegarde le tout dans /src/style
  .pipe(notify("Finish SASS!"));

});

gulp.task('images', function()  {
    return gulp.src('web/images/*')
        .pipe(plumber())

        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
        .pipe(notify("Finish IMAGES!"))
        .pipe(gulp.dest('web/dist/images'));
});

gulp.task('css', function() {
return gulp.src('web/css/*.css')    // Prend en entrée les fichiers *.scss
    .pipe(plumber())
    .pipe(csslint())
    .pipe(csslint.reporter())
    .pipe(concat('main.min.css'))
    .pipe(minifyCss())                 // Minifie le CSS qui a été généré
    .pipe(gulp.dest('web/dist/css'))  // Sauvegarde le tout dans /src/style
	.pipe(notify("Finish CSS!"));

});





// WATCH TASK
gulp.task('watch', function()
{
  //gulp.watch('web/css/*.css', ['css']);
  //gulp.watch('web/sass/*.sass', ['sass']);
  //gulp.watch('web/images/*', ['images']);
  gulp.watch('web/js/general.js', ['generaljs']);
  gulp.watch('web/js/angular.js', ['angular']);
});


//default : watch
gulp.task('default', ['watch']);
