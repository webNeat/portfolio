var gulp = require('gulp'),
    del = require('del'),
    connect = require('gulp-connect');

var config = require('../config.json');

// *** Watching all changes *** //
gulp.task('watch', ['watch:app']);

// *** Cleaning all *** //
gulp.task('clean', function(cb){
    del.sync(config.folders.build);
    cb(null);
});

// *** Building all *** //
gulp.task('build', ['vendors', 'app']);

// *** Local server *** //
gulp.task('serve', ['build'], function(){
    return connect.server({
        root: config.folders.build,
        // port: 8000,
        host: 'wn.dev',
        livereload: true
    });
});

// *** The default task *** //
gulp.task('default', ['clean'], function(){
    gulp.start('build', 'watch', 'serve');
});
