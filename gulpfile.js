/*
 Gulp Plugins:
    load-plugins,less,util,concat,cssnano,uglify,notify,replace,autoprefixer,sourcemaps,minify
 Other Plugins:
    path 
*/
var gulp = require('gulp');
var path = require('path');
var plugins = require('gulp-load-plugins')();

var bower  =  'bower_components/';
var assets =  'resources/assets/';
var config = {
   production: !!plugins.util.env.production,
   sourceMaps: false,//!plugins.util.env.production,
   clean:{
        prod:{
            paths: ['public/{/js,/css,/fonts}/**'],
            options: { read: false }
        }       
   },
   js:{
 	input:[],
    output:'public/js'
   },      
   css:{
       input:[],
       less: [
           assets+'less/app.less',
           assets+'less/admin-lte/AdminLTE.less',
           assets+'less/admin-lte/sk*/*.less',
           bower+'bootstrap/less/bootstrap.less'
       ],
       cssnano:{
           options:{
               discardComments: { removeAll: false },
               autoprefixer: false,
               safe: true
           }
       },
       autoprefix:{
           enable: true,
           options:{
           	   browsers: ['last 2 versions'],
           	   cascade: false
           }
       },
       output:'public/css' 
   },
   copy:[
       {
           src:[bower+'bootstrap/font*/**'],
           dest:'public'
       },
       {
           src:[bower+'jquery{,*}/dist/*.min.js'],
           dest:'public/plugins'
       },
       {
           src:[bower+'iCheck*/*'],
           dest:'public/plugins'
       }
  ] 
   
}

//Clean
gulp.task('clean',function(){
    return gulp.src(config.production ? config.clean.prod.paths : [])
        .pipe(plugins.clean(config.clean.prod.options))  
})


//Copy
gulp.task('copy',function(){    
    config.copy.forEach(function(files){
        gulp.src(files.src)
          .pipe(gulp.dest(files.dest))
    })
})


// Scripts
gulp.task('scripts',['clean'], function(){
    
  return gulp.src(config.js.input)
    .pipe(config.sourceMaps ? plugins.sourcemaps.init() : plugins.util.noop())
    .pipe(plugins.uglify())
    .pipe(config.sourceMaps ? plugins.sourcemaps.write('.') : plugins.util.noop())
    .pipe(config.production ? plugins.rename({suffix: '.min'}) : plugins.util.noop())
    .pipe(gulp.dest(config.js.output));
    
});

// Styles
gulp.task('styles',['clean','copy'],function() {   

  return gulp.src(config.css.less)    
    .pipe(config.sourceMaps ? plugins.sourcemaps.init() : plugins.util.noop())
    .pipe(plugins.less({paths: [bower] } ))
    .pipe(config.css.autoprefix.enable ? plugins.autoprefixer(config.css.autoprefix.options) :  plugins.util.noop())
    .pipe(config.sourceMaps ? plugins.sourcemaps.write('.') : plugins.util.noop())    
    .pipe(config.production ? plugins.cssnano(config.css.cssnano.options) : plugins.util.noop())
    .pipe(config.production ? plugins.rename({suffix : '.min'}) : plugins.util.noop())
    .pipe(gulp.dest(config.css.output))
    .pipe(plugins.notify({ message: 'Styles task complete' }));
    
});


// Watch
gulp.task('watch', function(){
 
  gulp.watch(config.css.less, ['styles']);

  gulp.watch(config.js.input, ['scripts']);

});

gulp.task('default', ['scripts', 'styles']);

