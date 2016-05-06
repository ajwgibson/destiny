//Gruntfile
module.exports = function(grunt) {

  //Initializing the configuration object
  grunt.initConfig({

    copy: {
      fonts: {
        expand: true,
        src: ['bower_components/bootstrap/fonts/*'],
        dest: 'public/assets/fonts',
        filter: 'isFile',
        flatten: true
      }
    },

    less: {
      development: {
        options: {
          compress: false,
        },
        files: {
          "./public/assets/stylesheets/frontend.css": "./app/assets/stylesheets/frontend.less",
          "./public/assets/stylesheets/admin.css": "./app/assets/stylesheets/admin.less",
          "./public/assets/stylesheets/registration.css": "./app/assets/stylesheets/registration.less",
        }
      }
    },

    concat: {
      options: {
        separator: ';',
      },
      js_frontend: {
        src: [
          './bower_components/jquery/dist/jquery.js',
          './bower_components/bootstrap/dist/js/bootstrap.js',
          './app/assets/javascript/frontend.js'
        ],
        dest: './public/assets/javascript/frontend.js',
      },
      js_admin: {
        src: [
          './bower_components/jquery/dist/jquery.js',
          './bower_components/bootstrap/dist/js/bootstrap.js',
          './app/assets/javascript/admin.js'
        ],
        dest: './public/assets/javascript/admin.js',
      },
      js_registration: {
        src: [
          './bower_components/jquery/dist/jquery.js',
          './bower_components/bootstrap/dist/js/bootstrap.js',
          './app/assets/javascript/registration.js'
        ],
        dest: './public/assets/javascript/registration.js',
      },
    },

    uglify: { 
      options: {
        mangle: false  // Use if you want the names of your functions and variables unchanged
      },
      frontend: {
        files: {
          './public/assets/javascript/frontend.js': './public/assets/javascript/frontend.js',
        }
      },
      admin: {
        files: {
          './public/assets/javascript/admin.js': './public/assets/javascript/admin.js',
        }
      },
      registration: {
        files: {
          './public/assets/javascript/registration.js': './public/assets/javascript/registration.js',
        }
      },
    },

    watch: {
      js_frontend: {
        files: [
          //watched files
          './bower_components/jquery/jquery.js',
          './bower_components/bootstrap/dist/js/bootstrap.js',
          './app/assets/javascript/frontend.js'
          ],   
        tasks: ['concat:js_frontend','uglify:frontend'],
        options: {
          livereload: true
        }
      },
      js_admin: {
        files: [
          './bower_components/jquery/jquery.js',
          './bower_components/bootstrap/dist/js/bootstrap.js',
          './app/assets/javascript/admin.js'
        ],   
        tasks: ['concat:js_admin','uglify:admin'],
        options: {
          livereload: true
        }
      },
      js_registration: {
        files: [
          './bower_components/jquery/jquery.js',
          './bower_components/bootstrap/dist/js/bootstrap.js',
          './app/assets/javascript/registration.js'
        ],   
        tasks: ['concat:js_registration','uglify:registration'],
        options: {
          livereload: true 
        }
      },
      less: {
        files: ['./app/assets/stylesheets/*.less'],
        tasks: ['less'],
        options: {
          livereload: true
        }
      },
    }
    
  });

  // Plugin loading
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-copy');

  // Task definition
  grunt.registerTask('default', ['less', 'concat', 'copy']);
  grunt.registerTask('deploy',  ['less', 'concat', 'uglify', 'copy']);

};