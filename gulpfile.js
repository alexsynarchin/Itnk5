var elixir = require('laravel-elixir');
var rename = require('gulp-rename');
var gulp = require('gulp');

/**
 * Copy any needed files.
 *
 * Do a 'gulp copyfiles' after bower updates
 */
gulp.task("copyfilesStyles", function() {
    gulp.src("vendor/bower_dl/bootstrap/less/**")
        .pipe(gulp.dest("resources/assets/less/bootstrap"));
        gulp.src("vendor/bower_dl/AdminLTE/build/less/**")
        .pipe(gulp.dest("resources/assets/less/AdminLte"));
    gulp.src("vendor/bower_dl/AdminLTE/build/bootstrap-less/**")
        .pipe(gulp.dest("resources/assets/less/bootstrap-less"));
});
gulp.task("copyfilesJs", function(){
    gulp.src("vendor/bower_dl/AdminLTE/dist/js/app.js")
        .pipe(gulp.dest("resources/assets/js/"));
    gulp.src("vendor/bower_dl/bootstrap/dist/js/bootstrap.js")
        .pipe(gulp.dest("resources/assets/js/"));
    gulp.src("vendor/bower_dl/jquery/dist/jquery.js")
        .pipe(gulp.dest("resources/assets/js/"));
    gulp.src("vendor/bower_dl/AdminLTE/plugins/datatables/jquery.dataTables.js")
        .pipe(gulp.dest("resources/assets/js/"));
    gulp.src("vendor/bower_dl/AdminLTE/plugins/datatables/dataTables.bootstrap.js")
        .pipe(gulp.dest("resources/assets/js/"));
});
/**
 * Default gulp is to run this elixir stuff
 */
elixir(function(mix){
    mix.scripts([
            'js/jquery.js',
            'js/bootstrap.js',
            'js/jquery.dataTables.js',
            'js/dataTables.bootstrap.js',
            'js/app.js'
        ],
        'public/assets/js/admin.js',
        'resources/assets'
    );
    mix.less('Admin.less', 'public/assets/css/admin.css');
});
