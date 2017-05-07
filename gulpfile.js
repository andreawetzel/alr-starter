var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var reload      = browserSync.reload;
var sass        = require('gulp-sass');
var maps        = require('gulp-sourcemaps');
var rename      = require('gulp-rename');
var concat      = require('gulp-concat');
var postcss     = require('gulp-postcss');
var autoprefix  = require('autoprefixer');


// Watch scss AND html files, doing different things with each.
gulp.task('serve', function () {
    // Serve files from the root of this project
    browserSync.init({
        server: {
            baseDir: "./"
        }
    });

    gulp.watch("*.html").on("change", reload);
});

gulp.task('sassify', function(){
  var processors = [
    autoprefix
  ];
  return gulp.src('./sass/**/*.scss')
    .pipe(maps.init())
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(postcss(processors))
    .pipe(maps.write('./'))
    .pipe(gulp.dest('./css'))
    .pipe(browserSync.reload({
      stream: true
    }))
});

gulp.task('sass', function(){
  var processors = [
    autoprefix
  ];
  return gulp.src('./sass/**/*.scss')
    .pipe(maps.init())
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(postcss(processors))
    .pipe(maps.write('./'))
    .pipe(gulp.dest('./stylesheets'))
});


// Run 'gulp watch' to use Browser Sync and transpile CSS on file save
gulp.task('watch', ['serve', 'sassify'], function (){
  gulp.watch('./sass/**/*.scss', ['sassify']);
  gulp.watch('*.html', browserSync.reload);
});

// Run 'gulp sasswatch' to transpile CSS on file save
gulp.task('sasswatch',  function (){
  gulp.watch('./sass/**/*.scss', ['sass']);
});
