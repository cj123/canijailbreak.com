var gulp    = require('gulp'),
minifycss   = require('gulp-minify-css'),
less        = require("gulp-less"),
runSequence = require('gulp-run-sequence');

var paths = {
    src: {
        less: "src/less/"
    },
    build: {
        css: "src/AppBundle/Resources/public/css"
    }
};

gulp.task("default", [ "watch" ]);

gulp.task("build", function() {
    runSequence([ "compile-less", "minify-css" ]);
});

gulp.task("watch", function() {
    gulp.start("build");

    gulp.watch(paths.src.less + "**/*.less", function() {
        gulp.start("compile-less");
    });
});

gulp.task('compile-less', function () {
    // build each site
    gulp.src(paths.src.less + 'styles.less')
    .pipe(less())
    .pipe(gulp.dest(paths.build.css));
});

gulp.task('minify-css', function () {
    gulp.src(paths.build.css + '**/*.css')
    .pipe(minifycss({
        keepSpecialComments: 0
    }))
    .pipe(gulp.dest(paths.build.css))
});
