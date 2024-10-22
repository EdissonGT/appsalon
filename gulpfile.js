import gulp from 'gulp';
import dartSass from 'sass';
import gulpSass from 'gulp-sass';
import autoprefixer from 'autoprefixer';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import cssnano from 'cssnano';
import concat from 'gulp-concat';
import terser from 'gulp-terser';
import rename from 'gulp-rename';
import imagemin from 'gulp-imagemin';
import notify from 'gulp-notify';
import cache from 'gulp-cache';
import clean from 'gulp-clean';
import webp from 'gulp-webp';

const { src, dest, watch, series, parallel } = gulp;
const sass = gulpSass(dartSass);

const paths = {
  scss: 'src/scss/**/*.scss',
  js: 'src/js/**/*.js',
  imagenes: 'src/img/**/*'
};

// Función para compilar CSS
export function css() {
  return src(paths.scss)
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('.'))
    .pipe(dest('public/build/css'));
}

// Función para minificar JavaScript
export function javascript() {
  return src(paths.js)
    .pipe(terser())
    .pipe(sourcemaps.write('.'))
    .pipe(dest('public/build/js'));
}

// Función para optimizar imágenes
export function imagenes() {
  return src(paths.imagenes)
    .pipe(cache(imagemin({ optimizationLevel: 3 })))
    .pipe(dest('public/build/img'))
    .pipe(notify({ message: 'Imagen Completada' }));
}

// Función para convertir imágenes a WebP
export function versionWebp() {
  return src(paths.imagenes)
    .pipe(webp())
    .pipe(dest('public/build/img'))
    .pipe(notify({ message: 'Conversión a WebP Completada' }));
}

// Función para observar cambios en los archivos
export function watchArchivos() {
  watch(paths.scss, css);
  watch(paths.js, javascript);
  watch(paths.imagenes, imagenes);
  watch(paths.imagenes, versionWebp);
}




// Tareas que pueden ser ejecutadas desde la terminal
export const build = parallel(css, javascript, imagenes, versionWebp);
export const dev = series(build, watchArchivos);

// Tarea por defecto
export default dev;
