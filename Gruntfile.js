module.exports = function (grunt) {
    'use strict';
    // Project configuration
    grunt.initConfig({
      // Metadata
      pkg: grunt.file.readJSON('package.json'),
      banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
          '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
          '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
          '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;*/\n',
      // Task configuration
      concat: {
          options: {
              banner: '<%= banner %>',
              stripBanners: true
          },
          dist: {
              src: ['public/js/src/namespace.js',
                    'public/js/src/modules/*.js',
                    'public/js/src/init.js'],
              dest: 'public/js/quiz.js'
          }
      },
      uglify: {
          options: {
              banner: '<%= banner %>'
          },
          dist: {
              src: '<%= concat.dist.dest %>',
              dest: 'public/js/quiz.min.js'
          }
      },
      jshint: {
          options: {
              node: true,
              curly: true,
              eqeqeq: true,
              immed: true,
              latedef: true,
              newcap: true,
              noarg: true,
              sub: true,
              undef: true,
              unused: true,
              eqnull: true,
              browser: true,
              globals: { jQuery: true },
              boss: true
          },
          gruntfile: {
              src: 'gruntfile.js'
          },
          source: {
              src: ['public/js/src/*.js', 'public/js/src/**/*.js']
          }
      },
      watch: {
          gruntfile: {
              files: '<%= jshint.gruntfile.src %>',
              tasks: ['jshint:gruntfile']
          },
          assets: {
              files: ['<%= concat.dist.src %>', 'public/scss/theme.scss'],
              tasks: ['default']
          }
      },
      sass: {
        theme: {
          files: {
            'public/css/theme.css': 'public/scss/theme.scss'
          },
          options: {
            style: 'compressed'
          }
        }
      }
    });

    // These plugins provide necessary tasks
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');

    // Default task
    grunt.registerTask('default', ['jshint:source', 'concat', 'uglify', 'sass']);
};
