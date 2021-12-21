const gulp = require('gulp');
var sass = require('gulp-sass')(require('sass'));

// Task for Coverting SASS to CSS
gulp.task('sass', async function() {
  return gulp.src('./assets/sass/*.scss')    
  .pipe(sass())
  .pipe(gulp.dest('./assets/css/'));
});

// Task 2 : Watch Taks

gulp.task('watch', async function() {
  gulp.watch('./assets/sass/*.scss', gulp.series('sass'));
});
