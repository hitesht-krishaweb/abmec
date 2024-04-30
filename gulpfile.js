var fs = require('fs');
var path = require('path');
var gulp = require('gulp');
var sass = require('gulp-sass');
var gutil = require('gulp-util');
var plumber = require('gulp-plumber');
var notify = require('gulp-notify');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var uglify = require("gulp-uglify");
var concat = require("gulp-concat");
var sourcemaps = require("gulp-sourcemaps");
var cleanCSS = require("gulp-clean-css");
var order = require("gulp-order");
var image = require('gulp-image');
var newer = require("gulp-newer");
var babel = require("gulp-babel");
var eslint = require('gulp-eslint');
var browserSync = require('browser-sync');
var workbox = require('workbox-build');
var critical = require('critical');
var reload = browserSync.reload;

/*
 * Source paths
 */
var js_source = ['!./src/js/loadmore.js' ,'./src/js/*.js'];
var js_vendor_source = './src/js/vendor/*.js';
var js_dest = './assets/js';
var scss_source = './src/scss/**/*.scss';
var scss_dest = './assets/css';
var img_source = './src/images/**/*.{jpeg,jpg,png,gif,svg}';
var img_dest = './assets/images';

/*
 * Compiling JS
 */
gulp.task('js-compile', function () {
    return gulp.src(js_source)
        .pipe(order([
            'js/helpers.js',
            'js/*.js',
            'js/main.js',
        ], { base: '.' }))
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(babel({
            presets: ["env"]
        }))
        .pipe(uglify())
        .pipe(concat('main.min.js'))
        .pipe(sourcemaps.write('/maps'))
        .pipe(gulp.dest(js_dest));
});

gulp.task('js-vendor-compile', function () {
    gulp.src(js_vendor_source)
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(uglify())
        .pipe(concat('plugins.min.js'))
        .pipe(sourcemaps.write('/maps'))
        .pipe(gulp.dest(js_dest))
        .pipe(reload({ stream: true }));
});

/*
 * Linting JS
 */
function jsLint() {
    var reportErrors = function (details) {
        var messages = details.eslint.messages;
        var messagesLength = details.eslint.messages.length;
        var errorMessages = '';

        // stop if there are no messages
        if (messagesLength === 0) return;

        // loop through array of messages
        for (var error of messages) {
            errorMessages += error.message + ' ';
        }

        // send message to user
        return notify.onError({
            title: 'JavaScript error',
            message: 'Location: ' + details.relative + ' ' + errorMessages,
            sound: true
        })(details);
    };

    return gulp.src(js_source)
        // .pipe(changedInPlace({
        //     howToDetermineDifference: 'modification-time'
        // }))
        .pipe(eslint({
            rules: {
                'no-use-before-define': ['error', {'functions': false, 'classes': true}],
                'no-unused-vars': 0,
                'no-undef': 0,
                'no-prototype-builtins': 0
            },
            envs: [
                'browser'
            ],
            fix: true,
            configFile: './src/linter/.eslintrc',
            useEslintrc: true
        }))
        //.pipe(plumber())
        .pipe(eslint.format())
        .pipe(eslint.results(function (results) {
            // Called once for all ESLint results.
            console.log('');
            console.log('Total Results:' + results.length);
            console.log('Total Warnings:' + results.warningCount);
            console.log('Total Errors:' + results.errorCount);
            console.log('');

            if (results.errorCount === 0) {
                gulp.start('js-compile');
            }
        }));
}

gulp.task('js-lint', jsLint);

/*
 * Compiling SCSS
 */
gulp.task('css-compile', function () {
    return gulp.src(['./src/scss/main.scss'])
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(sass()).on('error', function(err) {
            sass.logError.bind(this)(err);
        })
        .pipe(postcss([autoprefixer()]))
        .pipe(concat('main.min.css'))
        .pipe(cleanCSS({ compatibility: 'ie8' }))
        .pipe(sourcemaps.write('/maps'))
        .pipe(gulp.dest(scss_dest));
});

/*
 * Critical CSS
 */
// gulp.task('critical-css', ['default'], function (cb) {
//     critical.generate({
//         inline: false,
//         base: './assets/',
//         pathPrefix: '/assets',
//         src: 'http://www..local/',
//         css: ['./assets/css/main.min.css'],
//         dest: './assets/css/critical.min.css',
//         ignore: ['svg[class]', '@font-face']
//     });
// });


/*
 * Optimizing images
 */
gulp.task('img-optimize', function(){
    gulp.src(img_source)
        .pipe(newer(img_dest))
        .pipe(image({
            pngquant: true,
            optipng: false,
            zopflipng: true,
            jpegRecompress: false,
            jpegoptim: true,
            mozjpeg: true,
            gifsicle: true,
            svgo: false //disabled svgo for now, outputs an error. use https://jakearchibald.github.io/svgomg/ for manually optimizing svgs
        }))
        .pipe(gulp.dest(img_dest));
});

/*
 * Generate Service worker
 */
// gulp.task('generate-service-worker', () => {
//     var rootDir = '../';

//     return workbox.generateSW({
//         globDirectory: rootDir,
//         globPatterns: ['Assets/**/*.{js,css,png,jpg,gif}'],
//         swDest: '../sw.js',
//         clientsClaim: true,
//         skipWaiting: true
//     }).then(() => {
//         console.info('Service worker generation completed.');
//       }).catch((error) => {
//         console.warn('Service worker generation failed: ' + error);
//       });
// });

/*
 * Watch & Default
 */
gulp.task('watch', function () {
    // browserSync.init({
    //     proxy: {
    //         target: "http://www..local" // Add local URL Here
    //     },
    //     notify: false
    // });

    gulp.watch([js_source], ['js-lint']).on('error', gutil.log).on('change', browserSync.reload);
    gulp.watch([js_vendor_source], ['js-vendor-compile']).on('error', gutil.log).on('change', browserSync.reload);
    gulp.watch([scss_source], ['css-compile']).on('error', gutil.log).on('change', browserSync.reload);
});

gulp.task('default', ['watch']);
