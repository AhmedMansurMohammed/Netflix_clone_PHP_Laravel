import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
          // Agrega un alias para Bootstrap
          'bootstrap': 'bootstrap/dist/css/bootstrap.min.css',
          'datatables': 'datatables.net-dt/css/dataTables.dataTables.min.css',
          // Add an alias for Bootstrap JavaScript
          'bootstrap-js': 'bootstrap/dist/js/bootstrap.min.js',
        },
      },
    build: {
      outDir: 'dist', // Ensure this is correctly set to 'dist'
    },
});
