module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    uglify: {
      options: {
        sourceMap: false,
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n',
        compress: {
          drop_console: false
        }
      },
      public: {
        files: {
          'public/js/reframer-public.min.js':
          [
            'public/js/src/reframe.js',
            'public/js/src/main.js'
          ]
        }
      },
      admin: {
        files: {
          'admin/js/reframer-admin.min.js':
          [
            'admin/js/src/jquery.tagsinput.js',
            'admin/js/src/main.js'
          ]
        }
      }
    },
    cssmin: {
      options: {
        shorthandCompacting: false,
        roundingPrecision: -1
      },
      public: {
        files: {
          'public/css/reframer-public.min.css': [
            'public/css/src/reframe.css'
          ]
        }
      },
      admin: {
        files: {
          'admin/css/reframer-admin.min.css': [
            'admin/css/src/jquery.tagsinput.css',
          ]
        }
      }
    }

  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-cssmin');

  // Default task(s).
  grunt.registerTask('default', ['uglify', 'cssmin']);

};
