var gulp         = require('gulp'),
    del          = require('del'),
    changed      = require('gulp-changed'),
    imagemin     = require('gulp-imagemin'),
    sass         = require('gulp-sass'),
    sourcemaps   = require('gulp-sourcemaps'),
    autoprefixer = require('gulp-autoprefixer'),
    concat       = require('gulp-concat'),
    uglifycss    = require('gulp-uglifycss'),
    livereload   = require('gulp-livereload'),
    scsslint     = require('gulp-scss-lint');

var config = {
  sass: {
    source: './build/scss/**/*.scss',
    dest: './public/assets/css',
  },
  img: {
    source: './build/img/*',
    dest: './public/assets/img',
  }
}

gulp.task('default', function() {
  // place code for your default task here
});

gulp.task('img', function() {
  return gulp.src(config.img.source)
    .pipe(changed(config.img.dest))
    .pipe(imagemin())
    .pipe(gulp.dest(config.img.dest));
});

gulp.task('sass-lint', function() {
  return gulp.src(config.sass.source)
    .pipe(scsslint({
      'config': 'sass-lint.yml',
    }));
});

gulp.task('sass', ['sass-lint'], function () {
  gulp.src(config.sass.source)
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(concat('main.css'))
    .pipe(autoprefixer({ browsers: [
                          '> 1%',
                          'last 2 versions',
                          'firefox >= 4',
                          'safari 7',
                          'safari 8',
                          'IE 8',
                          'IE 9',
                          'IE 10',
                          'IE 11'
                        ],
                        cascade: false }))
    .pipe(uglifycss({
      "uglyComments": true
    }))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest(config.sass.dest))
    .pipe(livereload());
});

gulp.task('watch', function() {
  livereload.listen();
  gulp.watch(config.sass.source, ['sass']);
  gulp.watch(config.img.source, ['img']);
});
