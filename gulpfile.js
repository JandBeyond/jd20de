// VARIABLES
// const gulp = require('gulp');
const { watch, series, src, dest } = require('gulp');
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');
const sass = require('gulp-sass');
const cleanCSS = require('gulp-clean-css');
const autoprefixer = require('gulp-autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const browserSync = require('browser-sync').create();
const zip = require('gulp-zip');

// FILES
function getFiles() {
    return src('node_modules/normalize.css/normalize.css')
        .pipe(dest('css/'));
}

// SASS
function compileSass() {
    return src('css/template.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({ outputStyle: 'compressed' }))
        .pipe(autoprefixer())
        .pipe(sourcemaps.write())
        .pipe(dest('css/'));
}

// CSS
function prepareCss() {
    return src([
            'css/normalize.css',
            'css/fontawesome.css',
            'css/solid.css',
            'css/template.css'
        ])
        .pipe(sourcemaps.init())
        .pipe(concat('style.css'))
        .pipe(cleanCSS())
        .pipe(sourcemaps.write())
        .pipe(dest('build/'))
        .pipe(browserSync.stream());
}

// JS
function uglifyJavascript() {
    return src([
            'js/particles.js',
            'js/script.js'
        ])
        .pipe(sourcemaps.init())
        .pipe(uglify())
        .pipe(concat('app.js'))
        .pipe(sourcemaps.write())
        .pipe(dest('build/'))
        .pipe(browserSync.stream());
}

// ZIP
function zipTemplate() {
    return src([
        '**/*',
        '!node_modules/**',
        '!dist/**'
    ])
        .pipe(zip('jd20de.zip'))
        .pipe(dest('../'));
}

// SERVE
function serveSite() {
    browserSync.init({
        proxy: 'http://localhost/jd20de/'
    });
    watch('js/**/*.js', series(uglifyJavascript, zipTemplate));
    watch('css/**/*.scss', series(compileSass));
    watch('css/**/*.css', series(prepareCss, zipTemplate));
    watch('**/*.php', series(zipTemplate)).on('change', browserSync.reload);
}


// DEFAULT
exports.default = series(
    getFiles,
    compileSass,
    prepareCss,
    uglifyJavascript,
    zipTemplate,
//    serveSite
);
