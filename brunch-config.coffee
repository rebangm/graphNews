'use strict'
exports.config =

  modules:
    definition: false
    wrapper: false
  paths:
    'public': 'web'
    'watched': [ 'app/Resources','src/']
  files:
    javascripts: joinTo:
      'js/application.js': [/^app\/Resources\/(?!external)/, /^src\//]
      'js/bootstrap.js': /^app\/Resources\/external\/bootstrap-3.3.5-dist\/js.*.min.js/
      'js/external.js': /^app\/Resources\/external.*.min.js/
      'js/vendor.js': /^vendor/

    stylesheets: joinTo:
      'css/front.css': [/^app\/Resources\/(?!external).*\/front/,/^src\/.*(Front)/]
      'css/application.css': [/^app\/Resources\/(?!external).*\/manager/,/^src\//]
      'css/vendor.css': /^(vendor)/
      'css/bootstrap.css': /^app\/Resources\/external\/bootstrap-3.3.5-dist\/css.*.min.css/
  conventions:
    ignored: [
      /\/_/,
      /bootstrap(-theme)?.css(.map)?/,
      /(bootstrap|npm).js/
    ]

  plugins:
    assetsmanager:
      copyTo:
        'fonts' : ['app/Resources/external/bootstrap-3.3.5-dist/fonts/*']
    babel: pattern: /\.(js|jsx)$/
    sass: allowCache: true
    uglify:
      mangle: true
      compress: global_defs: DEBUG: false
    cleancss:
      keepSpecialComments: 0
      removeEmpty: true
  overrides: production:
    optimize: true
    sourceMaps: false
    plugins: autoReload: enabled: false