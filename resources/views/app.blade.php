<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite([
        'resources/sass/app.scss',
        'resources/js/app.ts',
    ])
    @routes
    @inertiaHead
  </head>
  <body>
    @inertia

    <div id="modals" class="relative z-20"></div>
  </body>
</html>
