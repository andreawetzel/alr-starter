# ALR WordPress Starter Theme

A WordPress theme based on http://underscores.me with custom CSS some components removed. 

## Getting Started
- Install theme in wp-content/themes directory
- `npm install` inside of folder
- Use gulp tasks below to transpile Sass partials 

## Gulp Tasks Included
- `gulp sass` (run sass once)
- `gulp sasswatch` (watch + sass but no broserify)
- `gulp watch` (browserify + sass)

### To speed up front end development  
- view source on your WordPress page and copy the code
- change your absolute links to relative links for JS and CSS files
- Paste it into styles.html or another html file and view using browserify (for example:  http://localhost:3000/styles.html )
