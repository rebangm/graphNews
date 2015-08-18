'use strict'
exports.config =
  paths:
    'public': 'web'
    'watched': [ 'app/Resources','src/' ]
  files:
    javascripts: joinTo:
      'js/app.js': [/^app\/Resources\/(?!external)/, /^src\//]
      'js/external.js': /^app\/Resources\/external.*.min.js/
      'js/vendor.js': /^vendor/

    stylesheets: joinTo:
      'css/style.css': [/^app\/Resources\/(?!external)/,/^src\//]
      'css/vendor.css': /^(vendor)/
      'css/bootstrap.css': /^app\/Resources\/external\/bootstrap-3.3.5-dist\/css.*.min.css/
  conventions:
    ignored: [
      /\/_/,
      /bootstrap(-theme)?.css(.map)?/,
      /(bootstrap|npm).js/
    ]
    assets: /^app\/Resources\/assets/
  plugins:
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