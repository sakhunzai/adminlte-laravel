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
   sourceMaps: !plugins.util.env.production,
   clean:{
        prod:{
            paths: [
                'public/{css,js}/**/*.map',
                'public/{css,js}/**/*(*.css|*.js)',
                '!public/{css,js}/**/*(*.min.css|*.min.js)',
                'public/img/admin-lte/{credit,landing,screenshots}',
                'public/img/admin-lte/profile/user*.*'
                ],
            options: { read: false }
        }       
   },
   js:{
 	input:[
       bower+'jquery/dist/jquery.js',
       bower+'jquery.localScroll/jquery.localScroll.js',
       bower+'jquery.scrollTo/jquery.scrollTo.js',
       assets+'js/**/*.js',
    ],
    output:'public/js'
   },      
   css:{
       input:[],
       less: [
           assets+'less/app.less',
           assets+'less/admin-lt*/AdminLTE.less',
           assets+'less/admin-lt*/sk*/*.less',
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
           src:[assets+'img/**'],
           dest:'public/img'
       },
       {
           src:[bower+'bootstrap/dist/fonts/**'],
           dest:'public/fonts'
       },      
       {
           src:[bower+'iCheck*/**'],
           dest:'public/plugins'
       }
  ] 
   
}

//Clean
gulp.task('clean',function(){  
    return gulp.src(config.clean.prod.paths)
        .pipe(plugins.clean(config.clean.prod.options))  
})


//Copy
gulp.task('copy',['clean'],function(){    
    config.copy.forEach(function(files){
        gulp.src(files.src)
          .pipe(gulp.dest(files.dest))
    })
})


// Scripts
gulp.task('scripts',['copy'], function(){
    
  return gulp.src(config.js.input)
    .pipe(config.sourceMaps ? plugins.sourcemaps.init() : plugins.util.noop())
    .pipe(plugins.uglify())
    .pipe(config.sourceMaps ? plugins.sourcemaps.write('.') : plugins.util.noop())
    .pipe(config.production ? plugins.rename({suffix: '.min'}) : plugins.util.noop())
    .pipe(gulp.dest(config.js.output));
    
});

// Styles
gulp.task('styles',['copy'],function() {   

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

