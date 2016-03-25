var gulp = require('gulp');
var less = require('gulp-less');
var path = require('path');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var notify = require('gulp-notify');
var replace = require('gulp-replace');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');

var bower  =  'bower_components/';
var assets =  'resources/assets/';

var paths = {
   scripts:{
 	input:[],
       output:'public/js'
   },
   less: [
       assets+'less/app.less',
       assets+'less/admin-lte/AdminLTE.less',
       assets+'less/admin-lte/sk*/*.less',
       bower+'bootstrap/less/bootstrap.less'    
   ],
   styles:{
       input:[],
       output:'public/css'
   }  
}

// Scripts
gulp.task('scripts',function(){
  return gulp.src(paths.scripts.input)
    .pipe(sourcemaps.init())
    .pipe(uglify())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(paths.scripts.output));
});

// Styles
gulp.task('styles', function() {
  return gulp.src(paths.less)    
    .pipe(sourcemaps.init())
    .pipe(less({paths: [bower] } ))
    .pipe(autoprefixer({
		browsers: ['last 2 versions'],
		cascade: false
	 }))
    .pipe(sourcemaps.write('.'))    
    .pipe(gulp.dest(paths.styles.output))    
    .pipe(notify({ message: 'Styles task complete' }));
});

// Watch
gulp.task('watch', function(){
  
  gulp.watch(paths.styles.less, ['styles']);

  gulp.watch(paths.scripts.input, ['scripts']);

});

gulp.task('default', ['scripts', 'styles']);

