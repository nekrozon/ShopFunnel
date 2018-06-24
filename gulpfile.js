var gulp = require('gulp'),
    merge = require('merge-stream'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    strip = require('gulp-strip-comments'),
    sourcemaps = require('gulp-sourcemaps'),
    less = require('gulp-less'),
    filter = require('gulp-filter'),
    minifyCss = require('gulp-minify-css');

var appJsPaths = [
    './src/Front/Angular/**/*.js'
]
lessFiles = [
    './src/Front/Less/variables.less',
    './src/Front/Less/custom-bootstrap.less',
    './src/Front/Less/style.less',
    './src/Front/Less/loading-bar.less'
],
    npmJsPaths = [
        './node_modules/jquery/dist/jquery.min.js',
        './node_modules/jquery-ui-sortable/jquery-ui.min.js',
        './node_modules/angular/angular.js',
        './node_modules/angular-ui-bootstrap/dist/ui-bootstrap.js',
        './node_modules/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js',
        './node_modules/bootstrap/dist/js/bootstrap.min.js',
        './node_modules/angular-animate/angular-animate.min.js',
        './node_modules/moment/min/moment-with-locales.min.js',
        './node_modules/angular-filter/dist/angular-filter.min.js',
        './node_modules/angular-ui-router/release/angular-ui-router.js',
        './node_modules/angular-resource/angular-resource.js',
        './node_modules/ng-table/bundles/ng-table.js',
        './node_modules/angular-google-chart/ng-google-chart.js',
        './node_modules/toastr/build/toastr.min.js',
        './node_modules/angular-ui-sortable/dist/sortable.js',
        './node_modules/checklist-model/checklist-model.js',
        './node_modules/angular-loading-bar/build/loading-bar.js',
        './node_modules/jquery-validation/dist/jquery.validate.min.js',
        './node_modules/ng-table-excel-export/ng-table-excel-export.js',
        './node_modules/angular-aria/angular-aria.min.js',
        './node_modules/angular-messages/angular-messages.min.js',
        './node_modules/angular-material/angular-material.min.js',
        './node_modules/clipboard/dist/clipboard.min.js',
        './node_modules/ngclipboard/dist/ngclipboard.min.js'
    ],
    npmCssPaths = [
        './node_modules/bootstrap/dist/css/bootstrap.min.css',
        './node_modules/angular-ui-bootstrap/dist/ui-bootstrap-csp.css',
        './node_modules/font-awesome/css/font-awesome.min.css',
        './node_modules/ng-table/bundles/ng-table.css',
        './node_modules/toastr/build/toastr.css',
        './node_modules/angular-loading-bar/build/loading-bar.css',
        './node_modules/material-design-icons/iconfont/material-icons.css',
        './node_modules/angular-material/angular-material.min.css'
    ],
    npmFontsPaths = [
        './node_modules/font-awesome/fonts/**',
        './node_modules/bootstrap/fonts/**',
        './node_modules/material-design-icons/**'
    ],
    buildPath = './src/Public',
    fontsBuildPaths = './src/Public/fonts';

gulp.task('app-dev', function() {
    var appJsStream = gulp.src(appJsPaths)
            .pipe(concat('main.js'))
            .pipe(uglify({mangle: false}).on('error', function(e) { console.log('\x07',e.message); return this.end(); }))
            .pipe(gulp.dest(buildPath + '/js')),
        appLessStream = gulp.src(lessFiles)
            .pipe(concat('main.css'))
            .pipe(less().on('error', function(e) { console.log('\x07',e.message); return this.end(); }))
            .pipe(gulp.dest('src/Front/Style')),
        appMoveCssMapStream = gulp.src('src/Front/Style/*.css')
            .pipe(concat('main.css'))
            .pipe(minifyCss().on('error', function(e) { console.log('\x07',e.message); return this.end(); }))
            .pipe(gulp.dest(buildPath + '/css'));
    return merge(appJsStream, appLessStream, appMoveCssMapStream);
});

gulp.task('app-prod', function() {
    var appJsStream = gulp.src(appJsPaths)
            .pipe(concat('main.js'))
            .pipe(uglify({mangle: false}).on('error', function(e) { console.log('\x07',e.message); return this.end(); }))
            .pipe(gulp.dest(buildPath + '/js')),
        appLessStream = gulp.src(lessFiles)
            .pipe(concat('main.css'))
            .pipe(less().on('error', function(e) { console.log('\x07',e.message); return this.end(); }))
            .pipe(gulp.dest('src/Front/Style')),
        appMoveCssMapStream = gulp.src('src/Front/Style/*.css')
            .pipe(concat('main.css'))
            .pipe(minifyCss().on('error', function(e) { console.log('\x07',e.message); return this.end(); }))
            .pipe(gulp.dest(buildPath + '/css'));
    return merge(appJsStream, appLessStream, appMoveCssMapStream);
});

gulp.task('less', function() {
    appLessStream = gulp.src(lessFiles)
        .pipe(concat('main.css'))
        .pipe(minifyCss().on('error', function(e) { console.log('\x07',e.message); return this.end(); }))
        .pipe(gulp.dest(buildPath + '/css'));
    return merge( appLessStream );
});

gulp.task('vendor', function() {
    var vendorJsStream = gulp.src(npmJsPaths)
            .pipe(sourcemaps.init())
            .pipe(concat('vendor.js'))
            .pipe(strip())
            .pipe(sourcemaps.write('.'))
            .pipe(gulp.dest(buildPath + '/js')),
        vendorCssStream = gulp.src(npmCssPaths)
            .pipe(sourcemaps.init())
            .pipe(concat('vendor.css'))
            .pipe(sourcemaps.write('.'))
            .pipe(gulp.dest(buildPath + '/css')),
        vendorFontsStream = gulp.src(npmFontsPaths)
            .pipe(gulp.dest(fontsBuildPaths));
    return merge(vendorJsStream, vendorCssStream, vendorFontsStream);
});

gulp.task('watch', ['app-dev', 'less'], function() {
    gulp.watch(appJsPaths, appLessStream ['app-dev']);
});
